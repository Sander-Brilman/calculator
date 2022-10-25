<?php

class second extends datatype
{
    public function __construct($value) {
        parent::__construct('s', $value);
    }

    public string $display_name = 'seconds';
    public static array $synonyms = [
        'ms' =>  [
            'milliseconds',
            'milliseconden',
            'milliseconde',
            'millisec',
        ],
        's' =>  [
            'sec',
            'seconden',
            'seconde',
            'seconds',
        ],
        'min' =>  [
            'minutes',
            'minute',
            'minuten',
        ],
        'h' =>  [
            'hour',
            'houre',
            'hours',
            'uur',
            'uren',
        ],
        'day' =>  [
            'days',
            'dag',
            'dagen',
        ],
        'w' =>  [
            'week',
            'weeks',
            'weken',
        ],
    ];


    public function convert_to(string $datatype)
    {
        switch ($datatype) {
            case 'ms':
                return $this->value * 1000;
            case 's':
            case 'number':
                return $this->value;
                break;
            case 'min':
                return $this->value / 60;
                break;
            case 'h':
                return ($this->value / 60) / 60;
                break;
            case 'day':
                return (($this->value / 60) / 60) / 24;
                break;
            case 'w':
                return ((($this->value / 60) / 60) / 24) / 7;
                break;
        }

        throw new convert_error(1, [$datatype, $this->display_name], [
            'nl' => 'Tijdseenheden kunnen alleen worden omgezet naar andere tijdseenheden',
            'en' => 'Time units can only be converted to other time units',
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
            case 's':
            case 'number':
                return new second($this->value + $value->value, 1);
                break;

            default:
                throw new datatype_error(1, [$value->display_name, '+', $this->display_name], [
                    'nl' => 'Tijdseenheden kunnen alleen worden opgeteld met getallen of andere tijdseenheden',
                    'en' => 'Time units can only be increased by numbers and other time units',
                ]);
                break;
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
            case 's':
            case 'number':
                return new second($this->value - $value->value, 1);
                break;
            
            default:
                throw new datatype_error(1, [$value->display_name, '-', $this->display_name], [
                    'nl' => 'operatie - is alleen mogelijk met getallen of andere tijdseenheden',
                    'en' => 'Time units can only be subtracted by numbers or other time units',
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
            case 's':
            case 'number':
                return new second($this->value * $value->value, 1);
                break;
            
            default:
                throw new datatype_error(1, [$value->display_name, '+', $this->display_name], [
                    'nl' => 'Tijdseenheden kunnen alleen worden vermenigvuldigt met getallen of andere tijdseenheden',
                    'en' => 'Time units can only be multiplied with numbers and other time units',
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
                return new second($this->value / $value->value, 1);
                break;

            case 's':
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
                return new second($this->value ** $value->value);
                break;

            default:
                throw new datatype_error(1, [$value->display_name, '^', $this->display_name], [
                    'nl' => 'Machtsverheffen is alleen beschikbaar met getallen',
                    'en' => 'Exponentiation is only available using numbers',
                ]);
                break;
        }
    }

}


?>