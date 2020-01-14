<?php
require 'vendor/autoload.php';
header('Content-Type: text/plain');


$graf = new Graf(6);

$graf->hozzaad(0, 1);
$graf->hozzaad(1, 2);
$graf->hozzaad(0, 2);
$graf->hozzaad(2, 3);
$graf->hozzaad(3, 4);
$graf->hozzaad(4, 5);
$graf->hozzaad(2, 4);

print($graf);

