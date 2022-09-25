<?php
require_once('../assets/php/load_files.php');


if (!isset($_REQUEST['type'])) {
    return_error('No request type given');
}

switch ($_REQUEST['type']) {
    case 'string':
        process_string_request();
        break;

    case 'table':
        process_table_request();
        break;

    default:
        return_error('Invalid request type');
        break;
}

?>