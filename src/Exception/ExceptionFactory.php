<?php
/**
 * Created by Roquie.
 * E-mail: roquie0@gmail.com
 * GitHub: Roquie
 */

namespace Tmconsulting\Uniteller\Exception;

use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;
use Tmconsulting\Uniteller\Error\Error;

/**
 * Class ExceptionFactory
 *
 * @package Tmconsulting\Client\Exception
 */
class ExceptionFactory
{
    /**
     * Мои любимые регулярочки <3
     *
     * @var array
     */
    protected static $messageToErrorCode = [
        Error::AUTH_CONFIRM_IS_NOT_ALLOWED => 'Authorization(\s)+confirm(\s)+is(\s)+not(\s)+allowed',
        Error::AUTHENTICATION              => 'Authentication(\s)+error',
        Error::BAD_FIELD_FORMAT            => 'Field(.*)has(\s)+bad(\s)+format',
        Error::MANDATORY_PARAMETER         => 'Mandatory(\s)+parameter(\s)+\\\'(.*)\\\'(.*)',
        Error::NOT_SUPPORTED_SFIELD        => 'S_FIELDS(\s)+contains(\s)+field(\s)+\\\'(.*)\\\'(.*)',
        Error::OPERATION_FAILED            => 'The(\s)+operation(\s)+failed',
    ];

    /**
     * В /results запросе кода ошибки нет, есть только его сообщение.
     * С помощью регулярок (а как еще!?) вызовем нужный эксепшен на помощь разработчикам.
     *
     * @param $message
     * @param \Psr\Http\Message\RequestInterface $request
     * @param \Psr\Http\Message\ResponseInterface $response
     * @return \ErrorException
     */
    public static function createFromMessage($message, RequestInterface $request, ResponseInterface $response)
    {
        foreach (self::$messageToErrorCode as $code => $regex) {
            preg_match('/' . $regex . '/', $message, $matches);
            if (count($matches) > 0) {
                return self::create($code, $message, $request, $response);
            }
        }

        return self::create(null, $message, $request, $response);
    }

    /**
     * Конвертируем код ошибки в эксепшен.
     *
     * @param $code
     * @param $message
     * @param \Psr\Http\Message\RequestInterface $request
     * @param \Psr\Http\Message\ResponseInterface $response
     * @return \ErrorException
     */
    public static function create($code, $message, RequestInterface $request, ResponseInterface $response)
    {
        switch ($code) {
            case Error::AUTH_CONFIRM_IS_NOT_ALLOWED:
                return new AuthConfirmIsNotAllowedException(
                    $message, $request, $response
                );
            case Error::AUTHENTICATION:
                return new AuthenticationException(
                    $message, $request, $response
                );
            case Error::BAD_FIELD_FORMAT:
                return new BadFieldFormatException(
                    $message, $request, $response
                );
            case Error::MANDATORY_PARAMETER:
                return new MandatoryParameterException(
                    $message, $request, $response
                );
            case Error::NOT_SUPPORTED_SFIELD:
                return new NotSupportedSFieldException(
                    $message, $request, $response
                );
            case Error::OPERATION_FAILED:
                return new OperationFailedException(
                    $message, $request, $response
                );
        }

        return new ErrorException($message, $request, $response);
    }
}