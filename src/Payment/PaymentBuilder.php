<?php
/**
 * Created by Roquie.
 * E-mail: roquie0@gmail.com
 * GitHub: Roquie
 */

namespace Tmconsulting\Uniteller\Payment;

use Tmconsulting\Uniteller\ArraybleInterface;

/**
 * Class PaymentBuilder
 *
 * @package Tmconsulting\Client\Payment
 */
final class PaymentBuilder implements ArraybleInterface
{
    /**
     * Shop_IDP (Client Point ID)
     *
     * @var string
     */
    protected $shopIdp;

    /**
     * Номер заказа в системе расчётов интернет-магазина,
     * соответствующий данному платежу. Может быть любой непустой
     * строкой максимальной длиной 127 символов, не может содержать только пробелы.
     *
     * Значение Order_IDP должно быть уникальным для всех оплаченных заказов (заказов,
     * по которым успешно прошла блокировка средств) в рамках одного магазина (одной точки продажи).
     *
     * @var string
     */
    protected $orderIdp;

    /**
     * Сумма покупки в валюте, оговоренной в договоре с банком-эквайером.
     * В качестве десятичного разделителя используется точка,
     * не более 2 знаков после разделителя. Например, 12.34
     *
     * @var float|string
     */
    protected $subtotalP;

    /**
     * Подпись, гарантирующая неизменность критичных данных оплаты
     * (суммы, Order_IDP)
     *
     * @var string
     */
    protected $signature;

    /**
     * URL страницы, на которую должен вернуться Покупатель
     * после успешного осуществления платежа в системе Client
     *
     * @var string
     */
    protected $urlReturnOk;

    /**
     * URL страницы, на которую должен вернуться Покупатель
     * после неуспешного осуществления платежа в системе
     *
     * @var string
     */
    protected $urlReturnNo;

    /**
     * Валюта платежа.
     * RUB — российский рубль;
     * UAH — украинская гривна;
     * AZN — азербайджанский манат;
     * KZT — казахский тенге.
     * Use Payment\Currecy class.
     *
     * @var string
     */
    protected $currency;

    /**
     * @var string
     */
    protected $email;

    /**
     * Время жизни формы оплаты в секундах, начиная с момента её показа.
     * Должно быть целым положительным числом
     *
     * @var int
     */
    protected $lifetime;

    /**
     * Время жизни (в секундах) заказа на оплату банковской картой,
     * начиная с момента первого вывода формы оплаты.
     *
     * @var int
     */
    protected $orderLifetime;

    /**
     * Идентификатор Покупателя, используемый некоторыми интернет-магазинами.
     * (64 символа)
     *
     * @var string
     */
    protected $customerIdp;

    /**
     * Идентификатор зарегистрированной карты
     * (до 128 символов)
     *
     * @var string
     */
    protected $cardIdp;

    /**
     * «длинная запись»
     *
     * @var string
     */
    protected $iData;

    /**
     * Тип платежа. Произвольная строка длиной до десяти символов включительно.
     * В подавляющем большинстве схем подключения интернет-магазинов этот параметр не используется.
     *
     * @var string
     */
    protected $ptCode;

    /**
     * Платёжная система кредитной карты.
     * Может принимать значения: 0 — любая, 1 — VISA, 2 — MasterCard,
     * 3 — Diners Club, 4 — JCB, 5 — American Express.
     * Use Payment\MeanType class.
     *
     * @var int
     */
    protected $meanType;

    /**
     * Тип электронной валюты.
     * 0 - Любая система электронных платежей
     * 1 - Яндекс.Деньги
     * 13 - Оплата наличными (Евросеть, Яндекс.Деньги и пр.)
     * 18 - QIWI Кошелек REST (по протоколу REST)
     * 29 - WebMoney WMR
     *
     * @var int
     */
    protected $eMoneyType;

    /**
     * Срок жизни заказа оплаты в электронной платёжной системе в часах (от 1 до 1080 часов).
     * Значение параметра BillLifetime учитывается только для QIWI-платежей.
     * Если BillLifetime не передаётся, то для QIWI-платежа срок жизни заказа на
     * оплату устанавливается по умолчанию — 72 часа.
     *
     * @var int
     */
    protected $billLifetime;

