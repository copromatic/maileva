<?php
namespace Maileva;

use Maileva\Element\Address\Paper;
use Maileva\Element\Campaign;
use Maileva\Element\Content;
use Maileva\Element\DocInFold;
use Maileva\Element\Document;
use Maileva\Element\Fold;
use Maileva\Element\Option;
use Maileva\Element\PageInDoc;
use Maileva\Element\Recipient;
use Maileva\Element\Request;
use Maileva\Element\User;

class CampaignTest extends \PHPUnit_Framework_TestCase{
    public function testValid()
    {
        /** @var Element $campaign */
        $campaign = new Campaign();

        $campaign->setName('Campagne Test');
        $campaign->setTrackId('1234');
        $campaign->setApplication('Copromatic');
        $campaign->setBreakdownCode('COPRO-1-2015');

        $campaign->setUser($this->getValidUser());
        $campaign->addRequest($this->getValidRequest());
        $campaign->addRequest($this->getValidRequest());

        $campaign->verify();

        echo $campaign->generateXml(new \SimpleXMLElement('<Campaign></Campaign>'))->saveXML();exit;
    }

    protected function getValidUser(){
        $user = new User();

        $user->setAuthType(User::AUTHTYPE_PLAINTEXT);
        $user->setLogin('copromatic');
        $user->setPassword('copromatic2015');

        return $user;
    }

    protected function getValidRequest(){
        $request = new Request();

        $request->setMediaType(Request::PAPER);
        $request->setTrackId('234');


        //RECIPIENTS
        $paperAddress = new Paper();

        #1
        $recipient1 = new Recipient();
        $recipient1->setTrackId('1234');
        $recipient1->setId(1);

        $paperAddress->setAddress('Copromatic', '', '', '8 rue Jean Moulin', '', '69001 Lyon');
        $recipient1->setPaperAddress($paperAddress);

        #2
        $recipient2 = new Recipient();
        $recipient2->setTrackId('1234');
        $recipient2->setId(2);

        $paperAddress->setAddress('Copromatic', 'Gaetan Hautecoeur', '', '8 rue Jean Moulin', '', '69001 Lyon');
        $recipient2->setPaperAddress($paperAddress);

        $request->addRecipient($recipient1);
        $request->addRecipient($recipient2);

        //DOCUMENTS
        $document1 = new Document();
        $document1->setId(1);

        $content = new Content();
        $content->setUri('b000001000.pdf');

        $document1->setContent($content);

        $document2 = new Document();
        $document2->setId(2);
        $document2->setContent($content);

        $request->addDocumentData($document1);
        $request->addDocumentData($document2);

        //FOLDS
        $fold = new Fold();
        $fold->setTrackId('xsx');
        $fold->setId('1');
        $fold->setRecipientId($recipient1->getId());

        #Doc
        $docInFold = new DocInFold();
        $docInFold->setDocumentId($document1->getId());
        $pageInDoc = new PageInDoc();
        $pageInDoc->setNumber(1);
        $pageInDoc->setPageOptionId('134');
        $docInFold->addPage($pageInDoc);

        $fold->addDocument($docInFold);

        $docInFold = new DocInFold();
        $docInFold->setDocumentId($document2->getId());
        $fold->addDocument($docInFold);

        $request->addFold($fold);


        //OPTION

        $option = new Option();

        #request
        $optionPaper = new Option\Request\Paper();
        $optionPaper->setRemoveInvalidReturnEnvelope(true);
        $optionPaper->setStampAdjust(true);

        $optionRequest = new Option\Request();
        $optionRequest->setPaperOption($optionPaper);
        $option->setRequestOption($optionRequest);

        #document
        $optionPaperPage = new Option\Page\Paper();
        $optionPaperPage->setBackgroundId(1);
        $insertId = new Option\Page\InsertPageId();
        $insertId->setValue('134');
        $insertId->setType(Option\Page\InsertPageId::INSERTPAGEID_TYPE_RV);
        $optionPaperPage->setInsertPageId($insertId);

        $optionPaper = new Option\Document\Paper();
        $optionPaper->setPageOption($optionPaperPage);
        $optionPaper->setStaple(true);

        $optionDocument = new Option\Document();
        $optionDocument->setPaperOption($optionPaper);
        $optionDocument->setId(1);

        $option->addDocumentOptions($optionDocument);

        #page
        $optionPage = new Option\Page();
        $optionPage->setPaperOption($optionPaperPage);
        $optionPage->setId(1);

        $option->addPageOptions($optionPage);

        $request->setOptions($option);



        return $request;
    }
}