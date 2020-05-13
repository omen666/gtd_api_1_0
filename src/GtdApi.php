<?php

namespace omen666\gtd_api_1_0;

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
    public function geographyCityGetList(array $params = []): Service
    {
        return $this->sendRequest(new services\geography\City($params));
    }

    /**
     * @param array $params
     *
     * @return mixed
     */
    public function geographyAddressGetList(array $params = []): Service
    {
        return $this->sendRequest(new services\geography\Address($params));
    }

    /**
     * @param array $params
     *
     * @return mixed
     */
    public function geographyPhoneGetList(array $params = []): Service
    {
        return $this->sendRequest(new services\geography\Phone($params));
    }

    /**
     * @param array $params
     *
     * @return Service
     */
    public function orderCalculate(array $params = []): Service
    {
        return $this->sendRequest(new services\order\Calculate($params));
    }

    /**
     * @param array $params
     *
     * @return Service
     */
    public function ttdCityGetList(array $params = []): Service
    {
        return $this->sendRequest(new services\tdd\City($params));
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