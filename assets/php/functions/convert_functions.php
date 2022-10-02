<?php

function meter_conversion($value, string $from, string $to)
{
    /**
     * Can convert a meter unit (dm2, cm, km3) to another meter unit if it has the same exponent
     */
    global $meter_units;

    global $meter_units;
    foreach ($meter_units as $key => $unit) {
        if (str_starts_with($from, $unit) && is_numeric(substr($from, strlen($unit)))) {
            $from_index    = $key;
            $exponent_from = (int)str_replace($unit, '', $from);
        }

        if (str_starts_with($to, $unit) && is_numeric(substr($to, strlen($unit)))) {
            $to_index    = $key;
            $exponent_to = (int)str_replace($unit, '', $to);
        }
    }

    $index_difference = abs($from_index - $to_index);

    $return_value = $value;


    if ($exponent_from != $exponent_to) {
        throw new Exception('cant convert '.$from.' to '.$to.'. exponent values are not equal', 1);
    } else if ($exponent_to == 0) {
        return $value;
    }

    $multiply_number = 1;
    if ($exponent_to < 0) {
        for ($i = 0; $i > $exponent_to; $i--) { 
            $multiply_number /= 10;
        }
    } else {
        for ($i = 0; $i < $exponent_to; $i++) { 
            $multiply_number .= 0;
        }
    }

    if ($from_index > $to_index) {
        for ($i = 0; $i < $index_difference; $i++) { 
            $return_value *= $multiply_number;
        }
    } else {
        for ($i = 0; $i < $index_difference; $i++) { 
            $return_value /= $multiply_number;
        }
    }

    return $return_value;
}


?>