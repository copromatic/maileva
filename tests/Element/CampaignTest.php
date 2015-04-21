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
use Maileva\Element\Stapling;
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
        $recipient1 = RecipientTest::getValidRecipient(0);
        $recipient2 = RecipientTest::getValidRecipient(1);
        $request->addRecipient($recipient1);
        $request->addRecipient($recipient2);

        //DOCUMENTS
        $document1 = DocumentTest::getValidDocument(0);
        $document2 = DocumentTest::getValidDocument(1);
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
        $docInFold->setFirstPage(2);
        $pageInDoc = new PageInDoc();
        $pageInDoc->setNumber(2);
        $pageInDoc->setPageOptionId('134');
        $docInFold->addPage($pageInDoc);

        $stapling = new Stapling();
        $stapling->setFirstPageOffset(1);
        $stapling->setLastPageOffset(3);
        $docInFold->addStaplingDetails($stapling);

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