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

    // dump(replace_synonyms('
    //     milimeter
    //     millimeter
    //     millimeters

    //     centimeter
    //     centimeters

    //     decimeter
    //     decimeters

    //     meter
    //     meters

    //     decameter
    //     dekameter
    //     dekameters
    //     decameters

    //     hectometer
    //     hectometers

    //     kilometer
    //     kilometers

    //     ----------

    //     date
    //     time
    //     date-time
    //     datum
    //     tijd
    //     datum-tijd

    //     ----------

    //     nanogram
    //     nanograms

    //     microgram
    //     microgrammen
    //     micrograms

    //     milligram
    //     milligrammen
    //     milligrams

    //     centigram
    //     centigrammen
    //     centigrams

    //     decigram
    //     decigrammen
    //     decigrams

    //     gram
    //     gram
    //     grams

    //     decagram
    //     decagrammen
    //     dekagram
    //     decagrams
    //     dekagrams

    //     hectogram
    //     hectogrammen
    //     hectograms

    //     kil 
    //     kilogram 
    //     kilogrammen 
    //     kilograms 
        
    //     ton
    //     tonnen

    //     ----------

    //     int
    //     integer
    //     num 
    //     getal
    //     getallen
    //     numbers
        
    //     ----------

    //     milliseconds
    //     milliseconden
    //     millisec

    //     sec
    //     seconden
    //     seconds

    //     minutes
    //     minuten

    //     hour
    //     hours
    //     uur
    //     uren

    //     days
    //     dag
    //     dagen

    //     week
    //     weeks
    //     weken
    // '));
    

    dump(parse_calculating_string('( 10 meter - -50 dm ) / 4 sec * 10 seconds * (500 dm2 + 500 int) als cm2 met 2 decimalen'));

    // dump(second::convert_synonyms('sec'));

} catch (calculator_error $er) {
    dump($er->get_error_message());
}

/*
problem explaination

-- converting int to number
10 int
10 [int] => 10 number

-- converting num to number
10 number
10 [num]ber => numberber




*/

?>

