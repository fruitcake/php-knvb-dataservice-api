<?php

namespace KNVB\Dataservice\Traits;

use KNVB\Dataservice\Exception\MissingAttributeException;

trait GetDataTrait {

    protected $data;

    public function getData()
    {
        return $this->data;
    }

    public function setData($data)
    {
        $this->data = $data;
    }

    public function get($name)
    {
        if (array_key_exists($name, $this->data)) {
            return $this->data[$name];
        }

        throw new MissingAttributeException("Attribute $name does not exist.");
    }

    /**
     * Get an attribute for this club
     *
     * @param  string $name
     * @return mixed
     * @throws MissingArgumentException
     */
    public function __get($name)
    {
        return $this->get($name);
    }
}
