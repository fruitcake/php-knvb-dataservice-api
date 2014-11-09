<?php

namespace KNVB\Dataservice\HttpClient;

interface HttpClientInterface {

    /**
     *
     * @param  string $path
     * @param  array $parameters
     * @return array
     */
    public function get($path, $parameters = []);

    /**
     * @param  string $pathname
     * @param  string $key
     * @return array
     */
    public function initialize($pathname, $key);

}
