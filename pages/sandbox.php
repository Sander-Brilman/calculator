<?php
require_once('assets/php/load_files.php');


// syntax for each separate calculation, Datatypes must be the default

// format: number datatype[power] operator number datatype[power]


// dump(calculate_string('( ( 2000 cm1 + 100 dm1 ) * 100 mm1 + ( 66 km2 - 88 dcm2 + 1 hm2 ) ) / 10 m1 | m1'). ' m1');

// dump((new meter(10, 1))->divide(new second(2)));

// dump((new kilogram(10))->divide(new second(2)));


// dump((new second(10))->divide(new kilogram(2)));

$expected = new kilogram(0.001);

$result = str_to_datatype(1, 'dag');

$expected == $result


?>

