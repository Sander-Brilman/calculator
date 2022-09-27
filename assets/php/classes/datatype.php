<?php
/**
 * Base class for all datatypes objects
 */

class datatype  
{
    public function __construct(string $datatype_name, $value, bool $uses_exponent = false, int $exponent_value = 0) {
        $this->datatype_name = $datatype_name; 
        $this->value = $value;

        $this->uses_exponent = $uses_exponent; 

        $this->exponent_value = $uses_exponent
            ? $exponent_value
            : 0; 
    }

    public bool $uses_exponent;
    public int $exponent_value;
    
    public string $datatype_name;

    public $value;

    public function execute_operation(string $operator, datatype $value): datatype
    {
        /**
         * Placeholder function. This function should be overwritten with custom code for each datatype
         */
        throw new Exception('execute_operation function is not defined for datatype '.$this->datatype_name, 1);
    }

    public function convert_to(string $datatype)
    {
        /**
         * Placeholder function. This function should be overwritten with custom code for each datatype
         */
        throw new Exception('export_to function is not defined for datatype '.$this->datatype_name, 1);
    }
}
?>