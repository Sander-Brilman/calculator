<?php
require_once('assets/php/load_files.php');


// syntax for each separate calculation, Datatypes must be the default

// format: number datatype[power] operator number datatype[power]


// 10 sec + 2 hour as min 

// as [datatype]

$sum = '( 2000 number + 100 number ) * 100 number / ( 8 number - 4 number ) as number';


dump(calculate_string($sum));

dump(str_to_sum_array($sum));


// dump(calculate_string('( ( 2000 number + 100 number ) * 100 number / ( 8 number - 4 number ) ) as km'));

// dump(calculate_string('4 number as km'));


$t = new number(11);


// 2 m1 * 5 m2 == 10 m3

// 7 m1 / 2 m2




?>