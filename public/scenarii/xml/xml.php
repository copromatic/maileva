<?php

$loader = require_once __DIR__ . '/../../../vendor/autoload.php';

$campaign = include_once __DIR__.'/../assets/campaign0.php';

$domDoc = \Maileva\Element::getDomFromCampaign($campaign);

if(!isset($_GET['xml'])){
    libxml_use_internal_errors(true);
    $valide = $domDoc->schemaValidate(\Maileva\Element::getXmlSchema());
    $error = libxml_get_last_error();
    libxml_clear_errors();
    echo '<br/>';
    echo 'XML passed validation : '.($valide ? 'YES' : 'NO')."<br/>\n";
    if (!$valide) {
        echo "Erreur : <pre>".$error->message."</pre>";
    }
    echo '<br/>';
    echo '<a href="?xml=" >See XML</a>';
    exit;
}

header('Content-Type: application/xml; charset=utf-8');
// Pretty output
$domDoc->preserveWhiteSpace = false;
$domDoc->formatOutput = true;
echo $domDoc->saveXML();
