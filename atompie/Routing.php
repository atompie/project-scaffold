<?php
use AtomPie\Boundary\System\IAmRouter;

return function (IAmRouter $router) {
    $router->addRoute(['get'],'test/{id:d+}','Hello');
};