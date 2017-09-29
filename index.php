<?php

require('functions.php');

// Задание №1:

echo 'Задание 1<br>';
task1('data.xml');


//Задание №2:

$arr = [
    'Human' => 'Boris',
    'Animal' => [
        'Cat',
        'Elephant' => [
            'Indian',
            'African'
        ]
    ]
];

echo 'Задание 2<br>';
file_put_contents("output.json", json_encode($arr));
changeJsonRandomly("output.json", "output2.json");
echo "Несовпадающие элемены: <br>";
print_r(compareJson("output.json", "output2.json"));
echo '<br><br>';


//Задание №3:

echo 'Задание 3<br>';
$NumdArr = [];

for ($i = 0; $i < 50; $i++) {
    array_push($NumdArr, rand(1, 100));
}
csvCreateFile($NumdArr);
echo cvsFileEvenSum('file.csv');


//Задание №4:

echo '<br><br>';
echo 'Задание 4<br>';
curlShow();