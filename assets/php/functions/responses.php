<?php
function return_response(string $status, string $message, array $optional_data = [])
{
    exit( json_encode(['status' => $status, 'message' => $message, 'return_data' => $optional_data]) );
}

function return_error(string $message) {
    return_response('error', $message);
}
?>