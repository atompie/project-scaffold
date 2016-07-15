<?php
namespace Example\Config {

    use AtomPie\Boundary\System\IAmEnvVariable;

    class DevConfig extends Production
    {

        /**
         * Fill config with data in constructor.
         * @param IAmEnvVariable $oEnv
         */
        public function __construct(IAmEnvVariable $oEnv)
        {
            parent::__construct($oEnv);
            $this->override('mysqlHost','127.0.0.1');
            $this->override('mysqlDatabase','test');
            $this->override('mysqlUser','root');
            $this->override('mysqlPassword','root');
        }

    }

}