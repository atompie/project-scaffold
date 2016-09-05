<?php
namespace Example {

    use Example\Param\UserName;

    class Hello
    {

        /**
         * @param UserName $Name
         * @return string
         */
        public function __default(UserName $Name)
        {
            return 'Hello ' . $Name->getValue();
        }

    }

}