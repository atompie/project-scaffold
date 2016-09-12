<?php
use AtomPie\System\EndPoint;
use Example\Hello;
use Example\Param\UserName;

return function (EndPoint $endPoint) {
    $endPoint->setClassName(Hello::class);
    $endPoint->onContract(UserName::class)->fillBy(function ($Name) {
        return new UserName($Name);
    });
};