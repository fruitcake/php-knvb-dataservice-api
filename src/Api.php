<?php

namespace KNVB\Dataservice;

use JsonMapper;
use KNVB\Dataservice\HttpClient\HttpClient;
use KNVB\Dataservice\HttpClient\HttpClientInterface;

class Api {

	/** @var HttpClientInterface $client  */
	protected $client;

	protected $mapper;

	/**
	 * @param HttpClientInterface $client
	 */
	public function __construct(HttpClientInterface $client = null)
	{
		$this->client = $client ?: new HttpClient();
		$this->mapper = new JsonMapper();
	}

	/**
	 * Make a request to the API
	 *
	 * @param $path
	 * @param array $parameters
	 * @throws InvalidResponseException
	 * @return array
	 */
	public function request($path, $parameters = [])
	{
		$data = $this->client->get($path, $parameters);

		if (!isset($data['errorcode']) || $data['errorcode'] !== 1000 || !isset($data['List'])) {
			throw new InvalidResponseException($data['message'], $data['errorcode']);
		}

		return $data;
	}

	/**
	 * Map data to an object
	 *
	 * @param array $json
	 * @param mixed $object
	 * @return mixed object
	 * @throws \JsonMapper_Exception
	 */
	public function map($json, $object)
	{
		return $this->mapper->map($json, $object);
	}


	/**
	 * Initialize the session and authenticate this club
	 *
	 * @throws InvalidResponseException
	 * @return Club
	 */
	public function initializeClub($pathname, $key, $apiversion = '2.0')
	{
		$response = $this->request('initialisatie/'.$pathname, ['apiversion' => $apiversion]);

		if (isset($response['List']) && isset($response['List'][0])) {

			/** @var Club $club */
			$club = $this->mapper->map($response['List'][0], new Club($this));
			$this->client->authenticate($club->PHPSESSID, $key);

			return $club;
		}

		throw new InvalidResponseException($response['message'], $response['errorcode']);
	}

}
