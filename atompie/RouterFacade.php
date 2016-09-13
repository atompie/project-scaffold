<?php

use AtomPie\System\RouteManifest;

class TreeRouterFacade extends \TreeRoute\Router implements \AtomPie\Boundary\System\IAddRoutes{

}

class RouterFacade
{

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
        $this->oRouter = new TreeRouterFacade();
    }

    /**
     * @param $aServerVariable
     * @return array
     * @throws Exception
     */
    public function dispatch($aServerVariable)
    {
        $sMethod = $aServerVariable['REQUEST_METHOD'];
        $sRequestUri = $aServerVariable['REQUEST_URI'];

        // TODO remove
        $sRequestUri = str_replace('/vagrant/atompie', '', $sRequestUri);

        $aResult = $this->oRouter->dispatch($sMethod, $sRequestUri);

        if (isset($aResult['error'])) {

            switch ($aResult['error']['code']) {
                case 404 :
                    // Not found handler here
                    throw new Exception('Not found');
                    break;
                case 405 :
                    // Method not allowed handler here
                    $allowedMethods = $aResult['allowed'];
                    if ($sMethod == 'OPTIONS') {
                        // OPTIONS method handler here
                    }
                    break;
            }

            return null;

        }

        $sEndPoint = $aResult['handler'];
        $aRequestParams = $aResult['params'];
        $aRequestParams[\AtomPie\Core\Dispatch\EndPointImmutable::END_POINT_QUERY] = $sEndPoint;

        return $aRequestParams;

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