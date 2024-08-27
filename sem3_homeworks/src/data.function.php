<?php

function testShow()
{
    print ("this is test" . PHP_EOL);
}
function validate(string $date): bool
{
    $dateBlocks = explode("-", $date);

    if (count($dateBlocks) < 3) {
        return false;
    }

    if (isset($dateBlocks[0]) && $dateBlocks[0] > 31) {
        return false;
    }

    if (isset($dateBlocks[1]) && $dateBlocks[1] > 12) {
        return false;
    }

    if (isset($dateBlocks[2]) && $dateBlocks[2] > date('Y')) {
        return false;
    }

    // Лучше добавить также проверку в случае високосных годов

    return validateDate($date);

    // return true;
}

function validateDate($date, $format = 'd-m-Y', $strict=true): bool
{
    $d = DateTime::createFromFormat($format, $date);
    if ($strict) {
        $errors = DateTime::getLastErrors();
        if (!empty($errors['warning_count'])) {
            return false;
        }
    }
    return $d && strtolower($d->format($format)) === strtolower($date);
}
