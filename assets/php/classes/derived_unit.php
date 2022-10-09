<?php

class derived_unit extends datatype
{
    public function __construct($datatype1_value, string $datatype1, string $datatype2) {

        if (in_array($datatype1, $this::$invalid_datatypes)) {
            throw new Exception("$datatype1 is not a valid datatype for derived units");
        }
        if (in_array($datatype2, $this::$invalid_datatypes)) {
            throw new Exception("$datatype2 is not a valid datatype for derived units");
        }

        $datatype_obj1 = str_to_datatype($datatype1_value, $datatype1);
        $datatype_obj2 = str_to_datatype(1, $datatype2);

        $this->datatype1 = $datatype_obj1;
        $this->datatype1->value = $datatype_obj1->value / $datatype_obj2->value;

        $this->datatype2 = $datatype_obj2;
        $this->datatype2->value = 1;

        parent::__construct("$datatype1/$datatype2", $this->datatype1->value, false);
    }

    public datatype $datatype1;
    public datatype $datatype2;

    static public array $invalid_datatypes = [];

    public function convert_to(string $datatype)
    {
        $derived_units = explode('/', $datatype);

        if (sizeof($derived_units) != 2) {
            throw new Exception('Invalid datatype for operator + on datatype '.$this->datatype_name, 1);
        }

        return $this->datatype1->convert_to($derived_units[0]) / $this->datatype2->convert_to($derived_units[1]);
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
        if (!($value instanceof derived_unit)) {
            throw new Exception('Invalid datatype for operator + on datatype '.$this->datatype_name, 1);
        }

        return new derived_unit(
            $this->datatype1->add($value->datatype1)->value,
            $this->datatype1->datatype_name,
            $this->datatype2->datatype_name,
        );
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
        if (!($value instanceof derived_unit)) {
            throw new Exception('Invalid datatype for operator + on datatype '.$this->datatype_name, 1);
        }

        return new derived_unit(
            $this->datatype1->subtract($value->datatype1)->value,
            $this->datatype1->datatype_name,
            $this->datatype2->datatype_name,
        ); 
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
        if ($value instanceof number) {

            return new derived_unit(
                $this->datatype1->value * $value->value,
                $this->datatype1->datatype_name,
                $this->datatype2->datatype_name,
            );

        } else if (get_class($value) == get_class($this->datatype2)) {

            return new derived_unit(
                $this->datatype1->value * ($value->value / $this->datatype2->value),
                $this->datatype1->datatype_name,
                $this->datatype2->datatype_name,
            );

        }

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
        
        if (!($value instanceof number)) {
            throw new Exception('Invalid datatype for operator / on datatype '.$this->datatype_name, 1);
        }

        return new derived_unit(
            $this->datatype1->value / $value->value,
            $this->datatype1->datatype_name,
            $this->datatype2->datatype_name,
        );
        
    }
}
?>