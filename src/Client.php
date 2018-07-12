<?php
/**
 * Created by Roquie.
 * E-mail: roquie0@gmail.com
 * GitHub: Roquie
 */

namespace Tmconsulting\Uniteller;

use Tmconsulting\Uniteller\Cancel\CancelRequest;
use Tmconsulting\Uniteller\Exception\NotImplementedException;
use Tmconsulting\Uniteller\Http\HttpManager;
use Tmconsulting\Uniteller\Http\HttpManagerInterface;
use Tmconsulting\Uniteller\Order\Order;
use Tmconsulting\Uniteller\Payment\Payment;
use Tmconsulting\Uniteller\Payment\PaymentInterface;
use Tmconsulting\Uniteller\Request\RequestInterface;
use Tmconsulting\Uniteller\Results\ResultsRequest;
use Tmconsulting\Uniteller\Signature\Signature;
use Tmconsulting\Uniteller\Signature\SignatureInterface;
use GuzzleHttp\Client as GuzzleClient;
use Http\Adapter\Guzzle6\Client as GuzzleAdapter;

/**
 * Class Client
 *
 * @package Tmconsulting\Uniteller
 */
class Client implements ClientInterface
{
    /**
     * @var array
     */
    protected $options = [];

    /**
     * @var PaymentInterface
     */
    protected $payment;

    /**
     * @var SignatureInterface
     */
    protected $signature;

    /**
     * @var RequestInterface
     */
    protected $cancelRequest;

    /**
     * @var RequestInterface
     */
    protected $resultsRequest;

    /**
     * @var HttpManagerInterface
     */
    protected $httpManager;

    /**
     * Client constructor.
     */
    public function __construct()
    {
        $this->registerPayment(new Payment());
        $this->registerCancelRequest(new CancelRequest());
        $this->registerResultsRequest(new ResultsRequest());
        $this->registerSignature(new Signature());
    }

    /**
     * @param $uri
     * @return $this
     */
    public function setBaseUri($uri)
    {
        $this->options['base_uri'] = $uri;

        return $this;
    }

    /**
     * @param $value
     * @return $this
     */
    public function setLogin($value)
    {
        $this->options['login'] = $value;

        return $this;
    }

    /**
     * @param $value
     * @return $this
     */
    public function setPassword($value)
    {
        $this->options['password'] = $value;

        return $this;
    }

    /**
     * @param $value
     * @return $this
     */
    public function setShopId($value)
    {
        $this->options['shop_id'] = $value;

        return $this;
    }

    /**
     * @param array $options
     * @return $this
     */
    public function setOptions(array $options)
    {
        $this->options = array_merge($this->options, $options);

        return $this;
    }

    /**
     * @param HttpManagerInterface $httpManager
     * @return $this
     */
    public function setHttpManager(HttpManagerInterface $httpManager)
    {
        $this->httpManager = $httpManager;

        return $this;
    }

    /**
     * @param PaymentInterface $payment
     * @return $this
     */
    public function registerPayment(PaymentInterface $payment)
    {
        $this->payment = $payment;

        return $this;
    }

    /**
     * @param RequestInterface $cancel
     * @return $this
     */
    public function registerCancelRequest(RequestInterface $cancel)
    {
        $this->cancelRequest = $cancel;

        return $this;
    }

    /**
     * @param RequestInterface $request
     * @return $this
     */
    public function registerResultsRequest(RequestInterface $request)
    {
        $this->resultsRequest = $request;

        return $this;
    }

    /**
     * @param \Tmconsulting\Uniteller\Signature\SignatureInterface $signature
     * @return $this
     */
    public function registerSignature(SignatureInterface $signature)
    {
        $this->signature = $signature;

        return $this;
    }

    /**
     * @return array
     */
    public function getOptions()
    {
        return $this->options;
    }

    /**
     * @param $key
     * @param null $default
     * @return string|mixed
     */
    public function getOption($key, $default = null)
    {
        if (array_key_exists($key, $this->options)) {
            return $this->options[$key];
        }

        return $default;
    }

    /**
     * @return string
     */
    public function getBaseUri()
    {
        return $this->getOption('base_uri');
    }

    /**
     * @return string
     */
    public function getLogin()
    {
        return $this->getOption('login');
    }

    /**
     * @return string
     */
    public function getShopId()
    {
        return $this->getOption('shop_id');
    }

    /**
     * @return string
     */
    public function getPassword()
    {
        return $this->getOption('password');
    }

