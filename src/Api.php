<?php
namespace KNVB\Dataservice;

use JsonMapper;
use KNVB\Dataservice\Exception\InvalidResponseException;
use KNVB\Dataservice\HttpClient\HttpClient;
use KNVB\Dataservice\HttpClient\HttpClientInterface;

class Api
{

	/** @var HttpClientInterface $client  */
	protected $client;

	/** @var JsonMapper $mapper */
	protected $mapper;

	/** @var Club $club  */
	protected $club;

	protected $pathname;
	protected $key;
	protected $apiversion;

	/**
	 * @param string $pathname
	 * @param string $key
	 * @param string $apiversion
	 * @param HttpClientInterface $client
	 */
	public function __construct($pathname, $key, $apiversion = '2.0', HttpClientInterface $client = null)
	{
		$this->pathname = $pathname;
		$this->key = $key;
		$this->apiversion = $apiversion;
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
		try {
			$data = $this->client->get($path, $parameters);
		}catch(\GuzzleHttp\Exception\ParseException $e){
			throw new InvalidResponseException("Cannot parse message: ".$e->getResponse()->getBody(), $e->getCode());
		}catch(\GuzzleHttp\Exception\RequestException $e) {
			throw new InvalidResponseException("Cannot finish request: " . $e->getMessage(). ', Request:' . $e->getRequest(), $e->getCode());
		}catch(\Exception $e){
			throw new InvalidResponseException($e->getMessage(), $e->getCode());
		}

		if (isset($data['errorcode']) && $data['errorcode'] == 9995) {
			// Result is empty, just return an empty array instead..
			$data['List'] = isset($data['List']) ? $data['List'] : [];
			return $data;
		} elseif (!isset($data['errorcode']) || $data['errorcode'] !== 1000 || !isset($data['List'])) {
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
		return $this->mapper->map((object) $json, $object);
	}


	/**
	 * Initialize the session and authenticate this club
	 *
	 * @throws InvalidResponseException
	 * @return Club
	 */
	public function getClub()
	{
		if ($this->club) {
			return $this->club;
		}

		$response = $this->request('initialisatie/'.$this->pathname, ['apiversion' => $this->apiversion]);

		if (isset($response['List']) && isset($response['List'][0])) {

			/** @var Club $club */
			$this->club = $this->map($response['List'][0], new Club($this));
			$this->client->authenticate($this->club->PHPSESSID, $this->key);

			return $this->club;
		}

		throw new InvalidResponseException($response['message'], $response['errorcode']);
	}

}
