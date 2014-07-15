<?php
namespace Oauth;

class Module extends \Vegas\Mvc\ModuleAbstract
{
    public function __construct() {
        $this->namespace = __NAMESPACE__;
        $this->dir = __DIR__;
    }
}