<?php
require_once('assets/php/load_files.php');


$show_list = false;
// $show_list = true;

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



    dump(parse_calculating_string('(1 + (1 + ( 10 meter - -50 dm + 20))) / 4 sec * (23/10/2022 - nu) x (500 decimeter2 + 500 int) als cm2 met 2 decimalen'));
    // dump(parse_calculating_string('(1 + (1 + 20)) als cm2 met 2 decimalen'));

    dump(parse_calculating_string('500 kilometer \ (nu - 21/10/2022 12:00 +03:00) | km/d | 0'));

    dump(calculate_string('500 km1 / ( 2022-10-24T15:10:41+02:00 dt - 2022-10-21T12:00:00+03:00 dt ) | km1/d | 0'));

    // dump(calculate_string('( 1 number + ( 1 number + ( 10 m1 - -50 dm1 + 20 number ) ) ) / 4 s * ( 2022-10-23T00:00:00+02:00 dt - 2022-10-24T15:05:00+02:00 dt ) * ( 500 dm2 + 500 number ) | cm3 | 2'));

} catch (calculator_error $er) {
    dump($er->error_code. ' -> '. $er->get_error_message());
}

/*
problem explaination

-- converting int to number
10 ints
10 [int] => 10 number

-- converting num to number
10 number
10 [num]ber => numberber




*/

?>

