<?php
/**
 * Created by gitkv.
 * E-mail: gitkv@ya.ru
 * GitHub: gitkv
 */

namespace Tmconsulting\Uniteller\Signature;


/**
 * Class Signature
 *
 * @package Tmconsulting\Client
 */
final class SignatureRecurrent extends AbstractSignature
{

    /**
     * @var string
     */
    protected $shopIdp;

    /**
     * @var string
     */
    protected $parentShopIdp;

    /**
     * @var string
     */
    protected $orderIdp;

    /**
     * @var string
     */
    protected $subtotalP;

    /**
     * @var string
     */
    protected $parentOrderIdp;

    /**
     * @var string
     */
    protected $password;

    /**
     * @param string $shopIdp
     * @return SignatureRecurrent
     */
    public function setShopIdp($shopIdp)
    {
        $this->shopIdp = $shopIdp;

        return $this;
    }

    /**
     * @param string $parentShopIdp
     * @return SignatureRecurrent
     */
    public function setParentShopIdp($parentShopIdp)
    {
        $this->parentShopIdp = $parentShopIdp;

        return $this;
    }

    /**
     * @param string $orderIdp
     * @return SignatureRecurrent
     */
    public function setOrderIdp($orderIdp)
    {
        $this->orderIdp = $orderIdp;

        return $this;
    }

    /**
     * @param string $subtotalP
     * @return SignatureRecurrent
     */
    public function setSubtotalP($subtotalP)
    {
        $this->subtotalP = $subtotalP;

        return $this;
    }

    /**
     * @param string $parentOrderIdp
     * @return SignatureRecurrent
     */
    public function setParentOrderIdp($parentOrderIdp)
    {
        $this->parentOrderIdp = $parentOrderIdp;

        return $this;
    }

    /**
     * @param string $password
     * @return SignatureRecurrent
     */
    public function setPassword($password)
    {
        $this->password = $password;

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
    public function getParentShopIdp()
    {
        return $this->parentShopIdp;
    }

    /**
     * @return string
     */
    public function getOrderIdp()
    {
        return $this->orderIdp;
    }

    /**
     * @return string
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
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * @return array
     */
    public function toArray()
    {
        $array = [];
        $array['Shop_IDP'] = $this->getShopIdp();
        if($this->getParentShopIdp() !== null)
            $array['Parent_Shop_IDP'] = $this->getParentShopIdp();
        $array['Order_IDP'] = $this->getOrderIdp();
        $array['Subtotal_P'] = $this->getSubtotalP();
        $array['Parent_Order_IDP'] = $this->getParentOrderIdp();
        $array['Password'] = $this->getPassword();

        return $array;
    }
}