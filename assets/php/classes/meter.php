<?php

class meter extends datatype
{
    public function __construct($value, int $exponent_value = 1) {
        parent::__construct('meter', $value, true, $exponent_value);
    }

    public function convert_to(string $datatype)
    {
        // check for derived unit
        if (strpos($datatype, '/') !== false) {
            throw new Exception('TODO');
        }


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

        throw new Exception('datatype number cannot be converted to '.$datatype, 1);
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
        $value_type = $value->datatype_name;



        switch ($value_type) {
            case 'number':
                return new meter($this->value + $value->value, $this->exponent_value);
                break;

            case 'meter':
                if ($value->exponent_value == $this->exponent_value) {
                    return new meter($this->value + $value->value, $this->exponent_value);
                }
                throw new Exception('Cannot add m'.$value->exponent_value.' on '.$this->exponent_value. ' because exponent_values are not equal', 1);
                break;

            default:
                throw new Exception('Invalid datatype for operator + on datatype meter', 1);
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
        $value_type = $value->datatype_name;
        switch ($value_type) {
            case 'number':
                return new meter($this->value - $value->value, $this->exponent_value);
                break;

            case 'meter':
                if ($value->exponent_value == $this->exponent_value) {
                    return new meter($this->value - $value->value, $this->exponent_value);
                }
                throw new Exception('Cannot subtract '.$value->value.' m'.$value->exponent_value.' from '.$this->value.' m'.$this->exponent_value. ' because exponent_values are not equal', 1);
                break;
            
            default:
                throw new Exception('Invalid datatype for operator - on datatype meter', 1);
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
        $value_type = $value->datatype_name;
        switch ($value_type) {
            case 'number':
                return new meter($this->value * $value->value, $this->exponent_value);
                break;

            case 'meter':
                return new meter($this->value * $value->value, $this->exponent_value + $value->exponent_value);
                break;
            
            default:
                throw new Exception('Invalid datatype for operator * on datatype meter', 1);
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
        $value_type = $value->datatype_name;
        switch ($value_type) {
            case 'number':
                return new meter($this->value / $value->value, $this->exponent_value);
                break;

            case 'meter':
                if ($this->exponent_value == $value->exponent_value) {
                    return new number($this->value / $value->value);
                }
                return new meter($this->value / $value->value, $this->exponent_value - $value->exponent_value);
                break;
            
            default:
                throw new Exception('Invalid datatype for operator / on datatype meter', 1);
                break;
        }
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
        $value_type = $value->datatype_name;
        switch ($value_type) {
            case 'number':
                return new number($this->value ** $value->value, $this->exponent_value * $value->exponent_value);
                break;
            
            default:
                throw new Exception('Invalid datatype for operator ^ on datatype meter', 1);
                break;
        }
    }
}


?>