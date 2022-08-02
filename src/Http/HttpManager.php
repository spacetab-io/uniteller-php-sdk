<?php
/**
 * Created by Roquie.
 * E-mail: roquie0@gmail.com
 * GitHub: Roquie
 */

namespace Tmconsulting\Uniteller\Http;

use Exception;
use GuzzleHttp\Psr7\Request;
use Http\Client\Exception\RequestException;
use Http\Client\HttpClient;
use Psr\Http\Client\ClientExceptionInterface;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;
use SimpleXMLElement;
use Throwable;
use Tmconsulting\Uniteller\Exception\ErrorException;
use Tmconsulting\Uniteller\Exception\ExceptionFactory;
use Tmconsulting\Uniteller\Exception\UnitellerException;
use function Tmconsulting\Uniteller\csv_to_array;

/**
 * Class HttpManager
 *
 * @package Tmconsulting\Client\Http
 */
class HttpManager implements HttpManagerInterface
{
    /**
     * @var HttpClient
     */
    protected $httpClient;

    /**
     * @var array
     */
    protected $options;

    /**
     * HttpManager constructor.
     *
     * @param HttpClient $httpClient
     * @param array $options
     */
    public function __construct(HttpClient $httpClient, array $options = [])
    {
        $this->httpClient = $httpClient;
        $this->options    = $options;
    }

    protected function getDefaultHeaders(string $format): array
    {
        $headers = [
            'Content-Type' => 'application/x-www-form-urlencoded',
        ];

        switch ($format) {
            case 'xml':
                $headers['Accept'] = 'application/xml';
                break;
            case 'csv':
                $headers['Accept'] = 'text/csv';
                break;
            case 'json':
                $headers['Accept'] = 'application/json';
                break;
        }

        return $headers;
    }

    /**
     * @param $uri
     * @param string $method
     * @param null $data
     * @param array $headers
     * @param string $format
     * @return string
     * @throws ErrorException|ClientExceptionInterface
     */
    public function request($uri, $method = 'POST', $data = null, array $headers = [], string $format = 'xml'): string
    {
        $uri = sprintf('%s/%s?%s', $this->options['base_uri'], $uri, http_build_query([
            'Shop_ID'  => $this->options['shop_id'],
            'Login'    => $this->options['login'],
            'Password' => $this->options['password'],
            'Format'   => Format::{"resolve$format"}($uri),
        ]));

        $request = new Request($method, $uri, array_merge($this->getDefaultHeaders($format), $headers), $data);

        try {
            $response = $this->httpClient->sendRequest($request);
        } catch (RequestException $e) {
            throw UnitellerException::create($request, $e->getResponse());
        }

        if ($response->getStatusCode() < 200 || $response->getStatusCode() > 299) {
            throw UnitellerException::create($request, $response);
        }

        $body = (string) $response->getBody();

        $this->providerError($body, $request, $response, $format);

        return $body;
    }

    /**
     * @param $body
     * @param RequestInterface $request
     * @param ResponseInterface $response
     * @param string $format
     * @throws ErrorException
     */
    protected function providerError($body, RequestInterface $request, ResponseInterface $response, string $format = 'xml'): void
    {
        if ($format === 'csv') {
            $data = csv_to_array($body, true);

            if (isset($data['ErrorMessage'])) {
                throw ExceptionFactory::createFromMessage(
                    $data['ErrorMessage'], $request, $response
                );
            }

            return;
        }

        if ($format === 'xml') {
            if (substr($body, 0, 6) === 'ERROR:') {
                throw ExceptionFactory::createFromMessage(
                    substr($body, 7), $request, $response
                );
            }

            try {
                $xml = new SimpleXMLElement((string) $body);
            } catch (Throwable $e) {
                throw new UnitellerException('XML parsing failed', $request, $response, $e);
            }

            $firstCode = (int) $xml->attributes()['firstcode'];

            if ($firstCode === 0) {
                return;
            }

            $secondCode = (string) $xml->attributes()['secondcode'];

            throw ExceptionFactory::create(
                $firstCode, $secondCode, $request, $response
            );
        }
    }
}
