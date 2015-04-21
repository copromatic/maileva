<?php
namespace Maileva;

use Maileva\Element\ContentMergeField;
use Maileva\Element\MergeField;

class MergeFieldTest extends \PHPUnit_Framework_TestCase{
    /**
     * @expectedException \Maileva\Exception\Element
     */
    public function testInvalidFont()
    {
        $field = new MergeField();

        $field->setPageNumber(1);
        $field->setFontName('Ariel');
        $field->setFontSize(12);
        $field->setPosUnit(MergeField::UNITE_CM);
        $field->setPosX(3);
        $field->setPosY(3);

        $content = new ContentMergeField();
        $content->setValue('YES');
        $field->setContent($content);

        $field->verify();
    }
    /**
     * @expectedException \Maileva\Exception\Element
     */
    public function testNoContent()
    {
        $field = new MergeField();

        $field->setPageNumber(1);
        $field->setFontName('Ariel');
        $field->setFontSize(12);
        $field->setPosUnit(MergeField::UNITE_CM);
        $field->setPosX(3);
        $field->setPosY(3);

        $field->verify();
    }

    /**
     * @expectedException \Maileva\Exception\Element
     */
    public function testFontColor()
    {
        $field = new MergeField();

        $field->setPageNumber(1);
        $field->setFontName(MergeField::FONT_ARIAL);
        $field->setFontSize(12);
        $field->setPosUnit(MergeField::UNITE_CM);
        $field->setFontColor('111111');
        $field->setPosX(3);
        $field->setPosY(3);

        $content = new ContentMergeField();
        $content->setValue('YES');
        $field->setContent($content);

        $field->verify();
    }

    /**
     * @expectedException \Maileva\Exception\Element
     */
    public function testOrientationTooBig()
    {
        $field = new MergeField();

        $field->setPageNumber(1);
        $field->setFontName(MergeField::FONT_ARIAL);
        $field->setFontSize(12);
        $field->setPosUnit(MergeField::UNITE_CM);
        $field->setPosX(3);
        $field->setPosY(3);
        $field->setOrientation(365);

        $content = new ContentMergeField();
        $content->setValue('YES');
        $field->setContent($content);

        $field->verify();
    }

    /**
     * @expectedException \Maileva\Exception\Element
     * @dataProvider getTooBigTooSmallFont
     */
    public function testFontTooBigTooSmall($fontSize)
    {
        $field = new MergeField();

        $field->setPageNumber(1);
        $field->setFontName(MergeField::FONT_ARIAL);
        $field->setFontSize($fontSize);
        $field->setPosUnit(MergeField::UNITE_CM);
        $field->setPosX(3);
        $field->setPosY(3);

        $content = new ContentMergeField();
        $content->setValue('YES');
        $field->setContent($content);

        $field->verify();
    }

    public function getTooBigTooSmallFont(){
        return array(array(1), array(2), array(3), array(4), array(5), array(73), array(74));
    }

    public function testValid()
    {
        $field = new MergeField();

        $field->setPageNumber(1);
        $field->setFontName(MergeField::FONT_ARIAL);
        $field->setFontSize(12);
        $field->setPosUnit(MergeField::UNITE_CM);
        $field->setPosX(3);
        $field->setPosY(3);

        $content = new ContentMergeField();
        $content->setValue('YES');
        $field->setContent($content);

        $field->verify();
    }
}