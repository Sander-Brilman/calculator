<?php
global $unit_tests;

$unit_tests['derived unit datatype tests'] = [
    'Add tests' => [
        new unit_test('derived unit Subtract test 1', function ()
            {
                $derived_unit = new derived_unit(10, 'm1', 1, 's');
                $value = new number(5);

                $expected = new derived_unit(30);

                $result = $derived_unit->execute_operation('+', $value);

                return $expected == $result
                    ? new test_result(true, '')
                    : new test_result(false, 'Expected value and result do not match');
            }
        ),

        new unit_test('derived unit Subtract test 2', function ()
            {
                $derived_unit = new derived_unit(30, -3);
                $value = new derived_unit(70, -3);

                $expected = new derived_unit(-40, -3);
                $result = $derived_unit->add($value);

                return $expected == $result
                    ? new test_result(true, '')
                    : new test_result(false, 'Expected value and result do not match');
            }
        ),
    ],

    'subtract tests' => [

    ],

    'multiply tests' => [

    ],

    'divide tests' => [

    ],

    'convert tests' => [

    ],
];

?>