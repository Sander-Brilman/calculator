<?php
class test_result {
    public function __construct(bool $success, string $message) {
        $this->success = $success;
        $this->message = $message;
    }

    public bool $success;
    public string $message;
}

class unit_test
{
    public function __construct(string $test_name, callable $function) {
        $this->test_name = $test_name;
        $this->test_function = $function;
    }

    public string $test_name;

    public $test_function;

    public function run_test() {
        $test_results = ($this->test_function)();
        
        if (!($test_results instanceof test_result)) {
            throw new Error('Unit test "'.$this->test_name.'" did not return a valid result object', 1);
        }

        if (!$test_results->success) {
            throw new Exception('Unit test "'.$this->test_name.'" failed. Message: '.$test_results->message, 1);
        }
    }
}

?>