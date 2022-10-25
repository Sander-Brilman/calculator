<?php
class number extends datatype 
{
    public function __construct($value) {
        parent::__construct('number', $value);
    }

    public static array $synonyms = [
        'number' => [
            'int',
            'integer',
            'getal',
            'getallen',
            'numbers',
            'numbre',
        ],
    ];

    public static array $invalid_datatypes = [
        'dt',
    ];

    public function convert_to(string $datatype)
    {
        if (in_array($datatype, $this::$invalid_datatypes)) {
            throw new convert_error(1, [$this->display_name, $datatype]);
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

            $value->value = ($this->value + $value->value);
            return $value;
        }

        throw new datatype_error(1, [$value->display_name, '+', $this->display_name]);
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

        throw new datatype_error(1, [$value->display_name, '-', $this->display_name]);
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
            $value->value = ($this->value * $value->value);
            return $value;
        }

        throw new datatype_error(1, [$value->display_name, '-', $this->display_name]);
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
            throw new operator_error(1, [$this->display_name]);
        }

        if (!in_array($datatype_name, $this::$invalid_datatypes)) {
            return new number($this->value / $value->value);
        }

        throw new datatype_error(1, [$value->display_name, '/', $this->display_name]);
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

        throw new datatype_error(1, [$value->display_name, '%', $this->display_name]);
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
                throw new datatype_error(1, [$value->display_name, '^', $this->display_name], [ 
                    'nl' => 'Machtsverheffen is alleen beschikbaar met getallen',
                    'en' => 'Exponentiation is only available using numbers',
                ]);
                break;
        }
    }
}

?>