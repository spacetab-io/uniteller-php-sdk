<?php
/**
 * Created by Roquie.
 * E-mail: roquie0@gmail.com
 * GitHub: Roquie
 */

namespace Tmconsulting\Uniteller\Signature;

/**
 * Class Signature
 *
 * @package Tmconsulting\Client
 */
final class Signature implements SignatureInterface
{
    /**
     * Create signature for send payment request.
     *
     * @param array $params
     * @return string
     */
    public function create(array $params)
    {
        $defaults = [
            'Shop_IDP'     => '',
            'Order_IDP'    => '',
            'Subtotal_P'   => '',
            'MeanType'     => '',
            'EMoneyType'   => '',
            'Lifetime'     => '',
            'Customer_IDP' => '',
            'Card_IDP'     => '',
            'IData'        => '',
            'PT_Code'      => '',
            'Password'     => '',
        ];

        $string = join('&', array_map(function ($item) {
            return md5($item);
        }, array_merge($defaults, $params)));

        return strtoupper(md5($string));
    }

    /**
     * Verify signature when Client will be send callback request.
     *
     * @param $signature
     * @param array $params
     * @return bool
     */
    public function verify($signature, array $params)
    {
        return strtoupper(md5(join('', $params))) === $signature;
    }
}