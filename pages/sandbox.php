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

    // dump(calculate_string(parse_calculating_string('1000 00 00 / (24/10/2022 12:00 +200 - nu) als cm3 met 2 decimalen')));
    // dump(calculate_string(parse_calculating_string('100 km + 50 + 2 / 10 seconden + 10 als number met 4 decimalen')));
    
    //dump(parse_calculating_string('woensdag 10 september 2021 - nu als ms met 2 decimalen'));
    //dump(calculate_string(parse_calculating_string('woensdag 10 september - nu met 2 decimalen')));


    $result = calculate_string('50 m1/s + 9 km1/h / 2 number * 3 number - 500 m1/min | m1/s | 1');
    $expected = 70.4;

    dump($result);
    dump($expected);

    //dump(calculate_string(parse_calculating_string('100 km / (today - today + 2 days) as km/h')));


    // dump((parse_calculating_string('(1 + (1 + ( 10 meter - -50 dm + 20))) / 4 sec * (23/10/2022 - nu) x (500 decimeter2 + 500 int) als cm3 met 2 decimalen')));
    // dump((parse_calculating_string('(1 + (1 + ( 10 meter - -50 dm + 20))) als number met 2 decimalen')));
    // dump(calculate_string(parse_calculating_string('(1 + (1 + ( 10 meter - -50 dm + 20))) / 4 sec * (23/10/2022 - nu) x (500 decimeter2 + 500 int) als cm3 met 2 decimalen')));
    // dump(parse_calculating_string('(1 + (1 + 20)) als cm2 met 2 decimalen'));

    // dump(parse_calculating_string('500 kilometer \ (nu - 21/10/2022 12:00 +03:00) 00 | km/dag | 0'));


    // dump(calculate_string('( 1 number + ( 1 number + ( 10 m1 - -50 dm1 + 20 number ) ) ) / 4 s * ( 2022-10-23T00:00:00+02:00 dt - 2022-10-24T15:05:00+02:00 dt ) * ( 500 dm2 + 500 number ) | cm3 | 2'));

} catch (calculator_error $er) {
    dump($er->error_code. ' -> '. $er->get_error_message('nl'));
}

?>

