<?php
/**
 * Created by Roquie.
 * E-mail: roquie0@gmail.com
 * GitHub: Roquie
 */

namespace Tmconsulting\Uniteller\Payment;

/**
 * Class Uri
 *
 * @package Tmconsulting\Client\Payment
 */
final class Uri implements UriInterface
{
    /**
     * @var string
     */
    private $uri;

    /**
     * Uri constructor.
     *
     * @param $uri
     */
    public function __construct($uri)
    {
        $this->uri = $uri;
    }

    /**
     * @return string
     */
    public function getUri()
    {
        return $this->uri;
    }

    /**
     * @return void
     */
    public function go()
    {
        header(sprintf('Location: %s', $this->uri));
    }
}