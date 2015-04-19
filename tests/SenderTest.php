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
        $sender->setPaperAddress($this->getValidPaperAddress());

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