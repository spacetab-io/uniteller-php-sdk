<?php
/**
 * Created by Roquie.
 * E-mail: roquie0@gmail.com
 * GitHub: Roquie
 */

namespace Tmconsulting\Uniteller;

use Tmconsulting\Uniteller\Order\Order;
use Tmconsulting\Uniteller\Payment\UriInterface;

/**
 * Interface ClientInterface
 *
 * @package Tmconsulting\Client
 */
interface ClientInterface
{
    /**
     * @param \Tmconsulting\Uniteller\Payment\PaymentBuilder|array $parameters
     * @return UriInterface
     */
    public function payment($parameters);

    /**
     * @param \Tmconsulting\Uniteller\Cancel\CancelBuilder|array $parameters
     * @return Order
     */
    public function cancel($parameters);

    /**
     * @param \Tmconsulting\Uniteller\Cancel\CancelBuilder|array $parameters
     * @return Order
     */
    public function results($parameters);

    /**
     * @param array $parameters
     * @return mixed
     */
    public function reccurent($parameters);

    /**
     * @param array $parameters
     * @return mixed
     */
    public function confirm($parameters);

    /**
     * @param array $parameters
     * @return mixed
     */
    public function card($parameters);
}