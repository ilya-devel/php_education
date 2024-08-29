<?php

namespace App\Homework\classes\library;

use App\Homework\interface\library\GetBookInterface;

abstract class Book implements GetBookInterface
{
    protected $title;
    protected $author;
    protected $isbn;
    protected $countView = 0;

    function __construct(string $title, string $author, string $isbn)
    {
        $this->author = $author;
        $this->title = $title;
        $this->isbn = $isbn;
    }

    function about()
    {
        $about = "";
        $about .= "Author: $this->author\r\n";
        $about .= "Title: $this->title\r\n";
        $about .= "ISBN: $this->isbn\r\n";
        return $about;
    }

    function getTitle()
    {
        return $this->title;
    }
    function getAuthor()
    {
        return $this->author;
    }
    function getIsbn()
    {
        return $this->isbn;
    }

    function getCountView() {
        return $this->countView;
    }
}