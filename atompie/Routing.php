<?php
use AtomPie\System\Router;

$oRouter = new Router();
$oRouter->get('/test/{Name}')->routeTo('Hello');
$oRouter->get('')->routeTo('Hello');

return $oRouter;