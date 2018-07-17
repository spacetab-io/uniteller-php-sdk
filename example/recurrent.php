<?php

use Tmconsulting\Uniteller\Recurrent\RecurrentBuilder;

require __DIR__ . '/credentials.php';

/** @var \Tmconsulting\Uniteller\Client $uniteller */

$builder = (new RecurrentBuilder())
    ->setOrderIdp(mt_rand(10000, 99999))
    ->setSubtotalP(15)
    ->setParentOrderIdp(00000) // order id of any past payment
    ->setParentShopIdp($uniteller->getShopId()); // optional

$results = $uniteller->recurrent($builder);

var_dump($results);
