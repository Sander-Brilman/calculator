<?php
function include_files(string $dir)
{
    /**
     * Load all php files from a directory
     */
    $function_files = scandir('assets/php/'.$dir);

    unset($function_files[0]);
    unset($function_files[1]);


    foreach($function_files as $file) {
        include_once('assets/php/'.$dir.'/'.$file);
    }
}

include_files('functions');
include_files('classes');


?>