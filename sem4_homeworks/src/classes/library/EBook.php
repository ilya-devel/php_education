<?php

namespace App\Homework\classes\library;

class EBook extends Book {
    private $pages;
    private $url;

    function __construct(string $title, string $author, string $isbn, int $pages, string $url = "https:\\\\library.site")
    {
        parent::__construct($title, $author, $isbn);
        $this->pages = $pages;
        $this->url = $url . "\\". $this->isbn;
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
        return "Вы можете скачать книгу по ссылке: $this->url, на текущий момент её резервировали $this->countView раз\r\n";
    }
}