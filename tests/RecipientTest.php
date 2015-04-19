<?php
namespace Maileva;

use Maileva\Element\Address\Paper;
use Maileva\Element\Recipient;
use Maileva\Exception\Element;

class RecipientTest extends \PHPUnit_Framework_TestCase{
    /**
     * @expectedException \Maileva\Exception\Element
     */
    public function testNoId()
    {
        $recipient = new Recipient();
        $recipient->setPaperAddress($this->getValidPaperAddress());

        $recipient->verify();
    }

    /**
     * @expectedException \Maileva\Exception\Element
     */
    public function testInvalidCategory()
    {
        $recipient = new Recipient();
        $recipient->setPaperAddress($this->getValidPaperAddress());
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
        $recipient->setPaperAddress($this->getValidPaperAddress());
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

    public function testValid()
    {
        $recipient = new Recipient();
        $recipient->setPaperAddress($this->getValidPaperAddress());
        $recipient->setId(1);
        $recipient->setCategory(Recipient::INDIVIDUAL);

        $recipient->verify();
    }

    protected function getValidPaperAddress(){
        $paperAddress = new Paper();
        $paperAddress->setAddress('Company 2', 'Adams Smith', '', '', '5th Park Street', '3776 Melbourne');
        $paperAddress->setCountry('Australia');

        try{
           $paperAddress->verify();
        }catch(Element $e){
            throw new Exception('PaperAddress is not valid');
        }

        return $paperAddress;
    }
}