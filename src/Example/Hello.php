<?php
namespace Example {

    use AtomPie\AnnotationTag\Authorize;
    use AtomPie\AnnotationTag\Client;
    use Example\Param\UserName;

    class Hello
    {

        /**
         * @Client(Accept="application/json")
         * @Authorize(AuthToken="risto:risto", AuthType="basic")
         * @param UserName $Name
         * @return string
         */
        public function __default(UserName $Name)
        {
            return 'Hello ' . $Name->getValue();
        }

    }

}