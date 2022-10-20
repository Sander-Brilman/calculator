<?php

class derived_unit extends datatype
{
    public function __construct($datatype1_value, string $datatype1, string $datatype2, $datatype2_value = 1)
    {
        if (in_array($datatype1, $this::$invalid_datatypes)) { throw new datatype_error(0, [$datatype1]); }
        if (in_array($datatype2, $this::$invalid_datatypes)) { throw new datatype_error(0, [$datatype2]); }

        $datatype_obj1 = str_to_datatype($datatype1_value, $datatype1);
        $datatype_obj2 = str_to_datatype($datatype2_value, $datatype2);

        $datatype_obj1->value = $datatype_obj1->value / $datatype_obj2->value;
        $datatype_obj2->value = 1;

        $this->datatype1 = $datatype_obj1;
        $this->datatype2 = $datatype_obj2;

        parent::__construct($this->datatype1->datatype_name.'/'.$this->datatype2->datatype_name, $this->datatype1->value);

        $this->display_name = str_replace('1', '', $this->datatype_name);
    }

    public datatype $datatype1;
    public datatype $datatype2;

    static public array $invalid_datatypes = [
        'calculator_datetime',
    ];

    public function convert_to(string $datatype)
    {
        $derived_units = explode('/', $datatype);

        if ($datatype == 'number') {
            return $this->value;
        }
        
        if (sizeof($derived_units) != 2) {
            throw new convert_error(1, [$this->display_name, $datatype]);
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
            throw new datatype_error(1, [$value->display_name, '+', $this->display_name]);
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
            throw new datatype_error(1, [$value->display_name, '-', $this->display_name]);
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

        throw new datatype_error(1, [$value->display_name, '*', $this->display_name]);
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
            throw new datatype_error(1, [$value->display_name, '/', $this->display_name]);
        }

        if ($value->value == 0) {
            throw new operator_error(1, [$this->display_name]);
        }

        return new derived_unit(
            $this->datatype1->value / $value->value,
            $this->datatype1->datatype_name,
            $this->datatype2->datatype_name,
        );
        
    }
}
?>