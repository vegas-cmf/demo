<?php
/**
 * @author Slawomir Zytko <slawomir.zytko@gmail.com>
 * @copyright Amsterdam Standard Sp. Z o.o.
 * Date: 5/23/14
 * Time: 9:25 AM
 */

namespace Oauth\Models;

use Vegas\Db\Decorator\CollectionAbstract;

/**
 * Class Identity
 * @package Oauth\Models
 */
class Identity extends CollectionAbstract
{
    public function getSource()
    {
        return 'vegas_oauth_identities';
    }

    /**
     * Finds indicated user oAuth identities
     *
     * @param \MongoId $userId
     * @return array
     */
    public static function findUserIdentities(\MongoId $userId)
    {
        return Identity::find(array(array('user_id' => $userId)));
    }

    /**
     * Stores user identity
     *
     * @param \MongoId $userId
     * @param \Vegas\Security\OAuth\Identity $oAuthIdentity
     * @return bool
     */
    public static function addUserIdentity(\MongoId $userId, \Vegas\Security\OAuth\Identity $oAuthIdentity)
    {
        $identity = new Identity();
        $identity->writeAttribute('user_id', $userId);
        $identity->writeAttribute('id', $oAuthIdentity->getId());
        $identity->writeAttribute('email', $oAuthIdentity->getEmail());
        $identity->writeAttribute('service', $oAuthIdentity->getService());

        return $identity->save();
    }
}