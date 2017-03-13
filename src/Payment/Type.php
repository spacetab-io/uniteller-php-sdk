<?php
/**
 * Created by Roquie.
 * E-mail: roquie0@gmail.com
 * GitHub: Roquie
 */

namespace Tmconsulting\Uniteller\Payment;

/**
 * Class Type
 *
 * @package Tmconsulting\Client\Payment
 */
final class Type
{
    /**
     * оплата кредитной картой;
     */
    const CREDIT_CARD = 1;

    /**
     * оплата с помощью электронной валюты.
     */
    const EMONEY      = 3;
}