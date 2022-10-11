<?php

class calculator_exception extends Exception
{
    public function __construct(string $error_code, $exception_data1, $exception_data2) {
        $this->error_code = $error_code;
        $this->exception_data1 = $exception_data1;
        $this->exception_data2 = $exception_data2;

        parent::__construct($error_code);
    }

    public string $error_code;
    public string $exception_data1;
    public string $exception_data2;

    public static array $supported_languages = ['nl', 'en'];
    public static array $error_messages = 
    [
        'CE' => [
            '000' => [
                'nl' => 'Kan geen ? omzetter naar ?',
                'en' => 'Cannot convert ? to ?',
            ],
        ],
        'OE' => [
            '000' => [
                'nl' => 'Kan geen ? omzetter naar ?',
                'en' => 'Cannot convert ? to ?',
            ],
        ],
        'DE' => [
            '000' => [
                'nl' => 'Kan geen ? omzetter naar ?',
                'en' => 'Cannot convert ? to ?',
            ],
        ],
    ];


    public function get_error_message(string $lang = 'en'): string 
    {
        /**
         * Get the error message in the specified language.
         * 
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

        
    }
}



?>