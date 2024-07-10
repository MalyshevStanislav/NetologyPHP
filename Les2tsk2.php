#!/usr/bin/env php
<?php
echo "Введите первое число:";
$dividend = trim(fgets(STDIN));
echo "Введите второе число:";
$divider = trim(fgets(STDIN));

if (!is_numeric($dividend) || !is_numeric($divider)) {
    fwrite(STDERR, "Введите, пожалуйста, число\n");
    exit(1);
}

$dividend = (int)$dividend;
$divider = (int)$divider;

if ($divider==0){
    fwrite(STDERR,"Делить на 0 нельзя");
    exit(1);
}

$result = $dividend / $divider;
echo "Результат: $result\n";
