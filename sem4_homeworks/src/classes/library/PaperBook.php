<?php

namespace App\Homework\classes\library;

class PaperBook extends Book {
    private $pages;
    private $locate;

    function __construct(string $title, string $author, string $isbn, int $pages, string $locate = "Central Library")
    {
        parent::__construct($title, $author, $isbn);
        $this->pages = $pages;
        $this->locate = $locate;
    }

    function about() {
        $about = parent::about();
        $about .= "Pages: $this->pages\r\n";
        return $about;
    }

    function getPages() {
        return $this->pages;
    }

    function getBook() {
        $this->countView += 1;
        return "Книга ожидает вас в библиотеке $this->locate, на текущий момент её резервировали $this->countView раз\r\n";
    }
}