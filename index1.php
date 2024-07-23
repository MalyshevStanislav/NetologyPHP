<?php
echo "Введите Имя:";
$name = trim(fgets(STDIN));
echo "Введите Фамилию:";
$surname = trim(fgets(STDIN));
echo "Введите Отчество:";
$lastname = trim(fgets(STDIN));

$name = ucfirst($name);
$surname = ucfirst($surname);
$lastname = ucfirst($lastname);
$fullname = $surname . ' ' . $name . ' ' . $lastname;

$initials = strtoupper($name[0]) . '.' . strtoupper($lastname[0]) . '.';
$surnameAndInitials = $surname . ' ' . $initials;

$fio = strtoupper($surname[0]) . strtoupper($name[0]) . strtoupper($lastname[0]);

echo "Полное ФИО: $fullname\n";
echo "Инициалы: $surnameAndInitials\n";
echo "ФИО: $fio\n";