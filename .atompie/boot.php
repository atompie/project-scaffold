<?php

use AtomPie\Core\Config\ConfigSwitcher;
use AtomPie\Core\FrameworkConfig;
use AtomPie\MiddleWare\ApiVersioning;
use AtomPie\System\EndPointConfig;
use AtomPie\System\Kernel;
use AtomPie\System\Namespaces;
use AtomPie\Web\Environment;
use Example\Config\Production;

return function(Environment $oEnvironment, Kernel $oKernel) {

    /*
     * Local config
     */
    function config() {
        return is_file(__DIR__.'/.config')
            ? file_get_contents(__DIR__.'/.config')
            : null;
    }

    /*
     * Catch kernel events
     */
    $oKernel->handleEvent(Kernel::EVENT_APPLICATION_BOOT, function () {
        // register event handlers
    });

    /*
     * EndPoint namespaces 
     */
    $oEndPointsNamespaces = new Namespaces([
        'Example\EndPoint' // namespace for endpoints
    ]);

    /*
     * Return framework config
     */
    return new FrameworkConfig(
        "Hello",
        new EndPointConfig($oEndPointsNamespaces),
        new ConfigSwitcher(Production::class, config()),
        $oEnvironment,
        [ // Contract fillers
        ],
        [ // Middleware
            new ApiVersioning('Example\EndPoint', $oEndPointsNamespaces, 'application/vnd.atompie+json')
        ]
    );
};
