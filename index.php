<?php
// Вывод названия текущего файла
    echo "Название текущего файла: " . __FILE__ . "\n";

// Вывод номера текущей строки
    echo "Номер текущей строки: " . __LINE__ . "\n";

//Создайте многострочную переменную при помощи heredoc синтаксиса
    $heredoc = <<<MSV
        1
        2
        3
    MSV;

    echo $heredoc;

//Задайте две простые строковые переменные и используйте их для построения конечной фразы.
    $a='Рыба';
    $b='человек';

    echo "$a рыбою сыта, а $b человеком";