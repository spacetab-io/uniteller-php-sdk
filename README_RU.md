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

PHP (5.6+) SDK для интеграции с интернет-эквайрингом от Uniteller.

Реализовано:
* оплата (метод `pay`)
* отмена (метод `unblock`)
* получение результатов
* callback (проверка сигнатуры)
* обработчик ошибок, кидает эксепшены даже на строку `ERROR: %s` в теле ответа на запрос
* единство статусов.

Что осталось:
* прикрутить валидацию, используя декораторы
* добавить билдер для метода `results`
* метод `card`
* метод `recurrent`
* метод `confirm` 

## Установка

Чтобы установить пакет, достаточно подключить его в проект, как зависимость:

`composer require tmconsulting/uniteller-php-sdk`

## Использование

Примеры использования SDK лежат в папке `./examples`, а так-же `README.md` файл, 
в котором написан способ установки.

### Установка учетных данных 

```php
<?php
$uniteller = new \Tmconsulting\Uniteller\Client();
$uniteller->setShopId('you_shop_id');
$uniteller->setLogin('you_login_number');
$uniteller->setPassword('you_password');
$uniteller->setBaseUri('https://wpay.uniteller.ru');
```

### Переход к оплате

Чтобы произвести оплату, достаточно вызвать метод `payment`, 
он принимает первым аргументом либо построитель запроса, либо обычный массив параметров.

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
// Если переходить к оплате сразу нет необходимости,
// можно получить готовую ссылку для оплаты
// $uniteller->payment($builder)->getUri();

```

или

```php
<?php
$uniteller->payment([
    'Order_IDP' => mt_rand(10000, 99999),
    // ... прочие параметры
])->go();
```

### Отмена платежа
 
```php
<?php
use Tmconsulting\Uniteller\Cancel\CancelBuilder;

$builder = (new CancelBuilder())->setBillNumber('RRN Number, (12 digits)');
$results = $uniteller->cancel($builder);
```

или

```php
<?php
use Tmconsulting\Uniteller\Order\Status;

$results = $uniteller->cancel([
    'Billnumber' => 'RRN Number, (12 digits)',
    // ...
]);

var_dump($results);

foreach ($results as $payment) {
    // смотрите в Tmconsulting\Uniteller\Order\Order остальные методы.
    if ($payment->getStatus() === Status::CANCELLED) {
        // платеж отменён
    }    
} 
```

### Получение результатов

```php
<?php

$results = $uniteller->results([
    'ShopOrderNumber' => 'Order_IDP number'
]);

var_dump($results);

// $results[0]->getCardNumber();
```

### Callback

Приём данных от шлюза и проверка сигнатуры.

```php
<?php
if (! $uniteller->getSignature()->verify('signature_from_post_params', ['all_parameters_from_post'])) {
    return 'invalid_signature';
}
```


## Тесты

`vendor/bin/phpunit`

## Лицензия

MIT.
