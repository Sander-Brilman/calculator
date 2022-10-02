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

        new unit_test('str to number', function() {
            $result = str_to_datatype(55, 'number');
            $expected = new number(55);
        
            return $result == $expected
                ? new test_result(true, '')
                : new test_result(false, 'Values are not equal');
        }),

        new unit_test('str to invalid type', function() {
            try {
                str_to_datatype(55, 'something_invalid');
            } catch (Exception $ex) {
                return new test_result(true);
            }
        
            return new test_result(false, 'No Exception was thrown');
        }),

        new unit_test('str to meter', function() {
            $result = str_to_datatype(55, 'm3');
            $expected = new meter(55, 3);
        
            return $result == $expected
                ? new test_result(true, '')
                : new test_result(false, 'Values are not equal');
        }),

    ],
];

$unit_tests['Full calculation test'] = [
    new unit_test('number only', function() {
        $sum_full = '( 2000 number + 100 number ) * 100 number / ( 8 number - 4 number ) | number | 0';

        $result = calculate_string($sum_full);
        $expected = 52500;

        return $result == $expected
            ? new test_result(true, '')
            : new test_result(false, 'Values are not equal');
    }),

    new unit_test('meter only', function() {
        $sum_full = '( ( 2000 cm1 + 100 dm1 ) * 100 mm1 + ( 66 km2 - 88 dcm2 + 1 hm2 ) ) / 10 m1 | m1 | 1';

        $result = calculate_string($sum_full);
        $expected = 6600120.3;

        return $result == $expected
            ? new test_result(true, '')
            : new test_result(false, 'Values are not equal');
    }),

    new unit_test('meter only (negative exponent)', function() {
        $sum_full = '( ( 2000 cm-1 + 100 dm-1 ) * 100 mm-1 + ( 66 km-2 - 88 dcm-2 + 1 hm-2 ) ) / 10 m-1 | m-1 | 3';

        $result = calculate_string($sum_full);
        $expected = '2009999999.912';

        return $result == $expected
            ? new test_result(true, '')
            : new test_result(false, 'Values are not equal');
    }),
];

?>