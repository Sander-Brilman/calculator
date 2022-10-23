<?php
$full_synonym_list = [];
$synonyms_collection = [
    calculator_datetime::$synonyms,
    meter::$synonyms,
    second::$synonyms,
    kilogram::$synonyms,
    number::$synonyms,
];

foreach ($synonyms_collection as $synonyms_array) {
    foreach ($synonyms_array as $replace => $search_array) {
        foreach ($search_array as $search) {
            $full_synonym_list[$search] = $replace;
        }
    }
}

$keys = array_map('strlen', array_keys($full_synonym_list));
array_multisort($keys, SORT_DESC, $full_synonym_list);
?>