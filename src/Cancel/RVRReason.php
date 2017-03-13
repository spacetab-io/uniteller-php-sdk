<?php
/**
 * Created by Roquie.
 * E-mail: roquie0@gmail.com
 * GitHub: Roquie
 */

namespace Tmconsulting\Uniteller\Cancel;

/**
 * Class RVRReason
 *
 * Причина отмена операции.
 * По умолчанию 1.
 *
 * @package Tmconsulting\Client\CancelRequest
 */
final class RVRReason
{
    /**
     * отказ магазина от операции
     */
    const SHOP = 1;

    /**
     * отказ держателя от операции
     */
    const CARDHOLDER = 2;

    /**
     * мошенническая операция
     */
    const FRAUD = 3;
}