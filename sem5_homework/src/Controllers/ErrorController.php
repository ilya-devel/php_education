<?php

namespace Geekbrains\Application1\Controllers;
use Geekbrains\Application1\Render;

class ErrorController
{

    public static function actionIndex(string $message)
    {
        $render = new Render();
        header("HTTP/1.1 404 Not Found");

        return $render->renderPage('page-error.tpl', [
            'title' => 'Error 404',
            'message' => $message
        ]);
    }
}
