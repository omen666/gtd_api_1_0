<?php

namespace omen666\gtd_api_1_0;

use omen666\gtd_api_1_0\services\geography\Address;
use omen666\gtd_api_1_0\services\geography\City;
use omen666\gtd_api_1_0\services\geography\Phone;
use omen666\gtd_api_1_0\services\order\Calculate;
use omen666\gtd_api_1_0\services\Service;

class GtdApi
{

    private $token;
    private $base_uri = 'https://capi.gtdel.com/1.0/';

    /**
     * GtdApi constructor.
     *
     * @param $token
     */
    public function __construct($token)
    {
        $this->token = $token;
    }

    /**
     * @param array $params
     *
     * @return mixed
     */
    public function cityGetList(array $params = []): array
    {
        return $this->sendRequest(new City($params));
    }

    /**
     * @param array $params
     *
     * @return mixed
     */
    public function addressGetList(array $params = []): array
    {
        return $this->sendRequest(new Address($params));
    }

    /**
     * @param array $params
     *
     * @return mixed
     */
    public function phoneGetList(array $params = []): array
    {
        return $this->sendRequest(new Phone($params));
    }

    /**
     * @param array $params
     *
     * @return Service
     */
    public function calculate(array $params = []): Service
    {
        return $this->sendRequest(new Calculate($params));
    }

    /**
     * @param Service $service
     *
     * @return mixed
     */
    public function sendRequest(Service $service): Service
    {
        if ($service->validate()) {
            $curl = curl_init();
            curl_setopt($curl, CURLOPT_URL, $this->base_uri . $service->getUrn() . '?token=' . $this->token);
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($curl, CURLOPT_POST, true);
            curl_setopt($curl, CURLOPT_POSTFIELDS, http_build_query($service->getParams()));
            $out = curl_exec($curl);
            curl_close($curl);
            $service->addResult(json_decode($out));
        }

        return $service;
    }

}