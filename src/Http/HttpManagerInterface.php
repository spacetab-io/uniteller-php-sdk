<?php

namespace Tmconsulting\Uniteller\Http;

/**
 * Created by Roquie.
 * E-mail: roquie0@gmail.com
 * GitHub: Roquie
 */
interface HttpManagerInterface
{
    /**
     * @param $uri
     * @param string $method
     * @param null $data
     * @param array $headers
     * @return string
     */
    public function request($uri, $method = 'POST', $data = null, array $headers = []);
}