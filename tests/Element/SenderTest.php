<?php
namespace Maileva;

use Maileva\Element\Address\Paper;
use Maileva\Element\Sender;
use Maileva\Exception\Element;

class SenderTest extends \PHPUnit_Framework_TestCase{
    /**
     * @expectedException \Maileva\Exception\Element
     */
    public function testNoId()
    {
        $sender = new Sender();
        $sender->setPaperAddress(PaperAddressTest::getValidPaperAddress(1));

        $sender->verify();
    }

    /**
     * @expectedException \Maileva\Exception\Element
     */
    public function testNoAddress()
    {
        $sender = new Sender();
        $sender->setId(1);

        $sender->verify();
    }

    /**
     * @dataProvider validContent
     */
    public function testValid($id, $address){
        $sender = new Sender();
        $sender->setId($id);
        $sender->setPaperAddress($address);

        $sender->verify();
    }

    public static function validContent(){
        return array(
            array( 1, PaperAddressTest::getValidPaperAddress(0) ),
            array( 2, PaperAddressTest::getValidPaperAddress(1) ),
            array( 3, PaperAddressTest::getValidPaperAddress(2) )
        );
    }

    public static function getValidSender($version){
        $senders = self::validContent();
        if(!isset($senders[$version])){
            throw new Exception('Sender is not valid');
        }
        $sender = new Sender();
        $sender->setId($senders[$version][0]);
        $sender->setPaperAddress($senders[$version][1]);

        try{
            $sender->verify();
        }catch(Element $e){
            throw new Exception('PaperAddress is not valid');
        }

        return $sender;
    }
}