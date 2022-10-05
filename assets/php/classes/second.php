<?php

class second extends datatype
{
    public function __construct($value) {
        parent::__construct('sec', $value, false);
    }

    public function convert_to(string $datatype)
    {
        switch ($datatype) {
            case 'ms':
                return $this->value * 1000;
            case 'sec':
            case 'number':
                return $this->value;
                break;
            case 'min':
                return $this->value / 60;
                break;
            case 'hrs':
                return ($this->value / 60) / 60;
                break;
            case 'day':
                return (($this->value / 60) / 60) / 24;
                break;
            case 'w':
                return ((($this->value / 60) / 60) / 24) / 7;
                break;
        }

        throw new Exception('datatype second cannot be converted to '.$datatype, 1);
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
            case 'sec':
            case 'number':
                return new second($this->value + $value->value, 1);
                break;

            default:
                throw new Exception('Invalid datatype for operator + on datatype second', 1);
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
            case 'sec':
            case 'number':
                return new second($this->value - $value->value, 1);
                break;
            
            default:
                throw new Exception('Invalid datatype for operator - on datatype second', 1);
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
            case 'sec':
            case 'number':
                return new second($this->value * $value->value, 1);
                break;
            
            default:
                throw new Exception('Invalid datatype for operator * on datatype second', 1);
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
                return new second($this->value / $value->value, 1);
                break;

            case 'sec':
                return new number($this->value / $value->value);
                break;
            
            default:
                throw new Exception('Invalid datatype for operator / on datatype second', 1);
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
                return new second($this->value ** $value->value);
                break;

            default:
                throw new Exception('Invalid datatype for operator ^ on datatype second', 1);
                break;
        }
    }

}


?>