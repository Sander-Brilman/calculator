<?php

class meter extends datatype
{
    public function __construct($value, int $exponent_value = 1) {
        $this->exponent_value = $exponent_value;

        $this->display_name = $exponent_value == 1 ? 'meter' : "m$exponent_value";
        
        parent::__construct('m'.$exponent_value, $value);
    }

    public string $display_name = '';
    public static array $synonyms = [
        'mm' => [
            'milimeter',
            'milimetre',
            'millimeter',
            'millimetre',
            'millimeters',
        ],
        'cm' => [
            'centimeter',
            'centimetre',
            'centimeters',
        ],
        'dm' => [
            'decimeter',
            'decimetre',
            'decimeters',
        ],
        'm' => [
            'meter',
            'metre',
            'meters',
        ],
        'dcm' => [
            'decameter',
            'decametre',

            'dekameter',
            'dekametre',

            'dekameters',
            'decameters',
        ],
        'hm' => [
            'hectometer',
            'hectometre',
            'hectometers',
        ],
        'km' => [
            'kilometer',
            'kilometre',
            'kilometers',
        ],

        // liters
        'ml' => [
            'milliliter',
            'millilitre',
            'mililiters',
            'milliliters',
        ],
        'cl' => [
            'centiliter',
            'centilitre',
            'centiliters',
        ],
        'dl' => [
            'deciliter',
            'decilitre',
            'deciliter',
        ],
        'l' => [
            'liter',
            'litre',
            'liters',
        ],
        'dal' => [
            'decaliter',
            'decalitre',

            'dekaliter',
            'dekalitre',

            'decaliters',
            'dekaliters',
        ],
        'hl' => [
            'hectoliter',
            'hectolitre',
            'hectoliters',
        ],
        'kl' => [
            'kiloliter',
            'kilolitre',
            'kiloliters',
        ],
    ];

    public int $exponent_value;

    public static $meter_units = [
        'mm',
        'cm',
        'dm',
        'm',
        'dcm',
        'hm',
        'km',
    ];
    public static function meter_conversion($value, string $from, string $to)
    {
        /**
         * Can convert a meter unit (dm2, cm, km3) to another meter unit if it has the same exponent
         */
        $meter_units = self::$meter_units;

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
            throw new datatype_error(3, [$to, $to]);
        }
        if (!isset($from_index)) {
            throw new datatype_error(3, [$from, $from]);
        }

        $index_difference = abs($from_index - $to_index);

        $return_value = $value;


