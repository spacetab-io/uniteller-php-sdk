<?php
/**
 * Created by Roquie.
 * E-mail: roquie0@gmail.com
 * GitHub: Roquie
 */

namespace Tmconsulting\Uniteller\Error;


class Error
{
    /**
     * Authentication error
     * Некорректные данные авторизации (Login, Password)
     */
    public const AUTHENTICATION              = 1;

    /**
     * Invalid signature
     * Неверная подпись в запросе
     */
    public const INVALID_SIGNATURE           = 2;

    /**
     * Field %fieldName% has bad  format
     * Неверный формат значения или значение не входит в область допустимых (%fieldname% - имя параметра)
     */
    public const BAD_FIELD_FORMAT            = 5;

    /**
     * Bill not found
     * Не найден платёж
     */
    public const BILL_NOT_FOUND              = 4;

    /**
     * Mandatory parameter  '%fieldName%' is not  present in the request
     * Не указан обязательный параметр (%fieldName% - имя параметра)
     */
    public const MANDATORY_PARAMETER         = 3;

    /**
     * S_FIELDS contains field  '%name%' which is not  allowed
     * В поле S_FIELDS присутствует неподдерживаемый параметр. %name% - код параметра
     */
    public const NOT_SUPPORTED_SFIELD        = 10;

    /**
     * The operation failed
     * По некоторым причинам операция была прервана. Попробуйте в другой раз.
     */
    public const OPERATION_FAILED            = 15;

    /**
     * Authorization confirm is not  allowed
     * Невозможно выполнить подтверждение
     */
    public const AUTH_CONFIRM_IS_NOT_ALLOWED = 18;

    /**
     * Recurrent payment not  allowed
     * Магазин не поддерживает рекуррентные платежи
     */
    public const RECURENT_PAY_NOT_ALLOWED   = 22;

    /**
     * Incorrect Parent_Order_IDP
     * Ссылка на «родительский» платёж отсутствует или указывает на неуспешный платёж.
     */
    public const INCORRECT_PARENT_ORDER_IDP  = 23;

    /**
     * Order_IDP already exists
     * Такой Order_IDP уже существует
     */
    public const ORDER_ALREADY_EXISTS        = 24;

    /**
     * Shop_IDP not found
     * Не найден Shop_IDP
     */
    public const SHOP_ALREADY_EXISTS         = 25;

    /**
     * Card not found
     * Карта не найдена
     */
    public const CARD_NOT_FOUND              = 30;

    /**
     * Card can’t be activated because it’s blocked
     * Карта не может быть активирована, так как она заблокирована
     */
    public const CARD_CANT_BE_ACTIVATED      = 31;

    /**
     * Card can’t be blocked because it’s not confirmed
     * Карта не может быть заблокирована, так как она неактивна
     */
    public const CARD_CANT_BE_BLOCKED        = 32;

    /**
     * Card can’t be unblocked because it’s not confirmed
     * Карта не может быть разблокирована, потому что она не активна
     */
    public const CARD_CANT_BE_UNBLOCKED      = 33;

    /**
     * TempCard not found
     * Карта с таким TempCard_IDP (для заданного Shop_IDP) не найдена
     */
    public const TEMP_CARD_NOT_FOUND         = 34;

    /**
     * Card is already registered
     * Карта уже зарегистрирована
     */
    public const CARD_IS_ALREADY_REGISTERED  = 35;

    /**
     * Unknown error
     */
    public const UNKNOWN  = 99;
}
