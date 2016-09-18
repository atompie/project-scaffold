<?php
use AtomPie\System\Dispatch\ClientConstrain;
use AtomPie\System\EndPoint;
use AtomPie\Web\Connection\Http\Header;
use Example\Hello;
use Example\Param\UserName;

return function (EndPoint $endPoint, ClientConstrain $client) {

//    $client->hasContentType('application/json');
    $client->accept('application/json');
//    $client->hasMethod('get');

    $endPoint->setClassName(Hello::class);
    $endPoint->onContract(UserName::class)->fillBy(function ($Name) {
        return new UserName($Name);
    });
    /*
    $endPoint->authorize(new Basic('risto','risto'));
    */
//    $endPoint->onResponse()->addHeader(Header::CONTENT_TYPE,'application/json');
};