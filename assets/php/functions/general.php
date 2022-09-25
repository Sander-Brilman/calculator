<?php
function comma_to_dot(string $number): string
{
    return str_replace(',', '.', $number);
}

?>