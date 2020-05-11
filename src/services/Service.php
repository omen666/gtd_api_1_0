<?php

namespace omen666\gtd_api_1_0\services;

abstract class Service
{
    protected $errors;
    protected $result;

    /**
     * @return string
     */
    abstract public function getUrn(): string;

    /**
     * @return array
     */
    abstract public function getParams(): array;

    /**
     * @return bool
     */
    abstract public function validate(): bool;

    /**
     * Service constructor.
     *
     * @param array $params
     */
    public function __construct(array $params = [])
    {
        foreach ($params as $key => $value) {
            $this->params[$key] = $value;
        }
    }

    /**
     * @return mixed
     */
    public function getResult()
    {
        return $this->result;
    }

    public function addResult($result)
    {
        if (isset($result->validate)) {
            foreach ($result->validate as $error_name => $messages) {
                $this->addError($error_name, $messages);
            }
        } else {
            $this->result = $result;
        }
    }

    /**
     * @return mixed
     */
    public function getErrors()
    {
        return $this->errors;
    }

    /**
     * @param $key
     * @param $message
     */
    protected function addError($key, $message)
    {
        $this->errors[$key] = $message;
    }

}