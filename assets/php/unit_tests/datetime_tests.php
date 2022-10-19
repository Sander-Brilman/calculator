<?php
global $unit_tests;

$unit_tests['datetime datatype tests'] = [
    'Add tests' => [
        new unit_test('datetime Add test 1', function ()
            {
                $calculator_datetime = new calculator_datetime('20/10/2022 12:00');
                $value = new second(3600);

                $expected = new calculator_datetime('20/10/2022 13:00');;

                $result = $calculator_datetime->execute_operation('+', $value);

                return $expected == $result
                    ? new test_result(true, '')
                    : new test_result(false, 'Expected value and result do not match');
            }
        ),

        new unit_test('datetime Add test 2', function ()
            {
                $calculator_datetime = new calculator_datetime('20/10/2022 12:00');
                $value = new second(7200);

                $expected = new calculator_datetime('20/10/2022 14:00');;

                $result = $calculator_datetime->add($value);

                return $expected == $result
                    ? new test_result(true, '')
                    : new test_result(false, 'Expected value and result do not match');
            }
        ),
    ],


    'Subtract tests' => [
        new unit_test('datetime Add test 1', function ()
            {
                $calculator_datetime = new calculator_datetime('20/10/2022 12:00');
                $value = new second(3600);

                $expected = new calculator_datetime('20/10/2022 11:00');;

                $result = $calculator_datetime->execute_operation('-', $value);

                return $expected == $result
                    ? new test_result(true, '')
                    : new test_result(false, 'Expected value and result do not match');
            }
        ),

        new unit_test('datetime Add test 2', function ()
            {
                $calculator_datetime = new calculator_datetime('20/10/2022 12:00');
                $value = new calculator_datetime('19/10/2022 12:00');

                $expected = new second(86400);

                $result = $calculator_datetime->subtract($value);

                return $expected == $result
                    ? new test_result(true, '')
                    : new test_result(false, 'Expected value and result do not match');
            }
        ),
    ],

    'convert tests' => [
        new unit_test('datetime convert test 1', function ()
            {
                $calculator_datetime = new calculator_datetime('20/10/2022 12:00');

                $expected = '12:00:00';
                $result = $calculator_datetime->convert_to('time');

                return $expected == $result
                    ? new test_result(true, '')
                    : new test_result(false, 'Expected value and result do not match');
            }
        ),

        new unit_test('datetime convert test 2', function ()
            {
                $calculator_datetime = new calculator_datetime('20/10/2022 12:00');

                $expected = '20-10-2022';
                $result = $calculator_datetime->convert_to('date');

                return $expected == $result
                    ? new test_result(true, '')
                    : new test_result(false, 'Expected value and result do not match');
            }
        ),

        new unit_test('datetime convert test 3', function ()
            {
                $calculator_datetime = new calculator_datetime('20/10/2022 12:00');

                $expected = 'Thursday 20';
                $result = $calculator_datetime->convert_to('day');

                return $expected == $result
                    ? new test_result(true, '')
                    : new test_result(false, 'Expected value and result do not match');
            }
        ),

        new unit_test('datetime convert test 4', function ()
            {
                $calculator_datetime = new calculator_datetime('20/10/2022 12:00');

                $expected = '10';
                $result = $calculator_datetime->convert_to('month');

                return $expected == $result
                    ? new test_result(true, '')
                    : new test_result(false, 'Expected value and result do not match');
            }
        ),

        new unit_test('datetime convert test 5', function ()
            {
                $calculator_datetime = new calculator_datetime('20/10/2022 12:00');

                $expected = '2022';
                $result = $calculator_datetime->convert_to('year');

                return $expected == $result
                    ? new test_result(true, '')
                    : new test_result(false, 'Expected value and result do not match');
            }
        ),

        new unit_test('datetime convert test 6', function ()
            {
                $calculator_datetime = new calculator_datetime('20/10/2022 12:00');

                $expected = 'false';
                $result = $calculator_datetime->convert_to('leapyear');

                return $expected == $result
                    ? new test_result(true, '')
                    : new test_result(false, 'Expected value and result do not match');
            }
        ),

        new unit_test('datetime convert test 7', function ()
            {
                $calculator_datetime = new calculator_datetime('20/10/2024 12:00');

                $expected = 'true';
                $result = $calculator_datetime->convert_to('leapyear');

                return $expected == $result
                    ? new test_result(true, '')
                    : new test_result(false, 'Expected value and result do not match');
            }
        ),

        new unit_test('datetime convert test 8', function ()
            {
                $calculator_datetime = new calculator_datetime('+200 20/10/2024 12:00');

                $expected = '+02:00';
                $result = $calculator_datetime->convert_to('timezone');

                return $expected == $result
                    ? new test_result(true, '')
                    : new test_result(false, 'Expected value and result do not match');
            }
        ),
    ],


];

?>