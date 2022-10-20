<?php
function translate_string(string $input, string $translate_from, string $translate_to): string
{
    $text = [
        'nl' => [
            // days
            'maandag',
            'dinsdag',
            'woensdag',
            'donderdag',
            'vrijdag',
            'zaterdag',
            'zondag',

            // months
            'januari',
            'februari', 
            'maart',
            'april',
            'mei',
            'juni',
            'juli',
            'augustus',
            'september',
            'oktober',
            'november',
            'december',

            // booleans
            'waar',
            'niet waar',
        ],

        'en' => [
            // days
            'Monday',
            'Tuesday',
            'Wednesday',
            'Thursday',
            'Friday',
            'Saturday',
            'Sunday',
    
            // months
            'January',
            'February',
            'march',
            'April',
            'May',
            'June',
            'July',
            'August',
            'September',
            'October',
            'November',
            'December',
    
            // booleans
            'true',
            'false',
        ],
    ];

    return str_replace($text[$translate_from], $$text[$translate_to], $input);
}

?>