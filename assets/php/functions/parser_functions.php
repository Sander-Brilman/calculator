<?php

function parse_calculating_string(string $string): string
{
    /**
     * Parses a user inputted string into a string readable for the calculating function
     * 
     * @throws calculator_error throws calculator_errors when the this cannot be parsed either due invalid syntax or invalid values
     * 
     * @param string $string the string to be parsed
     * 
     * @return string the parsed string ready to be calculated
     */
    $parsed_split_sum  = [];
    $control_characters = [
        '(',
        ')',
        '^',   
        '*',
        '/',    
        '+',
        '-',
        '%',
    ]; 

    $search_replace = [
        '(' => ' ( ',
        ')' => ' ) ',
        ' met ' => ' with ',
        'decimalen' => ' decimals ',
        ' als ' => ' as ',
        'naar' => ' as ',
        '->' => ' as ',
        '=>' => ' as ',

        // synonym operators
        ' x ' => ' * ',
        ' ** ' => ' ^ ',
        ' \ ' => ' / ',

        // constants
        ' nu ' => ' now ' ,
        ' vandaag ' => ' now ',

        // other
        'decimals' => '',
        ' as ' => ' | ',
        ' with ' => ' | ',
    ];


    // make sure all brackets are wrapped with spaces around them
    $string = str_replace_with_array($search_replace, $string);

    // replace synonyms into strings the calculator can understand
    $string = replace_synonyms($string);

    for ($i=0; $i < 5; $i++) { 
        $string = str_replace('  ', ' ', $string);
    }

    $string = trim($string);

    //
    // create valid calculator syntax from user input
    //
    $items_between  = [];
    $split_string   = explode(' | ', $string);
    $split_sum      = explode(' ', $split_string[0]);
    $return_type    = $split_string[1];
    $decimals       = $split_string[2];
    foreach ($split_sum as $current_index => $sum_part) {

        if (in_array($sum_part, $control_characters) || $current_index == sizeof($split_sum) - 1) {

            $items_count = sizeof($items_between);
            $items_joined = implode(' ', $items_between);
            if ($items_count > 0) {
                
                $value = '';
                $datatype = '';
                if ($items_count == 1) {
                    if (is_numeric($items_joined)) {
                        $value = $items_joined;
                        $datatype = 'number';
                    } else {
                        try {
                            $value = calculator_datetime::str_to_full_date_string($items_joined);
                            $datatype = 'dt';
                        } catch (calculator_error $er) {
                            throw new parser_error(1, [$items_joined]);
                        }
                    }
                } else if ($items_count == 2) {
                    $value = $items_between[0];
                    $datatype = $items_between[1];
                } else {
                    if ($items_between[$items_count - 1] == 'dt') {
                        $value = calculator_datetime::str_to_full_date_string(str_replace('dt', ' ', $items_joined));
                        $datatype = 'dt';
                    }

                    try {
                        $value = calculator_datetime::str_to_full_date_string($items_joined);
                        $datatype = 'dt';
                    } catch (calculator_error $er) {
                        throw new parser_error(1, [$items_joined]);
                    }
                }

                if (in_array($datatype, meter::$meter_units)) {
                    $datatype .= 1;
                }

                $parsed_split_sum[] = $value;
                $parsed_split_sum[] = $datatype;
            }

            // add control character to the array and reset value and datatype
            $parsed_split_sum[] = $sum_part;
            $items_between = [];
            continue;
        }

        $items_between[] = $sum_part;
    }

    return implode(' | ', [implode(' ', $parsed_split_sum), $return_type, $decimals]);
}

function replace_synonyms(string $input): string
{
    /**
     * Replace all synonyms of datatypes to the strings parsable by the calculator
     */
    global $full_synonym_list;

    return str_replace_with_array($full_synonym_list, $input);
}

function str_replace_with_array(array $key_value_array, string $subject): string
{
    /**
     * Uses a key value array in format search => replace to preform a string replacement
     * 
     * @param array $key_value_array the array with the key value pair in search => replace format
     */
    foreach ($key_value_array as $search => $replace) {
        $subject = str_replace($search, $replace, $subject);
    }

    return $subject;
}

?>