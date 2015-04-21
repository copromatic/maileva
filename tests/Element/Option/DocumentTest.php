<?php
namespace Maileva\Option;

use Maileva\Element\Option\Document;

class DocumentTest extends \PHPUnit_Framework_TestCase{
    public function testValid()
    {
        $documentOption = new Document();

        $documentOption->setId('1');

        $paperOptionDocument = new Document\Paper();
        $paperOptionDocument->setStaple(true);
        $documentOption->setPaperOption($paperOptionDocument);

        $documentOption->verify();
    }
}