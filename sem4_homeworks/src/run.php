<?php

require('./vendor/autoload.php');

use App\Homework\classes\library\Book;
use App\Homework\classes\library\EBook;
use App\Homework\classes\library\PaperBook;


$books = [
    new PaperBook('Docker. Вводный курс. 3 издание', 'Кейн Шон П., Маттиас Карл', '978-601-09-7541-5', 352),
    new PaperBook('Контролируемый взлом. Библия социальной инженерии. 2-е издание', 'Другач Юрий Станиславович', '978-5-9775-1990-8', 192),
    new EBook('Linux и Go. Эффективное низкоуровневое программирование. 2-е издание', 'Цилюрик Олег Иванович', '978-5-9775-1979-3', 302)
];

print ($books[0]->getBook());
print ($books[0]->getBook());
print ($books[0]->getBook());
print ($books[1]->getBook());
print ($books[2]->getBook());
print ($books[2]->getBook());
print ($books[2]->getBook());
print ($books[2]->getBook());

foreach ($books as $key => $value) {
    if ($value instanceof Book) {
        print("Количество резервирования/скачивания книги \"" . $value->getTitle() . "\" , равно: " . $value->getCountView() . "\r\n");
    }
}
