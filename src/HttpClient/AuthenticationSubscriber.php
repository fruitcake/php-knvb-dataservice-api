<?php
namespace KNVB\Dataservice\HttpClient;

use GuzzleHttp\Collection;
use GuzzleHttp\Event\RequestEvents;
use GuzzleHttp\Event\SubscriberInterface;
use GuzzleHttp\Event\BeforeEvent;
use GuzzleHttp\Message\RequestInterface;

class AuthenticationSubscriber implements SubscriberInterface
{

    /** @var Collection Configuration settings */
    private $config;

    /**
     * Create a new KNVB Dataservice Authentication Subscriber
     *
     * The configuration array must contain the following items:
     *
     * - pathname: Unique pathname for the club
     * - key: The secret API key
     * - session_id: Session ID from the initialisation
     *
     * @param  array $config Configuration array.
     */
    public function __construct($config)
    {
        $this->config = Collection::fromConfig($config, [], ['key', 'session_id']);
    }

    /**
     * {@inheritdoc}
     */
    public function getEvents()
    {
        return ['before' => ['onBefore', RequestEvents::SIGN_REQUEST]];
    }

    /**
     * The onBefore handler will add the hash to the request query
     *
     * @param  BeforeEvent $event
     */
    public function onBefore(BeforeEvent $event)
    {
        $request = $event->getRequest();

        // Only sign requests using "auth"="knvb"
        if ($request->getConfig()['auth'] != 'knvb') {
            return;
        }

        // Generate the hash based on the configuration
        $hash = $this->getHash($request, $this->config);

        // Add the hash and Session ID to the query parameters
        $request->getQuery()->set('hash', $hash);
        $request->getQuery()->set('PHPSESSID', $this->config['session_id']);
    }

    /**
     * Generate the hash based on the key, path and session
     *
     * @param  RequestInterface $request
     * @param  Collection $config
     * @return string
     */
    protected function getHash(RequestInterface $request, Collection $config)
    {
        // Remove the /api from the path to get the correct path
        $path = str_replace('/api', '', $request->getPath());

        return md5($config['key'].'#'.$path.'#'.$config['session_id']);
    }
}
