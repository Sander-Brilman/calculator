<?php

class meter extends datatype
{
    public function __construct($value, int $exponent_value = 1) {
        parent::__construct('m'.$exponent_value, $value, true, $exponent_value);
    }

    public function convert_to(string $datatype)
    {
        global $meter_units;
        foreach ($meter_units as $unit) {
            if (str_starts_with($datatype, $unit)) {
                return meter_conversion($this->value, 'm'.$this->exponent_value, $datatype);
                break;
            }
        }

        switch ($datatype) {
            case 'number':
                return $this->value;
                break;

        }

        throw new calculator_error('CE001', [$this->datatype_name, $datatype]);
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
                throw new calculator_error('DE002', [$datatype_name, '+', $this->datatype_name]);
                break;

            default:
                throw new calculator_error('DE001', [$datatype_name, '+', $this->datatype_name], [
                    'nl' => $this->datatype_name.' kan alleen worden opgeteld met getallen of door andere meter eenheden met dezelfde exponent waarde.',
                    'en' => $this->datatype_name.' can only be increased by numbers or other meter units with the same exponent value.',
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
                throw new calculator_error('DE002', [$datatype_name, '-', $this->datatype_name]);
                break;
            
            default:
                throw new calculator_error('DE001', [$datatype_name, '-', $this->datatype_name], [
                    'nl' => 'Operatie - op datatype '.$this->datatype_name.' kan alleen worden uitgevoerd met getallen of door andere meter eenheden met dezelfde exponent waarde.',
                    'en' => $this->datatype_name.' can only be subtracted by numbers or other meter units with the same exponent value.',
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
                throw new calculator_error('DE001', [$datatype_name, '*', $this->datatype_name], [
                    'nl' => $this->datatype_name.' kan alleen worden vermenigvuldigt met getallen of met andere meter eenheden.',
                    'en' => $this->datatype_name.' can only be multiplied by numbers or other meter units.',
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
            throw new calculator_error('OE001', [$this->datatype_name]);
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
            throw new calculator_error('DE001', [$datatype_name, '/', $this->datatype_name]);
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
                throw new calculator_error('DE001', [$datatype_name, '^', $this->datatype_name], [ 
                    'nl' => 'Machtsverheffen is alleen beschikbaar met getallen',
                    'en' => 'Exponentiation is only available using numbers',
                ]);
                break;
        }
    }
}


?>