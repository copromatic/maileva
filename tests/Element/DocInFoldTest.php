<?php
namespace Maileva;

use Maileva\Element\DocInFold;
use Maileva\Element\PageInDoc;
use Maileva\Element\Stapling;

class DocInFoldTest extends \PHPUnit_Framework_TestCase{

    /**
     * @expectedException \Maileva\Exception\Element
     */
    public function testEmpty()
    {
        $doc = new DocInFold();

        $doc->verify();
    }
    public function testValid()
    {
        $doc = new DocInFold();
        $doc->setDocumentId(1);
        $doc->setFirstPage(1);
        $doc->setLastPage(5);

        $page = new PageInDoc();
        $page->setPageOptionId(1);
        $page->setNumber(1);
        $doc->addPage($page);

        $stapling = new Stapling();
        $stapling->setFirstPageOffset(1);
        $stapling->setLastPageOffset(3);
        $doc->addStaplingDetails($stapling);

        $stapling = new Stapling();
        $stapling->setFirstPageOffset(4);
        $doc->addStaplingDetails($stapling);

        $doc->verify();
    }
}