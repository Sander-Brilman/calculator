<?php
function comma_to_dot(string $number): string
{
    return str_replace(',', '.', $number);
}

function str_starts_with(string $haystack, string $needle): bool
{
    return substr($haystack, 0, strlen($needle)) == $needle;
}

?>