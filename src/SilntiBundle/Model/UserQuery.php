<?php

namespace SilntiBundle\Model;

use SilntiBundle\Model\Base\UserQuery as BaseUserQuery;

/**
 * Skeleton subclass for performing query and update operations on the 'user' table.
 *
 *
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 */
class UserQuery extends BaseUserQuery
{
    public static function getUserByCredentials($email, $password) {
        $user = UserQuery::create()->findOneByEmail($email);
        if($user == null) return null;
        if($user->getMdp() == sha1($password)) return $user;
        else return null;
    }
}
