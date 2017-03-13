<?php
/**
 * Created by Roquie.
 * E-mail: roquie0@gmail.com
 * GitHub: Roquie
 */

namespace Tmconsulting\Uniteller\Payment;


interface UriInterface
{
    /**
     * @return string
     */
    public function getUri();

    /**
     * @return void
     */
    public function go();
}