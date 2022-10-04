<?php
global $unit_tests;

$unit_tests['meter datatype tests'] = [
    'Add tests' => [
        new unit_test('Meter add test 1', function ()
            {
                $meter = new meter(55);
                $value = new meter(55);

                $expected = new meter(110);

                $result = $meter->execute_operation('+', $value);

                return $expected == $result
                    ? new test_result(true, '')
                    : new test_result(false, 'Expected value and result do not match');
            }
        ),
        
        new unit_test('Meter add test 2', function ()
            {
                $meter = new meter(49.44);
                $value = new meter(51.66);

                $expected = new meter(101.1);

                $result = $meter->add($value);

                return $expected == $result
                    ? new test_result(true, '')
                    : new test_result(false, 'Expected value and result do not match');
            }
        ),

    ],

    'Subtract tests' => [

        
    ],

    'Divide tests' => [


    ],

    'multiply tests' => [

    ],

    'percentage test' => [

    ],

    'convert tests' => [

    ],
]

?>