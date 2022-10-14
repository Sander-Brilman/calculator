<?php
require_once('assets/php/load_files.php');


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


try {
    // dump($m->convert_to('cm1'));
    dump(str_to_full_date_string('12-12-2022'));
    dump(str_to_full_date_string('12-12-2022 12:00'));
    dump(str_to_full_date_string('12-12-2022 1:2 +200'));
    dump(str_to_full_date_string('3:30 12-12-2022'));



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

