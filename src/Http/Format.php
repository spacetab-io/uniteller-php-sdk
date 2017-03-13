<?php
/**
 * Created by Roquie.
 * E-mail: roquie0@gmail.com
 * GitHub: Roquie
 */

namespace Tmconsulting\Uniteller\Http;

use BadMethodCallException;
use Tmconsulting\Uniteller\Exception\RequestNotSupportedException;
use Tmconsulting\Uniteller\Request\RequestInterface;
use Tmconsulting\Uniteller;

/**
 * Class Format
 *
 * @method static int resolveXml(string $requestName)
 * @method static int resolveCsv(string $requestName)
 * @method static int resolveWddx(string $requestName)
 * @method static int resolveSoap(string $requestName)
 * @method static int resolveBrackets(string $requestName)
 *
 * @package Tmconsulting\Client\Http
 */
final class Format
{
    /**
     * @var array
     */
    private static $variants = [
        RequestInterface::REQUEST_CARD      => ['csv' => 1, 'wddx' => 2, 'xml' => 3],
        RequestInterface::REQUEST_CONFIRM   => ['csv' => 1, 'wddx' => 2, 'xml' => 3],
        RequestInterface::REQUEST_RECURRENT => ['csv' => 1],
        RequestInterface::REQUEST_CANCEL    => ['csv' => 1, 'wddx' => 2, 'xml' => 3, 'soap' => 4],
        RequestInterface::REQUEST_RESULTS   => ['csv' => 1, 'wddx' => 2, 'brackets' => 3, 'xml' => 4, 'soap' => 5]
    ];

    /**
     * Преобразование от имени запроса к одному формату.
     *
     * @param $format
     * @param $requestName
     * @return int
     * @throws \Tmconsulting\Uniteller\Exception\RequestNotSupportedException
     */
    public static function resolve($format, $requestName)
    {
        if (! array_key_exists($requestName, self::$variants)) {
            throw new RequestNotSupportedException(sprintf(
                'Request [%s] not supported here.', $requestName
            ));
        }

        if (! array_key_exists($format, self::$variants[$requestName])) {
            throw new FormatNotSupportedException(sprintf(
                'Format [%s] not supported for request [%s].', $format, $requestName
            ));
        }

        return self::$variants[$requestName][$format];
    }

    /**
     * Вариант Format::resolveXml(...), для ленивых, как я.
     *
     * @param $name
     * @param array $arguments
     * @return int
     */
    public static function __callStatic($name, array $arguments)
    {
        if (false === strpos($name, 'resolve')) {
            throw new BadMethodCallException(sprintf(
                'Method [%s] not found.', $name
            ));
        }

        return self::resolve(
            strtolower(substr($name, 7)),
            Uniteller\array_get($arguments, 0)
        );
    }
}