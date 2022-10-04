<?php
class number extends datatype 
{
    public function __construct($value) {
        parent::__construct('number', $value, false, 0);
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
        $invalid_datatypes = [ ];

        if (!in_array($value_type, $invalid_datatypes)) {
            $value->value = ($value->value + $this->value);
            return $value;
        }

        throw new Exception('Invalid datatype for operator + on datatype number', 1);
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
        $invalid_datatypes = [ ];

        if (!in_array($value_type, $invalid_datatypes)) {
            $value->value = ($this->value - $value->value);
            return $value;
        }

        throw new Exception('Invalid datatype for operator - on datatype number', 1);
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
        $invalid_datatypes = [ ];

        if (!in_array($value_type, $invalid_datatypes)) {
            $value->value = ($value->value * $this->value);
            return $value;
        }

        throw new Exception('Invalid datatype for operator * on datatype number', 1);
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
        $invalid_datatypes = [ ];

        if ($value->value == 0) {
            throw new Exception('Cant divide by 0..', 1);
        }

        if (!in_array($value_type, $invalid_datatypes)) {
            return new number($this->value / $value->value);
        }

        throw new Exception('Invalid datatype for operator / on datatype number', 1);
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
        $invalid_datatypes = [ ];

        if (!in_array($value_type, $invalid_datatypes)) {
            $value->value = ($value->value * $this->value / 100);
            return $value;
        }

        throw new Exception('Invalid datatype for operator % on datatype number', 1);
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
                return new number($this->value ** $value->value);
                break;
            
            default:
                throw new Exception('Invalid datatype for operator ^ on datatype number', 1);
                break;
        }
    }
}

?>