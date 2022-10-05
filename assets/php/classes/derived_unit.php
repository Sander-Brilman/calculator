<?php

class derived_unit extends datatype
{
    public function __construct($value) {
        parent::__construct('TODO', $value, false);
    }

    public function convert_to(string $datatype)
    {

        throw new Exception('datatype todo cannot be converted to '.$datatype, 1);
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

        
        throw new Exception('Invalid datatype for operator + on datatype todo', 1);

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

        
        throw new Exception('Invalid datatype for operator - on datatype todo', 1);

                
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
                return new todo($this->value * $value->value, 1);
                break;
            
            default:
                throw new Exception('Invalid datatype for operator * on datatype todo', 1);
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
                return new todo($this->value / $value->value, 1);
                break;

            case 'sec':
                return new number($this->value / $value->value);
                break;
            
            default:
                throw new Exception('Invalid datatype for operator / on datatype todo', 1);
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
                return new todo($this->value ** $value->value);
                break;

            default:
                throw new Exception('Invalid datatype for operator ^ on datatype todo', 1);
                break;
        }
    }

}


?>