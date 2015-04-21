<?php

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


/**********   Notifications   ********/
$notification = new \Maileva\Element\Notification();
$notification->setType(\Maileva\Element\Notification::NOTIF_GENERAL);
$notification->setFormat(\Maileva\Element\Notification::FORMAT_XML);
$protocol = new \Maileva\Element\Protocol();
$protocol->setFtp(new \Maileva\Element\Protocol\Ftp());
$notification->addProtocols($protocol);
$request->addNotification($notification);

$notification = new \Maileva\Element\Notification();
$notification->setType(\Maileva\Element\Notification::NOTIF_PND);
$notification->setFormat(\Maileva\Element\Notification::FORMAT_TXT);
$protocol = new \Maileva\Element\Protocol();
$protocol->setFtp(new \Maileva\Element\Protocol\Ftp());
$notification->addProtocols($protocol);
$request->addNotification($notification);

/**
 * ******** ******** ******** ******** ********
 */



$campaign->addRequest($request);

$campaign->verify();

return $campaign;