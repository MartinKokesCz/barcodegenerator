<?php
require_once __DIR__ . DIRECTORY_SEPARATOR . 'vendor' . DIRECTORY_SEPARATOR . 'autoload.php';

use Superzoo\Generator;

// TODO check if it is in array 500 1000 2000
$amount = filter_input(INPUT_GET, 'amount');
$EAN = filter_input(INPUT_GET, 'EAN');

$generator = new Generator();

$generator->buildPDF($EAN, $amount);