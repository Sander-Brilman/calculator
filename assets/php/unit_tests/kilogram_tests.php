<?php

use LDAP\Result;

global $unit_tests;

$unit_tests['kilograms datatype tests'] = [
    'Add tests' => [
        new unit_test('kilograms add test 1', function ()
            {
                $kilogram = new kilogram(55);
                $value = new kilogram(55);

                $expected = new kilogram(110);

                $result = $kilogram->execute_operation('+', $value);

                return $expected == $result
                    ? new test_result(true, '')
                    : new test_result(false, 'Expected value '.$expected->value.' and result '.$result->value.' do not match');
            }
        ),
        
        new unit_test('kilograms add test 2', function ()
            {
                $kilogram = new kilogram(49.44);
                $value = new kilogram(51.66);

                $expected = new kilogram(101.1);

                $result = $kilogram->add($value);

                return $expected == $result
                    ? new test_result(true, '')
                    : new test_result(false, 'Expected value '.$expected->value.' and result '.$result->value.' do not match');
            }
        ),
        
        new unit_test('kilograms add test 3', function ()
            {
                $kilogram = new kilogram(100);
                $value = new number(50);

                $expected = new kilogram(150);

                $result = $kilogram->add($value);

                return $expected == $result
                    ? new test_result(true, '')
                    : new test_result(false, 'Expected value '.$expected->value.' and result '.$result->value.' do not match');
            }
        ),

    ],

    'Subtract tests' => [
        new unit_test('kilograms Subtract test 1', function ()
            {
                $kilogram = new kilogram(55);
                $value = new kilogram(55);

                $expected = new kilogram(0);

                $result = $kilogram->execute_operation('-', $value);

                return $expected == $result
                    ? new test_result(true, '')
                    : new test_result(false, 'Expected value '.$expected->value.' and result '.$result->value.' do not match');
            }
        ),
        
        new unit_test('kilograms Subtract test 2', function ()
            {
                $kilogram = new kilogram(100);
                $value = new kilogram(20);

                $expected = new kilogram(80);

                $result = $kilogram->subtract($value);

                return $expected == $result
                    ? new test_result(true, '')
                    : new test_result(false, 'Expected value '.$expected->value.' and result '.$result->value.' do not match');
            }
        ),
        
        new unit_test('kilograms Subtract test 3', function ()
            {
                $kilogram = new kilogram(100);
                $value = new number(50);

                $expected = new kilogram(50);

                $result = $kilogram->subtract($value);

                return $expected == $result
                    ? new test_result(true, '')
                    : new test_result(false, 'Expected value '.$expected->value.' and result '.$result->value.' do not match');
            }
        ),
    ],

    'Divide tests' => [
        new unit_test('kilograms Divide test 1', function ()
            {
                try {
                    $kilogram = new kilogram(55);
                    $value = new kilogram(0);
                    $kilogram->execute_operation('/', $value);
                } catch (calculator_error $ex) {
                    return $ex->get_error_message() == 'Like most calculators, you can not divide kilogram by 0'
                        ? new test_result(true)
                        : new test_result(false, 'Wrong calculator_error was thrown');
                }

                return new test_result(false, 'No calculator_error was thrown');
            }
        ),

        new unit_test('kilograms Divide test 2', function ()
            {
                $kilogram = new kilogram(100);
                $value = new number(2);

                $expected = new kilogram(50);

                $result = $kilogram->divide($value);

                return $expected == $result
                    ? new test_result(true, '')
                    : new test_result(false, 'Expected value '.$expected->value.' and result '.$result->value.' do not match');
            }
        ),
        
        new unit_test('kilograms Divide test 3', function ()
            {
                $kilogram = new kilogram(100);
                $value = new kilogram(2);

                $expected = new number(50);

                $result = $kilogram->divide($value);

                return $expected == $result
                    ? new test_result(true, '')
                    : new test_result(false, 'Expected value '.$expected->value.' and result '.$result->value.' do not match');
            }
        ),
        
        new unit_test('kilograms Divide test 4 - derived unit', function ()
            {
                $kilogram = new kilogram(100);
                $value = new second(2);

                $expected = new derived_unit(50, 'kg','s');

                $result = $kilogram->divide($value);

                return $expected == $result
                    ? new test_result(true, '')
                    : new test_result(false, 'Expected value '.$expected->value.' and result '.$result->value.' do not match');
            }
        ),
        
        new unit_test('kilograms Divide test 5 - derived unit', function ()
            {
                $kilogram = new kilogram(100);
                $value = new meter(2);

                $expected = new derived_unit(50, 'kg','m1');

                $result = $kilogram->divide($value);

                return $expected == $result
                    ? new test_result(true, '')
                    : new test_result(false, 'Expected value '.$expected->value.' and result '.$result->value.' do not match');
            }
        ),
    ],

    'multiply tests' => [
        new unit_test('kilograms multiply test 1', function ()
            {
                $kilogram = new kilogram(2);
                $value = new kilogram(100);

                $expected = new kilogram(200);

                $result = $kilogram->execute_operation('*', $value);

                return $expected == $result
                    ? new test_result(true, '')
                    : new test_result(false, 'Expected value '.$expected->value.' and result '.$result->value.' do not match');
            }
        ),
        
        new unit_test('kilograms multiply test 2', function ()
            {
                $kilogram = new kilogram(100);
                $value = new kilogram(20);

                $expected = new kilogram(2000);

                $result = $kilogram->multiply($value);

                return $expected == $result
                    ? new test_result(true, '')
                    : new test_result(false, 'Expected value '.$expected->value.' and result '.$result->value.' do not match');
            }
        ),        

        new unit_test('kilograms multiply test 2', function ()
            {
                $kilogram = new kilogram(100);
                $value = new number(2);

                $expected = new kilogram(200);

                $result = $kilogram->multiply($value);

                return $expected == $result
                    ? new test_result(true, '')
                    : new test_result(false, 'Expected value '.$expected->value.' and result '.$result->value.' do not match');
            }
        ),
    ],

    'percentage test' => [
        new unit_test('kilogram percentage test 1', function ()
            {
                $second = new number(200);
                $value = new kilogram(10);

                $expected = new kilogram(20);

                $result = $second->execute_operation('%', $value);

                return $expected == $result
                    ? new test_result(true, '')
                    : new test_result(false, 'Expected value '.$expected->value.' and result '.$result->value.' do not match');
            }
        ),
        
        new unit_test('kilogram percentage test 3', function ()
            {
                try {
                    $second = new kilogram(173);
                    $value = new meter(73);
                    $second->percentage($value);
                } catch (calculator_error $ex) {
                    return new test_result(true, '');
                }

                return new test_result(false, 'calculator error was not thrown');
            }
        ),
    ],

    'convert tests' => [
        new unit_test('kilograms convert test t', function ()
            {
                $kilogram = new kilogram(1);

                $expected = 0.001;

                $result = $kilogram->convert_to('t');

                return $expected == $result
                    ? new test_result(true, '')
                    : new test_result(false, 'Expected value '.$expected.' and result '.$result.' do not match');
            }
        ),

        new unit_test('kilograms convert test kg', function ()
            {
                $kilogram = new kilogram(1);

                $expected = 1;

                $result = $kilogram->convert_to('kg');

                return $expected == $result
                    ? new test_result(true, '')
                    : new test_result(false, 'Expected value '.$expected.' and result '.$result.' do not match');
            }
        ),

        new unit_test('kilograms convert test hg', function ()
            {
                $kilogram = new kilogram(1);

                $expected = 10;

                $result = $kilogram->convert_to('hg');

                return $expected == $result
                    ? new test_result(true, '')
                    : new test_result(false, 'Expected value '.$expected.' and result '.$result.' do not match');
            }
        ),

        new unit_test('kilograms convert test dcg', function ()
            {
                $kilogram = new kilogram(1);

                $expected = 100;

                $result = $kilogram->convert_to('dcg');

                return $expected == $result
                    ? new test_result(true, '')
                    : new test_result(false, 'Expected value '.$expected.' and result '.$result.' do not match');
            }
        ),

        new unit_test('kilograms convert test g', function ()
            {
                $kilogram = new kilogram(1);

                $expected = 1000;

                $result = $kilogram->convert_to('g');

                return $expected == $result
                    ? new test_result(true, '')
                    : new test_result(false, 'Expected value '.$expected.' and result '.$result.' do not match');
            }
        ),

        new unit_test('kilograms convert test g', function ()
            {
                $kilogram = new kilogram(1);

                $expected = 1000;

                $result = $kilogram->convert_to('g');

                return $expected == $result
                    ? new test_result(true, '')
                    : new test_result(false, 'Expected value '.$expected.' and result '.$result.' do not match');
            }
        ),

        new unit_test('kilograms convert test dg', function ()
            {
                $kilogram = new kilogram(1);

                $expected = 10000;

                $result = $kilogram->convert_to('dg');

                return $expected == $result
                    ? new test_result(true, '')
                    : new test_result(false, 'Expected value '.$expected.' and result '.$result.' do not match');
            }
        ),

        new unit_test('kilograms convert test cg', function ()
            {
                $kilogram = new kilogram(1);

                $expected = 100000;

                $result = $kilogram->convert_to('cg');

                return $expected == $result
                    ? new test_result(true, '')
                    : new test_result(false, 'Expected value '.$expected.' and result '.$result.' do not match');
            }
        ),

        new unit_test('kilograms convert test mg', function ()
            {
                $kilogram = new kilogram(1);

                $expected = 1000000;

                $result = $kilogram->convert_to('mg');

                return $expected == $result
                    ? new test_result(true, '')
                    : new test_result(false, 'Expected value '.$expected.' and result '.$result.' do not match');
            }
        ),

        new unit_test('kilograms convert test mcg', function ()
            {
                $kilogram = new kilogram(1);

                $expected = 1000000000;

                $result = $kilogram->convert_to('mcg');

                return $expected == $result
                    ? new test_result(true, '')
                    : new test_result(false, 'Expected value '.$expected.' and result '.$result.' do not match');
            }
        ),

        new unit_test('kilograms convert test ng', function ()
            {
                $kilogram = new kilogram(1);

                $expected = 1000000000000;

                $result = $kilogram->convert_to('ng');

                return $expected == $result
                    ? new test_result(true, '')
                    : new test_result(false, 'Expected value '.$expected.' and result '.$result.' do not match');
            }
        ),
    ],
]

?>