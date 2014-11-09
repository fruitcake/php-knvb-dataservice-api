<?php

namespace KNVB\Dataservice;

use KNVB\Dataservice\HttpClient\HttpClient;


class Client {

    /** @var HttpClient $http  */
    protected $http;

    /**
     * Create a new Client instance. If the HttpClient is not set,
     * the default HttpClient will be used.
     *
     * @param HttpClient $http_client
     */
    public function __construct(HttpClient $http_client = null)
    {
        $this->http = $http_client ?: new HttpClient();
    }

    /**
     * @param  string $path
     * @param  array $params
     * @return Response
     */
    public function get($path, $params = [])
    {
        $data = $this->http->get($path, $params);
        return Response::createFromArray($data);
    }

    /**
     * @param  string $pathname
     * @param  string $key
     * @param  string $apiVersion
     * @return Response
     */
    public function initialize($pathname, $key, $apiVersion = '2.0')
    {
        $data = $this->http->initialize($pathname, $key, $apiVersion);
        return Response::createFromArray($data);
    }

}
