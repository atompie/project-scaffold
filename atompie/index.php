<?php
use AtomPie\Core\FrameworkConfig;
use AtomPie\System\Kernel;

ini_set('error_reporting','on');
ini_set('display_errors','on');
error_reporting(E_ALL);

$sVendorDir = __DIR__ . '/../vendor/';
/** @noinspection PhpIncludeInspection */
$oLoader = require $sVendorDir . 'autoload.php';

require 'Routing.php';

$oConfig = new FrameworkConfig(
    realpath(__DIR__.'/EndPoint'),
    "Hello"
);

// Kernel

$oKernel = new Kernel($oLoader);
$oResponse = $oKernel->__boot($oConfig);
$oResponse->send();
