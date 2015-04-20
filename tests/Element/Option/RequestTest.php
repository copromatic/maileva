<?php
namespace Maileva\Option;

use Maileva\Element\Option\Request;

class RequestTest extends \PHPUnit_Framework_TestCase{
    public function testValid()
    {
        $requestOption = new Request();

        $paperOptionRequest = new Request\Paper();
        $paperOptionRequest->isStampAdjust();

        $requestOption->setPaperOption($paperOptionRequest);

        $requestOption->verify();
    }
}