<?php

declare(strict_types=1);

const OPERATION_EXIT = 0;
const OPERATION_ADD = 1;
const OPERATION_DELETE = 2;
const OPERATION_PRINT = 3;
const OPERATION_RENAME = 4;
const OPERATION_SUM = 5;

$operations = [
    OPERATION_EXIT => OPERATION_EXIT . '. Завершить программу.',
    OPERATION_ADD => OPERATION_ADD . '. Добавить товар в список покупок.',
    OPERATION_DELETE => OPERATION_DELETE . '. Удалить товар из списка покупок.',
    OPERATION_PRINT => OPERATION_PRINT . '. Отобразить список покупок.',
    OPERATION_RENAME => OPERATION_RENAME . '. Переименовать товар.',
    OPERATION_SUM => OPERATION_SUM . '. Указать количество товара.',
];

$items = [];

function clearScreen(): void {
    system('clear'); // Linux/Unix
    // system('cls'); // Windows
}

function printItems(array $items): void {
    if (count($items)) {
        echo 'Ваш список покупок: ' . PHP_EOL;
        foreach ($items as $item => $quantity) {
            echo $item . ' - ' . $quantity . PHP_EOL;
        }
    } else {
        echo 'Ваш список покупок пуст.' . PHP_EOL;
    }
}

function getOperationNumber(array $operations): int {
    do {
        echo 'Выберите операцию для выполнения: ' . PHP_EOL;
        echo implode(PHP_EOL, $operations) . PHP_EOL . '> ';
        $operationNumber = (int) trim(fgets(STDIN));

        if (!array_key_exists($operationNumber, $operations)) {
            clearScreen();
            echo '!!! Неизвестный номер операции, повторите попытку.' . PHP_EOL;
        }
    } while (!array_key_exists($operationNumber, $operations));

    return $operationNumber;
}

function addItem(array &$items): void {
    echo "Введите название товара для добавления в список: \n> ";
    $itemName = trim(fgets(STDIN));
    echo "Введите количество товара: \n> ";
    $quantity = (int) trim(fgets(STDIN));
    $items[$itemName] = $quantity;
}

function deleteItem(array &$items): void {
    if (count($items) === 0) {
        echo 'Список покупок пуст. Нечего удалять.' . PHP_EOL;
        return;
    }
    echo 'Текущий список покупок:' . PHP_EOL;
    printItems($items);

    echo 'Введите название товара для удаления из списка:' . PHP_EOL . '> ';
    $itemName = trim(fgets(STDIN));

    if (array_key_exists($itemName, $items)) {
        unset($items[$itemName]);
    } else {
        echo 'Товар не найден в списке.' . PHP_EOL;
    }
}

function printShoppingList(array $items): void {
    printItems($items);
    echo 'Всего ' . count($items) . ' позиций.' . PHP_EOL;
    echo 'Нажмите enter для продолжения';
    fgets(STDIN);
}

function renameItem(array &$items): void {
    if (count($items) === 0) {
        echo 'Список покупок пуст. Нечего переименовывать.' . PHP_EOL;
        return;
    }
    echo 'Текущий список покупок:' . PHP_EOL;
    printItems($items);

    echo 'Введите название товара для переименовывания:' . PHP_EOL . '> ';
    $oldName = trim(fgets(STDIN));

    if (array_key_exists($oldName, $items)) {
        echo 'Введите новое название товара:' . PHP_EOL . '> ';
        $newName = trim(fgets(STDIN));
        $items[$newName] = $items[$oldName];
        unset($items[$oldName]);
    } else {
        echo 'Товар не найден в списке.' . PHP_EOL;
    }
}

function setItemQuantity(array &$items): void {
    if (count($items) === 0) {
        echo 'Список покупок пуст. Нечего изменять.' . PHP_EOL;
        return;
    }
    echo 'Текущий список покупок:' . PHP_EOL;
    printItems($items);

    echo 'Введите название товара для изменения количества:' . PHP_EOL . '> ';
    $itemName = trim(fgets(STDIN));

    if (array_key_exists($itemName, $items)) {
        echo 'Введите новое количество товара:' . PHP_EOL . '> ';
        $quantity = (int) trim(fgets(STDIN));
        $items[$itemName] = $quantity;
    } else {
        echo 'Товар не найден в списке.' . PHP_EOL;
    }
}

do {
    clearScreen();
    printItems($items); // Переместим сюда, чтобы список выводился перед выбором операции
    $operationNumber = getOperationNumber($operations);

    echo 'Выбрана операция: ' . $operations[$operationNumber] . PHP_EOL;

    switch ($operationNumber) {
        case OPERATION_ADD:
            addItem($items);
            break;

        case OPERATION_DELETE:
            deleteItem($items);
            break;

        case OPERATION_PRINT:
            printShoppingList($items);
            break;

        case OPERATION_RENAME:
            renameItem($items);
            break;

        case OPERATION_SUM:
            setItemQuantity($items);
            break;
    }

    echo "\n ----- \n";
} while ($operationNumber > 0);

echo 'Программа завершена' . PHP_EOL;
?>