    /**
     * Признак преавторизации платежа.
     * При использовании в запросе должен принимать значение “1”.
     *
     * @var bool
     */
    protected $preAuth;

    /**
     * Признак того, что платёж является «родительским» для
     * последующих рекуррентных платежей. Может принимать значение “1”.
     *
     * @var bool
     */
    protected $IsRecurrentStart;

    /**
     * Список дополнительных полей, передаваемых в
     * уведомлении об изменении статуса заказа.
     * BillNumber, ApprovalCode, Total
     * @var array
     */
    protected $callbackFields;

    /**
     * Запрашиваемый формат уведомления о статусе оплаты.
     * Eсли параметр имеет значение "json", то уведомление направляется
     * в json-формате. Во всех остальных случаях уведомление направляется в виде POST-запроса.
     *
     * @var string
     */
    protected $callbackFormat;

    /**
     * Код языка интерфейса платёжной страницы. Может быть en или ru.
     * (2 символа)
     *
     * @var string
     */
    protected $language;

    /**
     * Комментарий к платежу
     * (до 1024 символов)
     *
     * @var string
     */
    protected $comment;

    /**
     * Имя Покупателя, переданное с сайта Мерчанта
     * (64 символа)
     *
     * @var string
     */
    protected $firstName;

    /**
     * Фамилия Покупателя, переданная с сайта Мерчанта
     * (64 символа)
     *
     * @vars string
     */
    protected $lastName;

    /**
     * Отчество
     * (64 символа)
     *
     * @var string
     */
    protected $middleName;

    /**
     * Телефон
     * (64 символа)
     *
     * @var string
     */
    protected $phone;

    /**
     * Адрес
     * (128 символов)
     *
     * @var string
     */
    protected $address;

    /**
     * Название страны Покупателя
     * (64 символа)
     *
     * @var string
     */
    protected $country;

    /**
     * Код штата/региона
     * (3 символа)
     *
     * @var string
     */
    protected $state;

    /**
     * Город
     * (64 символа)
     *
     * @var string
     */
    protected $city;

    /**
     * Почтовый индекс
     *
     * (64 символа)
     * @var
     */
    protected $zip;

    /**
     * @param string $shopIdp
     * @return $this
     */
    public function setShopIdp($shopIdp)
    {
        $this->shopIdp = $shopIdp;

        return $this;
    }

    /**
     * @param string $orderIdp
     * @return $this
     */
    public function setOrderIdp($orderIdp)
    {
        $this->orderIdp = $orderIdp;

        return $this;
    }

    /**
     * @param float|string $subtotalP
     * @return $this
     */
    public function setSubtotalP($subtotalP)
    {
        $this->subtotalP = $subtotalP;

        return $this;
    }

    /**
     * @param string $signature
     * @return $this
     */
    public function setSignature($signature)
    {
        $this->signature = $signature;

        return $this;
    }

    /**
     * @param string $urlReturnOk
     * @return $this
     */
    public function setUrlReturnOk($urlReturnOk)
    {
        $this->urlReturnOk = $urlReturnOk;

        return $this;
    }

    /**
     * @param string $urlReturnNo
     * @return $this
     */
    public function setUrlReturnNo($urlReturnNo)
    {
        $this->urlReturnNo = $urlReturnNo;

        return $this;
    }

    /**
     * @param string $currency
     * @return $this
     */
    public function setCurrency($currency)
    {
        $this->currency = $currency;

        return $this;
    }

    /**
     * @param string $email
     * @return $this
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * @param int $lifetime
     * @return $this
     */
    public function setLifetime($lifetime)
    {
        $this->lifetime = $lifetime;

        return $this;
    }

    /**
     * @param int $orderLifetime
     * @return $this
     */
    public function setOrderLifetime($orderLifetime)
    {
        $this->orderLifetime = $orderLifetime;

        return $this;
    }

    /**
     * @param string $customerIdp
     * @return $this
     */
    public function setCustomerIdp($customerIdp)
    {
        $this->customerIdp = $customerIdp;

        return $this;
    }

