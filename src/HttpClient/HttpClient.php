<?php
namespace KNVB\Dataservice\HttpClient;

use GuzzleHttp\Client as GuzzleClient;
use GuzzleHttp\ClientInterface as GuzzleClientInterface;

class HttpClient implements HttpClientInterface
{
    /**
     * The default options that are passed to the Guzzle Client
     *
     * @var array
     */
    protected $options = array(
        'base_url' => 'http://api.knvbdataservice.nl/api/',
        'defaults' => [
            'auth'      => 'knvb',
            'timeout'   => 30,
            'headers'   => [
                'User-Agent' => 'php-knvb-dataservice-api',
            ],
        ],
    );

    /**
     * Construct a new HttpClient instance. Optional parameters can be supplied.
     * A Guzzle client can optionally be passed as argument, but a new instance
     * will be created by default.
     *
     * @param array $options
     * @param GuzzleClientInterface $client
     */
    public function __construct($options = [], GuzzleClientInterface $client = null)
    {
        $this->options = array_merge($this->options, $options);
        $client = $client ?: new GuzzleClient($this->options);
        $this->client = $client;
    }

    /**
     * {@inheritdoc}
     */
    public function get($path, $params = [])
    {
        return $this->client->get($path, ['query' => $params])->json();
    }

    /**
     * {@inheritdoc}
     */
    public function authenticate($sessionId, $key)
    {
        $subscriber = new AuthenticationSubscriber([
            'key'       => $key,
            'session_id'=> $sessionId,
        ]);

        $this->client->getEmitter()->attach($subscriber);
    }

}
