<?php
namespace Maileva;

use Maileva\Element\ContentMergeField;

class ContentMergeFieldTest extends \PHPUnit_Framework_TestCase{
    /**
     * @expectedException \Maileva\Exception\Element
     */
    public function testInvalidEncoding()
    {
        $content = new ContentMergeField();

        $content->setAutomatic('YES');

        $content->verify();
    }
    /**
     * @expectedException \Maileva\Exception\Element
     */
    public function testEmpty()
    {
        $content = new ContentMergeField();

        $content->verify();
    }

    /**
     * @expectedException \Maileva\Exception\Element
     */
    public function testTooManyData()
    {
        $content = new ContentMergeField();

        $content->setAutomatic(ContentMergeField::AUTOMATIC_AUTOMERGE);
        $content->setValue('Yes');

        $content->verify();
    }

    public function testValid()
    {
        $content = new ContentMergeField();

        $content->setValue('Yes');

        $content->verify();
    }
}