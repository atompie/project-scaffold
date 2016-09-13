<?php
use AtomPie\System\EndPoint;
use AtomPie\Web\Connection\Http\Header;
use Example\Hello;
use Example\Param\UserName;

return function (EndPoint $endPoint) {
    $endPoint->setClassName(Hello::class);
    $endPoint->onContract(UserName::class)->fillBy(function ($Name) {
        return new UserName($Name);
    });
    $endPoint->onResponse()->addHeader(Header::CONTENT_TYPE,'application/json');
};