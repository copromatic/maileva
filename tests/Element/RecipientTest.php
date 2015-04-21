<?php
namespace Maileva;

use Maileva\Element\Recipient;

class RecipientTest extends \PHPUnit_Framework_TestCase{
    /**
     * @expectedException \Maileva\Exception\Element
     */
    public function testNoId()
    {
        $recipient = new Recipient();
        $recipient->setPaperAddress(PaperAddressTest::getValidPaperAddress(0));

        $recipient->verify();
    }

    /**
     * @expectedException \Maileva\Exception\Element
     */
    public function testInvalidCategory()
    {
        $recipient = new Recipient();
        $recipient->setPaperAddress(PaperAddressTest::getValidPaperAddress(1));
        $recipient->setId(1);
        $recipient->setCategory('TEST');

        $recipient->verify();
    }
    /**
     * @expectedException \Maileva\Exception\Element
     */
    public function testInvalidHasDigitalId()
    {
        $recipient = new Recipient();
        $recipient->setPaperAddress(PaperAddressTest::getValidPaperAddress(2));
        $recipient->setId(1);
        $recipient->setHasDigitalId('TEST');

        $recipient->verify();
    }
    /**
     * @expectedException \Maileva\Exception\Element
     */
    public function testNoAddress()
    {
        $recipient = new Recipient();
        $recipient->setId(1);

        $recipient->verify();
    }

    /**
     * @dataProvider validContent
     */
    public function testValid($id, $paperAddress, $category){
        $recipient = new Recipient();

        $recipient->setPaperAddress($paperAddress);
        $recipient->setId($id);
        $recipient->setCategory($category);

        $recipient->verify();
    }

    public static function validContent(){
        return array(
            array( 1, PaperAddressTest::getValidPaperAddress(0), Recipient::INDIVIDUAL ),
            array( 2, PaperAddressTest::getValidPaperAddress(1), Recipient::PROFESSIONAL ),
            array( 3, PaperAddressTest::getValidPaperAddress(2), Recipient::UNKNOWN )
        );
    }

    public static function getValidRecipient($version){
        $recipients = self::validContent();

        if(!isset($recipients[$version])){
            throw new Exception('Recipient is not valid');
        }
        $recipient = new Recipient();
        $recipient->setId($recipients[$version][0]);
        $recipient->setPaperAddress($recipients[$version][1]);
        $recipient->setCategory($recipients[$version][2]);

        try{
            $recipient->verify();
        }catch(Element $e){
            throw new Exception('Recipient is not valid');
        }

        return $recipient;
    }
}