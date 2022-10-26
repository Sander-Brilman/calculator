<?php

class calculator_error extends Error
{
    public function __construct(string $error_code, array $error_data = [], array $additional_text = ['en' => '', 'nl' => '']) {
        /**
         * The error_data array contains strings with the details of the 
         * 
         * @param string $error_code the full error code of the error,
         * 
         * @param array $error_data the array with strings containing the details of the errors. Will be the replace value for the question marks
         * 
         * @param array $additional_text Give additional trailing text in different languages
         */
        $this->error_code = $error_code;
        $this->error_data = $error_data;
        $this->additional_text = $additional_text;

        parent::__construct($error_code);
    }

    public string $error_code;
    public array $error_data;
    public array $additional_text;

    public static array $supported_languages = ['nl', 'en'];
    public static array $error_messages = 
    [
        'GE' => [// General Error

            '000' => [// missing error code
                'nl' => 'Er is iets mis gegaan.. We weten alleen niet wat. Maar het heeft te maken met [?] en [?]',
                'en' => 'Something went wrong.. We do not know exactly what. But it has something to do with [?] and [?]',
            ],

            '001' => [// safety limit calculating
                'nl' => 'Maximum lengte van som bereikt',
                'en' => 'Maximum length of calculation reached',
            ],

            '002' => [// maximum decimal precision reached
                'nl' => 'Maximum aantal decimalen is '.PHP_FLOAT_DIG,
                'en' => 'Maximum amount of decimals is '.PHP_FLOAT_DIG,
            ],

            '003' => [// no operator found between
                'nl' => 'Niet alle waardes zijn gescheiden door een reken operator. Zorg dat er tussen alle waardes een rekenoperator zit',
                'en' => 'Not all values are separated by a math operator. Check your input and make sure there is a math operator between all values',
            ],

        ],
        'CE' => [// Convert Error

            '000' => [// covert function is not set
                'nl' => 'Omzetten is uitgeschakeld voor eenheid [?]',
                'en' => 'Converting is disables for unit [?]',
            ],

            '001' => [// cannot convert to
                'nl' => 'Eenheid [?] kan niet worden omgezet naar [?]',
                'en' => 'Unit [?] can not be converted to [?]',
            ],

            '002' => [// invalid exponent values not equal
                'nl' => 'Kan eenheid [?] niet omzetten naar [?], exponenten zijn niet gelijk',
                'en' => 'can not convert [?] to [?], exponents are not equal',
            ],

            '003' => [// invalid exponent values not equal
                'nl' => 'Kan [?] niet omzetten naar een geldige datum & tijd',
                'en' => 'can not convert [?] to a valid date time',
            ],

            '004' => [// value is not numeric
                'nl' => 'Kan [?] niet omzetten naar een getal',
                'en' => 'can not convert [?] to a number',
            ],

            '005' => [// value is not numeric
                'nl' => '[?] is geen geldige eenheid',
                'en' => '[?] is not a valid unit',
            ],

        ],
        'OE' => [// Operator Error

            '000' => [// invalid operator
                'nl' => '[?] is niet beschikbaar voor eenheid [?]',
                'en' => 'Operator [?] is not available for unit [?]',
            ],
            
            '001' => [// divide by 0
                'nl' => 'Zoals meeste rekenmachines, kan je ook hier [?] niet delen door 0',
                'en' => 'Like most calculators, you can not divide [?] by 0',
            ],
            
        ],
        'DE' => [// Invalid Datatype Error

            '000' => [// not a valid datatype for derived units
                'nl' => '[?] kan niet worden gedeeld',
                'en' => '[?] cannot be divided',
            ],

            '001' => [// invalid value for operator
                'nl' => 'Ongeldige waarde [?] voor operator [?] op eenheid [?]',
                'en' => 'Invalid value [?] for operator [?] on unit [?]',
            ],

            '002' => [// invalid exponent values not equal
                'nl' => 'Ongeldige waarde [?] voor operator [?] op eenheid [?], exponenten zijn niet gelijk',
                'en' => 'Invalid value [?] for operator [?] on unit [?], exponents are not equal',
            ],

            '003' => [// no exponent values found
                'nl' => 'Eenheid [?] heeft geen exponenten. Bedoel je misschien [?]1?',
                'en' => 'Unit [?] does not have an exponent value. Do you perhaps mean [?]1?',
            ],

        ],
        'PE' => [// Parser Error

            '000' => [// misplaced operator
                'nl' => 'Verkeerd geplaatste operator [?]',
                'en' => 'Misplaced operator [?]',
            ],

            '001' => [// no data type assigned and value not numeric and not a valid date time
                'nl' => 'Kan niet waarde [?] automatisch omzetten naar een getal of datum/tijd. Controleer je invoer en specificeer de eenheid om verwarring te voorkomen',
                'en' => 'Can not automatically convert value [?] to a number or date/time. Check your input and specify the datatype to prevent confusion',
            ],

        ],
    ];


