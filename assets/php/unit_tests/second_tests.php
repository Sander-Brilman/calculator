<?php
global $unit_tests;

$unit_tests['seconds datatype tests'] = [
    'Add tests' => [
        new unit_test('Seconds add test 1', function ()
            {
                $second = new second(55);
                $value = new second(55);

                $expected = new second(110);

                $result = $second->execute_operation('+', $value);

                return $expected == $result
                    ? new test_result(true, '')
                    : new test_result(false, 'Expected value and result do not match');
            }
        ),
        
        new unit_test('Seconds add test 2', function ()
            {
                $second = new second(49.44);
                $value = new second(51.66);

                $expected = new second(101.1);

                $result = $second->add($value);

                return $expected == $result
                    ? new test_result(true, '')
                    : new test_result(false, 'Expected value and result do not match');
            }
        ),

        new unit_test('Seconds add test 3', function ()
            {
                $second = new second(3);
                $value = new number(77);

                $expected = new second(80);

                $result = $second->add($value);

                return $expected == $result
                    ? new test_result(true, '')
                    : new test_result(false, 'Expected value and result do not match');
            }
        ),

        new unit_test('Seconds add test 4', function ()
            {
                try {
                    $second = new second(3);
                    $value = new meter(77);
                    $second->add($value);
                } catch (Exception $ex) {
                    return new test_result(true, '');
                }


                return new test_result(false, 'Exception was not thrown');
            }
        ),

    ],

    'Subtract tests' => [
        new unit_test('Seconds subtract test 1', function ()
            {
                $second = new second(55);
                $value = new second(105);

                $expected = new second(-50);

                $result = $second->execute_operation('-', $value);

                return $expected == $result
                    ? new test_result(true, '')
                    : new test_result(false, 'Expected value and result do not match');
            }
        ),
        
        new unit_test('Seconds subtract test 2', function ()
            {
                $second = new second(173);
                $value = new second(73);

                $expected = new second(100);

                $result = $second->subtract($value);

                return $expected == $result
                    ? new test_result(true, '')
                    : new test_result(false, 'Expected value and result do not match');
            }
        ),
        
        
        new unit_test('Seconds subtract test 3', function ()
            {
                try {
                    $second = new second(173);
                    $value = new meter(73);
                    $second->subtract($value);
                } catch (Exception $ex) {
                    return new test_result(true, '');
                }

                return new test_result(false, 'Exception was not thrown');
            }
        ),
    ],

    'Divide tests' => [
        new unit_test('Seconds divide test 1', function ()
            {
                $second = new second(100);
                $value = new second(20);

                $expected = new number(5);

                $result = $second->execute_operation('/', $value);

                return $expected == $result
                    ? new test_result(true, '')
                    : new test_result(false, 'Expected value and result do not match');
            }
        ),
        
        new unit_test('Seconds divide test 2', function ()
            {
                $second = new second(100);
                $value = new number(20);

                $expected = new second(5);

                $result = $second->divide($value);

                return $expected == $result
                    ? new test_result(true, '')
                    : new test_result(false, 'Expected value and result do not match');
            }
        ),
        
        new unit_test('Seconds divide test 3', function ()
            {
                try {
                    $second = new second(173);
                    $value = new meter(73);
                    $second->divide($value);
                } catch (Exception $ex) {
                    return new test_result(true, '');
                }

                return new test_result(false, 'Exception was not thrown');
            }
        ),

    ],

    'multiply tests' => [
        new unit_test('Seconds multiply test 1', function ()
            {
                $second = new second(200);
                $value = new second(5);

                $expected = new second(1000);

                $result = $second->execute_operation('*', $value);

                return $expected == $result
                    ? new test_result(true, '')
                    : new test_result(false, 'Expected value and result do not match');
            }
        ),
        
        new unit_test('Seconds multiply test 2', function ()
            {
                $second = new second(500);
                $value = new number(2);

                $expected = new second(1000);

                $result = $second->multiply($value);

                return $expected == $result
                    ? new test_result(true, '')
                    : new test_result(false, 'Expected value and result do not match');
            }
        ),
        
        new unit_test('Seconds multiply test 3', function ()
            {
                try {
                    $second = new second(173);
                    $value = new meter(73);
                    $second->multiply($value);
                } catch (Exception $ex) {
                    return new test_result(true, '');
                }

                return new test_result(false, 'Exception was not thrown');
            }
        ),
    ],

    'percentage test' => [
        new unit_test('Seconds percentage test 1', function ()
            {
                $second = new number(200);
                $value = new second(10);

                $expected = new second(20);

                $result = $second->execute_operation('%', $value);

                return $expected == $result
                    ? new test_result(true, '')
                    : new test_result(false, 'Expected value and result do not match');
            }
        ),
        
        new unit_test('Seconds percentage test 3', function ()
            {
                try {
                    $second = new second(173);
                    $value = new meter(73);
                    $second->percentage($value);
                } catch (Exception $ex) {
                    return new test_result(true, '');
                }

                return new test_result(false, 'Exception was not thrown');
            }
        ),
    ],

    'convert tests' => [
        new unit_test('Seconds convert test sec', function ()
            {
                $second = new second(200);

                $expected = 200;

                $result = $second->convert_to('s');

                return $expected == $result
                    ? new test_result(true, '')
                    : new test_result(false, 'Expected value and result do not match');
            }
        ),

        new unit_test('Seconds convert test min', function ()
            {
                $second = new second(60);

                $expected = 1;

                $result = $second->convert_to('min');

                return $expected == $result
                    ? new test_result(true, '')
                    : new test_result(false, 'Expected value and result do not match');
            }
        ),

        new unit_test('Seconds convert test h', function ()
            {
                $second = new second(3600);

                $expected = 1;

                $result = $second->convert_to('h');

                return $expected == $result
                    ? new test_result(true, '')
                    : new test_result(false, 'Expected value and result do not match');
            }
        ),

        new unit_test('Seconds convert test day', function ()
            {
                $second = new second(86400);

                $expected = 1;

                $result = $second->convert_to('day');

                return $expected == $result
                    ? new test_result(true, '')
                    : new test_result(false, 'Expected value and result do not match');
            }
        ),

        new unit_test('Seconds convert test w', function ()
            {
                $second = new second(604800);

                $expected = 1;

                $result = $second->convert_to('w');

                return $expected == $result
                    ? new test_result(true, '')
                    : new test_result(false, 'Expected value and result do not match');
            }
        ),

        new unit_test('Seconds convert test ms', function ()
            {
                $second = new second(1);

                $expected = 1000;

                $result = $second->convert_to('ms');

                return $expected == $result
                    ? new test_result(true, '')
                    : new test_result(false, 'Expected value and result do not match');
            }
        ),
    ],
]

?>