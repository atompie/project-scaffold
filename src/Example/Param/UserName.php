<?php
namespace Example\Param;

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

}