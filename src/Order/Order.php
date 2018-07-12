<?php
/**
 * Created by Roquie.
 * E-mail: roquie0@gmail.com
 * GitHub: Roquie
 */

namespace Tmconsulting\Uniteller\Order;

use DateTime;
use Tmconsulting\Uniteller\ArraybleInterface;
use Tmconsulting\Uniteller\Error\ResponseCode;

/**
 * Class Order
 *
 * @package Tmconsulting\Client\Order
 */
class Order implements ArraybleInterface
{
    /**
     * Адрес Держателя карты
     *
     * @var string
     */
    protected $address;

    /**
     * Код подтверждения транзакции от процессингового центра
     *
     * @var string
     */
    protected $approvalCode;

    /**
     * Имя банка-эмитента
     *
     * @var string
     */
    protected $bankName;

    /**
     * Номер платежа в системе Client
     *
     * @var int
     */
    protected $billNumber;

    /**
     * Идентификатор (логин) Мерчанта в сервисе Booking.com
     *
     * @var string
     */
    protected $bookingcomId;

    /**
     * Пароль Мерчанта в сервисе Booking.com
     *
     * @var string
     */
    protected $bookingcomPincode;

    /**
     * Идентификатор зарегистрированной карты
     *
     * @var string
     */
    protected $cardIdp;

    /**
     * Информация, введённая Покупателем на странице оплаты в поле имени владельца карты.
     *
     * @var string
     */
    protected $cardHolder;

    /**
     * Первые 6 цифр и последние 4 цифры номера карты (PAN), соединённые звёздочками
     *
     * @var string
     */
    protected $cardNumber;

    /**
     * Тип платёжной системы карты (возможные значения: visa, mastercard,  dinnersclub, jcb)
     *
     * @var string
     */
    protected $cardType;

    /**
     * Комментарий к оплате (передаётся в запросе на оплату)
     *
     * @var string
     */
    protected $comment;

    /**
     * Код валюты
     *
     * @var string
     */
    protected $currency;

    /**
     * Наличие CVC2/CVV2/4DBC
     * (0 — авторизация без CVC2, 1 — авторизация с СVC2)
     *
     * @var bool
     */
    protected $cvc2;

    /**
     * Дата и время создания заказа в системе
     * Client в формате dd.mm.yyyy hh:mm:ss
     *
     * @var DateTime|null
     */
    protected $date;

    /**
     * Адрес электронной почты Держателя карты
     *
     * @var string
     */
    protected $email;

    /**
     * Тип электронной валюты
     *
     * @var string
     */
    protected $eMoneyType;


    /**
     * Данные заказа, выставленного в электронной платёжной системе.
     *
     * @var array
     */
    protected $eOrderData;

    /**
     * Код ответа процессингового центра
     *
     * @var int
     */
    protected $errorCode;

    /**
     * Расшифровка кода ответа процессингового центра
     *
     * @var string
     */
    protected $errorComment;

    /**
     * Имя Держателя карты
     *
     * @var string
     */
    protected $firstName;

    /**
     * @var int
     */
    protected $gdsPaymentPurposeId;

    /**
     * «Длинная запись» (параметр, включающий дополнительную информацию, необходимую при бронировании и оплате авиабилетов)
     *
     * @var string
     */
    protected $iData;

    /**
     * IP-адрес Покупателя
     *
     * @var string
     */
    protected $ip;

    /**
     * Фамилия Держателя карты
     *
     * @var string
     */
    protected $lastName;

    /**
     * Идентификатор кредитной организации
     *
     * @var string
     */
    protected $loanId;

    /**
     * Сообщение об ошибке (текст ошибки, если она произошла)
     *
     * @var string
     */
    protected $message;

    /**
     * Отчество Держателя карты
     *
     * @var string
     */
    protected $middleName;

    /**
     * Признак необходимости подтверждения преавторизации
     *
     * «0» — платёж без преавторизации или уже подтверждён;
     * «1» — необходимо подтверждение.
     *
     * @var bool
     */
    protected $needConfirm;

    /**
     * Номер заказа в интернет-магазине Мерчанта
     *
     * @var string
     */
    protected $orderNumber;

    /**
     * Идентификатор «родительского» платежа (значение параметра OrderNumber) для рекуррентного платежа.
     * Пустое значение, если платёж нерекуррентный.
     *
     * @var string
     */
    protected $parentOrderNumber;

