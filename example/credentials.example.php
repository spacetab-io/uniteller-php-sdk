<?php
/**
 * Created by Roquie.
 * E-mail: roquie0@gmail.com
 * GitHub: Roquie
 */

require __DIR__ . '/../vendor/autoload.php';

$uniteller = new \Tmconsulting\Uniteller\Client();
$uniteller->setShopId('your_shop_id');
$uniteller->setLogin(1234);
$uniteller->setPassword('your_password');
$uniteller->setBaseUri('https://wpay.uniteller.ru');
