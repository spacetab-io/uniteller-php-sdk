<?php
/**
 * Created by gitkv.
 * E-mail: gitkv@ya.ru
 * GitHub: gitkv
 */

namespace Tmconsulting\Uniteller\Recurrent;


use Tmconsulting\Uniteller\ArraybleInterface;

/**
 * Class RecurrentBuilder
 * @package Tmconsulting\Uniteller\Recurrent
 */
class RecurrentBuilder implements ArraybleInterface
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
     * Номер (Order_IDP) «родительского» платежа в системе расчётов
     * интернет-магазина. Может быть любой непустой строкой максимальной
     * длиной 127 символов, не может содержать только пробелы.
     *
     * @var string
     */
    protected $parentOrderIdp;

    /**
     * Идентификатор точки продажи в системе Uniteller, через которую был проведён «родительский» платёж.
     *
     * Если рекуррентный платёж осуществляется через ту же точку продажи, что и «родительский» платёж,
     * то параметр Parent_Shop_IDP можно не передавать.
     *
     * @var string
     */
    protected $parentShopIdp;

    /**
     * @param string $shopIdp
     * @return RecurrentBuilder
     */
    public function setShopIdp($shopIdp)
    {
        $this->shopIdp = $shopIdp;

        return $this;
    }

    /**
     * @param string $orderIdp
     * @return RecurrentBuilder
     */
    public function setOrderIdp($orderIdp)
    {
        $this->orderIdp = $orderIdp;

        return $this;
    }

    /**
     * @param float|string $subtotalP
     * @return RecurrentBuilder
     */
    public function setSubtotalP($subtotalP)
    {
        $this->subtotalP = $subtotalP;

        return $this;
    }

    /**
     * @param string $parentOrderIdp
     * @return RecurrentBuilder
     */
    public function setParentOrderIdp($parentOrderIdp)
    {
        $this->parentOrderIdp = $parentOrderIdp;

        return $this;
    }

    /**
     * @param string $parentShopIdp
     * @return RecurrentBuilder
     */
    public function setParentShopIdp($parentShopIdp)
    {
        $this->parentShopIdp = $parentShopIdp;

        return $this;
    }

    /**
     * @return string
     */
    public function getShopIdp()
    {
        return $this->shopIdp;
    }

    /**
     * @return string
     */
    public function getOrderIdp()
    {
        return $this->orderIdp;
    }

    /**
     * @return float|string
     */
    public function getSubtotalP()
    {
        return $this->subtotalP;
    }

    /**
     * @return string
     */
    public function getParentOrderIdp()
    {
        return $this->parentOrderIdp;
    }

    /**
     * @return string
     */
    public function getParentShopIdp()
    {
        return $this->parentShopIdp;
    }

    /**
     * @return array
     */
    public function toArray()
    {
        return [
            'Shop_IDP'         => $this->getShopIdp(),
            'Parent_Shop_IDP'  => $this->getParentShopIdp(),
            'Order_IDP'        => $this->getOrderIdp(),
            'Parent_Order_IDP' => $this->getParentOrderIdp(),
            'Subtotal_P'       => $this->getSubtotalP(),
        ];
    }
}