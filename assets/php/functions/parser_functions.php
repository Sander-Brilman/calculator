<?php

function parse_calculating_string(string $string): string
{
    /**
     * Parses a user inputted string into a string readable for the calculating function
     */
    $string = str_replace([
            '(',
            ')',
            '  '
        ],
        [
            ' ( ',
            ' ) ',
            ' '
        ], 
        $string
    );

    $slit_sum = explode(' ', $string);

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

    // replace synonyms 
    foreach ($slit_sum as $sum_part) {
        if (is_numeric($sum_part) || in_array($sum_part, $control_characters)) {
            continue;
        }
        dump($sum_part);

    }


    return $string;
}

function replace_synonyms($input): string
{
    /**
     * Replace all synonyms of datatypes to the string parsable by the calculator
     */
    $timer = start_timer();

    $synonyms_collection = [
        calculator_datetime::$synonyms,
        meter::$synonyms,
        second::$synonyms,
        kilogram::$synonyms,
        number::$synonyms,
    ];

    $full_search_list = [];
    $full_replace_list = [];

    foreach ($synonyms_collection as $synonyms_array) {
        foreach ($synonyms_array as $replace => $search_array) {
            foreach ($search_array as $search) {
                $full_search_list[] = $search;
                $full_replace_list[] = $replace;
            }
        }
    }

    usort($array, function($a, $b) {
        return strlen($b) <=> strlen($a);
    });


    $input = str_replace($full_search_list, $full_replace_list, $input);

    echo end_timer($timer) . 'ms. end of timer';

    return $input;
}

?>