    /**
     * @param mixed $cardIdp
     * @return $this
     */
    public function setCardIdp($cardIdp)
    {
        $this->cardIdp = $cardIdp;

        return $this;
    }

    /**
     * @param string $iData
     * @return $this
     */
    public function setIData($iData)
    {
        $this->iData = $iData;

        return $this;
    }

    /**
     * @param string $ptCode
     * @return $this
     */
    public function setPtCode($ptCode)
    {
        $this->ptCode = $ptCode;

        return $this;
    }

    /**
     * @param int $meanType
     * @return $this
     */
    public function setMeanType($meanType)
    {
        $this->meanType = $meanType;

        return $this;
    }

    /**
     * @param int $eMoneyType
     * @return $this
     */
    public function setEMoneyType($eMoneyType)
    {
        $this->eMoneyType = $eMoneyType;

        return $this;
    }

    /**
     * @param int $billLifetime
     * @return $this
     */
    public function setBillLifetime($billLifetime)
    {
        $this->billLifetime = $billLifetime;

        return $this;
    }

    /**
     *
     */
    public function usePreAuth()
    {
        $this->preAuth = true;

        return $this;
    }

    /**
     * @return bool
     */
    public function useRecurrentPayment()
    {
        $this->IsRecurrentStart = true;

        return $this;
    }

    /**
     * @param array $callbackFields
     * @return $this
     */
    public function setCallbackFields(array $callbackFields)
    {
        $this->callbackFields = join(' ', $callbackFields);

        return $this;
    }

    /**
     * @param string $callbackFormat
     * @return $this
     */
    public function setCallbackFormat($callbackFormat)
    {
        $this->callbackFormat = $callbackFormat;

        return $this;
    }

    /**
     * @param string $language
     * @return $this
     */
    public function setLanguage($language)
    {
        $this->language = $language;

        return $this;
    }

    /**
     * @param string $comment
     * @return $this
     */
    public function setComment($comment)
    {
        $this->comment = $comment;

        return $this;
    }

    /**
     * @param string $firstName
     * @return $this
     */
    public function setFirstName($firstName)
    {
        $this->firstName = $firstName;

        return $this;
    }

    /**
     * @param mixed $lastName
     * @return $this
     */
    public function setLastName($lastName)
    {
        $this->lastName = $lastName;

        return $this;
    }

    /**
     * @param string $middleName
     * @return $this
     */
    public function setMiddleName($middleName)
    {
        $this->middleName = $middleName;

        return $this;
    }

    /**
     * @param string $phone
     * @return $this
     */
    public function setPhone($phone)
    {
        $this->phone = $phone;

        return $this;
    }

    /**
     * @param string $address
     * @return $this
     */
    public function setAddress($address)
    {
        $this->address = $address;

        return $this;
    }

    /**
     * @param string $country
     * @return $this
     */
    public function setCountry($country)
    {
        $this->country = $country;

        return $this;
    }

    /**
     * @param string $state
     * @return $this
     */
    public function setState($state)
    {
        $this->state = $state;

        return $this;
    }

    /**
     * @param string $city
     * @return $this
     */
    public function setCity($city)
    {
        $this->city = $city;

        return $this;
    }

    /**
     * @param mixed $zip
     * @return $this
     */
    public function setZip($zip)
    {
        $this->zip = $zip;

        return $this;
    }

    /* Getters */

    /**
     * @return string
     */
    public function getShopIdp()
    {
        return $this->shopIdp;

        return $this;
    }

    /**
     * @return string
     */
    public function getOrderIdp()
    {
        return $this->orderIdp;

        return $this;
    }

    /**
     * @return float|string
     */
    public function getSubtotalP()
    {
        return $this->subtotalP;

        return $this;
    }

    /**
     * @return string
     */
    public function getSignature()
    {
        return $this->signature;
    }

    /**
     * @return string
     */
    public function getUrlReturnOk()
    {
        return $this->urlReturnOk;
    }

    /**
     * @return string
     */
    public function getUrlReturnNo()
    {
        return $this->urlReturnNo;
    }

    /**
     * @return string
     */
    public function getCurrency()
    {
        return $this->currency;
    }

    /**
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @return int
     */
    public function getLifetime()
    {
        return $this->lifetime;
    }

