<?php
namespace Auth;

use Vegas\Mvc\ModuleAbstract;

class Module extends ModuleAbstract
{
    public function __construct() {
        $this->namespace = __NAMESPACE__;
        $this->dir = __DIR__;
    }
}