    public function get_error_message(string $lang = 'en'): string 
    {
        /**
         * Get the error message in the specified language.
         * 
         * GE = General Error
         * CE = Convert Error
         * OE = Operator Error
         * DE = Invalid Datatype Error
         * 
         * @param string $lang the short language notation
         * 
         * @return string the error message in the chosen language
         */
        $error_type = substr($this->error_code, 0, 2);
        $error_id = substr($this->error_code, 2);

        $return_string = isset($this::$error_messages[$error_type][$error_id][$lang])
            ? $this::$error_messages[$error_type][$error_id][$lang]
            : $this::$error_messages['GE']['000'][$lang];

        for ($i = sizeof($this->error_data); $i < substr_count($return_string, '?', 0); $i++) { 
            $add_string = '';
            switch ($lang) {
                case 'nl':
                    $add_string = '[onbekend]';
                    break;
                    
                case 'en':
                    $add_string = '[unknown]';
                    break;
            }
            $this->error_data[] = $add_string;
        }

        foreach ($this->error_data as $data_string) {
            $return_string = str_replace_first_match('[?]', "\"$data_string\"", $return_string);
        }

        if (isset($this->additional_text[$lang]) && $this->additional_text[$lang] != '') {
            $return_string .= '. '.(is_string($this->additional_text)
                ? $this->additional_text
                : $this->additional_text[$lang]);
        }
        
        return $return_string;
    }
}

class convert_error extends calculator_error {
    public function __construct(int $error_number, array $error_data = [], array $additional_text = ['en' => '', 'nl' => '']) {
        /**
         * throws a new convert calculator error.
         * convert errors occur when converting datatypes is not possible.
         * 
         * @param string $error_number the error code number of the convert_error category,
         * 
         * @param array $error_data the array with strings containing the details of the errors. Will be the replace value for the question marks
         * 
         * @param array $additional_text Give additional trailing text in different languages
         */


        parent::__construct('CE'.sprintf('%03d', $error_number), $error_data, $additional_text);
    }
}

class general_error extends calculator_error {
    public function __construct(int $error_number, array $error_data = [], array $additional_text = ['en' => '', 'nl' => '']) {
        /**
         * throws a new general calculator error.
         * general errors are uncategorised errors. 
         * 
         * @param string $error_number the error code number of the general_error category,
         * 
         * @param array $error_data the array with strings containing the details of the errors. Will be the replace value for the question marks
         * 
         * @param array $additional_text Give additional trailing text in different languages
         */


        parent::__construct('GE'.sprintf('%03d', $error_number), $error_data, $additional_text);
    }
}

class operator_error extends calculator_error {
    public function __construct(int $error_number, array $error_data = [], array $additional_text = ['en' => '', 'nl' => '']) {
        /**
         * throws a new operator calculator error.
         * operator errors are thrown when a math operation cant be executed for some reason
         * 
         * @param string $error_number the error code number of the operator_error category,
         * 
         * @param array $error_data the array with strings containing the details of the errors. Will be the replace value for the question marks
         * 
         * @param array $additional_text Give additional trailing text in different languages
         */


        parent::__construct('OE'.sprintf('%03d', $error_number), $error_data, $additional_text);
    }
}

class datatype_error extends calculator_error {
    public function __construct(int $error_number, array $error_data = [], array $additional_text = ['en' => '', 'nl' => '']) {
        /**
         * throws a new datatype calculator error.
         * datatype errors are thrown when a datatype object does not meet the requirements for the current context.
         * 
         * @param string $error_number the error code number of the datatype_error category,
         * 
         * @param array $error_data the array with strings containing the details of the errors. Will be the replace value for the question marks
         * 
         * @param array $additional_text Give additional trailing text in different languages
         */


        parent::__construct('DE'.sprintf('%03d', $error_number), $error_data, $additional_text);
    }
}

class parser_error extends calculator_error {
    public function __construct(int $error_number, array $error_data = [], array $additional_text = ['en' => '', 'nl' => '']) {
        /**
         * throws a new parser calculator error.
         * parser errors are thrown when the string being parsed contains invalid syntax or invalid characters
         * 
         * @param string $error_number the error code number of the datatype_error category,
         * 
         * @param array $error_data the array with strings containing the details of the errors. Will be the replace value for the question marks
         * 
         * @param array $additional_text Give additional trailing text in different languages
         */


        parent::__construct('PE'.sprintf('%03d', $error_number), $error_data, $additional_text);
    }
}

?>