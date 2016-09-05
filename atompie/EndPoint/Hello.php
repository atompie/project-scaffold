<?php
return function (\AtomPie\System\EndPoint $endPoint) {
    $endPoint->setClassName(\Example\Hello::class);
};