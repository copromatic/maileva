<?php

$loader = require_once __DIR__ . '/../../../vendor/autoload.php';

$campaign = include_once __DIR__.'/../assets/campaign0.php';

$domDoc = \Maileva\Element::getDomFromCampaign($campaign);

if(!isset($_GET['xml'])){
    $valide = $domDoc->schemaValidate(\Maileva\Element::getXmlSchema());

    echo '<br/>';
    echo 'XML passed validation : '.(($valide)?'YES':'NO');
    echo '<br/>';
    echo '<a href="?xml=" >See XML</a>';
    exit;
}

header('Content-Type: application/xml; charset=utf-8');
echo $domDoc->saveXML();