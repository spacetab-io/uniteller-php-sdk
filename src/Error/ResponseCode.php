<?php
/**
 * Created by Roquie.
 * E-mail: roquie0@gmail.com
 * GitHub: Roquie
 */

namespace Tmconsulting\Uniteller\Error;

/**
 * Class ResponseCode
 *
 * Параметр  Response_code  служит  для  приведения к единому виду схожих по смыслу,
 * но разных по формату ответов эквайеров на запросы оплат картами.
 * Response_code  имеет смысл только по оплатам картами.
 * По операциям с электронными валютами этот параметр не имеет смысла,
 * так как оплата является отложенной.
 *
 * @package Tmconsulting\Client\Error
 */
final class ResponseCode
{
    /**
     * @var array
     */
    protected static $messages = [
        'AS000' => 'АВТОРИЗАЦИЯ УСПЕШНО ЗАВЕРШЕНА',
        'AS100' => 'ОТКАЗ В АВТОРИЗАЦИИ',
        'AS101' => 'ОТКАЗ В АВТОРИЗАЦИИ. Ошибочный номер карты.',
        'AS102' => 'ОТКАЗ В АВТОРИЗАЦИИ. Недостаточно средств.',
        'AS104' => 'ОТКАЗ В АВТОРИЗАЦИИ. Неверный срок действия карты.',
        'AS105' => 'ОТКАЗ В АВТОРИЗАЦИИ. Превышен лимит.',
        'AS107' => 'ОТКАЗ В АВТОРИЗАЦИИ. Ошибка приёма данных.',
        'AS108' => 'ОТКАЗ В АВТОРИЗАЦИИ. Подозрение на мошенничество.',
        'AS109' => 'ОТКАЗ В АВТОРИЗАЦИИ. Превышен лимит операций Client.',
        'AS200' => 'ПОВТОРИТЕ АВТОРИЗАЦИЮ',
        'AS998' => 'ОШИБКА СИСТЕМЫ. Свяжитесь с Client.',
    ];

    /**
     * Преобразование кода ошибки в сообщение.
     *
     * @param $code
     * @return string|null
     */
    public static function message($code)
    {
        if (array_key_exists($code, self::$messages)) {
            return self::$messages[$code];
        }

        return null;
    }
}