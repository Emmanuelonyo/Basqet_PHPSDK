<?php
require __DIR__. "/../../vendor/autoload.php";

// load dotenv

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__."/../../");
$dotenv->load();

const email = "test@gmail.com";
const first_name = "oye";
const last_name = "olalekan";
const reference = "snfji9r545f59jvnnv";

const customer = [
    'name'=>first_name. ' '. last_name,
    'email'=> email
];
  

const customerData = [
'customer'=> customer,
'amount'=> "1000",
"currency"=> "NGN",
"meta"=> [
    'reference'=>reference
  ]
];

