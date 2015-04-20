<?php

$loader = require_once __DIR__ . '/../../../vendor/autoload.php';

$campaign = new \Maileva\Element\Campaign();

$campaign->setName('Campagne Test');
$campaign->setTrackId(1);
$campaign->setApplication('Copromatic');
$campaign->setBreakdownCode('COPRO-1-2015');

/***********************************
 *              USER
 ***********************************/
$user = new \Maileva\Element\User();
$user->setAuthType(\Maileva\Element\User::AUTHTYPE_PLAINTEXT);
$user->setLogin('copromatic');
$user->setPassword('copromatic2015');
$campaign->setUser($user);

/***********************************
 *              REQUEST
 ***********************************/

$request = new \Maileva\Element\Request();
$request->setMediaType(\Maileva\Element\Request::PAPER);
$request->setTrackId(1);

/**********   Recipients   ********/
$paperAddressRecipient = new \Maileva\Element\Address\Paper();
$paperAddressRecipient->setFrenchAddress('Copromatic', 'RH', '6 Cours Lafayette', '', '', 69003, 'LYON');

$recipient1 = new \Maileva\Element\Recipient();
$recipient1->setTrackId(12341);
$recipient1->setCategory(\Maileva\Element\Recipient::PROFESSIONAL);
$recipient1->setId(1);
$recipient1->setPaperAddress($paperAddressRecipient);

$request->addRecipient($recipient1);

$paperAddressRecipient = new \Maileva\Element\Address\Paper();
$paperAddressRecipient->setFrenchAddress('', 'Gaetan Hautecoeur', '146 Cours Tolsto?', '', '', 69100, 'Villeurbanne');

$recipient2 = new \Maileva\Element\Recipient();
$recipient2->setTrackId(642);
$recipient2->setCategory(\Maileva\Element\Recipient::INDIVIDUAL);
$recipient2->setId(2);
$recipient2->setPaperAddress($paperAddressRecipient);

$request->addRecipient($recipient2);

/**********   Sender   ********/
$paperAddressSender = new \Maileva\Element\Address\Paper();
$paperAddressSender->setFrenchAddress('Copromatic', 'Service Web', '', '', 'BP107', 69003, 'LYON');

$sender = new \Maileva\Element\Sender();
$sender->setId(1);
$sender->setPaperAddress($paperAddressSender);

$request->addSender($sender);

/**********   Documents   ********/
$content = new \Maileva\Element\Content();
$content->setUri('doc1.pdf');
$document = new \Maileva\Element\Document();
$document->setContent($content);
$document->setId(1);

//mergefield
$mergeField = new \Maileva\Element\MergeField();
$mergeField->setPageNumber(1);
$mergeField->setFontSize(12);
$mergeField->setFontName(\Maileva\Element\MergeField::FONT_ARIAL);
$mergeField->setPosUnit(\Maileva\Element\MergeField::UNITE_CM);
$mergeField->setPosX(4);
$mergeField->setPosY(4);
$mergeField->setHalign(\Maileva\Element\MergeField::HALIGN_CENTER);
$content = new \Maileva\Element\ContentMergeField();
$content->setId('var_1');
$mergeField->setContent($content);
$document->addMergeField($mergeField);

$request->addDocumentData($document);

/**********   Fold   ********/
$fold = new \Maileva\Element\Fold();

$fold->setId(1);
$fold->setTrackId(12);
$fold->setRecipientId($recipient1->getId());

//document
$docInFold = new \Maileva\Element\DocInFold();
$docInFold->setDocumentId($document->getId());
$fold->addDocument($docInFold);

//mergeValue
$mergeValue = new \Maileva\Element\MergeValue();
$value = new \Maileva\Element\ValueWithRef();
$value->setValue('MARS 2016');
$value->setRef($mergeField->getContent()->getId());
$mergeValue->setValueWithRef($value);
$fold->addMergeValue($mergeValue);

$request->addFold($fold);


$fold = new \Maileva\Element\Fold();

$fold->setId(2);
$fold->setTrackId(12);
$fold->setRecipientId($recipient2->getId());

//document
$docInFold = new \Maileva\Element\DocInFold();
$docInFold->setDocumentId($document->getId());
$fold->addDocument($docInFold);

//mergeValue
$mergeValue = new \Maileva\Element\MergeValue();
$value = new \Maileva\Element\ValueWithRef();
$value->setValue('AVRIL 2016');
$value->setRef($mergeField->getContent()->getId());
$mergeValue->setValueWithRef($value);
$fold->addMergeValue($mergeValue);

$request->addFold($fold);

/**********   Options   ********/
$request->setOptions(new \Maileva\Element\Option());

/**
 * ******** ******** ******** ******** ********
 */



$campaign->addRequest($request);

$campaign->verify();


$domDoc = new DOMDocument();
$element = $domDoc->createElementNS(\Maileva\Element::NAMESPACE_PJS, 'pjs:Campaign');
$element->setAttributeNS('http://www.w3.org/2000/xmlns/', 'xmlns:com', \Maileva\Element::NAMESPACE_COM);
$element->setAttributeNS('http://www.w3.org/2000/xmlns/', 'xmlns:spec', \Maileva\Element::NAMESPACE_SPEC);
$element->setAttributeNS('http://www.w3.org/2000/xmlns/', 'xmlns:xsi', \Maileva\Element::NAMESPACE_XSI);
$domDoc->appendChild($element);

$campaign->generateXml($element);

if(!isset($_GET['xml'])){
    $valide = $domDoc->schemaValidate(__DIR__.'/../../../xsd/1.0.9/MailevaPJS.xsd');

    echo '<br/>';
    echo 'XML passed validation : '.(($valide)?'YES':'NO');
    echo '<br/>';
    echo '<a href="?xml=" >See XML</a>';
    exit;
}

header('Content-Type: application/xml; charset=utf-8');
echo $domDoc->saveXML();