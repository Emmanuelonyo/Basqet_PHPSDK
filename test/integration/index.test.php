<?php
header("Content-Type: application/json");
require __DIR__ . "/../fixtures/details.php";

use Basqet\Basqet;

$Basqet = new Basqet($_ENV['BASQET_SECRET_KEY'],$_ENV['BASQET_PUBLIC_KEY']);

$fetch = json_decode($Basqet::fetchAllCurrency('FIAT'), true);

$initialize =  json_decode($Basqet::initializeTransaction(customerData), true);

$initiate = json_decode($Basqet::initiateTransaction($initialize['data']['reference'],['currency_id'=>"3"]), true);

$verify = json_decode($Basqet::verifyTransaction($initialize['data']['reference']), true);

$triggerWebhook = json_decode($Basqet::triggerWebhook($initialize['data']['reference'], $verify['data']),true);

$response['fetchAllCurrency'] = $fetch;
$response['initializeTransaction'] = $initialize ;
$response['initiateTransaction'] = $initiate ;
$response['verifyTransaction'] = $verify ;
$response['triggerWebhook'] = $triggerWebhook;

echo json_encode($response);