<?php
return function (\AtomPie\System\EndPoint $endPoint) {
    $endPoint->setClassName(\Example\Hello::class);
    $endPoint->onContract(\Example\Param\UserName::class)->fillBy(function ($Name) {
        return new \Example\Param\UserName($Name);
    });
};