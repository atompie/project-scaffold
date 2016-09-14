<?php
use AtomPie\System\Router;

$oRouter = new Router();
$oRouter->get('/Hello/{Name}')->routeTo('Hello');

return $oRouter;