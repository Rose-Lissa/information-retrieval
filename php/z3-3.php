<?php
$printArray = function ($array) {
    $out = implode(", ", $array);
    print "<p>$out</p>";
};

$treug = [];
for ($n = 1; $n <= 10; $n++) {
    $treug [] = $n * ($n + 1) / 2;
}
$printArray($treug);

$square = [];
for ($n = 1; $n <= 10; $n++) {
    $square [] = pow($n, 2);
}
$printArray($square);

$rez = array_merge($treug, $square);
$printArray($rez);

sort($rez);
$printArray($rez);

array_shift($rez);
$printArray($rez);

$unique_rez = array_unique($rez);
$printArray($unique_rez);
