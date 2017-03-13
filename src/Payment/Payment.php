<?php
/**
 * Created by Roquie.
 * E-mail: roquie0@gmail.com
 * GitHub: Roquie
 */

namespace Tmconsulting\Uniteller\Payment;

/**
 * Class Payment
 *
 * @package Tmconsulting\Client\Payment
 */
class Payment implements PaymentInterface
{
    /**
     * Payment constructor.
     */
    public function __construct()
    {
        //
    }

    /**
     * @param array $parameters
     * @param array $options
     * @return \Tmconsulting\Uniteller\Payment\UriInterface
     */
    public function execute(array $parameters, array $options)
    {
        $uri = sprintf('%s/pay?%s', $options['base_uri'], http_build_query($parameters));

        return new Uri($uri);
    }
}