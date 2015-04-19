<?php
namespace Maileva;

use Maileva\Element\User;

class UserTest extends \PHPUnit_Framework_TestCase{
    /**
     * @expectedException \Maileva\Exception\Element
     */
    public function testNoAuthType()
    {

        $user = new User();

        $user->setLogin('gaetan');
        $user->setPassword('Yeah!');

        $user->verify();
    }
    /**
     * @expectedException \Maileva\Exception\Element
     */
    public function testNoPassword()
    {

        $user = new User();

        $user->setAuthType(User::AUTHTYPE_PLAINTEXT);
        $user->setLogin('gaetan');

        $user->verify();
    }
    /**
     * @expectedException \Maileva\Exception\Element
     */
    public function testNoLogin()
    {

        $user = new User();

        $user->setAuthType(User::AUTHTYPE_PLAINTEXT);
        $user->setPassword('Yeah!');

        $user->verify();
    }

    /**
     * @expectedException \Maileva\Exception\Element
     */
    public function testLoginTooLong()
    {

        $user = new User();

        $user->setLogin('azertyuiopqsdfghjklmwxcvbnazertyuiopqsdfghjklmwxcvbnazertyuiopqsdfghjklmwxcvbn');
        $user->setAuthType(User::AUTHTYPE_PLAINTEXT);
        $user->setPassword('Yeah!');

        $user->verify();
    }

    public function testValid()
    {

        $user = new User();

        $user->setAuthType(User::AUTHTYPE_PLAINTEXT);
        $user->setPassword('Yeah!');
        $user->setLogin('gaetan');

        $user->verify();
    }
}