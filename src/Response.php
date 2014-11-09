<?php

namespace KNVB\Dataservice;

class Response {

    protected $code;
    protected $message;
    protected $list;

    /**
     * @param int $code
     * @param string $message
     * @param array $list
     */
    public function __construct($code, $message, $list=[])
    {
        $this->code = $code;
        $this->message = $message;
        $this->list = $list;
    }

    /**
     * Create a new Response object from the raw array response
     *
     * @param  array $data
     * @return static
     */
    public static function createFromArray($data)
    {
        $code = isset($data['errorcode']) ? $data['errorcode'] : 0;
        $message = isset($data['message']) ? $data['message'] : '';
        $list = isset($data['List']) ? $data['List'] : [];

        return new static($code, $message, $list);
    }

    /**
     * @return int
     */
    public function getCode()
    {
        return (int) $this->code;
    }

    /**
     * @return string
     */
    public function getMessage()
    {
        return (string) $this->message;
    }

    /**
     * @return array
     */
    public function getList()
    {
        return $this->list;
    }

    /**
     * Get the first result object
     *
     * @return Result
     */
    public function getResult()
    {
        if(isset($this->list[0])){
            return new Result($this->list[0]);
        }
    }

    /**
     * Get an array of Result objects
     *
     * @return Result[]
     */
    public function getResults()
    {
        $results = [];

        foreach($this->list as $data){
            $results[] = new Result($data);
        }

        return $results;
    }
}
