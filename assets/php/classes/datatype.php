<?php
/**
 * Base class for all datatypes objects
 */
abstract class datatype  
{
    public function __construct(string $datatype_name, $value) {
        $this->datatype_name = $datatype_name; 

        if ($this->display_name == '') {
            $this->display_name = $datatype_name;
        }

        $this->value = $value;
    }
        
    public string $datatype_name;
    public $value;

    public string $display_name = '';
    public static array $synonyms = [];

    public function convert_to(string $datatype)
    {
        /**
         * Placeholder function. This function should be overwritten with custom code for each datatype
         */
        throw new convert_error(0, [$this->display_name, '']);
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
                throw new operator_error(0, [$operator, $this->display_name]);
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
        throw new operator_error(0, ['+', $this->display_name]);
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
        throw new operator_error(0, ['-', $this->display_name]);
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
        throw new operator_error(0, ['*', $this->display_name]);
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
        throw new operator_error(0, ['/', $this->display_name]);
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
        throw new operator_error(0, ['%', $this->display_name]);
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
        throw new operator_error(0, ['^', $this->display_name]);
    }
}

?>