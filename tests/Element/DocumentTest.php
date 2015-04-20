<?php
namespace Maileva;

use Maileva\Element\Content;
use Maileva\Element\ContentMergeField;
use Maileva\Element\Document;
use Maileva\Element\MergeField;

class DocumentTest extends \PHPUnit_Framework_TestCase{
    /**
     * @expectedException \Maileva\Exception\Element
     */
    public function testTooManyMergeField()
    {
        $document = new Document();
        $document->setId(1);

        $content = new Content();
        $content->setUri('test.pdf');
        $document->setContent($content);

        for($i = 0; $i < 100; $i++){
            $mergeField = new MergeField();
            $mergeField->setPageNumber(1);
            $mergeField->setFontName(MergeField::FONT_ARIAL);
            $mergeField->setFontSize(12);
            $mergeField->setPosX(1);
            $mergeField->setPosY(1);
            $mergeField->setPosUnit(MergeField::UNITE_CM);

            $content = new ContentMergeField();
            $content->setId(1);

            $mergeField->setContent($content);

            $document->addMergeField($mergeField);
        }

        $document->verify();
    }
    /**
     * @dataProvider validContent
     */
    public function testValid($id, $uri)
    {
        $document = new Document();
        $document->setId($id);

        $content = new Content();
        $content->setUri($uri);
        $document->setContent($content);

        $document->verify();
    }

    public static function validContent(){

        return array(
            array(
                1,
                'doc1.pdf'
            ),
            array(
                2,
                'doc2.xlsx'
            ),
            array(
                2,
                'doc3.xls'
            ),
        );
    }

    public static function getValidDocument($version){
        $documents = self::validContent();
        if(!isset($documents[$version])){
            throw new Exception('Document is not valid');
        }

        $document = new Document();
        $document->setId($documents[$version][0]);

        $content = new Content();
        $content->setUri($documents[$version][1]);
        $document->setContent($content);

        try{
            $document->verify();
        }catch(Element $e){
            throw new Exception('Document is not valid');
        }

        return $document;
    }
}