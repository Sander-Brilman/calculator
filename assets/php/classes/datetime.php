<?php
class calculator_datetime extends datatype
{
    public function __construct(string $datetime_string) {
        parent::__construct('calculator_datetime', $datetime_string, false);
    }

    public function convert_to(string $datatype)
    {

        throw new Exception('datatype calculator_datetime cannot be converted to '.$datatype, 1);
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

        throw new Exception('Invalid datatype for operator + on datatype calculator_datetime', 1);
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

        throw new Exception('Invalid datatype for operator - on datatype calculator_datetime', 1);
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

        
        throw new Exception('Invalid datatype for operator * on datatype calculator_datetime', 1);
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


        
        throw new Exception('Invalid datatype for operator / on datatype calculator_datetime', 1);
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

        

        throw new Exception('Invalid datatype for operator ^ on datatype calculator_datetime', 1);

    }

}


?>