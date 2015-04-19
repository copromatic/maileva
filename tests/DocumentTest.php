<?php
namespace Maileva;

use Maileva\Element\Content;
use Maileva\Element\Document;
use Maileva\Element\Hash;

class DocumentTest extends \PHPUnit_Framework_TestCase{
    public function testValid()
    {
        $document = new Document();
        $document->setId(1);

        $content = new Content();
        $content->setUri('test.pdf');
        $document->setContent($content);

        $hash = new Hash();
        $hash->setType(Hash::SHA1);
        $hash->setHash(sha1('TETETE'));
        $document->setHash($hash);

        $document->setSize(189008);
        $document->setShrink(true);

        $document->verify();
    }
}