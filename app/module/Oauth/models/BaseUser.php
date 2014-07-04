<?php
/**
 * This file is part of Vegas package
 *
 * @author Slawomir Zytko <slawomir.zytko@gmail.com>
 * @copyright Amsterdam Standard Sp. Z o.o.
 * @homepage http://vegas-cmf.github.io
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
 
namespace Oauth\models;

/**
 * Class BaseUser
 * @package Oauth\models
 */
class BaseUser extends \Auth\Models\BaseUser
{
    private $oAuthServiceDetails = array();

    /**
     * @param $details
     */
    public function setOAuthServiceDetails($details)
    {
        $this->oAuthServiceDetails = $details;
    }

    /**
     * @return array
     */
    public function getAttributes()
    {
        $attributes = parent::getAttributes();
        $attributes = array_merge($attributes, $this->oAuthServiceDetails);

        return $attributes;
    }
} 