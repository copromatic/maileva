<?php
namespace Maileva\Option;

use Maileva\Element\Option\Page;

class PageTest extends \PHPUnit_Framework_TestCase{
    public function testValid()
    {
        $pageOption = new Page();
        $pageOption->setId(1);

        $paperOptionRequest = new Page\Paper();
        $paperOptionRequest->setBackgroundId(2);

        $pageOption->setPaperOption($paperOptionRequest);

        $pageOption->verify();
    }
}