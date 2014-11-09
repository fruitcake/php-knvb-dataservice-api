<?php

namespace KNVB\Dataservice;


class Result {

    protected $data = [];

    /**
     * Supply the data to normalize
     *
     * @param $data
     */
    public function __construct($data)
    {
        foreach($data as $key => $value){
            $key = $this->normalizeKey($key);
            $this->data[$key] = $value;
        }
    }

    /**
     * {@inheritdoc}
     */
    public function get($key)
    {
        $key = $this->normalizeKey($key);
        return isset($this->data[$key]) ? $this->data[$key] : null;
    }

    /**
     * {@inheritdoc}
     */
    public function has($key)
    {
        $key = $this->normalizeKey($key);
        return isset($this->data[$key]) ? true : false;
    }

    /**
     * Normalize the key to fix inconsistencies
     *
     * @param  string $key
     * @return string
     */
    protected function normalizeKey($key)
    {
        return strtolower(str_replace(['-', '_'], '', $key));
    }


    /**
     * Allow magic calls to $this->getSomeValue() to get 'some_value'
     *
     * @param $name
     * @param $arguments
     * @return mixed|null
     */
    public function __call($name, $arguments)
    {
        if(substr($name, 0, 3) === 'get'){
            $key = substr($name, 3);
            return $this->get($key);
        }

        $className = get_class($this);
        throw new \BadMethodCallException("Call to undefined method {$className}::{$name}()");
    }

}
