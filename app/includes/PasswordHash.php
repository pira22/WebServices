<?php

/**
 * Password hash.
 * User: Rami Jemli
 * Date: 13/01/2015
 * Time: 11:24
 */
class PasswordHash
{

    // blowfish
    private static $algo = '$2a';
    // cost parameter
    private static $cost = '$10';

    // mainly for internal use
    public static function unique_salt()
    {
        return substr(sha1(mt_rand()), 0, 30);
    }

    // this will be used to generate a hash
    public static function hash($password)
    {
        $options = [
            'salt' => sha1(microtime(true)),
            'cost' => 12 // the default cost is 10
        ];
        return $hash = [
            'hash' => password_hash($password, PASSWORD_BCRYPT, $options),
            'salt' => $options['salt']
        ];
    }

    // this will be used to compare a password against a hash
    public static function check_password($newpassword, $salt , $hash)
    {
        $options = [
            'salt' => $salt,
            'cost' => 12 // the default cost is 10
        ];
        return  (password_hash($newpassword, PASSWORD_BCRYPT, $options) == $hash);
    }
}