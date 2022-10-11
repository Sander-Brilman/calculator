<?php

class second extends datatype
{
    public function __construct($value) {
        parent::__construct('s', $value, false);
    }

    public function convert_to(string $datatype)
    {
        switch ($datatype) {
            case 'ms':
                return $this->value * 1000;
            case 's':
            case 'number':
                return $this->value;
                break;
            case 'min':
                return $this->value / 60;
                break;
            case 'h':
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
        $datatype_name = $value->datatype_name;

        switch ($datatype_name) {
            case 's':
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
        $datatype_name = $value->datatype_name;
        switch ($datatype_name) {
            case 's':
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
        $datatype_name = $value->datatype_name;
        switch ($datatype_name) {
            case 's':
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
        $datatype_name = $value->datatype_name;

        if ($value->value == 0) {
            throw new Exception('Cannot divide by 0');
        }

        switch ($datatype_name) {
            case 'number':
                return new second($this->value / $value->value, 1);
                break;

            case 's':
                return new number($this->value / $value->value);
                break;
            
            default:
                return new derived_unit($this->value, $this->datatype_name, $datatype_name, $value->value);
                break;
        }
        
        throw new Exception('Invalid datatype for operator / on datatype second', 1);
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
                return new second($this->value ** $value->value);
                break;

            default:
                throw new Exception('Invalid datatype for operator ^ on datatype second', 1);
                break;
        }
    }

}


?>