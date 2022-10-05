<?php
global $unit_tests;

$unit_tests['number datatype tests'] = [

    'Add tests' => [
        new unit_test('Number add test 1', function ()
            {
                $number = new number(55);
                $value = new number(55);

                $expected = new number(110);

                $result = $number->execute_operation('+', $value);

                return $expected == $result
                    ? new test_result(true, '')
                    : new test_result(false, 'Expected value and result do not match');
            }
        ),

        new unit_test('Number add test 2', function ()
            {
                $number = new number(30);
                $value = new number(70);

                $expected = new number(100);

                $result = $number->add($value);

                return $expected == $result
                    ? new test_result(true, '')
                    : new test_result(false, 'Expected value and result do not match');
            }
        ),

        new unit_test('Number add test 3', function ()
            {
                $number = new number(30);
                $value = new second(70);

                $expected = new second(100);

                $result = $number->add($value);

                return $expected == $result
                    ? new test_result(true, '')
                    : new test_result(false, 'Expected value and result do not match');
            }
        ),

        new unit_test('Number add test 3', function ()
            {
                $number = new number(30);
                $value = new meter(70);

                $expected = new meter(100);

                $result = $number->add($value);

                return $expected == $result
                    ? new test_result(true, '')
                    : new test_result(false, 'Expected value and result do not match');
            }
        ),
    ],

    'Subtract tests' => [
        new unit_test('Number subtract test 1', function ()
            {
                $number = new number(321);
                $value = new number(121);

                $expected = new number(200);

                $result = $number->execute_operation('-', $value);

                return $expected == $result
                    ? new test_result(true, '')
                    : new test_result(false, 'Expected value and result do not match');
            }
        ),

        new unit_test('Number subtract test 2', function ()
            {
                $number = new number(600);
                $value = new number(200);

                $expected = new number(400);

                $result = $number->subtract($value);
                
                return $expected == $result
                    ? new test_result(true, '')
                    : new test_result(false, 'Expected value and result do not match');
            }
        ),

        new unit_test('Number subtract test 3', function ()
            {
                $number = new number(600);
                $value = new second(200);

                $expected = new second(400);

                $result = $number->subtract($value);

                return $expected == $result
                    ? new test_result(true, '')
                    : new test_result(false, 'Expected value and result do not match');
            }
        ),

        new unit_test('Number subtract test 4', function ()
            {
                $number = new number(600);
                $value = new meter(200);

                $expected = new meter(400);

                $result = $number->subtract($value);

                return $expected == $result
                    ? new test_result(true, '')
                    : new test_result(false, 'Expected value and result do not match');
            }
        ),
    ],

    'Divide tests' => [
        new unit_test('Number divide test 1', function ()
            {
                $number = new number(44);
                $value = new number(11);

                $expected = new number(4);

                $result = $number->execute_operation('/', $value);

                return $expected == $result
                    ? new test_result(true, '')
                    : new test_result(false, 'Expected value and result do not match');
            }
        ),

        new unit_test('Number divide test 2', function ()
            {
                $number = new number(66);
                $value = new number(5);

                $expected = new number(13.2);

                $result = $number->divide($value);

                return $expected == $result
                    ? new test_result(true, '')
                    : new test_result(false, 'Expected value and result do not match');
            }
        ),

        new unit_test('Number divide test 3', function ()
            {
                $number = new number(66);
                $value = new number(0);


                try {
                    $number->divide($value);
                } catch (Exception $ex) {
                    return new test_result(true);
                }

                return new test_result(false, 'No Exception has been thrown');
            }
        ),

        new unit_test('Number divide test 4', function ()
            {
                $number = new number(66);
                $value = new second(5);

                $expected = new number(13.2);

                $result = $number->divide($value);

                return $expected == $result
                    ? new test_result(true, '')
                    : new test_result(false, 'Expected value and result do not match');
            }
        ),

        new unit_test('Number divide test 5', function ()
            {
                $number = new number(66);
                $value = new meter(5);

                $expected = new number(13.2);

                $result = $number->divide($value);

                return $expected == $result
                    ? new test_result(true, '')
                    : new test_result(false, 'Expected value and result do not match');
            }
        ),

    ],

    'multiply tests' => [
        new unit_test('Number multiply test 1', function ()
            {
                $number = new number(44);
                $value = new number(11);

                $expected = new number(484);

                $result = $number->execute_operation('*', $value);

                return $expected == $result
                    ? new test_result(true, '')
                    : new test_result(false, 'Expected value and result do not match');
            }
        ),

        new unit_test('Number multiply test 2', function ()
            {
                $number = new number(66);
                $value = new number(5);

                $expected = new number(330);

                $result = $number->multiply($value);

                return $expected == $result
                    ? new test_result(true, '')
                    : new test_result(false, 'Expected value and result do not match');
            }
        ),

        new unit_test('Number multiply test 3', function ()
            {
                $number = new number(66);
                $value = new second(5);

                $expected = new second(330);

                $result = $number->multiply($value);

                return $expected == $result
                    ? new test_result(true, '')
                    : new test_result(false, 'Expected value and result do not match');
            }
        ),

        new unit_test('Number multiply test 4', function ()
            {
                $number = new number(66);
                $value = new meter(5);

                $expected = new meter(330);

                $result = $number->multiply($value);


                return $expected == $result
                    ? new test_result(true, '')
                    : new test_result(false, 'Expected value and result do not match');
            }
        ),
    ],

    'percentage test' => [
        new unit_test('Number percentage test 1', function ()
            {
                $number = new number(200);
                $value = new number(10);

                $expected = new number(20);

                $result = $number->execute_operation('%', $value);

                return $expected == $result
                    ? new test_result(true, '')
                    : new test_result(false, 'Expected value and result do not match');
            }
        ),

        new unit_test('Number percentage test 2', function ()
            {
                $number = new number(5);
                $value = new number(332.92);

                $expected = new number(16.646);

                $result = $number->percentage($value);

                return $expected == $result
                    ? new test_result(true, '')
                    : new test_result(false, 'Expected value and result do not match');
            }
        ),

        new unit_test('Number percentage test 3', function ()
            {
                $number = new number(5);
                $value = new number(312);

                $expected = new number(15.6);

                $result = $number->percentage($value);

                return $expected == $result
                    ? new test_result(true, '')
                    : new test_result(false, 'Expected value and result do not match');
            }
        ),

        new unit_test('Number percentage test 4', function ()
            {
                $number = new number(5);
                $value = new second(312);

                $expected = new second(15.6);

                $result = $number->percentage($value);

                return $expected == $result
                    ? new test_result(true, '')
                    : new test_result(false, 'Expected value and result do not match');
            }
        ),

        new unit_test('Number percentage test 5', function ()
            {
                $number = new number(10);
                $value = new meter(200, 1);

                $expected = new meter(20, 1);

                $result = $number->percentage($value);

                return $expected == $result
                    ? new test_result(true, '')
                    : new test_result(false, 'Expected value and result do not match');
            }
        ),
    ],

    'convert tests' => [
        new unit_test('Number convert test 1', function ()
            {
                $number = new number(200);

                $expected = 200;

                $result = $number->convert_to('number');

                return $expected == $result
                    ? new test_result(true, '')
                    : new test_result(false, 'Expected value and result do not match');
            }
        ),

        new unit_test('Number convert test 2', function ()
            {
                $number = new number(200);

                $expected = 200;

                $result = $number->convert_to('s');

                return $expected == $result
                    ? new test_result(true, '')
                    : new test_result(false, 'Expected value and result do not match');
            }
        ),
    ],
];

?>