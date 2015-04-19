<?php
namespace Maileva;

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
        $field->setContent('TEXT');

        $field->verify();
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
        $field->setContent('TEXT');

        $field->verify();
    }
}