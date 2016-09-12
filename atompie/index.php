<?php
use AtomPie\Core\Dispatch\DispatchManifest;
use AtomPie\Core\FrameworkConfig;
use AtomPie\System\Context;
use AtomPie\System\Kernel;
use AtomPie\System\RouteManifest;

ini_set('error_reporting','on');
ini_set('display_errors','on');
error_reporting(E_ALL);

$sVendorDir = __DIR__ . '/../vendor/';
/** @noinspection PhpIncludeInspection */
$oLoader = require $sVendorDir . 'autoload.php';

class RouterFacade {

    /**
     * @var \TreeRoute\Router
     */
    private $oRouter;

    /**
     * @var RouteManifest
     */
    private $oRouteManifest;

    public function __construct()
    {
        $this->oRouter = new \TreeRoute\Router();
    }

    /**
     * @param $sMethod
     * @param $string
     * @return DispatchManifest
     */
    public function dispatch($sMethod, $string)
    {
        $aResult = $this->oRouter->dispatch($sMethod, $string);

        if (!isset($aResult['error'])) {
            $defaultEndPoint = $aResult['handler'];
            $params = $aResult['params'];

            $oConfig = new FrameworkConfig(
                realpath(__DIR__.'/EndPoint'),
                $defaultEndPoint
            );

            return DispatchManifest::factory($oConfig, $params);

        } else {
            switch ($aResult['error']['code']) {
                case 404 :
                    // Not found handler here
                    break;
                case 405 :
                    // Method not allowed handler here
                    $allowedMethods = $aResult['allowed'];
                    if ($sMethod == 'OPTIONS') {
                        // OPTIONS method handler here
                    }
                    break;
            }
        }
    }

    /**
     * @param $sUrl
     * @return RouteManifest
     */
    public function post($sUrl)
    {
        $this->oRouteManifest = new RouteManifest(
            $this->oRouter,
            ['POST'], $sUrl);


        return $this->oRouteManifest;
    }

    /**
     * @param $sUrl
     * @return RouteManifest
     */
    public function get($sUrl)
    {
        $this->oRouteManifest = new RouteManifest(
            $this->oRouter,
            ['GET'], $sUrl);
        return $this->oRouteManifest;
    }

    /**
     * @param $sUrl
     * @return RouteManifest
     */
    public function put($sUrl)
    {
        $this->oRouteManifest = new RouteManifest(
            $this->oRouter,
            ['PUT'], $sUrl);
        return $this->oRouteManifest;
    }

    /**
     * @param $sUrl
     * @return RouteManifest
     */
    public function delete($sUrl)
    {
        $this->oRouteManifest = new RouteManifest(
            $this->oRouter,
            ['DELETE'], $sUrl);
        return $this->oRouteManifest;
    }

}


$oRouter = new RouterFacade();
$oRouter->get('/test/{id}')->routeTo('Hello');
$oRouter->get('/test1/{id}')->routeTo('Hello');

$sMethod = $_SERVER['REQUEST_METHOD'];
$oDispatchManifest = $oRouter->dispatch($sMethod, 'test/1');

//$oConfig = new FrameworkConfig(
//    realpath(__DIR__.'/EndPoint'),
//    "Hello"
//);
//
//$oDispatchManifest = DispatchManifest::factory($oConfig);
$oContext = new Context($oDispatchManifest->getEndPoint(), $oConfig);

// Kernel

$oKernel = new Kernel($oLoader);
$oResponse = $oKernel->boot($oConfig, $oDispatchManifest, $oContext);
$oResponse->send();
