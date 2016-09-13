<?php
require  'RouterFacade.php';

$oRouter = new RouterFacade();
$oRouter->get('/test/{Name}')->routeTo('Hello');
$oRouter->get('/test1/{id}')->routeTo('Hello');

$_REQUEST = $oRouter->dispatch($_SERVER);