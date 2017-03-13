<?php
/**
 * Created by Roquie.
 * E-mail: roquie0@gmail.com
 * GitHub: Roquie
 */

require __DIR__ . '/credentials.php';

/** @var \Tmconsulting\Uniteller\Client $uniteller */

$results = $uniteller->results([
    'ShopOrderNumber' => 'number'
]);


var_dump($results);
