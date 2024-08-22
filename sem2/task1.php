<?php

$arr1 = [1, 4, 6, 6, 8, 9];
$arr2 = [2, 3, 5, 6, 7, 9, 10, 11];

$newArr = [];

$i1 = 0;
$i2 = 0;

while ($i1 < count($arr1) && $i2 < count($arr2)) {
    if ($arr1[$i1] < $arr2[$i2]) {
        array_push($newArr, $arr1[$i1]);
        $i1 += 1;
    } else {
        array_push($newArr, $arr2[$i2]);
        $i2 += 1;
    }
    if ($i1 >= count($arr1)) {
        for ($tInd = $i2; $tInd < count($arr2); $tInd++) {
            array_push($newArr, $arr2[$tInd]);
        }
        $i2 = count($arr2);
    }
    if ($i2 >= count($arr2)) {
        for ($tInd = $i1; $tInd < count($arr1); $tInd++) {
            array_push($newArr, $arr1[$tInd]);
        }
        $i1 = count($arr1);
    }
}

print_r($newArr);