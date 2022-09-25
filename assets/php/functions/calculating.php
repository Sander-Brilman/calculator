<?php
<<<<<<< HEAD:assets/php/functions/calculating.php
function process_table_request()
=======



function process_string_request()
>>>>>>> dad8ef153e9fe83750f70e70a38a26d1e3410f14:assets/php/functions.php
{
    /**
     * Handles the request for table calculations
     * 
     * Includes error handeling & input validation
     */
<<<<<<< HEAD:assets/php/functions/calculating.php
    
    for ($i = 1; $i <= 4; $i++) { 
        if (!isset($_REQUEST['cell'.$i])) {
            return_error('Cell '.$i.' is missing');
        }
=======

    // set_error_handler('exceptions_error_handler');

    // function exceptions_error_handler($severity, $message, $filename, $lineno) {
    //     if (error_reporting() == 0) {
    //         return;
    //     }
    //     if (error_reporting() & $severity) {
    //         throw new ErrorException($message, 0, $severity, $filename, $lineno);
    //     }
    // }


    error_reporting(E_ERROR | E_PARSE);


    if (!isset($_REQUEST['sum'])) {
        request_error('No sum given to calculate');
>>>>>>> dad8ef153e9fe83750f70e70a38a26d1e3410f14:assets/php/functions.php
    }

    $cell1 = comma_to_dot($_REQUEST['cell1']);
    $cell2 = comma_to_dot($_REQUEST['cell2']);
    $cell3 = comma_to_dot($_REQUEST['cell3']);
    $cell4 = comma_to_dot($_REQUEST['cell4']);

    function table_calculation($multiply1, $multiply2, $divide)
    {
        return ($multiply1 * $multiply2) / $divide;
    }

    switch (null) {
        case $cell1:
            $answer = table_calculation($cell2, $cell3, $cell4);
            break;
        case $cell2:
            $answer = table_calculation($cell1, $cell4, $cell3);
            break;
        case $cell3:
            $answer = table_calculation($cell1, $cell4, $cell2);
            break;
        case $cell4:
            $answer = table_calculation($cell2, $cell3, $cell1);
            break;
        default:
            $answer = 'No empty cells';
            break;
    }

<<<<<<< HEAD:assets/php/functions/calculating.php
    return_response('success', $answer, ['answer' => $answer]);
=======
function process_table_request()
{
    /**
     * Handles the request for table calculations
     * 
     * Includes error handeling & input validation
     */

    for ($i = 1; $i <= 4; $i++) { 
        if (!isset($_REQUEST['cell'.$i])) {
            request_error('Cell '.$i.' is missing');
        }
    }

    $answer = calculate_missing_value(
        $_REQUEST['cell1'],
        $_REQUEST['cell2'],
        $_REQUEST['cell3'],
        $_REQUEST['cell4'],
    );

    request_response('success', $answer, ['answer' => $answer]);
>>>>>>> dad8ef153e9fe83750f70e70a38a26d1e3410f14:assets/php/functions.php
}

function calculate_string_old(string $sum)
{
    /**
     * MEDICAL ADVICE:
     * Don't attempt to read/edit this code. It will be at the cost of your mental health
     * 
     * does the actual calculating of the sum
     */
    
    try {

        $valid_caractars = array(//lijst met geldige operators
            '(',
            ')',
            '^' => 4,   
            '*' => 3,
            '/' => 3,    
            '+' => 2,
            '-' => 2,
            '%' => 1,
        );
    
        $opening_haakje = 0;
    
        $rekensom = '(' . $sum . ')';
    
        // replace characters
        $rekensom = str_replace(' ', '', $rekensom); 
        $rekensom = str_replace('**', '^', $rekensom);
        $rekensom = str_replace(')', ' )', $rekensom);
        $rekensom = str_replace('(', '( ', $rekensom);
        $rekensom = str_replace(':', '/', $rekensom);
        $rekensom = str_replace('x', '*', $rekensom);
        $rekensom = str_replace('X', '*', $rekensom);
        $rekensom = str_replace(',', '.', $rekensom);
    
        $rekensom = str_replace('*', ' * ', $rekensom);
        $rekensom = str_replace('^', ' ^ ', $rekensom);
        $rekensom = str_replace('/', ' / ', $rekensom);
        $rekensom = str_replace('%', ' % ', $rekensom);
        $rekensom = str_replace('+', ' + ', $rekensom);
        $rekensom = str_replace('-', ' - ', $rekensom);
    
        $rekensom = str_replace(PHP_EOL, '', $rekensom);
    
        $totale_array = explode(' ', $rekensom);
    
        $teller = 0;
        foreach ($totale_array as $current_caracter) {//loop through the array and remove cells that are not valid
    
            $valid = false;
    
            foreach ($valid_caractars as $current_valid_caracter => $value) {
    
                if (!is_numeric($current_caracter)) {
    
                    if ($current_caracter == $current_valid_caracter) {
    
                        $valid = true;
    
                    }
    
                } else {
    
                    $valid = true;
    
                }
    
            }
    
            if ($valid == false) {
    
                unset($totale_array[$teller]);
    
                $totale_array = array_values($totale_array);
    
            } else {
    
                $teller++;
    
            }
    
        }
    
        function opdracht($valid_caractars, $huidige_array) {//de functie van het bepalen van de opdracht die moet worden uitgevoert.
    
            $opdrachten = array();
    
            $counter = 0;
            foreach ($huidige_array as $onderdeel) {
                if ($onderdeel != '(' && $onderdeel != ')') {
                    if (isset($valid_caractars[$onderdeel])) {
                        $opdrachten["$onderdeel->$counter"] = $valid_caractars[$onderdeel];
                    }
                }
                $counter++;
            }
    
            arsort($opdrachten);
    
            $repeat = true;
            foreach ($opdrachten as $name => $value) {
                if ($repeat) {
                    return explode('->', $name);
                }
            }
    
        }
    
        $huidige_array = $totale_array;
        $ophalen = false;
    
        do {//loop for solving the calculations
    
            for ($teller = 0; $teller <= sizeof($totale_array); $teller++) {// search for brackets
    
                $weghalen = false;
    
                if ($ophalen == true) {//get data from total list to current list
    
                    $huidige_array[] = $totale_array[$teller];
    
                }    
    
                if (isset($totale_array[$teller]) && $totale_array[$teller] == '(') {//when opening bracket is found
    
                    $opening_haakje = $teller;
                    $huidige_array = array(// reset current list
                        '(',
                    );
                    $ophalen = true;
    
                } elseif (isset($totale_array[$teller]) && $totale_array[$teller] == ')') {// when closing bracket has been found
    
                    $sluiting_haakje = $teller;
                    $ophalen = false;
    
                    do {//de loop voor de sommen oplossen in 1 haakjes
    
                        $opdracht = opdracht($valid_caractars, $huidige_array);
    
                        $locatie = $opdracht[1];
    
                        $getal1 = $huidige_array[$locatie - 1];
                        $getal2 = $huidige_array[$locatie + 1];
    
                        if ($opdracht[0] == '*') {//als het een keer opdracht is
                            $andwoord = $getal1 * $getal2;
                        } elseif ($opdracht[0] == '/') {//als het een gededeeld door opdracht is
                            $andwoord = $getal1 / $getal2;
                        } elseif ($opdracht[0] == '+') {//als het een plus opdracht is
                            $andwoord = $getal1 + $getal2;
                        } elseif ($opdracht[0] == '-') {// als het een min opdracht is
                            $andwoord = $getal1 - $getal2;
                        } elseif ($opdracht[0] == '%') {
                            $andwoord = ($getal1 * $getal2) / 100;
                        } elseif ($opdracht[0] == '^') {
                            $andwoord = $getal1 ** $getal2;
                        }
    
                        //haal de som van de huidige lijst weg
                        unset($huidige_array[$locatie + 1]);
                        unset($huidige_array[$locatie - 1]);
                        $huidige_array[$locatie] = $andwoord;
    
                        $huidige_array = array_values($huidige_array);
    
                        $weghalen = true;
    
                    } while (sizeof($huidige_array) > 3);
    
                    if ($weghalen == true) {// remove brackets from total list
    
    
                        $totale_array[$sluiting_haakje] = $andwoord;
    
                        for ($i = $opening_haakje; $i <= $sluiting_haakje - 1; $i++) {
    
                            unset($totale_array[$i]);
    
                        }
    
                        $totale_array = array_values($totale_array);
    
                        $teller = -1;
    
                    }
    
                }
    
            }
    
        } while (sizeof($totale_array) > 3);
    
        return $andwoord;

    } catch (Error $e) {

        return_error('Incorrecte som opgegeven');

    } catch (Exception $ex) {

        return_error('Incorrecte som opgegeven');

    }


}

function calculate_string(string $full_calculate_string)
{
    $splitted_string = explode(' as ', $full_calculate_string);

    $sum = $splitted_string[0];
    $return_type = $splitted_string[1];

    $operators_priority = [
        '^' => 4,   
        '*' => 3,
        '/' => 3,    
        '+' => 2,
        '-' => 2,
        '%' => 1,
    ];


    $sum_array = explode(' ', $sum);
    dump($sum_array);


    $counter = 0 ;
    while (sizeof($sum_array) > 5 && $counter < 32) {
        $sum_length = sizeof($sum_array);
        $highest = null;

        for ($index = 0; $index < $sum_length; $index++) { 
            $value = $sum_array[$index];
    
            if (!is_array($value) && isset($operators_priority[$value])) {
                if ($highest === null || $operators_priority[$value] > $highest) {
                    $highest = $index;
                }
            }
        }
    
        if ($highest !== null) {

            $sum_part = [
                $sum_array[$highest - 2],
                $sum_array[$highest - 1],
                $sum_array[$highest],
                $sum_array[$highest + 1],
                $sum_array[$highest + 2],
            ];
        
            unset($sum_array[$highest - 2]);
            unset($sum_array[$highest - 1]);    
            unset($sum_array[$highest + 2]);
        
            $sum_array[$highest] = $sum_part;
            $sum_array[$highest + 1] = get_return_type($sum_part);

    
            $sum_array = array_values($sum_array);
        }
        $counter++;

        dump($sum_array);

    }
}

function get_return_type(array $sum_part): string
{
    /**
     * Get the return datatype of a sum_part
     * 
     * @param array $sum_array the sum to get the return value from, must follow the sum_part format.
     * 
     * @return string
     */

    $type1 = $sum_part[1];
    $type2 = $sum_part[4];

    $power_of_units = [

    ];


    return '';


}

function get_power_of_from_datatype(string $datatype): int {
    return str_replace(']', '', explode('[', $datatype)[1]);
}
?>