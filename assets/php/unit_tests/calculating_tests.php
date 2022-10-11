<?php
global $unit_tests;
 
$unit_tests['string processing tests'] = [
    new unit_test('str_to_sum_array test', function() {
        $sum = '( 2000 number + 100 number ) * 100 number / ( 8 number - 4 number )';
    
        $result = str_to_sum_array($sum);
        $expected = [
            [
                "2000",
                "number",
                "+",
                "100",
                "number",
            ],
            "*",
            "100",
            "number",
            "/",
            [
                "8",
                "number",
                "-",
                "4",
                "number",
            ],
        ];
    
        return $result == $expected
            ? new test_result(true, '')
            : new test_result(false, 'Values are not equal');
    }),

    new unit_test('set_datatypes_recursive test', function() {
    
        $result = set_datatypes_recursive(
            [
                [
                    "2000",
                    "number",
                    "+",
                    "100",
                    "number",
                ],
                "*",
                "100",
                "number",
                "/",
                [
                    "8",
                    "number",
                    "-",
                    "4",
                    "number",
                ],
            ]
        );
        $expected = [
            [
                new number(2000),
                "+",
                new number(100),
            ],
            "*",
            new number(100),
            "/",
            [
                new number(8),
                "-",
                new number(4),
            ],
        ];
    
        return $result == $expected
            ? new test_result(true, '')
            : new test_result(false, 'Values are not equal');
    }),

    'str_to_datatype' => [
        
        new unit_test('str to invalid type', function() {
            try {
                str_to_datatype(55, 'something_invalid');
            } catch (Exception $ex) {
                return new test_result(true);
            }
        
            return new test_result(false, 'No Exception was thrown');
        }),

        'str to number' => [
            new unit_test('str to number', function() {
                $result = str_to_datatype(55, 'number');
                $expected = new number(55);
            
                return $result == $expected
                    ? new test_result(true, '')
                    : new test_result(false, 'Values are not equal');
            }),
        ],

        'str to meter' => [
            new unit_test('str to m3', function() {
                $result = str_to_datatype(55, 'm3');
                $expected = new meter(55, 3);
            
                return $result == $expected
                    ? new test_result(true, '')
                    : new test_result(false, 'Values are not equal');
            }),
    
            new unit_test('str to m1', function() {
                $result = str_to_datatype(100, 'm1');
                $expected = new meter(100, 1);
            
                return $result == $expected
                    ? new test_result(true, '')
                    : new test_result(false, 'Values are not equal');
            }),

            new unit_test('str to m-2', function() {
                $result = str_to_datatype(100, 'm-2');
                $expected = new meter(100, -2);
            
                return $result == $expected
                    ? new test_result(true, '')
                    : new test_result(false, 'Values are not equal');
            }),
        ],

        'str to sec' => [

            new unit_test('str to s', function() {
                $result = str_to_datatype(100, 's');
                $expected = new second(100);
            
                return $result == $expected
                    ? new test_result(true, '')
                    : new test_result(false, 'Values are not equal');
            }),
    
            new unit_test('str to s 2', function() {
                $result = str_to_datatype(1, 'min');
                $expected = new second(60);
            
                return $result == $expected
                    ? new test_result(true, '')
                    : new test_result(false, 'Values are not equal');
            }),
    
            new unit_test('str to s 3', function() {
                $result = str_to_datatype(1, 'h');
                $expected = new second(3600);
            
                return $result == $expected
                    ? new test_result(true, '')
                    : new test_result(false, 'Values are not equal');
            }),
    
            new unit_test('str to s 4', function() {
                $result = str_to_datatype(1, 'day');
                $expected = new second(86400);
            
                return $result == $expected
                    ? new test_result(true, '')
                    : new test_result(false, 'Values are not equal');
            }),
    
            new unit_test('str to s 5', function() {
                $result = str_to_datatype(1, 'w');
                $expected = new second(604800);
            
                return $result == $expected
                    ? new test_result(true, '')
                    : new test_result(false, 'Values are not equal');
            }),

        ],

        'str to derived units' => [
            new unit_test('str to derived unit m/s 1', function() {
                $result = str_to_datatype(100, 'm1/s');
                $expected = new derived_unit(100, 'm1', 's');

                return $result == $expected
                    ? new test_result(true, '')
                    : new test_result(false, 'Values are not equal');
            }),

            new unit_test('str to derived unit km/h 1', function() {
                $result = str_to_datatype(9, 'km1/h');
                $expected = new derived_unit(2.5, 'm1', 's');
            
                return $result->value == $expected->value
                    ? new test_result(true, '')
                    : new test_result(false, 'Values are not equal');
            }),
        ],

        'str to kilogram' => [
            new unit_test('kilograms convert test t', function ()
                {
                    $expected = new kilogram(1000);

                    $result = str_to_datatype(1, 't');

                    return $expected == $result
                        ? new test_result(true, '')
                        : new test_result(false, 'Expected value '.$expected->value.' and result '.$result->value.' do not match');
                }
            ),

            new unit_test('kilograms convert test kg', function ()
                {
                    $expected = new kilogram(1);

                    $result = str_to_datatype(1, 'kg');

                    return $expected == $result
                        ? new test_result(true, '')
                        : new test_result(false, 'Expected value '.$expected->value.' and result '.$result->value.' do not match');
                }
            ),
            // 
            new unit_test('kilograms convert test hg', function ()
                {
                    $expected = new kilogram(0.1);

                    $result = str_to_datatype(1, 'hg');

                    return $expected == $result
                        ? new test_result(true, '')
                        : new test_result(false, 'Expected value '.$expected->value.' and result '.$result->value.' do not match');
                }
            ),

            new unit_test('kilograms convert test dag', function ()
                {
                    $expected = new kilogram(0.01);

                    $result = str_to_datatype(1, 'dag');


                    return $expected == $result
                        ? new test_result(true, '')
                        : new test_result(false, 'Expected value '.$expected->value.' and result '.$result->value.' do not match');
                }
            ),

            new unit_test('kilograms convert test g', function ()
                {
                    $expected = new kilogram(0.001);

                    $result = str_to_datatype(1, 'g');

                    return $expected == $result
                        ? new test_result(true, '')
                        : new test_result(false, 'Expected value '.$expected->value.' and result '.$result->value.' do not match');
                }
            ),

            new unit_test('kilograms convert test dg', function ()
                {
                    $expected = new kilogram(0.0001);

                    $result = str_to_datatype(1, 'dg');

                    return $expected == $result
                        ? new test_result(true, '')
                        : new test_result(false, 'Expected value '.$expected->value.' and result '.$result->value.' do not match');
                }
            ),

            new unit_test('kilograms convert test cg', function ()
                {
                    $expected = new kilogram(0.00001);

                    $result = str_to_datatype(1, 'cg');

                    return $expected == $result
                        ? new test_result(true, '')
                        : new test_result(false, 'Expected value '.$expected->value.' and result '.$result->value.' do not match');
                }
            ),

            new unit_test('kilograms convert test mg', function ()
                {
                    $expected = new kilogram(0.000001);

                    $result = str_to_datatype(1, 'mg');

                    return $expected == $result
                        ? new test_result(true, '')
                        : new test_result(false, 'Expected value '.$expected->value.' and result '.$result->value.' do not match');
                }
            ),

            new unit_test('kilograms convert test mcg', function ()
                {
                    $expected = new kilogram(0.000000001);

                    $result = str_to_datatype(1, 'mcg');

                    return $expected == $result
                        ? new test_result(true, '')
                        : new test_result(false, 'Expected value '.$expected->value.' and result '.$result->value.' do not match');
                }
            ),

            new unit_test('kilograms convert test ng', function ()
                {
                    $expected = new kilogram(0.000000000001);

                    $result = str_to_datatype(1, 'ng');

                    return $expected == $result
                        ? new test_result(true, '')
                        : new test_result(false, 'Expected value '.$expected->value.' and result '.$result->value.' do not match');
                }
            ),
        ],



    ],
];

