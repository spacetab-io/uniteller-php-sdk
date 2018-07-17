<?php

use Tmconsulting\Uniteller\Payment\PaymentBuilder;

require __DIR__ . '/credentials.php';


/** @var \Tmconsulting\Uniteller\Client $uniteller */

$builder = new PaymentBuilder();
$builder
    ->useRecurrentPayment()
    ->setOrderIdp(mt_rand(10000, 99999))
    ->setSubtotalP(10)
    ->setCustomerIdp(mt_rand(10000, 99999))
    ->setUrlReturnOk('http://google.ru/?q=success')
    ->setUrlReturnNo('http://google.ru/?q=failure');


$uri = $uniteller->payment($builder)->getUri();

echo <<< HTML
    <h2>Client Payment Sample</h2>
    <br>
    <p>Оплатить</p>
    <a href="{$uri}" target="_blank">{$uri}</a>
    <br>
    <p>Отмена</p>
    <a href="/cancel.php">/cancel.php</a>
    <br>
    <br>
    <p>Результаты платежа</p>
    <a href="/results.php">/results.php</a>
    <br>
HTML;

// or...

/*

 $uniteller->payment([
    'Shop_IDP' => '',
    // ...
]);

*/

