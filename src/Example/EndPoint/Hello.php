<?php
namespace Example\EndPoint {

    use AtomPie\AnnotationTag\Client;
    use AtomPie\AnnotationTag\EndPoint;
    use Example\EndPoint\Param\UserName;

    class Hello
    {

        /**
         * @Client(Accept="text/html", Method="GET", Type="WebRequest")
         * @EndPoint(ContentType="text/html")
         * @param UserName $Name
         * @return string
         */
        public function __default(UserName $Name)
        {
            return 'Hello ' . $Name->getValue();
        }

    }

}