<?php
namespace Maileva;

use Maileva\Element\Hash;

class HashTest extends \PHPUnit_Framework_TestCase{
    /**
     * @expectedException \Maileva\Exception\Element
     */
    public function testEmptyHash()
    {
        $hash = new Hash();

        $hash->verify();
    }

    public function testValid()
    {
        $hash = new Hash();

        $hash->setType(Hash::MD5);
        $hash->setHash(md5_file(__FILE__));

        $hash->verify();
    }
}