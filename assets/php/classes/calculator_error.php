<?php

class calculator_error extends Error
{
    public function __construct(string $error_code, string $error_data1, string $error_data2, array $additional_text = [ 'nl' => '', 'en' => '' ]) {
        /**
         * The $error_data1 and $error_data2 variables are strings that will fill the value of the '?' inside the error messages
         * The strings will be loaded in order. So $error_data1 will replace the first occurring '?' and $error_data2 will replace the second
         * 
         * @param string $error_code the full error code of the error,
         * 
         * @param string $error_data1 the string representing a part of the error.
         * @param string $error_data21 the string representing a part of the error.
         * 
         * @param array $additional_text Give additional text in 
         */
        $this->error_code = $error_code;

        $this->error_data1 = $error_data1;
        $this->error_data2 = $error_data2;

        $this->additional_text = $additional_text;

        parent::__construct($error_code);
    }

    public string $error_code;

    public string $error_data1;
    public string $error_data2;

    public array $additional_text;

    public static array $supported_languages = ['nl', 'en'];
    public static array $error_messages = 
    [
        'GE' => [// General Error

            '000' => [// missing error code
                'nl' => 'Er is iets mis gegaan.. We weten alleen niet wat. Maar het heeft te maken met ? en ?',
                'en' => 'Something went wrong.. We do not know exactly what. But it has something to do with ? and ?',
            ],

        ],
        'CE' => [// Convert Error

            '000' => [// covert function is not set
                'nl' => 'Omzetten is uitgeschakeld voor datatype ?.',
                'en' => 'Converting is disables for datatype ?.',
            ],

            '001' => [// cannot convert to
                'nl' => 'Datatype ? kan niet worden omgezet naar ?',
                'en' => 'Datatype ? can not be converted to ?',
            ],

        ],
        'OE' => [// Operator Error

            '000' => [// invalid operator
                'nl' => 'Operator ? is niet beschikbaar voor datatype ?',
                'en' => 'Operator ? is not available for datatype ?',
            ],
            

            
        ],
        'DE' => [// Invalid Datatype Error

            '000' => [// not a valid datatype for derived units
                'nl' => '? kan niet worden gedeeld',
                'en' => '? cannot be divided',
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

        $return_string = str_replace_first_match('?', $this->error_data1, $return_string);
        $return_string = str_replace_first_match('?', $this->error_data2, $return_string);

        if (isset($this->additional_text[$lang])) {
            $return_string .= ' '.$this->additional_text[$lang];
        }
        
        return $return_string;
    }
}



?>