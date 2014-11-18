<?php
namespace KNVB\Dataservice\HttpClient;

interface HttpClientInterface
{
    /**
     *
     * @param  string $path
     * @param  array $parameters
     * @return array
     */
    public function get($path, $parameters = []);

    /**
     * @param  string $sessionId
     * @param  string $key
     * @return array
     */
    public function authenticate($sessionId, $key);

}
