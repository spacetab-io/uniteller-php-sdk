<?php
/**
 * Created by Roquie.
 * E-mail: roquie0@gmail.com
 * GitHub: Roquie
 */

namespace Tmconsulting\Uniteller\Payment;


interface PaymentInterface
{
    /**
     * @param array $parameters
     * @param array $options
     * @return \Tmconsulting\Uniteller\Payment\UriInterface
     */
    public function execute(array $parameters, array $options);
}