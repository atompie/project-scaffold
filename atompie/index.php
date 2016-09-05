<?php
use AtomPie\Core\Dispatch\DispatchManifest;
use AtomPie\Core\FrameworkConfig;
use AtomPie\System\Context;
use AtomPie\System\Kernel;
ini_set('error_reporting','on');
ini_set('display_errors','on');
error_reporting(E_ALL);

$sVendorDir = __DIR__ . '/../vendor/';
/** @noinspection PhpIncludeInspection */
$oLoader = require $sVendorDir . 'autoload.php';

$oConfig = new FrameworkConfig(
    realpath(__DIR__.'/EndPoint'),
    "Hello"
);

$oDispatchManifest = DispatchManifest::factory($oConfig);
$oContext = new Context($oDispatchManifest->getEndPoint(), $oConfig);

// Kernel

$oKernel = new Kernel($oLoader);
$oResponse = $oKernel->boot($oConfig, $oDispatchManifest, $oContext);
$oResponse->send();
