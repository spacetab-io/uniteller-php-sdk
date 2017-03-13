<?php
/**
 * Created by Roquie.
 * E-mail: roquie0@gmail.com
 * GitHub: Roquie
 */

require __DIR__ . '/../vendor/autoload.php';

$uniteller = new \Tmconsulting\Uniteller\Client();
$uniteller->setShopId('00009167');
$uniteller->setLogin(3326);
$uniteller->setPassword('5sqoSpQsCfl0rUTzVQDd33RMWQRsm4SIjzA7IvQkFm90k52OnrH6eTuhogTqOUPRhkptGZhWATHsoiSW');
$uniteller->setBaseUri('https://wpay.uniteller.ru');
