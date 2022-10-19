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

    
    $m = str_to_datatype(1, 'km1');
    $sec = str_to_datatype(1, 'h');

    $m->add($sec);

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

