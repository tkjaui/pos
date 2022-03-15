<?php
require __DIR__ . '/../../vendor/autoload.php';

use Mike42\Escpos\Printer;
use Mike42\Escpos\PrintConnectors\RawbtPrintConnector;
use Mike42\Escpos\CapabilityProfile;


$profile = CapabilityProfile::load("default");
$connector = new RawbtPrintConnector();
$printer = new Printer($connector);
$printer->initialize();


$printer -> text("Hello World!\n");
$printer -> text("サカシタ\n");
$printer->pulse();
// $printer->feed();
// $printer->cut();

$printer->close();