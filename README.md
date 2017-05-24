# Uniteller PHP SDK

<br />

<p align="center">
    <img src="https://www.uniteller.ru//local/templates/index/img/base/logo.svg" width="220">
</p>

<br />
<br />

<p align="center">
    <a href="https://travis-ci.org/tmconsulting/uniteller-php-sdk" target="_blank">
        <img src="https://travis-ci.org/tmconsulting/uniteller-php-sdk.svg?branch=master" />
    </a>
    <a href="https://packagist.org/packages/tmconsulting/uniteller-php-sdk" target="_blank">
        <img src="https://poser.pugx.org/tmconsulting/uniteller-php-sdk/v/stable" />
    </a>
    <a href="https://packagist.org/packages/tmconsulting/uniteller-php-sdk" target="_blank">
        <img src="https://poser.pugx.org/tmconsulting/uniteller-php-sdk/license" />
    </a>
    <a href="https://packagist.org/packages/tmconsulting/uniteller-php-sdk" target="_blank">
        <img src="https://poser.pugx.org/tmconsulting/uniteller-php-sdk/composerlock" />
    </a>
</p>

<br />

PHP (5.6+) SDK for integration internet-acquiring of the Uniteller (unofficial).
[This documentation is available in Russian language](README_RU.md).
Also, this SDK integrated with [Payum](https://github.com/Payum/Payum) library and you can use [gateway](https://github.com/tmconsulting/payum-uniteller-gateway).

Features:
* payment (method `pay`)
* cancel (method `unblock`)
* receive results
* callback (method for verify incoming signature)
* general error handler for any request
* general statuses (In the requests/responses may to meet `canceled` or `cancelled` variants. They will be converted to general status like as `cancelled`.)

TODO:
* translate to English comments and system (error) messages
* validation
* implement method `card`
* implement method `recurrent`
* implement method `confirm` 

## Install

For install package follow this command:

`composer require tmconsulting/uniteller-php-sdk`

## Usage

A few usage example the current SDK your can found on the `examples` folder. 
Just follow instruction on `README.md` file. 

### Configure credentials  

```php
<?php
$uniteller = new \Tmconsulting\Uniteller\Client();
$uniteller->setShopId('you_shop_id');
$uniteller->setLogin('you_login_number');
$uniteller->setPassword('you_password');
$uniteller->setBaseUri('https://wpay.uniteller.ru');
```

### Redirect to page payment 

So, for redirect to page your enough to run `payment` method with parameters like as:

```php
<?php
use Tmconsulting\Uniteller\Payment\PaymentBuilder;

$builder = new PaymentBuilder();
$builder
    ->setOrderIdp(mt_rand(10000, 99999))
    ->setSubtotalP(10)
    ->setCustomerIdp(mt_rand(10000, 99999))
    ->setUrlReturnOk('http://google.ru/?q=success')
    ->setUrlReturnNo('http://google.ru/?q=failure');

$uniteller->payment($builder)->go();
// if you don't need redirect
// $uniteller->payment($builder)->getUri();

```

or use plain array

```php
<?php
$uniteller->payment([
    'Order_IDP' => mt_rand(10000, 99999),
    // ... other parameters
])->go();
```

### Cancel payment
 
```php
<?php
use Tmconsulting\Uniteller\Cancel\CancelBuilder;

$builder = (new CancelBuilder())->setBillNumber('RRN Number, (12 digits)');
$results = $uniteller->cancel($builder);
```

or

```php
<?php
use Tmconsulting\Uniteller\Order\Status;

$results = $uniteller->cancel([
    'Billnumber' => 'RRN Number, (12 digits)',
    // ...
]);

foreach ($results as $payment) {
    // see Tmconsulting\Uniteller\Order\Order for other methods.
    if ($payment->getStatus() === Status::CANCELLED) {
        // payment was cancelled
    }    
} 
```

### Receive results

```php
<?php

$results = $uniteller->results([
    'ShopOrderNumber' => 'Order_IDP number'
]);

var_dump($results);

// $results[0]->getCardNumber();
```

### Callback (gateway notification)

Receive incoming parameters from gateway and verifying signature. 

```php
<?php
if (! $uniteller->getSignature()->verify('signature_from_post_params', ['all_parameters_from_post'])) {
    return 'invalid_signature';
}
```

## Tests

`vendor/bin/phpunit`

## License

MIT.
