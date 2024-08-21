<?php
$a = 5;
$b = '05';
var_dump($a == $b); // bool(true) не строгое сравнение с неявным приведением второй переменной к целому числу
var_dump((int) '012345'); // int(12345) явное приведение строки к целому числу
var_dump((float) 123.0 === (int) 123.0); // bool(false) строгое сравнение 2 переменных разного типа
var_dump(0 == 'hello, world'); // bool(false) нет возможности привести строку к целому числу, а т.к. значения разные то ложь



$first = 10;
$second = 2;
echo "first = $first and second = $second\n";

$first+=+$second-$second=$first;
echo "first = $first and second = $second\n";