        if ($from_exponent != $to_exponent) {
            throw new convert_error(2, [$from, $to]);
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

    public function convert_to(string $datatype)
    {
        foreach (meter::$meter_units as $unit) {
            if (str_starts_with($datatype, $unit)) {
                return self::meter_conversion($this->value, 'm'.$this->exponent_value, $datatype);
                break;
            }
        }

        if ($this->exponent_value == 3) {
            switch ($datatype) {
                // liters
                case 'ml':
                    return $this->value * 1000000;
                    break;
                case 'cl':
                    return $this->value * 100000;
                    break;
                case 'dl':
                    return $this->value * 10000;
                    break;
                case 'l':
                    return $this->value * 1000;
                    break;
                case 'dal':
                    return $this->value * 100;
                    break;
                case 'hl':
                    return $this->value * 10;
                    break;
                case 'kl':
                    return $this->value;
                    break;
            }
        }

        switch ($datatype) {
            case 'number':
                return $this->value;
                break;

        }

        throw new convert_error(1, [$this->display_name, $datatype]);
    }

    public function add(datatype $value): datatype
    {
        /**
         * Returns a new datatype object with the result
         * 
         * @param datatype $value
         * 
         * @return datatype returns a new datatype with the result
         */
        $datatype_name = $value->datatype_name;

        switch ($datatype_name) {
            case 'number':
                return new meter($this->value + $value->value, $this->exponent_value);
                break;

            case substr($datatype_name, 0, 1) == 'm' && is_numeric(substr($datatype_name, 1)):
                if ($value->exponent_value == $this->exponent_value) {
                    return new meter($this->value + $value->value, $this->exponent_value);
                }
                throw new datatype_error(2, [$value->display_name, '+', $this->display_name]);
                break;

            default:
                throw new datatype_error(1, [$value->display_name, '+', $this->display_name], [
                    'nl' => $this->display_name.' kan alleen worden opgeteld met getallen of door andere meter eenheden met dezelfde exponent waarde.',
                    'en' => $this->display_name.' can only be increased by numbers or other meter units with the same exponent value.',
                ]);
                break;
        }
    }

    public function subtract(datatype $value): datatype
    {
        /**
         * Returns a new datatype object with the result
         * 
         * @param datatype $value
         * 
         * @return datatype returns a new datatype with the result
         */
        $datatype_name = $value->datatype_name;
        switch ($datatype_name) {
            case 'number':
                return new meter($this->value - $value->value, $this->exponent_value);
                break;

            case substr($datatype_name, 0, 1) == 'm' && is_numeric(substr($datatype_name, 1)):
                if ($value->exponent_value == $this->exponent_value) {
                    return new meter($this->value - $value->value, $this->exponent_value);
                }
                throw new datatype_error(2, [$value->display_name, '-', $this->display_name]);
                break;
            
            default:
                throw new datatype_error(1, [$value->display_name, '-', $this->display_name], [
                    'nl' => 'Operatie - op datatype '.$this->display_name.' kan alleen worden uitgevoerd met getallen of door andere meter eenheden met dezelfde exponent waarde.',
                    'en' => $this->display_name.' can only be subtracted by numbers or other meter units with the same exponent value.',
                ]);
                break;
        }
    }

    public function multiply(datatype $value): datatype
    {
        /**
         * Returns a new datatype object with the result
         * 
         * @param datatype $value
         * 
         * @return datatype returns a new datatype with the result
         */
        $datatype_name = $value->datatype_name;
        switch ($datatype_name) {
            case 'number':
                return new meter($this->value * $value->value, $this->exponent_value);
                break;

            case substr($datatype_name, 0, 1) == 'm' && is_numeric(substr($datatype_name, 1)):
                return new meter($this->value * $value->value, $this->exponent_value + $value->exponent_value);
                break;
            
            default:
                throw new datatype_error(1, [$value->display_name, '*', $this->display_name], [
                    'nl' => $this->display_name.' kan alleen worden vermenigvuldigt met getallen of met andere meter eenheden.',
                    'en' => $this->display_name.' can only be multiplied by numbers or other meter units.',
                ]);
                break;
        }
    }

    public function divide(datatype $value): datatype
    {
        /**
         * Returns a new datatype object with the result
         * 
         * @param datatype $value
         * 
         * @return datatype returns a new datatype with the result
         */
        $datatype_name = $value->datatype_name;

        if ($value->value == 0) {
            throw new operator_error(1, [$this->display_name]);
        }

        switch ($datatype_name) {
            case 'number':
                return new meter($this->value / $value->value, $this->exponent_value);
                break;

            case substr($datatype_name, 0, 1) == 'm' && is_numeric(substr($datatype_name, 1)):
                if ($this->exponent_value == $value->exponent_value) {
                    return new number($this->value / $value->value);
                }
                return new meter($this->value / $value->value, $this->exponent_value - $value->exponent_value);
                break;
            
        }

        if (in_array($datatype_name, derived_unit::$invalid_datatypes)) {
            throw new datatype_error(1, [$value->display_name, '/', $this->display_name]);
        }

        return new derived_unit($this->value, $this->datatype_name, $datatype_name, $value->value);
    }

    public function power_of(datatype $value): datatype
    {
        /**
         * Returns a new datatype object with the result
         * 
         * @param datatype $value
         * 
         * @return datatype returns a new datatype with the result
         */
        $datatype_name = $value->datatype_name;
        switch ($datatype_name) {
            case 'number':
                return new meter($this->value ** $value->value, $this->exponent_value * $value->exponent_value);
                break;
             
            default:
                throw new datatype_error(1, [$value->display_name, '^', $this->display_name], [ 
                    'nl' => 'Machtsverheffen is alleen beschikbaar met getallen',
                    'en' => 'Exponentiation is only available using numbers',
                ]);
                break;
        }
    }
}


?>