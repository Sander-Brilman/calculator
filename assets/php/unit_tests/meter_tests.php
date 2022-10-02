<?php
global $unit_tests;
//  calculate_string('600 m2 / 300 m2 | m1')
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

        new unit_test('Meter add test 3', function ()
            {
                $meter = new meter(30, 2);
                $value = new meter(70, 2);

                $expected = new meter(100, 2);

                $result = $meter->add($value);

                return $expected == $result
                    ? new test_result(true, '')
                    : new test_result(false, 'Expected value and result do not match');
            }
        ),

        new unit_test('Meter add test 4', function ()
            {
                $meter = new meter(30, -3);
                $value = new meter(70, -3);

                $expected = new meter(100, -3);

                $result = $meter->add($value);

                return $expected == $result
                    ? new test_result(true, '')
                    : new test_result(false, 'Expected value and result do not match');
            }
        ),
    ],

    'Subtract tests' => [
        new unit_test('Meter add test 1', function ()
            {
                $meter = new meter(55);
                $value = new meter(55);

                $expected = new meter(110);

                $result = $meter->execute_operation('-', $value);

                return $expected == $result
                    ? new test_result(true, '')
                    : new test_result(false, 'Expected value and result do not match');
            }
        ),

        new unit_test('Meter add test 2', function ()
            {
                $meter = new meter(30, -3);
                $value = new meter(70, -3);

                $expected = new meter(100, -3);
                $result = $meter->subtract($value);

                return $expected == $result
                    ? new test_result(true, '')
                    : new test_result(false, 'Expected value and result do not match');
            }
        ),
        
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