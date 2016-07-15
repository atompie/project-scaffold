<?php
namespace Example\Config {

    use AtomPie\Boundary\System\IAmEnvVariable;
    use AtomPie\Config\ApplicationConfig;

    class Production extends ApplicationConfig
    {
        /**
         * Fill config with data in constructor.
         * @param IAmEnvVariable $oEnv
         */
        public function __construct(IAmEnvVariable $oEnv)
        {
            $this->set('mysqlHost','127.0.0.1');
            $this->set('mysqlDatabase','test');
            $this->set('mysqlUser','root');
            $this->set('mysqlPassword','root');
        }
        
    }

}
