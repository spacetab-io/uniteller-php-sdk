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
final class SignaturePayment extends AbstractSignature
{

    /**
     * @var string
     */
    protected $shopIdp;

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
    protected $meanType;

    /**
     * @var string
     */
    protected $eMoneyType;

    /**
     * @var string
     */
    protected $lifeTime;

    /**
     * @var string
     */
    protected $customerIdp;

    /**
     * @var string
     */
    protected $cardIdp;

    /**
     * @var string
     */
    protected $iData;

    /**
     * @var string
     */
    protected $ptCode;

    /**
     * @var string
     */
    protected $password;

    /**
     * @param string $shopIdp
     * @return SignaturePayment
     */
    public function setShopIdp($shopIdp)
    {
        $this->shopIdp = $shopIdp;

        return $this;
    }

    /**
     * @param string $orderIdp
     * @return SignaturePayment
     */
    public function setOrderIdp($orderIdp)
    {
        $this->orderIdp = $orderIdp;

        return $this;
    }

    /**
     * @param string $subtotalP
     * @return SignaturePayment
     */
    public function setSubtotalP($subtotalP)
    {
        $this->subtotalP = $subtotalP;

        return $this;
    }

    /**
     * @param string $meanType
     * @return SignaturePayment
     */
    public function setMeanType($meanType)
    {
        $this->meanType = $meanType;

        return $this;
    }

    /**
     * @param string $eMoneyType
     * @return SignaturePayment
     */
    public function setEMoneyType($eMoneyType)
    {
        $this->eMoneyType = $eMoneyType;

        return $this;
    }

    /**
     * @param string $lifeTime
     * @return SignaturePayment
     */
    public function setLifeTime($lifeTime)
    {
        $this->lifeTime = $lifeTime;

        return $this;
    }

    /**
     * @param string $customerIdp
     * @return SignaturePayment
     */
    public function setCustomerIdp($customerIdp)
    {
        $this->customerIdp = $customerIdp;

        return $this;
    }

    /**
     * @param string $cardIdp
     * @return SignaturePayment
     */
    public function setCardIdp($cardIdp)
    {
        $this->cardIdp = $cardIdp;

        return $this;
    }

    /**
     * @param string $iData
     * @return SignaturePayment
     */
    public function setIData($iData)
    {
        $this->iData = $iData;

        return $this;
    }

    /**
     * @param string $ptCode
     * @return SignaturePayment
     */
    public function setPtCode($ptCode)
    {
        $this->ptCode = $ptCode;

        return $this;
    }

    /**
     * @param string $password
     * @return SignaturePayment
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
    public function getMeanType()
    {
        return $this->meanType;
    }

    /**
     * @return string
     */
    public function getEMoneyType()
    {
        return $this->eMoneyType;
    }

    /**
     * @return string
     */
    public function getLifeTime()
    {
        return $this->lifeTime;
    }

    /**
     * @return string
     */
    public function getCustomerIdp()
    {
        return $this->customerIdp;
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
        $array['Order_IDP'] = $this->getOrderIdp();
        $array['Subtotal_P'] = $this->getSubtotalP();
        $array['MeanType'] = $this->getMeanType();
        $array['EMoneyType'] = $this->getEMoneyType();
        $array['Lifetime'] = $this->getLifeTime();
        $array['Customer_IDP'] = $this->getCustomerIdp();
        $array['Card_IDP'] = $this->getCardIdp();
        $array['IData'] = $this->getIData();
        $array['PT_Code'] = $this->getPtCode();
        $array['Password'] = $this->getPassword();

        return $array;
    }
}