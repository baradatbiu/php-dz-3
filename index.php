<?php
require('src/functions.php');

echo '<pre>';

echo task1('data.xml');

$cars = [
    'opel' => [
        'year' => 2015,
    ],
    'toyota' => [
        'year' => 2017,
    ],
    'bmw' => [
        'year' => 2019,
    ],
];

print_r(task2($cars));

echo task3('nums-csv.csv') . PHP_EOL;

$dataArticle = task4('https://en.wikipedia.org/w/api.php?action=query&titles=Main%20Page&prop=revisions&rvprop=content&format=json');

echo implode($dataArticle, ', ');