$unit_tests['Full calculation test'] = [

    'number only' => [
        new unit_test('number', function() {
            $sum_full = '( 2000 number + 100 number ) * 100 number / ( 8 number - 4 number ) | number | 0';
    
            $result = calculate_string($sum_full);
            $expected = 52500;
    
            return $result == $expected
                ? new test_result(true, '')
                : new test_result(false, 'Values are not equal');
        }),
    ],

    'meter only' => [
        new unit_test('meter 1', function() {
            $sum_full = '( ( 2000 cm1 + 100 dm1 ) * 100 mm1 + ( 66 km2 - 88 dcm2 + 1 hm2 ) ) / 10 m1 | m1 | 1';
    
            $result = calculate_string($sum_full);
            $expected = 6600120.3;
    
            return $result == $expected
                ? new test_result(true, '')
                : new test_result(false, 'Values are not equal');
        }),
    
        new unit_test('meter 2 (negative exponent)', function() {
            $sum_full = '( ( 2000 cm-1 + 100 dm-1 ) * 100 mm-1 + ( 66 km-2 - 88 dcm-2 + 1 hm-2 ) ) / 10 m-1 | m-1 | 3';
    
            $result = calculate_string($sum_full);
            $expected = '2009999999.912';
    
            return $result == $expected
                ? new test_result(true, '')
                : new test_result(false, 'Values are not equal');
        }),
    
        new unit_test('meter 3', function() {
            $result = calculate_string('600 m2 / 300 m2 | m1 | 0');
            $expected = 2;
    
            return $result == $expected
                ? new test_result(true, '')
                : new test_result(false, 'Values are not equal');
        }),
    
    ],

    'second only' => [
        new unit_test('second 1', function() {
            $result = calculate_string('660 s / 1 min | number | 0');
            $expected = 11;
    
            return $result == $expected
                ? new test_result(true, '')
                : new test_result(false, 'Values are not equal');
        }),
    
        new unit_test('second 2', function() {
            $result = calculate_string('( ( 60 s * 1 min ) + ( 8 h * 3 number ) + 1 w ) | s | 0');
            $expected = 694800;
    
            return $result == $expected
                ? new test_result(true, '')
                : new test_result(false, 'Values are not equal');
        }),
    
        new unit_test('second 3', function() {
            $result = calculate_string('1 w - 3 day | day | 0');
            $expected = 4;
    
            return $result == $expected
                ? new test_result(true, '')
                : new test_result(false, 'Values are not equal');
        }),

        new unit_test('second percentage 4', function() {
            $result = calculate_string('50 number % 2 day | h | 0');
            $expected = 24;
    
            return $result == $expected
                ? new test_result(true, '')
                : new test_result(false, 'Values are not equal');
        }),
    
    ],

    'derived unit only' => [
        new unit_test('derived unit m/s test 1', function() {
            $result = calculate_string('50 m1/s + 9 km1/h / 2 number * 3 number - 500 m1/min | m1/s | 1');
            $expected = 70.4;
    
            return $result == $expected
                ? new test_result(true, '')
                : new test_result(false, 'Values are not equal');
        }),
    ],
];

?>