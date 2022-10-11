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

    public function convert_to(string $datatype)
    {
        /**
         * Placeholder function. This function should be overwritten with custom code for each datatype
         */
        throw new calculator_error('CE000', $this->datatype_name, '');
    }

    
    public function execute_operation(string $operator, datatype $value): datatype
    {
        /**
         * Returns a new object with the preformed operation on it.
         * 
         * @param string $operator The operator
         * @param datatype $value The value to preform the operation on
         * 
         * @return datatype returns a new datatype with the result of the operation set as value
         */
        switch ($operator) {
            case '+':
                return $this->add($value);
                break;
            case '-':
                return $this->subtract($value);
                break;
            case '*':
                return $this->multiply($value);
                break;
            case '/':
                return $this->divide($value);
                break;
            case '%':
                return $this->percentage($value);
                break;
            case '^':
                return $this->power_of($value);
                break;
            default:
                throw new calculator_error('OE000', $operator, $this->datatype_name);
                break;
        }
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
        throw new calculator_error('OE000', '+', $this->datatype_name);
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
        throw new calculator_error('OE000', '-', $this->datatype_name);
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
        throw new calculator_error('OE000', '*', $this->datatype_name);
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
        throw new calculator_error('OE000', '/', $this->datatype_name);
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
        throw new calculator_error('OE000', '%', $this->datatype_name);
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
        throw new calculator_error('OE000', '^', $this->datatype_name);
    }
}

?>