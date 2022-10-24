<?php
function calculate_string(string $full_calculate_string)
{
    /**
     * Takes the parsed string and calculates the result. The given string must be fully formatted & parsed.
     * 
     * Syntax:
     * [calculation] | [return datatype] | [number of decimals]
     * 
     * @throws calculator_error
     * 
     * @param string $full_calculate_string The full formatted & parsed string
     * 
     * @return mixed The converted result of the calculation.
     */
    $splitted_string  = explode(' | ', $full_calculate_string);

    $return_type = $splitted_string[1];
    $decimal_places = $splitted_string[2];

    if ($decimal_places > 14) {
        throw new general_error(2);
    }

    $sum_string        = $splitted_string[0];
    $sum_array         = str_to_sum_array($sum_string);

    $calculating_history = [];

    // replace [value] [datatype] pair with datatype objects
    $sum_array = set_datatypes_recursive($sum_array, $calculating_history);

    $sum_array = replace_number($sum_array, $calculating_history);


    // calculate the converted array in appropriate order
    $result_datatype = calculate_array_recursive($sum_array, $calculating_history);

    // print history for debugging
    dump($sum_string);
    dump($calculating_history);

    // convert to requested datatype
    $result = $result_datatype->convert_to($return_type);

    return number_format(round($result, $decimal_places), $decimal_places, '.', '');
}

function str_to_sum_array(string $sum_string): array
{
    /**
     * split sum on the spaces.
     * Divides parts into nested arrays if brackets they are wrapped in round brackets
     * 
     * @throws calculator_error
     * 
     * @param string $sum_string the full parsed sum string
     * 
     * @return array A new multidimensional array with the sum splitted
     */
    $sum_array = explode(' ', $sum_string);

    do {
        $sum_length = sizeof($sum_array);
        $open_bracket = null;

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

function set_datatypes_recursive(array $array, array &$history = []): array
{
    /**
     * Convert array with [value] [datatype] pair to datatype object
     * Is used recursively to make sure all nested arrays are converted
     * 
     * @throws calculator_error
     * 
     * @param array $array The array to preform the conversion on
     * @param array $history The array to store the history of the conversion in
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
            $array[$index] = set_datatypes_recursive($array_item, $history);
        } else if (!in_array($array_item, $operators)) {

            if ($value == '') {
                $value = $array_item;
                continue;
            }
            
            // unset keys & replace with the object
            unset($array[$index - 1]);
            $array[$index] = str_to_datatype($value, $array_item);

            // set history
            $history['conversion'][] = "$value $array_item -> ".$array[$index]->value.' '.$array[$index]->datatype_name;

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
     * 
     * @throws calculator_error
     * 
     * @param string $value The value that belongs to the datatype
     * @param string $datatype_string The datatype you want the value in
     * 
     * @return datatype A new datatype object with the value set
     */

    if (is_numeric($value)) {

        // meters
        foreach (meter::$meter_units as $unit) {
            if (str_starts_with($datatype_string, $unit) && is_numeric(substr($datatype_string, strlen($unit)))) {
                $exponent = (int)str_replace($unit, '', $datatype_string);
                return new meter(meter::meter_conversion($value, $datatype_string, 'm'.$exponent), $exponent);
                break;
            }
        }

        switch ($datatype_string) {
            //
            // number
            //
            case 'number':
                return new number($value);
                break;
            
            //
            // seconds
            //
            case 'ms':
                return new second($value * 1000);
                break;
            case 's':
                return new second($value);
                break;
            case 'min':
                return new second($value * 60);
                break;
            case 'h':
                return new second(($value * 60) * 60);
                break;
            case 'day':
                return new second((($value * 24) * 60) * 60);
                break;
            case 'w':
                return new second(((($value * 7) * 24) * 60) * 60);
                break;

            //
            // kilogram
            //
            case 'ng':
                return new kilogram($value / 1000000000000);
                break;
            case 'mcg':
            case 'μg':
                return new kilogram($value / 1000000000);
                break;
            case 'mg':
                return new kilogram($value / 1000000);
                break;
            case 'cg':
                return new kilogram($value / 100000);
                break;
            case 'dg':
                return new kilogram($value / 10000);
                break;
            case 'g':
                return new kilogram($value / 1000);
                break;
            case 'dcg':
                return new kilogram($value / 100);
                break;
            case 'hg':
                return new kilogram($value / 10);
                break;
            case 'kg':
                return new kilogram($value);
                break;
            case 't':
                return new kilogram($value * 1000);
                break;

            // liters
            case 'ml':
                return new meter(($value / 1000000), 3);
                break;
            case 'cl':
                return new meter(($value / 100000), 3);
                break;
            case 'dl':
                return new meter(($value / 10000), 3);
                break;
            case 'l':
                return new meter(($value / 1000), 3);
                break;
            case 'dal':
                return new meter(($value / 100), 3);
                break;
            case 'hl':
                return new meter(($value / 10), 3);
                break;
            case 'kl':
                return new meter($value, 3);
                break;
        }

        // derived_units
        if (strpos($datatype_string, '/') !== false) {
            $derived_unit_array = explode('/', $datatype_string);
            return new derived_unit($value, $derived_unit_array[0], $derived_unit_array[1]);
        }

        throw new convert_error(5, [$datatype_string]);
    } else {

        switch ($datatype_string) {
            //
            // datetime
            //
            case 'dt':
                return new calculator_datetime($value);
                break;

        }

        throw new convert_error(5, [$datatype_string]);
    }

}

function replace_number(array $calculation_array, array &$history): array
{
    /**
     * Calculates nested arrays datatypes recursively and will return a single result datatype
     * 
     * @throws calculator_error
     * 
     * @param array $array The array to calculate
     * @param array &$history The array where the history of all calculations will be kept
     * 
     * @param datatype The result datatype object from all the calculation within the given array
     */
    $search_operators = [ 
        '+' => 2,
        '-' => 2,
    ];


    foreach ($calculation_array as $index => $sum_part) {
        dump($sum_part);
    }


    return $calculation_array;
}

function calculate_array_recursive(array $array, array &$history): datatype
{
    /**
     * Calculates nested arrays datatypes recursively and will return a single result datatype
     * 
     * @throws calculator_error
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

            if ($index % 2 == 1) 
            {
                if (!is_string($array_item) || !isset($operators_priority[$array_item])) {
                    throw new general_error(3, []);
                }

                if (is_string($array_item) && $highest_operator === null)
                {
                    $highest_operator = $index;
                    continue;
                }
            } 
            
            if (is_array($array_item)) 
            {
                $array[$index] = calculate_array_recursive($array_item, $history);
            } 
        }

        // replace the [datatype] [operator] [datatype] with the result datatype object
        if ($highest_operator !== null) 
        {
            $object_1 = $array[$highest_operator - 1];
            $object_2 = $array[$highest_operator + 1];
            $operator = $array[$highest_operator];
            
            $return = $object_1->execute_operation($operator, clone $object_2);

            unset($array[$highest_operator - 1]);  
            unset($array[$highest_operator + 1]);

            $array[$highest_operator] = $return;

            $array = array_values($array);

            // keep track of history
            $history['calculation'][] = $object_1->value.' '.$object_1->datatype_name.' '.
                                        $operator.' '.
                                        $object_2->value.' '.$object_2->datatype_name.' = '.
                                        $return->value.' '.$return->datatype_name;
        }

        // Prevent infinite loop in case of error
        if ($limit_counter > 200) {

            throw new calculator_error('GE001', []);
            exit;

        }

        $limit_counter++;

    }

    return $array[0];
}


?>