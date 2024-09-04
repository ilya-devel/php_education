<?php

namespace Geekbrains\Application1\Models;

class User
{
    private ?string $userName;
    private ?int $userBirthday;

    private static string $storageAddress = '/storage/birthdays.txt';

    public function __construct(string $name = null, int $birthday = null)
    {
        $this->userName = $name;
        $this->userBirthday = $birthday;
    }

    public function setName(string $userName): void
    {
        $this->userName = $userName;
    }

    public function getUserName(): string
    {
        return $this->userName;
    }

    public function getUserBirthday(): int
    {
        return $this->userBirthday;
    }

    public function setBirthdayFromString($birthdayString): void
    {
        $this->userBirthday = strtotime($birthdayString);
    }

    public static function getAllUsersFromStorage(): array|false
    {
        $address = $_SERVER['DOCUMENT_ROOT'] . User::$storageAddress;

        if (file_exists($address) && is_readable($address)) {
            $file = fopen($address, "r");

            $users = [];

            while (!feof($file)) {
                $userString = fgets($file);
                $userArray = explode(",", $userString);
                if (!$userArray[0]) {
                    continue;
                }
                $user = new User(
                    $userArray[0]
                );
                $user->setBirthdayFromString($userArray[1]);

                $users[] = $user;
            }

            fclose($file);

            return $users;
        } else {
            return false;
        }
    }

    public static function saveUserToStorage(string $userData): array
    {
        $address = $_SERVER['DOCUMENT_ROOT'] . User::$storageAddress;

        if (file_exists($address) && is_readable($address)) {
            $user = explode('&', $userData);

            $name = urldecode(explode('=', $user[0])[1]);
            $date = urldecode(explode('=', $user[1])[1]);
            // if (User::validate($date)) {
            if ($date != '' && $name != '') {
                $file = fopen($address, "a");
                $data = $name . ", " . $date . "\r\n";
                fwrite($file, $data);
                fclose($file);
                return [
                    'isOk' => true,
                    'message' => $data . ' записана'
                ];
            } else {
                return [
                    'isOk' => false,
                    'message' => 'Указанная дата не валидна'
                ];
            }
        } else {
            return [
                'isOk' => false,
                'message' => 'Возникла ошибка при обработке'
            ];
        }
    }

    // public static function validate(string $date): bool
    // {
    //     $dateBlocks = explode("-", $date);

    //     if (count($dateBlocks) < 3) {
    //         return false;
    //     }

    //     if (isset($dateBlocks[0]) && $dateBlocks[0] > 31) {
    //         return false;
    //     }

    //     if (isset($dateBlocks[1]) && $dateBlocks[1] > 12) {
    //         return false;
    //     }

    //     if (isset($dateBlocks[2]) && $dateBlocks[2] > date('Y')) {
    //         return false;
    //     }

    //     return User::validateDate($date);

    // }
    // public static function validateDate($date, $format = 'd-m-Y', $strict = true): bool
    // {
    //     $d = DateTime::createFromFormat($format, $date);
    //     if ($strict) {
    //         $errors = DateTime::getLastErrors();
    //         if (!empty($errors['warning_count'])) {
    //             return false;
    //         }
    //     }
    //     return $d && strtolower($d->format($format)) === strtolower($date);
    // }

}