<?php
namespace Maileva;

use Maileva\Element\Option;

class OptionTest extends \PHPUnit_Framework_TestCase{

    public function testValid()
    {
        $option = new Option();

        $requestOption = new Option\Request();
        $paperOption = new Option\Request\Paper();
        $paperOption->setStampAdjust(true);
        $requestOption->setPaperOption($paperOption);

        $option->setRequestOption($requestOption);

        $documentOption = new Option\Document();
        $documentOption->setId(1);
        $paperOption = new Option\Document\Paper();
        $paperOption->setStaple(true);
        $documentOption->setPaperOption($paperOption);

        $option->addDocumentOptions($documentOption);

        $pageOption = new Element\Option\Page();
        $pageOption->setId(1);
        $paperOption = new Option\Page\Paper();
        $paperOption->setBackgroundId(1);
        $pageOption->setPaperOption($paperOption);

        $option->addPageOptions($pageOption);

        $option->verify();
    }
}