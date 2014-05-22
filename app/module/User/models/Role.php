<?php
/**
 * This file is part of Vegas package
 *
 * @author Jaroslaw Macko <jarek@amsterdam-standard.pl>
 * @copyright Amsterdam Standard Sp. Z o.o.
 * @homepage https://bitbucket.org/amsdard/vegas-phalcon
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace User\Models;

class Role extends \Vegas\Mvc\CollectionAbstract
{

    // Roles:
    const SUPER_ADMIN = 'SuperAdmin';
    const EDITOR = 'Editor';
    const USER = 'User';
    const GUEST = 'Guest';

    // List of roles
    static $roles = array(
        self::SUPER_ADMIN,
        self::EDITOR,
        self::USER,
        self::GUEST
    );

    public function getSource()
    {
        return 'vegas_acl_roles';
    }
}

