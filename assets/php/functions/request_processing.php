<?php
// calculating functions;

function process_string_request()
{
    /**
     * Handles the request for string calculations
     * 
     * Includes error handeling & input validation
     */

    error_reporting(E_ERROR | E_PARSE);


    if (!isset($_REQUEST['sum'])) {
        return_error('No sum given to calculate');
    }

    $answer = calculate_string_old($_REQUEST['sum']);

    return_response('success', $answer, ['answer' => $answer]);


}

?>