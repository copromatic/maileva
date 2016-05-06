<?php

$loader = require_once __DIR__ . '/../../../vendor/autoload.php';

$host = '';
$username = '';
$password = '';
$ftp_directory = '';

/** @var \Maileva\Campaign $campaign */
$campaign = include_once __DIR__.'/../assets/campaign0.php';

$command = new \Maileva\Ftp\Command('clientId', \Maileva\Ftp\Command::GATEWAY_PAPER_XML);
$package = new \Maileva\Ftp\Package($command, 'PackageName', __DIR__.'/packages', false, false, false);

/** @var \Maileva\Element\Request $request */
foreach($campaign->getRequests() as $request){
    /** @var \Maileva\Element\Document $document */
    foreach($request->getDocumentData() as $document){
        $document->getContent()->setUri(__DIR__.'/../assets/'.$document->getContent()->getUri());
    }
}

$package->generate($campaign);

if($host == '' || $username == ''){
    throw new Exception('Please add your FTP configuration to '.__FILE__);
}

$package->push($host, $username, $password, $ftp_directory);
