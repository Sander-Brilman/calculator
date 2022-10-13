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
         * @param array $additional_text Give additional text in different languages
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
                'nl' => 'Maximum aantal haakjes bereikt',
                'en' => 'Maximum amount of round brackets reached',
            ],

        ],
        'CE' => [// Convert Error

            '000' => [// covert function is not set
                'nl' => 'Omzetten is uitgeschakeld voor eenheid [?].',
                'en' => 'Converting is disables for unit [?].',
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
            $return_string = str_replace_first_match('[?]', $data_string, $return_string);
        }

        if (isset($this->additional_text[$lang]) && $this->additional_text[$lang] != '') {
            $return_string .= '. '.(is_string($this->additional_text)
                ? $this->additional_text
                : $this->additional_text[$lang]);
        }
        
        return $return_string;
    }
}



?>