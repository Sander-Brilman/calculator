<?php
function comma_to_dot(string $number): string
{
    return str_replace(',', '.', $number);
}

function str_starts_with(string $haystack, string $needle): bool
{
    return substr($haystack, 0, strlen($needle)) == $needle;
}

function str_replace_first_match(string $search, string $replace, string $subject): string
{
    $pos = strpos($subject, $search);
    return $pos === false
        ? $subject
        : substr_replace($subject, $replace, $pos, strlen($search));
}

?>