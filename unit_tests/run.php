<?php

use LDAP\Result;

require_once('../assets/php/load_files.php');

$tests = [
    // new unit_test('')
];

foreach ($tests as $unit_test) {

    if (!($unit_test instanceof unit_test)) {
        continue;
    }

    try {
        $unit_test->run_test();
    } catch(Exception $ex) {
        echo $ex . '<br>';
    } catch(Error $er) {
        echo $er . '<br>';
    }
}

?>