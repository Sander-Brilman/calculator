<?php

class kilogram extends datatype
{
    public function __construct($value) {
        parent::__construct('kg', $value, false, 1);
    }

    public function convert_to(string $datatype)
    {
        switch ($datatype) {
            case 'number':
                return $this->value;
                break;
            case 'ng':
                return $this->value * 1000000000000;
                break;
            case 'mcg':
            case 'μg':
                return $this->value * 1000000000;
                break;
            case 'mg':
                return $this->value * 1000000;
                break;
            case 'cg':
                return $this->value * 100000;
                break;
            case 'dg':
                return $this->value * 10000;
                break;
            case 'g':
                return $this->value * 1000;
                break;
            case 'dag':
                return $this->value * 100;
                break;
            case 'hg':
                return $this->value * 10;
                break;
            case 'kg':
                return $this->value;
                break;
            case 't':
                return $this->value / 1000;
                break;
        }

        throw new Exception('datatype kilogram cannot be converted to '.$datatype, 1);
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
            case 'kg':
                return new kilogram($this->value + $value->value);
                break;

            default:
                throw new Exception('Invalid datatype '.$datatype_name.' for operator + on datatype kilogram', 1);
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
            case 'kg':
                return new kilogram($this->value - $value->value);
                break;
            
            default:
                throw new Exception('Invalid datatype '.$datatype_name.' for operator - on datatype kilogram', 1);
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
            case 'kg':
                return new kilogram($this->value * $value->value);
                break;
            
            default:
                throw new Exception('Invalid datatype '.$datatype_name.' for operator * on datatype kilogram', 1);
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
                return new kilogram($this->value / $value->value);
                break;

            case 'kg':
                return new number($this->value / $value->value);
                break;

            default:
                return new derived_unit($this->value, $this->datatype_name, $datatype_name, $value->value);
                break;
        }
        throw new Exception('Invalid datatype '.$datatype_name.' for operator / on datatype kilogram', 1);
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
                return new kilogram($this->value ** $value->value);
                break;
            
            default:
                throw new Exception('Invalid datatype '.$datatype_name.' for operator ^ on datatype kilogram', 1);
                break;
        }
    }
}


?>