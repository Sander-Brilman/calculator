<?php
require_once('assets/php/load_files.php');


// syntax for each separate calculation, Datatypes must be the default

// format: number datatype[power] operator number datatype[power]


// dump(calculate_string('( ( 2000 cm1 + 100 dm1 ) * 100 mm1 + ( 66 km2 - 88 dcm2 + 1 hm2 ) ) / 10 m1 | m1'). ' m1');

// dump((new meter(10, 1))->divide(new second(2)));

// dump((new kilogram(10))->divide(new second(2)));


// dump((new second(10))->divide(new kilogram(2)));



//                   [date]T[time]-[offset]   
//                   yyyy-mm-ddThh:mm:ss-hh:mm
// date time format: 1996-12-19T16:39:57-08:00
// 
$show_list = true;

if ($show_list) {
    echo '<pre>';
    foreach (calculator_error::$error_messages as $type => $messages) {
        echo '--------------<br>';
        echo "     $type<br>";
        echo '--------------<br>';
        foreach ($messages as $code => $lang_array) {
            echo "$type$code<br>";
            foreach ($lang_array as $lang => $text) {
                echo "    $lang: $text<br>";
            }
            echo '<br>';
        }
    }
    echo '</pre>';
}

$m = new meter(10, 2);

dump(str_to_full_date_string('12-12-2022'));

try {
    dump($m->convert_to('cm1'));
} catch (calculator_error $er) {
    dump($er->get_error_message());
}


// $datetime = new DateTime('1990-12-31T23:59:60Z');
// dump($datetime);


// $datetime = new DateTime('1996-12-19T16:39:57-08:00');
// dump($datetime);


// $datetime = new DateTime('1996-12-19T16:39:57+e08:00');
// dump($datetime);


?>

