<?php
require_once('assets/php/load_files.php');


// syntax for each separate calculation, Datatypes must be the default

// format: number datatype[power] operator number datatype[power]


// dump(calculate_string('( ( 2000 cm1 + 100 dm1 ) * 100 mm1 + ( 66 km2 - 88 dcm2 + 1 hm2 ) ) / 10 m1 | m1'). ' m1');


// dump($derived);
// dump((new derived_unit(1, 'km1', 'h'))->convert_to('m1/s'));
// dump((new derived_unit(1, 'km1', 'h'))->convert_to('dm1/min'));

$unit = new derived_unit(2000, 'm1', 1,'s');
dump($unit->multiply(new second(2)));


$unit = new derived_unit(2000, 'm1', 50,'s');
dump($unit->multiply(new second(2)));


// dump((new derived_unit(1, 'm1', 's'))->convert_to('km1/h'));
// dump((new derived_unit(1, 'km1', 'h'))->convert_to('m1/s'));


?>