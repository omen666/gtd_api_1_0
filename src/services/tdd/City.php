<?php

namespace omen666\gtd_api_1_0\services\tdd;

use omen666\gtd_api_1_0\services\Service;

class City extends Service
{
    /**
     * @see https://ekaterinburg.gtdel.com/about/developers/api-doc/1.0/tdd/city/get-list
     */
    protected $params = [];

    private $urn = 'tdd/city/get-list';

    /**
     * @return string
     */
    public function getUrn(): string
    {
        return $this->urn;
    }

    /**
     * @return array
     */
    public function getParams(): array
    {
        return $this->params;
    }

    /**
     * @return bool
     */
    public function validate(): bool
    {
        return true;
    }
}