<?php

class meter extends datatype
{
    public function __construct($value, int $exponent_value = 1) {
        parent::__construct('meter', $value, true, $exponent_value);
    }

    public function convert_to(string $datatype)
    {


        // value per datatype
        if (strpos($datatype, '/') !== false) {

        }


        global $meter_units;
        foreach ($meter_units as $key => $unit) {
            if (str_starts_with($datatype, $unit)) {
                $meter_index = 3;
                $current_index = $key;
                $index_difference = abs($meter_index - $current_index);
                $exponent = (int)str_replace($unit, '', $datatype);
                $return_value = $this->value;

                if ($exponent == 0) {
                    return $this->value;
                } else if ($exponent != $this->exponent_value) {
                    throw new Exception('cant convert m'.$this->exponent_value.' to '.$datatype.'. exponent values are not equal', 1);
                }

                $multiply_number = 1;
                if ($exponent < 0) {
                    for ($i = 0; $i > $this->exponent_value; $i--) { 
                        $multiply_number /= 10;
                    }
                } else {
                    for ($i = 0; $i < $this->exponent_value; $i++) { 
                        $multiply_number .= 0;
                    }
                }

                dump($multiply_number);

                if ($meter_index > $current_index) {
                    for ($i = 0; $i < $index_difference; $i++) { 
                        $return_value *= $multiply_number;
                    }
                }

                return $return_value;
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
                return new meter($this->value + $value->value, 1);
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
                return new meter($this->value - $value->value);
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
                return new meter($this->value * $value->value, $this->exponent_value + $value->exponent_value);
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
                return new meter($this->value / $value->value, $this->exponent_value - $value->exponent_value);
                break;

            case 'meter':
                return new meter($this->value / $value->value, $this->exponent_value - $value->exponent_value);
                break;
            
            default:
                throw new Exception('Invalid datatype for operator / on datatype number', 1);
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

            case 'meter':
                return new meter($this->value ** $value->value, $this->exponent_value * $value->exponent_value);
                break;
            
            default:
                throw new Exception('Invalid datatype for operator ^ on datatype number', 1);
                break;
        }
    }
}


?>