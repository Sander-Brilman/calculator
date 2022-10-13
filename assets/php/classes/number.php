<?php
class number extends datatype 
{
    public function __construct($value) {
        parent::__construct('number', $value, false, 0);
    }

    public static array $invalid_datatypes = [];

    public function convert_to(string $datatype)
    {
        if (in_array($datatype, $this::$invalid_datatypes)) {
            throw new calculator_error('CE001', [$this->datatype_name, $datatype]);
        }

        return $this->value;
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

        if (!in_array($datatype_name, $this::$invalid_datatypes)) {
            $value->value = ($value->value + $this->value);
            return $value;
        }

        throw new calculator_error('DE001', [$datatype_name, '+', $this->datatype_name]);
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

        if (!in_array($datatype_name, $this::$invalid_datatypes)) {
            $value->value = ($this->value - $value->value);
            return $value;
        }

        throw new calculator_error('DE001', [$datatype_name, '-', $this->datatype_name]);
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

        if (!in_array($datatype_name, $this::$invalid_datatypes)) {
            $value->value = ($value->value * $this->value);
            return $value;
        }

        throw new calculator_error('DE001', [$datatype_name, '-', $this->datatype_name]);
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

        if (!in_array($datatype_name, $this::$invalid_datatypes)) {
            return new number($this->value / $value->value);
        }

        throw new calculator_error('DE001', [$datatype_name, '/', $this->datatype_name]);
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
        $datatype_name = $value->datatype_name;
        
        if (!in_array($datatype_name, $this::$invalid_datatypes)) {
            $value->value = ($value->value * $this->value / 100);
            return $value;
        }

        throw new calculator_error('DE001', [$datatype_name, '%', $this->datatype_name]);
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
                return new number($this->value ** $value->value);
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