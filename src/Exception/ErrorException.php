<?php
/**
 * Created by Roquie.
 * E-mail: roquie0@gmail.com
 * GitHub: Roquie
 */

namespace Tmconsulting\Uniteller\Exception;

/**
 * Class ErrorException
 *
 * @package Tmconsulting\Client\Http
 */
class ErrorException extends UnitellerException
{
    /**
     * @var int
     */
    protected $errorCode;

    /**
     * @return mixed
     */
    public function getErrorCode()
    {
        return $this->errorCode;
    }
}