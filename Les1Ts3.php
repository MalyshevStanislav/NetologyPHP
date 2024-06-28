<?php
$input = 1;

if (is_bool($input)) {
    echo 'bool';
} else if (is_int($input)) {
    echo 'int';
} else if (is_float($input)) {
    echo 'float';
} else if (is_string($input)) {
    echo 'string';
} else if (is_null($input)) {
    echo 'null';
} else {
    echo 'other';
}

?>

<?php
$input = '1';

switch (true) {
    case is_bool($input):
        echo 'bool';
        break;
    case is_float($input):
        echo 'float';
        break;
    case is_int($input):
        echo 'int';
        break;
    case is_string($input):
        echo 'string';
        break;
    case is_null($input):
        echo 'null';
        break;
    default:
        echo 'other';
        break;
}