    /**
     * @return int
     */
    public function getOrderLifetime()
    {
        return $this->orderLifetime;
    }


    /**
     * @return string
     */
    public function getCustomerIdp()
    {
        return $this->customerIdp;
    }

    /**
     * @return mixed
     */
    public function getCardIdp()
    {
        return $this->cardIdp;
    }

    /**
     * @return string
     */
    public function getIData()
    {
        return $this->iData;
    }

    /**
     * @return string
     */
    public function getPtCode()
    {
        return $this->ptCode;
    }

    /**
     * @return int
     */
    public function getMeanType()
    {
        return $this->meanType;
    }

    /**
     * @return int
     */
    public function getEMoneyType()
    {
        return $this->eMoneyType;
    }

    /**
     * @return int
     */
    public function getBillLifetime()
    {
        return $this->billLifetime;
    }

    /**
     * @return bool
     */
    public function isPreAuth()
    {
        return $this->preAuth;
    }

    /**
     * @return bool
     */
    public function isIsRecurrentStart()
    {
        return $this->IsRecurrentStart;
    }

    /**
     * @return array
     */
    public function getCallbackFields()
    {
        return $this->callbackFields;
    }

    /**
     * @return string
     */
    public function getCallbackFormat()
    {
        return $this->callbackFormat;
    }

    /**
     * @return string
     */
    public function getLanguage()
    {
        return $this->language;
    }

    /**
     * @return string
     */
    public function getComment()
    {
        return $this->comment;
    }

    /**
     * @return string
     */
    public function getFirstName()
    {
        return $this->firstName;
    }

    /**
     * @return mixed
     */
    public function getLastName()
    {
        return $this->lastName;
    }

    /**
     * @return string
     */
    public function getMiddleName()
    {
        return $this->middleName;
    }

    /**
     * @return string
     */
    public function getPhone()
    {
        return $this->phone;
    }

    /**
     * @return string
     */
    public function getAddress()
    {
        return $this->address;
    }

    /**
     * @return string
     */
    public function getCountry()
    {
        return $this->country;
    }

    /**
     * @return string
     */
    public function getState()
    {
        return $this->state;
    }

    /**
     * @return string
     */
    public function getCity()
    {
        return $this->city;
    }

    /**
     * @return mixed
     */
    public function getZip()
    {
        return $this->zip;
    }

    /**
     * @return array
     */
    public function toArray()
    {
        return [
            'Shop_IDP'         => $this->getShopIdp(),
            'Order_IDP'        => $this->getOrderIdp(),
            'Subtotal_P'       => $this->getSubtotalP(),
            'Signature'        => $this->getSignature(),
            'URL_RETURN_OK'    => $this->getUrlReturnOk(),
            'URL_RETURN_NO'    => $this->getUrlReturnNo(),
            'Currency'         => $this->getCurrency(),
            'Email'            => $this->getEmail(),
            'Lifetime'         => $this->getLifetime(),
            'OrderLifetime'    => $this->getOrderLifetime(),
            'Customer_IDP'     => $this->getCustomerIdp(),
            'Card_IDP'         => $this->getCardIdp(),
            'IData'            => $this->getIData(),
            'PT_Code'          => $this->getPtCode(),
            'MeanType'         => $this->getMeanType(),
            'EMoneyType'       => $this->getEMoneyType(),
            'BillLifetime'     => $this->getBillLifetime(),
            'Preauth'          => $this->isPreAuth(),
            'IsRecurrentStart' => $this->isIsRecurrentStart(),
            'CallbackFields'   => $this->getCallbackFields(),
            'CallbackFormat'   => $this->getCallbackFormat(),
            'Language'         => $this->getLanguage(),
            'Comment'          => $this->getComment(),
            'FirstName'        => $this->getFirstName(),
            'LastName'         => $this->getLastName(),
            'MiddleName'       => $this->getMiddleName(),
            'Phone'            => $this->getPhone(),
            'Address'          => $this->getAddress(),
            'Country'          => $this->getCountry(),
            'State'            => $this->getState(),
            'City'             => $this->getCity(),
            'Zip'              => $this->getZip(),
        ];
    }
}