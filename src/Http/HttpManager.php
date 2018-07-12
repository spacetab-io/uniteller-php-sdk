<?php
/**
 * Created by Roquie.
 * E-mail: roquie0@gmail.com
 * GitHub: Roquie
 */

namespace Tmconsulting\Uniteller\Http;

use GuzzleHttp\Psr7\Request;
use Http\Client\Exception\RequestException;
use Http\Client\HttpClient;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;
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
     * @var \Http\Client\HttpClient
     */
    protected $httpClient;

    /**
     * @var array
     */
    protected $options;

    /**
     * HttpManager constructor.
     *
     * @param \Http\Client\HttpClient $httpClient
     * @param array $options
     */
    public function __construct(HttpClient $httpClient, array $options = [])
    {
        $this->httpClient = $httpClient;
        $this->options    = $options;
    }

    /**
     * @param string $format
     * @return array
     */
    protected function getDefaultHeaders($format)
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
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function request($uri, $method = 'POST', $data = null, array $headers = [], $format='xml')
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
        }
        catch (RequestException $e) {
            throw UnitellerException::create($request, $e->getResponse());
        }

        $this->basicError($request, $response);
        $body = $response->getBody()->getContents();
        $this->providerError($body, $request, $response, $format);

        return $body;
    }

    /**
     * @param $body
     * @param $request
     * @param $response
     * @throws \ErrorException
     */
    protected function providerError($body, RequestInterface $request, ResponseInterface $response, $format='xml')
    {
        if ($format === 'csv') {
            $data = csv_to_array($body, true);

            if (isset($data['ErrorMessage'])) {
                throw ExceptionFactory::createFromMessage(
                    $data['ErrorMessage'], $request, $response
                );
            }

        }
        elseif ($format === 'xml') {

            if (substr($body, 0, 6) === 'ERROR:') {
                throw ExceptionFactory::createFromMessage(
                    substr($body, 7), $request, $response
                );
            }

            $xml = new \SimpleXMLElement((string)$body);
            if (($firstCode = (string)$xml->attributes()['firstcode']) == 0) {
                return;
            }

            $secondCode = (string)$xml->attributes()['secondcode'];

            throw ExceptionFactory::create(
                $firstCode, $secondCode, $request, $response
            );

        }
    }

    /**
     * @param \Psr\Http\Message\RequestInterface $request
     * @param \Psr\Http\Message\ResponseInterface $response
     */
    protected function basicError(RequestInterface $request, ResponseInterface $response)
    {
        if ($response->getStatusCode() >= 200 && $response->getStatusCode() < 300) {
            return;
        }

        throw UnitellerException::create($request, $response);
    }
}