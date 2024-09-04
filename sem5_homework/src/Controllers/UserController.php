<?php

namespace Geekbrains\Application1\Controllers;

use Geekbrains\Application1\Render;
use Geekbrains\Application1\Models\User;

class UserController {

    public function actionIndex() {
        $users = User::getAllUsersFromStorage();

        $render = new Render();

        if(!$users){
            return $render->renderPage(
                'user-empty.tpl',
                [
                    'title' => 'Список пользователей в хранилище',
                    'message' => "Список пуст или не найден"
                ]);
        }
        else{
            return $render->renderPage(
                'user-index.tpl',
                [
                    'title' => 'Список пользователей в хранилище',
                    'users' => $users
                ]);
        }
    }

    public function actionSave(string $args) {
        $result = User::saveUserToStorage($args);

        $render = new Render();

        if(!$result['isOk']){
            return $render->renderPage(
                'page-error.tpl',
                [
                    'title' => 'Ошибка',
                    'message' => $result['message']
                ]);
        }
        else{
            return UserController::actionIndex();
        }
    }
}