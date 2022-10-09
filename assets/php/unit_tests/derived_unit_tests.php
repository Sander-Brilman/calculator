<?php
global $unit_tests;

$unit_tests['derived unit datatype tests'] = [
    'Add tests' => [
        new unit_test('derived unit meter/second Add test 1', function ()
            {
                $derived_unit = new derived_unit(100, 'm1', 's');
                $value = new derived_unit(50, 'm1', 's');

                $expected = new derived_unit(150, 'm1', 's');

                $result = $derived_unit->execute_operation('+', $value);

                return $expected == $result
                    ? new test_result(true, '')
                    : new test_result(false, 'Expected value and result do not match');
            }
        ),

        new unit_test('derived unit meter/second Add test 2', function ()
            {
                $derived_unit = new derived_unit(100, 'm1', 's');
                $value = new derived_unit(50, 'km1', 'h');

                $expected = new derived_unit(113.88888888889, 'm1', 's');
                $result = $derived_unit->add($value);

                return $expected == $result
                    ? new test_result(true, '')
                    : new test_result(false, 'Expected value and result do not match');
            }
        ),
    ],


    'Subtract tests' => [
        new unit_test('derived unit meter/second Subtract test 1', function ()
            {
                $derived_unit = new derived_unit(100, 'm1', 's');
                $value = new derived_unit(50, 'm1', 's');

                $expected = new derived_unit(50, 'm1', 's');

                $result = $derived_unit->execute_operation('-', $value);

                return $expected == $result
                    ? new test_result(true, '')
                    : new test_result(false, 'Expected value and result do not match');
            }
        ),

        new unit_test('derived unit meter/second Subtract test 2', function ()
            {
                $derived_unit = new derived_unit(100, 'm1', 's');
                $value = new derived_unit(50, 'km1', 'h');

                $expected = new derived_unit(86.111111111111, 'm1', 's');
                $result = $derived_unit->subtract($value);

                return $expected == $result
                    ? new test_result(true, '')
                    : new test_result(false, 'Expected value and result do not match');
            }
        ),
    ],

    'multiply tests' => [
        new unit_test('derived unit meter/second Subtract test 1', function ()
            {
                $derived_unit = new derived_unit(100, 'm1', 's');
                $value = new number(2);

                $expected = new derived_unit(200, 'm1', 's');

                $result = $derived_unit->execute_operation('*', $value);

                return $expected == $result
                    ? new test_result(true, '')
                    : new test_result(false, 'Expected value and result do not match');
            }
        ),

        new unit_test('derived unit meter/second Subtract test 2', function ()
            {
                $derived_unit = new derived_unit(100, 'm1', 's');
                $value = new second(10);

                $expected = new derived_unit(1000, 'm1', 's');
                $result = $derived_unit->multiply($value);

                return $expected == $result
                    ? new test_result(true, '')
                    : new test_result(false, 'Expected value and result do not match');
            }
        ),
    ],

    'divide tests' => [
        new unit_test('derived unit meter/second Subtract test 1', function ()
            {
                $derived_unit = new derived_unit(100, 'm1', 's');
                $value = new number(2);

                $expected = new derived_unit(50, 'm1', 's');

                $result = $derived_unit->execute_operation('/', $value);

                return $expected == $result
                    ? new test_result(true, '')
                    : new test_result(false, 'Expected value and result do not match');
            }
        ),

        new unit_test('derived unit meter/second Subtract test 2', function ()
            {
                $derived_unit = new derived_unit(100, 'm1', 's');
                $value = new number(5);

                $expected = new derived_unit(20, 'm1', 's');
                $result = $derived_unit->divide($value);

                return $expected == $result
                    ? new test_result(true, '')
                    : new test_result(false, 'Expected value and result do not match');
            }
        ),
    ],

    'convert tests' => [
        new unit_test('derived unit meter/second convert test 1', function ()
            {
                $derived_unit = new derived_unit(100, 'm1', 's');

                $expected = 100;
                $result = $derived_unit->convert_to('m1/s');

                return $expected == $result
                    ? new test_result(true, '')
                    : new test_result(false, 'Expected value and result do not match');
            }
        ),

        new unit_test('derived unit meter/second convert test 2', function ()
            {
                $derived_unit = new derived_unit(100, 'm1', 's');

                $expected = 360;
                $result = $derived_unit->convert_to('km1/h');

                return $expected == $result
                    ? new test_result(true, '')
                    : new test_result(false, 'Expected value and result do not match');
            }
        ),

        new unit_test('derived unit meter/second convert test 3', function ()
            {
                $derived_unit = new derived_unit(100, 'm1', 's');

                $expected = 10000;
                $result = $derived_unit->convert_to('cm1/s');

                return $expected == $result
                    ? new test_result(true, '')
                    : new test_result(false, 'Expected value and result do not match');
            }
        ),
    ],
];

?>