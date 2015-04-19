<?php
namespace Maileva;

use Maileva\Element\Content;

class ContentTest extends \PHPUnit_Framework_TestCase{
    /**
     * @expectedException \Maileva\Exception\Element
     */
    public function testInvalidEncoding()
    {
        $content = new Content();

        $content->setUri('elo.pdf');
        $content->setValue('TEST RETST');
        $content->setEncoding('TEST');

        $content->verify();
    }

    /**
     * @expectedException \Maileva\Exception\Element
     */
    public function testNoUri()
    {
        $content = new Content();

        $content->setValue('TEST RETST');
        $content->setEncoding(Content::UTF_8);

        $content->verify();
    }

    public function testValid()
    {
        $content = new Content();

        $content->setUri('elo.pdf');
        $content->setValue('TEST RETST');
        $content->setEncoding(Content::UTF_8);

        $content->verify();
    }
}