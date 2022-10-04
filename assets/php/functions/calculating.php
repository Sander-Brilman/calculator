<?php

function calculate_string(string $full_calculate_string)
{
    /**
     * Takes the parsed string and calculates the result. The given string must be fully formatted & parsed.
     * Will throw Exceptions on error.
     * 
     * Syntax:
     * [calculation] | [return datatype] | [number of decimals]
     * 
     * @param string $full_calculate_string The full formatted & parsed string
     * 
     * @return mixed The converted result of the calculation.
     */
    $splitted_string  = explode(' | ', $full_calculate_string);

    $return_type = $splitted_string[1];
    $decimal_places = $splitted_string[2];

    $sum_string        = $splitted_string[0];
    $sum_array         = str_to_sum_array($sum_string);

    $calculating_history = [];

    // replace [value] [datatype] pair with datatype objects
    $sum_array = set_datatypes_recursive($sum_array);

    // calculate the converted array in appropriate order
    $result_datatype = calculate_array_recursive($sum_array, $calculating_history);

    // dump history (debugging)
    // dump($sum_string);
    // dump($calculating_history);

    // convert to requested datatype
    $result = $result_datatype->convert_to($return_type);

    return round($result, $decimal_places);
}

function str_to_sum_array(string $sum_string): array
{
    /**
     * split sum on the spaces.
     * Divides parts into nested arrays if brackets they are wrapped in round brackets
     * 
     * @param string $sum_string the full parsed sum string
     * 
     * @return array A new multidimensional array with the sum splitted
     */
    $sum_array      = explode(' ', $sum_string);

    do {
        $sum_length     = sizeof($sum_array);
        $open_bracket   = null;

        for ($index = 0; $index < $sum_length; $index++) {
            $char = $sum_array[$index];

            if ($char == '(') {
                $open_bracket = $index;
            } else if ($char == ')') {
                unset($sum_array[$index]);
                $sum_array[$open_bracket] = array_splice($sum_array, $open_bracket + 1, $index - 1 - $open_bracket);
                break;
            }
        }

        $sum_array = array_values($sum_array);
    } while ($open_bracket !== null);
    
    return $sum_array;
}

function set_datatypes_recursive(array $array): array
{
    /**
     * Convert array with [value] [datatype] pair to datatype object
     * Is used recursively to make sure all nested arrays are converted
     * 
     * @param array $array The array to preform the conversion on
     * 
     * @return array A new array with [value] [datatype] pair replaced with corresponding objects
     */
    $operators = [
        '^',   
        '*',
        '/',    
        '+',
        '-',
        '%',
    ];
    $value          = '';
    $array_length   = sizeof($array);
    for ($index = 0; $index < $array_length; $index++) {
        $array_item = $array[$index];

        if (is_array($array_item)) {
            // recursive replacement
            $array[$index] = set_datatypes_recursive($array_item);
        } else if (!in_array($array_item, $operators)) {

            if ($value == '') {
                $value = $array_item;
                continue;
            }
            
            // unset keys & replace with the object
            unset($array[$index - 1]);
            $array[$index] = str_to_datatype($value, $array_item);

            $value = '';
        }
    }
    $array = array_values($array);
    return $array;
}

function str_to_datatype(string $value, string $datatype_string): datatype
{
    /**
     * Takes a [value] [datatype] pair in string format and returns a single datatype object.
     * Will throw Exceptions on converting errors.
     * 
     * @param string $value The value that belongs to the datatype
     * @param string $datatype_string The datatype you want the value in
     * 
     * @return datatype A new datatype object with the value set
     */

    // number
    if ($datatype_string == 'number') {
        if (!is_numeric($value)) {
            throw new Exception('Cannot convert '.$value.' to datatype number: value is not numeric', 1);
        }

        return new number($value);
    }

    // meters
    global $meter_units;
    foreach ($meter_units as $unit) {
        if (str_starts_with($datatype_string, $unit) && is_numeric(substr($datatype_string, strlen($unit)))) {
            $exponent = (int)str_replace($unit, '', $datatype_string);
            return new meter(meter_conversion($value, $datatype_string, 'm'.$exponent), $exponent);
            break;
        }
    }

    // seconds
    switch ($datatype_string) {
        case 'sec':
            return new second($value);
            break;
        case 'min':
            return new second($value * 60);
            break;
        case 'hrs':
            return new second(($value * 60) * 60);
            break;
        case 'day':
            return new second((($value * 24) * 60) * 60);
            break;
        case 'w':
            return new second(((($value * 7) * 24) * 60) * 60);
            break;
    }
    
    throw new Exception($datatype_string.' is not a valid datatype', 1);

}

function calculate_array_recursive(array $array, array &$history): datatype
{
    /**
     * Calculates nested arrays datatypes recursively and will return a single result datatype
     * 
     * @param array $array The array to calculate
     * @param array &$history The array where the history of all calculations will be kept
     * 
     * @param datatype The result datatype object from all the calculation within the given array
     */
    $limit_counter = 0;
    $operators_priority = [
        '^' => 4,   
        '*' => 3,
        '/' => 3,    
        '+' => 2,
        '-' => 2,
        '%' => 1,
    ];

    while (sizeof($array) > 1 || is_array($array[0])) {

        $array_length = sizeof($array);
        $highest_operator = null;

        // get highest operator
        for ($index = 0; $index < $array_length; $index++) { 
            $array_item = $array[$index];

            if (is_array($array_item)) {

                $array[$index] = calculate_array_recursive($array_item, $history);

            } else if ((is_string($array_item) && isset($operators_priority[$array_item])) && $highest_operator === null)
            {
                $highest_operator = $index;
            }
        }

        // replace the [datatype] [operator] [datatype] with the result datatype object
        if ($highest_operator !== null) {

            $object_1 = $array[$highest_operator - 1];
            $object_2 = $array[$highest_operator + 1];
            $operator = $array[$highest_operator];

            $return = $object_1->execute_operation($operator, $object_2);

            unset($array[$highest_operator - 1]);  
            unset($array[$highest_operator + 1]);

            $array[$highest_operator] = $return;

            $array = array_values($array);

            // keep track of history
            $history[] = $object_1->value.' '.$object_1->datatype_name.' '.$operator.' '.$object_2->value.' '.$object_2->datatype_name.' = '.$return->value.' '.$return->datatype_name;
        }

        // Prevent infinite loop in case of error
        if ($limit_counter > 200) {

            throw new Exception('Safety limit reached for calculate_array_recursive function', 1);
            exit;

        }

        $limit_counter++;

    }

    return $array[0];
}


?>