    /**
     * @return \Tmconsulting\Uniteller\Payment\PaymentInterface
     */
    public function getPayment()
    {
        return $this->payment;
    }

    /**
     * @return \Tmconsulting\Uniteller\Request\RequestInterface
     */
    public function getCancelRequest()
    {
        return $this->cancelRequest;
    }

    /**
     * @return \Tmconsulting\Uniteller\Request\RequestInterface
     */
    public function getResultsRequest()
    {
        return $this->resultsRequest;
    }

    /**
     * @return \Tmconsulting\Uniteller\Signature\SignatureInterface
     */
    public function getSignature()
    {
        return $this->signature;
    }

    /**
     * @return \Tmconsulting\Uniteller\Http\HttpManagerInterface
     */
    public function getHttpManager()
    {
        return $this->httpManager;
    }

    /**
     * Получение платежной ссылки или сразу переход к оплате.
     *
     * @param array $parameters|\Tmconsulting\Client\Payment\PaymentBuilder $builder
     * @return \Tmconsulting\Uniteller\Payment\UriInterface
     */
    public function payment($parameters)
    {
        $array = $this->getParameters($parameters);
        $array['Shop_IDP']  = $this->getShopId();
        $array['Signature'] = $this->signature->create([
            'Shop_IDP'     => array_get($array, 'Shop_IDP'),
            'Order_IDP'    => array_get($array, 'Order_IDP'),
            'Subtotal_P'   => array_get($array, 'Subtotal_P'),
            'MeanType'     => array_get($array, 'MeanType'),
            'EMoneyType'   => array_get($array, 'EMoneyType'),
            'Lifetime'     => array_get($array, 'Lifetime'),
            'Customer_IDP' => array_get($array, 'Customer_IDP'),
            'Card_IDP'     => array_get($array, 'Card_IDP'),
            'IData'        => array_get($array, 'IData'),
            'PT_Code'      => array_get($array, 'PT_Code'),
            'Password'     => $this->getPassword(),
        ]);

        return $this->getPayment()->execute($array, $this->getOptions());
    }

    /**
     * Отмена платежа.
     *
     * @param \Tmconsulting\Uniteller\Cancel\CancelBuilder|array $parameters
     * @return mixed
     * @internal param  $builder
     */
    public function cancel($parameters)
    {
        return $this->callRequestFor('cancel', $parameters);
    }

    /**
     * @param \Tmconsulting\Uniteller\Cancel\CancelBuilder|array $parameters
     * @return Order
     */
    public function results($parameters)
    {
        return $this->callRequestFor('results', $parameters);
    }

    /**
     * @param array $parameters
     * @return mixed
     * @throws \Tmconsulting\Uniteller\Exception\NotImplementedException
     */
    public function reccurent($parameters)
    {
        throw new NotImplementedException(sprintf(
            'In current moment, feature [%s] not implemented.', __METHOD__
        ));
    }

    /**
     * @param array $parameters
     * @return mixed
     * @throws \Tmconsulting\Uniteller\Exception\NotImplementedException
     */
    public function confirm($parameters)
    {
        throw new NotImplementedException(sprintf(
            'In current moment, feature [%s] not implemented.', __METHOD__
        ));
    }

    /**
     * @param array $parameters
     * @return mixed
     * @throws \Tmconsulting\Uniteller\Exception\NotImplementedException
     */
    public function card($parameters)
    {
        throw new NotImplementedException(sprintf(
            'In current moment, feature [%s] not implemented.', __METHOD__
        ));
    }

    /**
     * Подгружаем собственный HttpManager с газлом в качестве клиента, если
     * не был задан свой, перед выполнением запроса.
     *
     * @param $name
     * @param $parameters
     * @return Order|mixed
     */
    private function callRequestFor($name, $parameters)
    {
        if (! $this->getHttpManager()) {
            $httpClient = new GuzzleAdapter(new GuzzleClient());
            $this->setHttpManager(new HttpManager($httpClient, $this->getOptions()));
        }

        /** @var RequestInterface $request */
        $request = $this->{'get' . ucfirst($name) . 'Request'}();

        return $request->execute(
            $this->getHttpManager(),
            $this->getParameters($parameters)
        );
    }

    /**
     * @param $parameters
     * @return mixed
     */
    private function getParameters($parameters)
    {
        if ($parameters instanceof ArraybleInterface) {
            return $parameters->toArray();
        }

        return $parameters;
    }
}