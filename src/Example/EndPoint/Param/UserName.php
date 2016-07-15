<?php
namespace Example\EndPoint\Param;

/**
 * 
 * Value object UserName
 * @package Example\EndPoint\Param
 */
class UserName
{
    private $sName;

    public function __construct($sName)
    {
        if(is_numeric($sName)) {
            throw new \Exception('Validation failed.');
        }
        $this->sName = $sName;
    }

    public function getValue() {
        return $this->sName;
    }

    /**
     * Injection factory method.
     *
     * @param $Name
     * @return UserName
     */
    public static  function __build($Name) {
        return new UserName($Name);
    }
}