    /**
     * «1» — оплата кредитной картой;
     * «3» — оплата с помощью электронной валюты.
     * Payment\Type::CREDIT_CARD
     *
     * @var int
     */
    protected $paymentType;

    /**
     * Телефон Держателя карты
     *
     * @var string
     */
    protected $phone;

    /**
     * Тип платежа
     *
     * @var string
     */
    protected $ptCode;

    /**
     * Расшифровка кода возврата
     *
     * @var string
     */
    protected $recommendation;

    /**
     * Код возврата
     *
     * @var string
     */
    protected $responseCode;

    /**
     * Состояние заказа
     * Order\Status::PAID
     *
     * @var string
     */
    protected $status;

    /**
     * Сумма всех средств, уплаченных по одному заказу.
     * Десятичный разделитель — точка
     *
     * @var string
     */
    protected $total;

    /**
     * @var DateTime|null
     */
    protected $packetDate;

    /**
     * @var string
     */
    protected $signature;


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
     * @param string $approvalCode
     * @return $this
     */
    public function setApprovalCode($approvalCode)
    {
        $this->approvalCode = $approvalCode;

        return $this;
    }

    /**
     * @param string $bankName
     * @return $this
     */
    public function setBankName($bankName)
    {
        $this->bankName = $bankName;

        return $this;
    }

    /**
     * @param int $billNumber
     * @return $this
     */
    public function setBillNumber($billNumber)
    {
        $this->billNumber = $billNumber;

        return $this;
    }

    /**
     * @param string $bookingcomId
     * @return $this
     */
    public function setBookingcomId($bookingcomId)
    {
        $this->bookingcomId = $bookingcomId;

        return $this;
    }

    /**
     * @param string $bookingcomPincode
     * @return $this
     */
    public function setBookingcomPincode($bookingcomPincode)
    {
        $this->bookingcomPincode = $bookingcomPincode;

        return $this;
    }

    /**
     * @param string $cardIdp
     * @return $this
     */
    public function setCardIdp($cardIdp)
    {
        $this->cardIdp = $cardIdp;

        return $this;
    }

    /**
     * @param string $cardHolder
     * @return $this
     */
    public function setCardHolder($cardHolder)
    {
        $this->cardHolder = $cardHolder;

        return $this;
    }

    /**
     * @param string $cardNumber
     * @return $this
     */
    public function setCardNumber($cardNumber)
    {
        $this->cardNumber = $cardNumber;

        return $this;
    }

