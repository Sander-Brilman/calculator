<?php
class calculator_datetime extends datatype
{
    public function __construct(string $datetime_string) {
        parent::__construct('calculator_datetime', $datetime_string, false);
    }

    public function convert_to(string $datatype)
    {

        throw new calculator_error('CE001', [$this->datatype_name, $datatype]);
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

        throw new calculator_error('OE000', ['+', $this->datatype_name]);
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

        throw new calculator_error('OE000', ['-', $this->datatype_name]);
    }


}


?>