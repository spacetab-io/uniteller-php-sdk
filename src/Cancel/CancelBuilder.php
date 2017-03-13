<?php
/**
 * Created by Roquie.
 * E-mail: roquie0@gmail.com
 * GitHub: Roquie
 */

namespace Tmconsulting\Uniteller\Cancel;

use Tmconsulting\Uniteller\ArraybleInterface;

/**
 * Class CancelBuilder
 *
 * @package Tmconsulting\Client\CancelRequest
 */
final class CancelBuilder implements ArraybleInterface
{
    /**
     * Номер платежа в системе Client
     *
     * @var int
     */
    private $billNumber;

    /**
     * Сумма возврата средств. Должна быть в диапазоне от 0.01 руб.
     * до суммы платежа включительно. В качестве десятичного
     * разделителя используется точка.
     * (Если Subtotal_P не передаётся в запросе,
     * то отмена платежа происходит на полную сумму)
     *
     * @var float
     */
    private $subtotalP;

    /**
     * Код валюты отмены или возврата средств.
     * Может быть использован только код валюты авторизации.
     *
     * @var string
     */
    private $currency;

    /**
     * Причина отмена операции.
     * По умолчанию RVRReason::SHOP.
     *
     * @var int
     */
    private $rvrReason;
    // private $language;

    /**
     * @var array
     */
    private $selectFields = [];

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
     * @param string $currency
     * @return $this
     */
    public function setCurrency($currency)
    {
        $this->currency = $currency;

        return $this;
    }

    /**
     * @param int $rvrReason
     * @return $this
     */
    public function setRvrReason($rvrReason)
    {
        $this->rvrReason = $rvrReason;

        return $this;
    }

    /**
     * @param float $subtotalP
     * @return $this
     */
    public function setSubtotalP($subtotalP)
    {
        $this->subtotalP = $subtotalP;

        return $this;
    }

    /**
     * @param array $selectFields
     * @return $this
     */
    public function setSelectFields(array $selectFields)
    {
        $this->selectFields = $selectFields;

        return $this;
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
    public function getCurrency()
    {
        return $this->currency;
    }

    /**
     * @return int
     */
    public function getRvrReason()
    {
        return $this->rvrReason;
    }

    /**
     * @return float
     */
    public function getSubtotalP()
    {
        return $this->subtotalP;
    }

    /**
     * @return array
     */
    public function getSelectFields()
    {
        return $this->selectFields;
    }

    public function toArray()
    {
        return [
            'Billnumber' => $this->getBillNumber(),
            'Subtotal_P' => $this->getSubtotalP(),
            'Currency'   => $this->getCurrency(),
            'RVRReason'  => $this->getRvrReason(),
            'S_FIELDS'   => $this->getSelectFields()
        ];
    }
}
