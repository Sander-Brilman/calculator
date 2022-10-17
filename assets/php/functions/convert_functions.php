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
            $from_exponent = (int)str_replace($unit, '', $from);
        }

        if (str_starts_with($to, $unit) && is_numeric(substr($to, strlen($unit)))) {
            $to_index    = $key;
            $to_exponent = (int)str_replace($unit, '', $to);
        }
    }

    if (!isset($to_index)) {
        throw new calculator_error('DE003', [$to, $to]);
    }
    if (!isset($from_index)) {
        throw new calculator_error('DE003', [$from, $from]);
    }

    $index_difference = abs($from_index - $to_index);

    $return_value = $value;


    if ($from_exponent != $to_exponent) {
        throw new calculator_error('CE002', [$from, $to]);
    } else if ($to_exponent == 0) {
        return $value;
    }

    $multiply_number = 1;
    if ($to_exponent < 0) {
        for ($i = 0; $i > $to_exponent; $i--) { 
            $multiply_number /= 10;
        }
    } else {
        for ($i = 0; $i < $to_exponent; $i++) { 
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