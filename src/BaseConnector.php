<?php
/**
 * Created by PhpStorm.
 * User: hellenmicky
 * Date: 06.03.2019
 * Time: 14:41
 */

namespace APN\YourConnectorNamespace;


use APN\YourInterfaceNamespace\ConnectorInterface;
use Exception;
use GuzzleHttp\Exception\GuzzleException;
use Psr\Http\Message\ResponseInterface;
use GuzzleHttp\Client;

/**
 * Class BaseConnector
 * @package APN\YourConnector
 */
abstract class BaseConnector implements ConnectorInterface
{
    /**
     * @var Client
     */
    protected $client;

    /**
     * Auth token
     *
     * @var string
     */
    protected $token;

    /**
     * Endpoint url
     *
     * @var string
     */
    protected $endpoint;

    /**
     * Request method
     *
     * @var string
     */
    protected $method = 'GET';

    /**
     * Request params
     *
     * @var array
     */
    protected $params = [];

    /**
     * BaseConnector constructor.
     * @param string $token
     * @param string $domain
     */
    public function __construct(string $token, string $domain)
    {
        $this->client = new Client(['base_uri' => $domain]);
        $this->token = $token;
    }

    /**
     * Params fluent setter
     *
     * @param string $endpoint
     * @param string $method
     * @param array $params
     * @return BaseConnector
     */
    public function setRequestParams(string $endpoint, string $method = 'GET', array $params = []): BaseConnector
    {
        $this->endpoint = $endpoint;
        $this->method = $method;
        $this->params = $params;

        return $this;
    }

    /**
     * Method is responsible for sending the request to the
     * remote endpoint and should return the entire response
     * object.
     *
     * @return ResponseInterface
     * @throws GuzzleException
     * @throws Exception
     */
    public function doRequest(): ResponseInterface
    {
        $this->validateRequestParams();

        return $this->client->request($this->method, $this->endpoint, array_merge($this->getAuthHeaders(), $this->params));
    }

    /**
     * Set a unique key for this data collection for caching purposes
     *
     * @return string
     */
    public function getJobKey(): string
    {
        return md5(json_encode([$this->method, $this->endpoint, $this->params]));
    }

    /**
     * Expose additional api methods if you are using a library
     * supplied by the vendor
     */
    public function getApi()
    {
        // TODO: Implement getApi() method.
    }

    /**
     * Method is responsible for extracting data out of a
     * response object.
     *
     * e.g return json_decode(
     *                $this->doRequest('endpoint', 'GET')
     *                ->getBody()
     *                ->getContents(), true)['item'];
     *
     * @return array
     * @throws Exception
     * @throws GuzzleException
     */
    public function getData(): array
    {
        $response = $this->doRequest();
        if ($response->getStatusCode() !== 200) {
            throw new Exception("Response status code is {$response->getStatusCode()}");
        }

        return json_decode($this->doRequest()->getBody()->getContents(), true);
    }

    /**
     * Set the authenticate header to support Guzzle client
     *
     * @return array
     */
    protected function getAuthHeaders(): array
    {
        return [
            'headers' => [
                'Authorization' => "Token token={$this->token}",
            ],
        ];
    }

    /**
     * Request params validation
     *
     * @throws Exception
     * @return void
     */
    protected function validateRequestParams(): void
    {
        if (!$this->endpoint) {
            throw new Exception('Request endpoint url must be specified!');
        }

        if (!$this->method) {
            throw new Exception('Request method must be specified!');
        }
    }
}