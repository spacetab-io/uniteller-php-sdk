<?php
/**
 * Created by Roquie.
 * E-mail: roquie0@gmail.com
 * GitHub: Roquie
 */

namespace Tmconsulting\Uniteller\Payment;

/**
 * Class EMoneyType
 *
 * @package Tmconsulting\Client\Payment
 */
final class EMoneyType
{
    /**
     * Любая система электронных платежей
     */
    const ANY          = 0;

    /**
     * Яндекс.Деньги
     */
    const YANDEX_MONEY = 1;

    /**
     * Оплата наличными (Евросеть, Яндекс.Деньги и пр.)
     */
    const CASH         = 13;

    /**
     * QIWI Кошелек REST (по протоколу REST)
     */
    const QIWI_REST    = 18;

    /**
     * WebMoney WMR
     */
    const WEBMONEY_WMR = 29;
}