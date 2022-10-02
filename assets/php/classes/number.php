<?php
class number extends datatype 
{
    public function __construct($value, int $exponent_value = 0) {
        parent::__construct('number', $value, true, $exponent_value);
    }

    public function convert_to(string $datatype)
    {
        $invalid_datatypes = [];

        if (!in_array($datatype, $invalid_datatypes)) {
            return $this->value;
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
                return new number($this->value + $value->value);
                break;
            
            default:
                throw new Exception('Invalid datatype for operator + on number', 1);
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
                return new number($this->value - $value->value);
                break;
            
            default:
                throw new Exception('Invalid datatype for operator - on number', 1);
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
                return new number($this->value * $value->value, $this->exponent_value + $value->exponent_value);
                break;
            
            default:
                throw new Exception('Invalid datatype for operator * on datatype number', 1);
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

        if ($value->value == 0) {
            throw new Exception('Cant divide by 0..', 1);
        }

        switch ($value_type) {
            case 'number':
                return new number($this->value / $value->value, $this->exponent_value - $value->exponent_value);
                break;
            
            default:
                throw new Exception('Invalid datatype for operator / on datatype number', 1);
                break;
        }
    }

    public function percentage(datatype $value): datatype
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
                return new number($value->value * $this->value / 100, $value->exponent_value);
                break;
            
            default:
                throw new Exception('Invalid datatype for operator % on datatype number', 1);
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
                throw new Exception('Invalid datatype for operator ^ on datatype number', 1);
                break;
        }
    }
}

?>