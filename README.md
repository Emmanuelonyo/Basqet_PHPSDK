
# Basqet PHP SDK

The Official PHP library for the Basqet API.

## Installation

Initialize the Project With Composer and clone the repo

```bash
  composer require emmanuelonyo/basqet-php
```

## Usage/Examples

#### Instantiate class

```php
use Basqet\Basqet;
$Basqet = new Basqet($_ENV['BASQET_SECRET_KEY'],$_ENV['BASQET_PUBLIC_KEY']);

```

#### Fetch Available currency

```php

// Fetch all fiat currency
$currencies = $basqet::fetchAllCurrency("FIAT")

```


#### Initialize transaction


```php

$paymentData = [
     "customer": [
          "name"=> "tunde",
          "email"=> "customer@example.com"
     ],
     "amount"=> "1000",
     "currency"=> "NGN",
     "meta"=> [
          "reference": "bghggbbvv"
     ]
];

$transactionObj = $Basqet::initializeTransaction(paymentData);

```


#### Initiate transaction

```php

$transactionObj = $Basqet::initiateTransaction(<transactionId>, ['currency_id'=> <currency_id>])

```


#### Verify transaction

```php


$transactionObj = $Basqet::verifyTransaction(<transactionId>)

```

#### Mock webhook events

```php


$transactionObj = $Basqet.triggerWebhook(<transactionId>, [ status=> 'SUCCESSFUL' ])

```

## Documentation/API reference

[Documentation](https://docs.basqet.com/docs)


## Buy me a coffee 

I need Employment you can contact me via +2348102937785 <emmanuelonyo34@gmail.com>
