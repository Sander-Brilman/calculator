<?php

class kilogram extends datatype
{
    public function __construct($value) {
        parent::__construct('kg', $value);
    }

    public string $display_name = 'kilogram';
    public static array $synonyms = [
        'ng' =>  [
            'nanogram',
            'nanograms',
        ],

        'mcg' =>  [
            'microgram',
            'microgrammen',
            'micrograms',
        ],

        'mg' =>  [
            'milligram',
            'milligrammen',
            'milligrams',
        ],

        'cg' =>  [
            'centigram',
            'centigrammen',
            'centigrams',
        ],

        'dg' =>  [
            'decigram',
            'decigrammen',
            'decigrams',    
        ],

        'g' =>  [
            'gram',
            'gram',
            'grams',         
        ],

        'dcg' =>  [
            'decagram',
            'decagrammen',
            'dekagram',
            'decagrams',  
            'dekagrams',  
        ],

        'hg' =>  [
            'hectogram',  
            'hectogrammen',  
            'hectograms',  
        ],

        'kg' =>  [
            'kilo',
            'kilogram',  
            'kilogrammen',  
            'kilograms',  
        ],

        't' =>  [
            'ton',  
            'tonnen',  
        ],
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
            case 'dcg':// decagram
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

        throw new convert_error(1, [$this->display_name, $datatype], [
            'nl' => $this->display_name.' kan alleen worden omgezet naar gewicht eenheden',
            'en' => $this->display_name.' can only be converted to a units of weight',
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
                throw new datatype_error(1, [$value->display_name, '+', $this->display_name], [
                    'nl' => $this->display_name.' optellen kan alleen met getallen of gewicht eenheden',
                    'en' => 'Increasing '.$this->display_name.' is only possible with units of weight',
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
                throw new datatype_error(1, [$value->display_name, '-', $this->display_name], [
                    'nl' => 'operatie - kan alleen met getallen of gewicht eenheden',
                    'en' => 'subtracting '.$this->display_name.' is only possible with units of weight',
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
                throw new datatype_error(1, [$value->display_name, '*', $this->display_name], [
                    'nl' => $this->display_name.' kan alleen worden vermenigvuldigt met getallen of met andere gewicht eenheden.',
                    'en' => $this->display_name.' can only be multiplied by numbers or other meter units.',
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
            throw new operator_error(1, [$this->display_name]);
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
        throw new datatype_error(1, [$value->display_name, '/', $this->display_name]);
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
                throw new datatype_error(1, [$value->display_name, '^', $this->display_name]);
                break;
        }
    }
}


?>