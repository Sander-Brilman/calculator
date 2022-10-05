<?php

class derived_unit extends datatype
{
    public function __construct($value, string $datatype1, string $datatype2) {
        $this->datatype1 = str_to_datatype($value, $datatype1);
        $this->datatype2 = str_to_datatype(1, $datatype2);


        parent::__construct("$datatype1/$datatype2", $this->datatype1->value, false);
    }

    public datatype $datatype1;
    public datatype $datatype2;

    public function convert_to(string $datatype)
    {
        $derived_units = explode('/', $datatype);

        // dump($derived_units);

        // dump($this->datatype1);
        // dump($this->datatype2);


        // dump($this->datatype1->datatype_name . ' to ' . $derived_units[0] . ' -> ' .$this->datatype1->convert_to($derived_units[0]));
        // dump($this->datatype2->datatype_name . ' to ' . $derived_units[1] . ' -> ' .$this->datatype2->convert_to($derived_units[1]));

        // dump($this->value);


        // dump($derived_unit);

        // dump($this->value);

        if (sizeof($derived_units) != 2) {
            throw new Exception('Invalid datatype for operator + on datatype '.$this->datatype_name, 1);
        }

        return $this->value / $this->datatype2->convert_to($derived_units[1]);
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

        // if (!($value instanceof derived_unit)) {
            throw new Exception('Invalid datatype for operator + on datatype '.$this->datatype_name, 1);
        // }

        // $datatype1 = $value->datatype1;
        // $datatype2 = $value->datatype2;

        // return new derived_unit()
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

        
        throw new Exception('Invalid datatype for operator - on datatype '.$this->datatype_name, 1);
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

        
        throw new Exception('Invalid datatype for operator * on datatype '.$this->datatype_name, 1);
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

        
        throw new Exception('Invalid datatype for operator / on datatype '.$this->datatype_name, 1);
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

        
        throw new Exception('Invalid datatype for operator ^ on datatype '.$this->datatype_name, 1);
    }
}
?>