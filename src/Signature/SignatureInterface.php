<?php
/**
 * Created by Roquie.
 * E-mail: roquie0@gmail.com
 * GitHub: Roquie
 */

namespace Tmconsulting\Uniteller\Signature;

/**
 * Interface SignatureInterface
 *
 * @package Tmconsulting\Client
 */
interface SignatureInterface
{
    /**
     * Create signature for send payment request.
     *
     * @param array $params
     * @return string
     */
    public function create(array $params);

    /**
     * Verify signature when Client will be send callback request.
     *
     * @param $signature
     * @param array $params
     * @return bool
     */
    public function verify($signature, array $params);
}
