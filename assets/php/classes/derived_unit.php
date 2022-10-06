<?php

class derived_unit extends datatype
{
    public function __construct($datatype1_value, string $datatype1, $datatype2_value = 1, string $datatype2) {
        $this->datatype1 = str_to_datatype($datatype1_value, $datatype1);
        $this->datatype2 = str_to_datatype($datatype2_value, $datatype2);


        parent::__construct("$datatype1/$datatype2", $this->datatype1->value, false);
    }

    public datatype $datatype1;
    public datatype $datatype2;

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

        if (get_class($value) == get_class($this->datatype2)) {
   
        } else if (!($value instanceof derived_unit)) {

            return new derived_unit(
                $this->datatype1->add($value->datatype1)->value,
                $this->datatype1->datatype_name,
                $this->datatype2->add($value->datatype2)->value,
                $this->datatype2->datatype_name,
            );

        }


        throw new Exception('Invalid datatype for operator + on datatype '.$this->datatype_name, 1);

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
            throw new Exception('Invalid datatype for operator - on datatype '.$this->datatype_name, 1);
        }

        return new derived_unit(
            $this->datatype1->subtract($value->datatype1)->value,
            $this->datatype1->datatype_name,
            $this->datatype2->subtract($value->datatype2)->value,
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
            $copy = $this;

            $copy->datatype1->value = $this->datatype1->value * $value->value;

            return $copy;
        } else if (get_class($value) == get_class($this->datatype2)) {
            $copy = $this->datatype1;
            $copy->value = $this->datatype1->value * ($value->value / $this->datatype2->value);
            
            return $copy;    
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
        
        $copy = $this;

        $copy->datatype1->value = $this->datatype1->value / $value->value;

        return $copy;
    }
}
?>