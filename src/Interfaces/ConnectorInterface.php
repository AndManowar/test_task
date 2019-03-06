<?php

namespace APN\YourInterfaceNamespace;

use GuzzleHttp\Exception\GuzzleException;
use Psr\Http\Message\ResponseInterface;

/**
 * Interface ConnectorInterface
 * @package App\scr\Interfaces
 */
interface ConnectorInterface
{
    /**
     * Method is responsible for sending the request to the
     * remote endpoint and should return the entire response
     * object.
     *
     * @return ResponseInterface
     */
    public function doRequest(): ResponseInterface;

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
     * @throws GuzzleException
     */
    public function getData(): array;

    /**
     * Set a unique key for this data collection for caching purposes
     *
     * @return string
     */
    public function getJobKey(): string;

    /**
     * Expose additional api methods if you are using a library
     * supplied by the vendor
     */
    public function getApi();
}
