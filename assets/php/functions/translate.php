<?php
function translate_string(string $input, string $translate_to): string
{
    $search = [
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

        // other
        'true',
        'false',
    ];

    $replace = [
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

            // other
            'waar',
            'niet waar',
        ],

        'en' => &$search,
    ];

    return str_replace($search, $replace[$translate_to], $input);
}

?>