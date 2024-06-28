<?php
$variable = true;

if (is_bool($variable)) {
    echo 'bool';
} else if (is_int($variable)) {
    echo 'int';
} else if (is_float($variable)) {
    echo 'float';
} else if (is_string($variable)) {
    echo 'string';
} else if (is_null($variable)) {
    echo 'null';
} else {
    echo 'other';
}