    /**
     * @param string $cardType
     * @return $this
     */
    public function setCardType($cardType)
    {
        $this->cardType = $cardType;

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
     * @param string $currency
     * @return $this
     */
    public function setCurrency($currency)
    {
        $this->currency = $currency;

        return $this;
    }

    /**
     * @param $value
     * @return $this
     */
    public function setCvc2($value)
    {
        $this->cvc2 = (bool) $value;

        return $this;
    }

    /**
     * @return $this
     */
    public function withCvc2()
    {
        $this->cvc2 = true;

        return $this;
    }

    /**
     * @return $this
     */
    public function withoutCvc2()
    {
        $this->cvc2 = false;

        return $this;
    }

    /**
     * @param DateTime $date
     * @return $this
     */
    public function setDate($date)
    {
        if (empty($date)) {
            return $this;
        }

        // Ёбаный насрать, а даты зачем разного формата отдавать?
        // Полностью разделяю и поддерживаю данное негодование, значит ебашим костыли))
        $date = str_replace('.', '-', $date);
        $this->date = DateTime::createFromFormat('U', strtotime($date));

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
     * @param string $eMoneyType
     * @return $this
     */
    public function setEMoneyType($eMoneyType)
    {
        $this->eMoneyType = $eMoneyType;

        return $this;
    }

    /**
     * @param array $eOrderData
     * @return $this
     */
    public function setEOrderData($eOrderData)
    {
        if (empty($eOrderData)) {
            return $this;
        }

        foreach (explode(', ', $eOrderData) as $item) {
            list($key, $value) = explode('=', $item);
            $this->eOrderData[$key] = $value;
        }

        return $this;
    }

    /**
     * @param int $errorCode
     * @return $this
     */
    public function setErrorCode($errorCode)
    {
        $this->errorCode = $errorCode;

        return $this;
    }

    /**
     * @param string $errorComment
     * @return $this
     */
    public function setErrorComment($errorComment)
    {
        $this->errorComment = $errorComment;

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
     * @param int $gdsPaymentPurposeId
     * @return $this
     */
    public function setGdsPaymentPurposeId($gdsPaymentPurposeId)
    {
        $this->gdsPaymentPurposeId = $gdsPaymentPurposeId;

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
     * @param string $ip
     * @return $this
     */
    public function setIp($ip)
    {
        $this->ip = $ip;

        return $this;
    }

    /**
     * @param string $lastName
     * @return $this
     */
    public function setLastName($lastName)
    {
        $this->lastName = $lastName;

        return $this;
    }

    /**
     * @param string $loanId
     * @return $this
     */
    public function setLoanId($loanId)
    {
        $this->loanId = $loanId;

        return $this;
    }

    /**
     * @param string $message
     * @return $this
     */
    public function setMessage($message)
    {
        $this->message = $message;

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
     * @param bool $needConfirm
     * @return $this
     */
    public function setNeedConfirm($needConfirm)
    {
        $this->needConfirm = (bool) $needConfirm;
        
        return $this;
    }

    /**
     * @param string $orderNumber
     * @return $this
     */
    public function setOrderNumber($orderNumber)
    {
        $this->orderNumber = $orderNumber;

        return $this;
    }

    /**
     * @param string $parentOrderNumber
     * @return $this
     */
    public function setParentOrderNumber($parentOrderNumber)
    {
        $this->parentOrderNumber = $parentOrderNumber;

        return $this;
    }

    /**
     * @param int $paymentType
     * @return $this
     */
    public function setPaymentType($paymentType)
    {
        $this->paymentType = $paymentType;

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
     * @param string $ptCode
     * @return $this
     */
    public function setPtCode($ptCode)
    {
        $this->ptCode = $ptCode;

        return $this;
    }

    /**
     * @param string $recommendation
     * @return $this
     */
    public function setRecommendation($recommendation)
    {
        $this->recommendation = $recommendation;

        return $this;
    }

    /**
     * @param string $responseCode
     * @return $this
     */
    public function setResponseCode($responseCode)
    {
        $this->responseCode = $responseCode;

        return $this;
    }

    /**
     * @param string $status
     * @return $this
     */
    public function setStatus($status)
    {
        $this->status = Status::resolve($status);

        return $this;
    }

    /**
     * @param string $total
     * @return $this
     */
    public function setTotal($total)
    {
        $this->total = $total;

        return $this;
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
    public function getApprovalCode()
    {
        return $this->approvalCode;
    }

    /**
     * @return string
     */
    public function getBankName()
    {
        return $this->bankName;
    }

    /**
     * @return int
     */
    public function getBillNumber()
    {
        return $this->billNumber;
    }

    /**
     * @return string
     */
    public function getBookingcomId()
    {
        return $this->bookingcomId;
    }

    /**
     * @return string
     */
    public function getBookingcomPincode()
    {
        return $this->bookingcomPincode;
    }

    /**
     * @return string
     */
    public function getCardIdp()
    {
        return $this->cardIdp;
    }

    /**
     * @return string
     */
    public function getCardHolder()
    {
        return $this->cardHolder;
    }

    /**
     * @return string
     */
    public function getCardNumber()
    {
        return $this->cardNumber;
    }

    /**
     * @return string
     */
    public function getCardType()
    {
        return $this->cardType;
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
    public function getCurrency()
    {
        return $this->currency;
    }

    /**
     * @return int
     */
    public function isCvc2()
    {
        return $this->cvc2;
    }

    /**
     * @return DateTime
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @return string
     */
    public function getEMoneyType()
    {
        return $this->eMoneyType;
    }

    /**
     * @return array
     */
    public function getEOrderData()
    {
        return $this->eOrderData;
    }

    /**
     * @return int
     */
    public function getErrorCode()
    {
        return $this->errorCode;
    }

    /**
     * @return string
     */
    public function getErrorComment()
    {
        return $this->errorComment;
    }

    /**
     * @return string
     */
    public function getFirstName()
    {
        return $this->firstName;
    }

    /**
     * @return int
     */
    public function getGdsPaymentPurposeId()
    {
        return $this->gdsPaymentPurposeId;
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
    public function getIp()
    {
        return $this->ip;
    }

    /**
     * @return string
     */
    public function getLastName()
    {
        return $this->lastName;
    }

    /**
     * @return string
     */
    public function getLoanId()
    {
        return $this->loanId;
    }

    /**
     * @return string
     */
    public function getMessage()
    {
        return $this->message;
    }

    /**
     * @return string
     */
    public function getMiddleName()
    {
        return $this->middleName;
    }

    /**
     * @return bool
     */
    public function isNeedConfirm()
    {
        return $this->needConfirm;
    }

    /**
     * @return string
     */
    public function getOrderNumber()
    {
        return $this->orderNumber;
    }

    /**
     * @return string
     */
    public function getParentOrderNumber()
    {
        return $this->parentOrderNumber;
    }

    /**
     * @return int
     */
    public function getPaymentType()
    {
        return $this->paymentType;
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
    public function getPtCode()
    {
        return $this->ptCode;
    }

    /**
     * @return string
     */
    public function getRecommendation()
    {
        return $this->recommendation;
    }

    /**
     * @return string
     */
    public function getResponseCode()
    {
        return $this->responseCode;
    }

    /**
     * @return string
     */
    public function getResponseMessage()
    {
        return ResponseCode::message($this->responseCode);
    }

    /**
     * @return string
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * @return string
     */
    public function getTotal()
    {
        return $this->total;
    }

    /**
     * @param DateTime $packetDate
     * @return $this
     */
    public function setPacketDate($packetDate)
    {
        if (empty($packetDate)) {
            return $this;
        }

        // 10.03.2017 15:42:42 - o_O
        // 2018.07.16 10:54:05 - O_o
        $packetDate = str_replace('.', '-', $packetDate);
        $this->packetDate = DateTime::createFromFormat('U', strtotime($packetDate));

        return $this;
    }

    /**
     * @return DateTime
     */
    public function getPacketDate()
    {
        return $this->packetDate;
    }

    /**
     * @return string
     */
    public function getSignature()
    {
        return $this->signature;
    }

    /**
     * @param string $signature
     * @return Order
     */
    public function setSignature($signature)
    {
        $this->signature = $signature;

        return $this;
    }

    /**
     * @return array
     */
    public function toArray()
    {
        return [
            'Address'                => $this->getAddress(),
            'ApprovalCode'           => $this->getApprovalCode(),
            'BankName'               => $this->getBankName(),
            'BillNumber'             => $this->getBillNumber(),
            'bookingcom_id'          => $this->getBookingcomId(),
            'bookingcom_pincode'     => $this->getBookingcomPincode(),
            'Card_IDP'               => $this->getCardIdp(),
            'CardHolder'             => $this->getCardHolder(),
            'CardNumber'             => $this->getCardNumber(),
            'CardType'               => $this->getCardType(),
            'Comment'                => $this->getComment(),
            'Currency'               => $this->getCurrency(),
            'CVC2'                   => $this->isCvc2(),
            'Date'                   => $this->getDate(),
            'PacketDate'             => $this->getPacketDate(),
            'Email'                  => $this->getEmail(),
            'EMoneyType'             => $this->getEMoneyType(),
            'EOrderData'             => $this->getEOrderData(),
            'Error_Code'             => $this->getErrorCode(),
            'Error_Comment'          => $this->getErrorComment(),
            'FirstName'              => $this->getFirstName(),
            'gds_payment_purpose_id' => $this->getGdsPaymentPurposeId(),
            'IData'                  => $this->getIData(),
            'IPAddress'              => $this->getIp(),
            'LastName'               => $this->getLastName(),
            'LoanID'                 => $this->getLoanId(),
            'Message'                => $this->getMessage(),
            'MiddleName'             => $this->getMiddleName(),
            'need_confirm'           => $this->isNeedConfirm(),
            'OrderNumber'            => $this->getOrderNumber(),
            'parent_order_number'    => $this->getParentOrderNumber(),
            'PaymentType'            => $this->getPaymentType(),
            'Phone'                  => $this->getPhone(),
            'PT_Code'                => $this->getPtCode(),
            'Recommendation'         => $this->getRecommendation(),
            'Response_Code'          => $this->getResponseCode(),
            'Response_Message'       => $this->getResponseMessage(),
            'Status'                 => $this->getStatus(),
            'Total'                  => $this->getTotal(),
            'Signature'              => $this->getSignature(),
        ];
    }
}