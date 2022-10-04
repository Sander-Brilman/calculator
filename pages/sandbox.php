<?php
require_once('assets/php/load_files.php');


// syntax for each separate calculation, Datatypes must be the default

// format: number datatype[power] operator number datatype[power]


// 10 sec + 2 hour | min 

// | [datatype]

// dump(calculate_string('10 m1 * 100 m1 + 66 km2 | m2'). ' m2');



// dump(calculate_string('20 m2 - 10 dm2 | cm2'));
// dump(calculate_string('20 m-2 | cm-2'));

$timer = start_timer();

// dump(calculate_string('20 m2 - 10 dm2 | cm2'));


// dump(calculate_string('( ( 2000 cm1 + 100 dm1 ) * 100 mm1 + ( 66 km2 - 88 dcm2 + 1 hm2 ) ) / 10 m1 | m1'). ' m1');

// '( 2000 cm1 + 100 dm1 ) * 100 mm1 + ( 66 km2 - 88 dcm2 + 1 hm2 ) | m2';
// '( 2000 cm1 + 1000 dm1 ) * 100 mm1 + ( 66 km2 - 88 dcm2 + 1 hm2 ) | m2';
// '3000 cm1 * 100 mm1 + ( 66 km2 - 88 dcm2 + 1 hm2 ) | m2';
// '3000 cm1 * 10 cm1 + ( 66 km2 - 88 dcm2 + 1 hm2 ) | m2';
// '30 000 cm2 + ( 66 km2 - 88 dcm2 + 1 hm2 ) | m2';
// '3 m2 + ( 66 km2 - 88 dcm2 + 1 hm2 ) | m2';
// '3 m2 + ( 66 000 000 m2 - 8 800 m2 + 1 hm2 ) | m2';
// '3 m2 + ( 66 000 000 m2 - 8 800 m2 + 10 000 m2 ) | m2';
// '3 m2 + 66.001.200 m2 | m2';
// '66.001.203 m2 | m2';

// dump(calculate_string('( ( 2000 cm-1 + 100 dm-1 ) * 100 mm-1 + ( 66 km-2 - 88 dcm-2 + 1 hm-2 ) ) / 10 m-1 | m-1'));

// dump(calculate_string('6737 m0 | dm0'). ' m1');


// dump(calculate_string('600 m2 / 300 m2 | m1 | 2'));
// dump(calculate_string('600 sec - 2 min | sec | 2'));


// dump(calculate_string('600 sec + 2 min | sec | 2'));
// dump(calculate_string('600 sec / 2 min | sec | 2'));
// dump(calculate_string('600 sec * 2 min | day | 5'));


// $sum_full = '( 2000 number + 100 number ) * 100 number / ( 8 number - 4 number ) | number | 0';

// $result = calculate_string($sum_full);
// $expected = 52500;

// dump($result);

dump(calculate_string('10 number - 5 number | number | 0'));

echo end_timer($timer);

// dump(meter_conversion(100, 'm2', 'km2'));

$sum_full = '( 2000 cm1 + 100 dm1 ) * 100 mm1 / ( 8 number - 4 number ) | number | 2';
?>