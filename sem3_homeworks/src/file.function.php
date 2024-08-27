<?php

// function readAllFunction(string $address) : string {
function readAllFunction(array $config): string
{
    $address = $config['storage']['address'];

    if (file_exists($address) && is_readable($address)) {
        $file = fopen($address, "rb");

        $contents = '';

        while (!feof($file)) {
            $contents .= fread($file, 100);
        }

        fclose($file);
        return $contents;
    } else {
        return handleError("Файл не существует");
    }
}

// function addFunction(string $address) : string {
function addFunction(array $config): string
{
    $address = $config['storage']['address'];

    $name = readline("Введите имя: ");
    $date = readline("Введите дату рождения в формате ДД-ММ-ГГГГ: ");
    $data = $name . ", " . $date . "\r\n";

    if (!validate($date)) {
        return handleError("Запись $date не корректна");
    }

    $fileHandler = fopen($address, 'a');

    if (fwrite($fileHandler, $data)) {
        return "Запись $data добавлена в файл $address";
    } else {
        return handleError("Произошла ошибка записи. Данные не сохранены");
    }

    fclose($fileHandler);
}

// function clearFunction(string $address) : string {
function clearFunction(array $config): string
{
    $address = $config['storage']['address'];

    if (file_exists($address) && is_readable($address)) {
        $file = fopen($address, "w");

        fwrite($file, '');

        fclose($file);
        return "Файл очищен";
    } else {
        return handleError("Файл не существует");
    }
}

function helpFunction()
{
    return handleHelp();
}

function readConfig(string $configAddress): array|false
{
    return parse_ini_file($configAddress, true);
}

function readProfilesDirectory(array $config): string
{
    $profilesDirectoryAddress = $config['profiles']['address'];

    if (!is_dir($profilesDirectoryAddress)) {
        mkdir($profilesDirectoryAddress);
    }

    $files = scandir($profilesDirectoryAddress);

    $result = "";

    if (count($files) > 2) {
        foreach ($files as $file) {
            if (in_array($file, ['.', '..']))
                continue;

            $result .= $file . "\r\n";
        }
    } else {
        $result .= "Директория пуста \r\n";
    }

    return $result;
}

function readProfile(array $config): string
{
    $profilesDirectoryAddress = $config['profiles']['address'];

    if (!isset($_SERVER['argv'][2])) {
        return handleError("Не указан файл профиля");
    }

    $profileFileName = $profilesDirectoryAddress . $_SERVER['argv'][2] . ".json";

    if (!file_exists($profileFileName)) {
        return handleError("Файл $profileFileName не существует");
    }

    $contentJson = file_get_contents($profileFileName);
    $contentArray = json_decode($contentJson, true);

    $info = "Имя: " . $contentArray['name'] . "\r\n";
    $info .= "Фамилия: " . $contentArray['lastname'] . "\r\n";

    return $info;
}

function checkBirthday(array $config)
{
    $address = $config['storage']['address'];

    if (file_exists($address) && is_readable($address)) {
        $fileHandler = fopen($address, 'r');
        $find = false;
        while (($buffer = fgets($fileHandler, 4096)) != false) {
            $date = explode("-", explode(", ", $buffer)[1]);
            if ($date[0] === date('d') && $date[1] === date('m')) {
                print ($buffer);
                $find = true;
            }
        }
        fclose($fileHandler);

        if (!$find) {
            print ("Сегодня именинников нет" . PHP_EOL);
        }

    } else {
        print (handleError("Файл не существует или не доступен для чтения"));
    }
    return "";
}

function removeFunction(array $config): string
{
    $address = $config['storage']['address'];

    if (file_exists($address) && is_readable($address)) {
        $name = readline("Введите имя: ");
        $date = readline("Введите дату рождения в формате ДД-ММ-ГГГГ: ");
        $data = $name . ", " . $date . "\r\n";

        if ($name === "" && $date === "") {
            return handleError("Вы не указали ни даты, ни имени для удаления");
        }

        if ($date !== "" && !validate($date)) {
            return handleError("Запись $date не корректна");
        }

        $lstForRemove = [];
        $checked = false;

        if (count($lstForRemove) == 0 && !$checked) {
            $fileHandler = fopen($address, 'r');
            while (($buffer = fgets($fileHandler, 4096)) != false) {
                $lstRow = explode(", ", $buffer, 4096);
                if ($buffer === $data) {
                    array_push($lstForRemove, $buffer);
                }
                if (($lstRow[0] === $name && $date === "") || ($lstRow[1] === $date . "\r\n" && $name === "")) {
                    array_push($lstForRemove, $buffer);
                }
            }
            $checked = true;
            fclose($fileHandler);
        }
        if (count($lstForRemove) == 0 && $checked) {
            print ("Нет подходящих для удаления строк" . PHP_EOL);
        } else {
            $fileHandler = fopen($address, 'r');
            $newFile = "";
            while (($buffer = fgets($fileHandler, 4096)) != false) {
                if (gettype(array_search($buffer, $lstForRemove)) === "boolean") {
                    $newFile .= $buffer;
                } else {
                    $msg = array_splice($lstForRemove, array_search($buffer, $lstForRemove), 1)[0];
                    print ("Удалена запись: $msg" . PHP_EOL);
                }
            }
            fclose($fileHandler);
            $fileHandler = fopen($address, 'w');
            fwrite($fileHandler, $newFile);
            fclose($fileHandler);
        }

    } else {
        print (handleError("Файл не существует или не доступен для чтения"));
    }
    return "";
}
