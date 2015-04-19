<?php
namespace Maileva;

use Maileva\Element\Address\Paper;
use Maileva\Element\Recipient;
use Maileva\Element\Request;
use Maileva\Element\Sender;

class RequestTest extends \PHPUnit_Framework_TestCase{
    /**
     * @expectedException \Maileva\Exception\Element
     */
    public function testInvalidMediaType()
    {
        $request = new Request();

        $request->setTrackId('1');
        $request->setMediaType('TEST');

        $request->verify();
    }

    /**
     * @expectedException \Maileva\Exception\Element
     */
    public function testNoTrackId()
    {
        $request = new Request();

        $request->setMediaType(Request::PAPER);
        $request->addRecipient($this->getValidRecipient());
        $request->addSender($this->getValidSender());

        $request->verify();
    }

    public function testValid()
    {
        $request = new Request();

        $request->setTrackId('1');
        $request->setMediaType(Request::PAPER);
        $request->addRecipient($this->getValidRecipient());
        $request->addSender($this->getValidSender());

        $request->verify();

        echo $request->generateXml(new \SimpleXMLElement('<xml/>'))->saveXml();exit;
    }

    public function getValidSender(){
        $sender = new Sender();
        $sender->setId(1);
        $sender->setPaperAddress($this->getValidPaperAddress());

        try{
            $sender->verify();
        }catch(Element $e){
            throw new Exception('Sender is not valid');
        }

        return $sender;
    }

    public function getValidRecipient(){
        $recipient = new Recipient();
        $recipient->setId(1);
        $recipient->setPaperAddress($this->getValidPaperAddress());

        try{
            $recipient->verify();
        }catch(Element $e){
            throw new Exception('Recipient is not valid');
        }

        return $recipient;
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