<?php
require_once('assets/php/load_files.php');


// syntax for each separate calculation, Datatypes must be the default

// format: number datatype[power] operator number datatype[power]


// 10 sec + 2 hour as min 

// as [datatype]


dump(get_power_of_from_datatype('m[1]'));
dump(get_power_of_from_datatype('m[2]'));
dump(get_power_of_from_datatype('m[3]'));

echo calculate_string('2000 m + 0.8 m/s * 300 sec + 5 m * 3 m as km');



?>