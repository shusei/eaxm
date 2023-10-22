<?php

require __DIR__.'/../vendor/autoload.php';

$string_src = "BSA01,BSA02,BSA03,BSA04,BSA05,BSA06,BSA07";

$items = collect(explode(",", $string_src));

$result = $items->map(function ($item, $key) {
    return ($key + 1) . "->" . $item;
})->implode(', ');

echo $result;