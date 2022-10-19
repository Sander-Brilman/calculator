<?php

class kilogram extends datatype
{
    public function __construct($value) {
        parent::__construct($this::get_string_identifier(), $value);
    }

    public static function get_string_identifier(): string { return 'kg'; }
    public static array $synonyms = [
        'en' => [
            'kilogram',
            'kilograms',

            'nanogram',
            'nanograms',

            'microgram',
            'micrograms',

            'milligram',
            'milligrams',

            'centigram',
            'centigrams',

            'decigram',
            'decigrams',    
          
            'gram',
            'grams',         

            'decagram',
            'dekagram',
            'decagrams',  
            'dekagrams',  

            'hectogram',  
            'hectograms',  

            'kilogram',  
            'kilograms',  

            'ton',  
        ],
        'nl' => &self::$synonyms['en'],
    ];

    public function convert_to(string $datatype)
    {
        switch ($datatype) {
            case 'number':
                return $this->value;
                break;
            case 'ng':
                return $this->value * 1000000000000;
                break;
            case 'mcg':
            case 'μg':
                return $this->value * 1000000000;
                break;
            case 'mg':
                return $this->value * 1000000;
                break;
            case 'cg':
                return $this->value * 100000;
                break;
            case 'dg':// decigram
                return $this->value * 10000;
                break;
            case 'g':
                return $this->value * 1000;
                break;
            case 'dag':// decagram
                return $this->value * 100;
                break;
            case 'hg':
                return $this->value * 10;
                break;
            case 'kg':
                return $this->value;
                break;
            case 't':
                return $this->value / 1000;
                break;
        }

        throw new convert_error(1, [$this->datatype_name, $datatype], [
            'nl' => $this->datatype_name.' kan alleen worden omgezet naar gewicht eenheden',
            'en' => $this->datatype_name.' can only be converted to a units of weight',
        ]);
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

        switch ($datatype_name) {
            case 'number':
            case 'kg':
                return new kilogram($this->value + $value->value);
                break;

            default:
                throw new datatype_error(1, [$datatype_name, '+', $this->datatype_name], [
                    'nl' => $this->datatype_name.' optellen kan alleen met getallen of gewicht eenheden',
                    'en' => 'Increasing '.$this->datatype_name.' is only possible with units of weight',
                ]);
        }
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
        switch ($datatype_name) {
            case 'number':
            case 'kg':
                return new kilogram($this->value - $value->value);
                break;
            
            default:
                throw new datatype_error(1, [$datatype_name, '-', $this->datatype_name], [
                    'nl' => 'operatie - kan alleen met getallen of gewicht eenheden',
                    'en' => 'subtracting '.$this->datatype_name.' is only possible with units of weight',
                ]);
                break;
        }
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
        switch ($datatype_name) {
            case 'number':
            case 'kg':
                return new kilogram($this->value * $value->value);
                break;
            
            default:
                throw new datatype_error(1, [$datatype_name, '*', $this->datatype_name], [
                    'nl' => $this->datatype_name.' kan alleen worden vermenigvuldigt met getallen of met andere gewicht eenheden.',
                    'en' => $this->datatype_name.' can only be multiplied by numbers or other meter units.',
                ]);
                break;
        }
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
            throw new operator_error(1, [$this->datatype_name]);
        }

        switch ($datatype_name) {
            case 'number':
                return new kilogram($this->value / $value->value);
                break;

            case 'kg':
                return new number($this->value / $value->value);
                break;

            default:
                return new derived_unit($this->value, $this->datatype_name, $datatype_name, $value->value);
                break;
        }
        throw new datatype_error(1, [$datatype_name, '/', $this->datatype_name]);
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
                return new kilogram($this->value ** $value->value);
                break;
            
            default:
                throw new datatype_error(1, [$datatype_name, '^', $this->datatype_name]);
                break;
        }
    }
}


?>