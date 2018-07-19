<?php
/**
 * Created by gitkv.
 * E-mail: gitkv@ya.ru
 * GitHub: gitkv
 */

namespace Tmconsulting\Uniteller\Signature;


/**
 * Class SignatureCallback
 * @package Tmconsulting\Uniteller\Signature
 */
final class SignatureCallback extends AbstractSignature
{

    /**
     * @var string
     */
    protected $orderId;

    /**
     * @var string
     */
    protected $status;

    /**
     * @var array
     */
    protected $fields = [];

    /**
     * @var string
     */
    protected $password;

    /**
     * @param $orderId
     * @return SignatureCallback
     */
    public function setOrderId($orderId)
    {
        $this->orderId = $orderId;

        return $this;
    }

    /**
     * @param $status
     * @return SignatureCallback
     */
    public function setStatus($status)
    {
        $this->status = $status;

        return $this;
    }

    /**
     * @param array $fields
     * @return SignatureCallback
     */
    public function setFields($fields)
    {
        $this->fields = $fields;

        return $this;
    }

    /**
     * @param string $password
     * @return SignatureCallback
     */
    public function setPassword($password)
    {
        $this->password = $password;

        return $this;
    }

    /**
     * @return string
     */
    public function getOrderId()
    {
        return $this->orderId;
    }

    /**
     * @return string
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * @return array
     */
    public function getFields()
    {
        return $this->fields;
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
        $array['Order_ID'] = $this->getOrderId();
        $array['Status'] = $this->getStatus();
        $array = array_merge($array, $this->getFields());
        $array['Password'] = $this->getPassword();

        return $array;
    }

    /**
     * Create signature
     *
     * @return string
     */
    public function create()
    {
        return strtoupper(md5(join('', $this->toArray())));
    }
}