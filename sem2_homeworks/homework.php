<?php

function add($a, $b)
{
    return $a + $b;
}

function sub($a, $b)
{
    return $a - $b;
}
function mult($a, $b)
{
    return $a * $b;
}
function div($a, $b)
{
    if ($b === 0)
        return "ERROR";
    return $a / $b;
}

function math($a, $b, $operation)
{
    switch ($operation) {
        case '-':
            return sub($a, $b);
        case '+':
            return add($a, $b);
        case '/':
            return div($a, $b);
        case '*':
            return mult($a, $b);
        default:
            return "Unknown operation";
    }

}

function showCities($lstCities)
{
    foreach ($lstCities as $region => $cities) {
        print ($region . ":" . PHP_EOL);
        print ("\t" . implode(", ", $cities) . PHP_EOL);
    }
}

$cities = [
    "Свердловская область" => ["Екатеринбург", "Каменск-Уральский", "Нижний Тагил"],
    "Московская область" => ["Москва", "Мытищи", "Химки"]
];

function translateWordRuToEng($sentence, $translate)
{
    $newSentence = [];
    foreach (mb_str_split($sentence) as $value) {
        if (array_key_exists($value, $translate)) {
            array_push($newSentence, $translate[$value]);
        } else {
            array_push($newSentence, $value);
        }
    }
    return implode("", $newSentence);
}

function power($val, $pow)
{
    if ($pow === 0)
        return 1;
    return $val * power($val, $pow - 1);
}

function showCurTime()
{
    $hours = date('H');
    $minutes = date('i');
    switch ($hours) {
        case (int) $hours === 1 || (int) $hours === 21:
            $hours = $hours . " " . "час";
            break;
        case (int) $hours >= 2 && (int) $hours <= 4 || (int) $hours >= 22 && (int) $hours <= 24:
            $hours = $hours . " " . "часа";
            break;
        default:
            $hours = $hours . " " . "часов";
            break;
    }

    switch ($minutes) {
        case $minutes == 1 || $minutes == 21 || $minutes == 31 || $minutes == 41 || $minutes == 51:
            $minutes = $minutes . " " . "минута";
            break;
        case $minutes >= 2 && $minutes <= 4:
        case $minutes >= 22 && $minutes <= 24:
        case $minutes >= 32 && $minutes <= 34:
        case $minutes >= 42 && $minutes <= 44:
        case $minutes >= 52 && $minutes <= 54:
            $minutes = $minutes . " " . "минуты";
            break;
        default:
            $minutes = $minutes . " " . "минут";
            break;
    }

    print ($hours . " " . $minutes . PHP_EOL);
}

$characters = [
    "а" => "a",
    "б" => "b",
    "в" => "v",
    "г" => "g",
    "д" => "d",
    "е" => "e",
    "ё" => "yo",
    "ж" => "g",
    "з" => "z",
    "и" => "i",
    "й" => "i'",
    "к" => "k",
    "л" => "l",
    "м" => "m",
    "н" => "n",
    "о" => "o",
    "п" => "p",
    "р" => "r",
    "с" => "s",
    "т" => "t",
    "у" => "u",
    "ф" => "f",
    "х" => "h",
    "ц" => "ts",
    "ч" => "ch",
    "ш" => "sh",
    "щ" => "tch",
    "ъ" => "'",
    "ы" => "i'",
    "ь" => "`",
    "э" => "e'",
    "ю" => "yu",
    "я" => "ya"
];

print (math(3, 5, '*') . PHP_EOL);
print (math(3, 5, '+') . PHP_EOL);
print (math(3, 5, '-') . PHP_EOL);
print (math(3, 5, '/') . PHP_EOL);
print (math(3, 0, '/') . PHP_EOL);
print (math(3, 0, ':') . PHP_EOL);

showCities($cities);

print (translateWordRuToEng("привет мир!" . PHP_EOL, $characters));

print ("Работа функции возведения в степень: " . power(5, 3) . PHP_EOL);

showCurTime();