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
        new unit_test('Meter Subtract test 1', function ()
            {
                $meter = new meter(55);
                $value = new number(25);

                $expected = new meter(30);

                $result = $meter->execute_operation('-', $value);

                return $expected == $result
                    ? new test_result(true, '')
                    : new test_result(false, 'Expected value and result do not match');
            }
        ),

        new unit_test('Meter Subtract test 2', function ()
            {
                $meter = new meter(30, -3);
                $value = new meter(70, -3);

                $expected = new meter(-40, -3);
                $result = $meter->subtract($value);

                return $expected == $result
                    ? new test_result(true, '')
                    : new test_result(false, 'Expected value and result do not match');
            }
        ),
        
    ],

    'Divide tests' => [
        new unit_test('Meter Divide test 1', function ()
            {
                $meter = new meter(50, 2);
                $value = new number(25);

                $expected = new meter(2, 2);

                $result = $meter->execute_operation('/', $value);

                return $expected == $result
                    ? new test_result(true, '')
                    : new test_result(false, 'Expected value and result do not match');
            }
        ),

        new unit_test('Meter Divide test 2', function ()
            {
                $meter = new meter(30);
                $value = new meter(10);

                $expected = new number(3);
                $result = $meter->divide($value);


                return $expected == $result
                    ? new test_result(true, '')
                    : new test_result(false, 'Expected value and result do not match');
            }
        ),
        
        new unit_test('Meter Divide test 4 - derived unit', function ()
            {
                $kilogram = new meter(100);
                $value = new second(2);

                $expected = new derived_unit(50, 'm1','s');

                $result = $kilogram->divide($value);

                return $expected == $result
                    ? new test_result(true, '')
                    : new test_result(false, 'Expected value '.$expected->value.' and result '.$result->value.' do not match');
            }
        ),
        
        new unit_test('Meter Divide test 5 - derived unit', function ()
            {
                $kilogram = new meter(100, 3);
                $value = new kilogram(2);

                $expected = new derived_unit(50, 'm3', 'kg');

                $result = $kilogram->divide($value);

                return $expected == $result
                    ? new test_result(true, '')
                    : new test_result(false, 'Expected value '.$expected->value.' and result '.$result->value.' do not match');
            }
        ),
    ],

    'multiply tests' => [
        new unit_test('Meter multiply test 1', function ()
            {
                $meter = new meter(50, 2);
                $value = new number(3);

                $expected = new meter(150, 2);

                $result = $meter->execute_operation('*', $value);

                return $expected == $result
                    ? new test_result(true, '')
                    : new test_result(false, 'Expected value and result do not match');
            }
        ),

        new unit_test('Meter multiply test 2', function ()
            {
                $meter = new meter(5, -2);
                $value = new meter(5, -2);

                $expected = new meter(25, -4);
                $result = $meter->multiply($value);

                return $expected == $result
                    ? new test_result(true, '')
                    : new test_result(false, 'Expected value and result do not match');
            }
        ),
    ],

    'percentage test' => [
        new unit_test('Meter percentage test 1', function ()
            {
                try {
                    $meter = new meter(50, 2);
                    $value = new number(3);
    
                    $expected = new meter(150, 2);
    
                    $result = $meter->execute_operation('%', $value);
                } catch(calculator_error $ex) {
                    return new test_result(true, '');
                }

                return new test_result(false, 'calculator_error value and result do not match');
            }
        ),

    ],

    'convert tests' => [
        new unit_test('Meter convert test number', function ()
            {
                $meter = new meter(50, 2);
                $expected = 50;

                $result = $meter->convert_to('number');

                return $expected == $result
                    ? new test_result(true, '')
                    : new test_result(false, 'Expected value and result do not match');
            }
        ),

        new unit_test('Meter convert test dm 1', function ()
            {
                $meter = new meter(50, 1);
                $expected = 500;

                $result = $meter->convert_to('dm1');

                return $expected == $result
                    ? new test_result(true, '')
                    : new test_result(false, 'Expected value and result do not match');
            }
        ),

        new unit_test('Meter convert test dm 2', function ()
            {
                $meter = new meter(50, 2);
                $expected = 5000;

                $result = $meter->convert_to('dm2');

                return $expected == $result
                    ? new test_result(true, '')
                    : new test_result(false, 'Expected value and result do not match');
            }
        ),

        new unit_test('Meter convert test dm 3', function ()
            {
                $meter = new meter(50,3);
                $expected = 50000;

                $result = $meter->convert_to('dm3');

                return $expected == $result
                    ? new test_result(true, '')
                    : new test_result(false, 'Expected value and result do not match');
            }
        ),

        new unit_test('Meter convert test cm 1', function ()
            {
                $meter = new meter(50,1);
                $expected = 5000;

                $result = $meter->convert_to('cm1');

                return $expected == $result
                    ? new test_result(true, '')
                    : new test_result(false, 'Expected value and result do not match');
            }
        ),

        new unit_test('Meter convert test cm 2', function ()
            {
                $meter = new meter(50,2);
                $expected = 500000;

                $result = $meter->convert_to('cm2');

                return $expected == $result
                    ? new test_result(true, '')
                    : new test_result(false, 'Expected value and result do not match');
            }
        ),

        new unit_test('Meter convert test cm 3', function ()
            {
                $meter = new meter(50,3);
                $expected = 50000000;

                $result = $meter->convert_to('cm3');

                return $expected == $result
                    ? new test_result(true, '')
                    : new test_result(false, 'Expected value and result do not match');
            }
        ),

        new unit_test('Meter convert test mm 1', function ()
            {
                $meter = new meter(50,1);
                $expected = 50000;

                $result = $meter->convert_to('mm1');

                return $expected == $result
                    ? new test_result(true, '')
                    : new test_result(false, 'Expected value and result do not match');
            }
        ),
        
        new unit_test('Meter convert test mm 2', function ()
            {
                $meter = new meter(50,2);
                $expected = 50000000;

                $result = $meter->convert_to('mm2');

                return $expected == $result
                    ? new test_result(true, '')
                    : new test_result(false, 'Expected value and result do not match');
            }
        ),
        
        new unit_test('Meter convert test mm 3', function ()
            {
                $meter = new meter(50,3);
                $expected = 50000000000;

                $result = $meter->convert_to('mm3');

                return $expected == $result
                    ? new test_result(true, '')
                    : new test_result(false, 'Expected value and result do not match');
            }
        ),
        
        new unit_test('Meter convert test dcm 1', function ()
            {
                $meter = new meter(5000,1);
                $expected = 500;

                $result = $meter->convert_to('dcm1');

                return $expected == $result
                    ? new test_result(true, '')
                    : new test_result(false, 'Expected value and result do not match');
            }
        ),
        
        new unit_test('Meter convert test dcm 2', function ()
            {
                $meter = new meter(5000,2);
                $expected = 50;

                $result = $meter->convert_to('dcm2');

                return $expected == $result
                    ? new test_result(true, '')
                    : new test_result(false, 'Expected value and result do not match');
            }
        ),
        
        new unit_test('Meter convert test dcm 3', function ()
            {
                $meter = new meter(5000,3);
                $expected = 5;

                $result = $meter->convert_to('dcm3');

                return $expected == $result
                    ? new test_result(true, '')
                    : new test_result(false, 'Expected value and result do not match');
            }
        ),
        
        new unit_test('Meter convert test hm 1', function ()
            {
                $meter = new meter(5000,1);
                $expected = 50;

                $result = $meter->convert_to('hm1');

                return $expected == $result
                    ? new test_result(true, '')
                    : new test_result(false, 'Expected value and result do not match');
            }
        ),
        
        new unit_test('Meter convert test hm 2', function ()
            {
                $meter = new meter(5000,2);
                $expected = 0.5;

                $result = $meter->convert_to('hm2');

                return $expected == $result
                    ? new test_result(true, '')
                    : new test_result(false, 'Expected value and result do not match');
            }
        ),
        
        new unit_test('Meter convert test hm 3', function ()
            {
                $meter = new meter(5000,3);
                $expected = 0.005;

                $result = $meter->convert_to('hm3');

                return $expected == $result
                    ? new test_result(true, '')
                    : new test_result(false, 'Expected value and result do not match');
            }
        ),
        
        new unit_test('Meter convert test km 1', function ()
            {
                $meter = new meter(5000,1);
                $expected = 5;

                $result = $meter->convert_to('km1');

                return $expected == $result
                    ? new test_result(true, '')
                    : new test_result(false, 'Expected value and result do not match');
            }
        ),
        
        new unit_test('Meter convert test km 2', function ()
            {
                $meter = new meter(5000,2);
                $expected = 0.005;

                $result = $meter->convert_to('km2');

                return $expected == $result
                    ? new test_result(true, '')
                    : new test_result(false, 'Expected value and result do not match');
            }
        ),
        
        new unit_test('Meter convert test km 3', function ()
            {
                $meter = new meter(5000,3);
                $expected = 0.000005;

                $result = $meter->convert_to('km3');

                return $expected == $result
                    ? new test_result(true, '')
                    : new test_result(false, 'Expected value and result do not match');
            }
        ),
    ],
]

?>