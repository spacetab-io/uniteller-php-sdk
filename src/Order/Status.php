<?php
/**
 * Created by Roquie.
 * E-mail: roquie0@gmail.com
 * GitHub: Roquie
 */

namespace Tmconsulting\Uniteller\Order;

/**
 * Class Status
 *
 * Статус заказа
 *
 * @package Tmconsulting\Client\Order
 */
final class Status
{
    /**
     *  Мерчант не знает об этом заказе или считает, что заказ все еще не оплачен;
     */
    const NEW            = 'new';

    /**
     * Средства успешно заблокированы (выполнена авторизационная транзакция).
     */
    const AUTHORIZED     = 'authorized';

    /**
     * Cредства не заблокированы (авторизационная транзакция не выполнена)
     * по ряду причин.
     * !! Статус not authorized  может фигурировать только в результатах
     * !! запроса результата авторизации.
     */
    const NOT_AUTHORIZED = 'not authorized';

    /**
     * Оплачен (выполнена финансовая транзакция или
     * заказ оплачен в электронной платёжной системе).
     */
    const PAID           = 'paid';

    /**
     * Отменён (выполнена транзакция разблокировки средств или
     * выполнена операция по возврату платежа после списания
     * средств; при частичных отмене/возврате платежа этот
     * статус не присваивается),
     *
     */
    const CANCELLED      = 'cancelled';

    /**
     * Ожидается оплата выставленного счёта. Статус используется только
     * для оплат электронными валютами, при которых процесс оплаты
     * может содержать этап выставления через систему Client
     * счёта на оплату и этап фактической оплаты этого счёта
     * Покупателем, которые существенно разнесённы во времени.
     */
    const WAITING        = 'waiting';

    /**
     * Преобразуем в одинаковый формат статуса.
     *
     * @param $value
     * @return string|null
     */
    public static function resolve($value)
    {
        switch (strtolower($value)) {
            case self::NEW:
                return self::NEW;
            case self::AUTHORIZED:
                return self::AUTHORIZED;
            case self::NOT_AUTHORIZED:
                return self::NOT_AUTHORIZED;
            case self::PAID:
                return self::PAID;
            case 'canceled':
            case self::CANCELLED:
                return self::CANCELLED;
            case self::WAITING:
                return self::WAITING;
        }

        return null;
    }
}