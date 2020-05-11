<?php

namespace omen666\gtd_api_1_0\services\order;

use omen666\gtd_api_1_0\services\Service;

class Calculate extends Service
{
    const LIMIT_PRICE_NEED_DOCUMENT = 50000;

    /**
     * @see https://ekaterinburg.gtdel.com/about/developers/api-doc/1.0/order/calculate
     */
    protected $params = [];

    private $urn = 'order/calculate';

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
        $this->checkAndAddConfirmationPrice();

        $this->checkAndAddInsuranceParam();

        $this->checkAndAddHaveDoc();

        return true;
    }


    private function checkAndAddConfirmationPrice()
    {
        if (isset($this->params['declared_price']) && $this->params['declared_price'] >= self::LIMIT_PRICE_NEED_DOCUMENT) {
            $this->params['confirmation_price'] = 1;
        }
    }

    private function checkAndAddInsuranceParam()
    {
        if (isset($this->params['declared_price']) && $this->params['declared_price'] > 10000) {
            $this->params['insurance'] = 1;
        }
    }

    private function checkAndAddHaveDoc()
    {
        if (isset($this->params['declared_price']) && $this->params['declared_price'] >= self::LIMIT_PRICE_NEED_DOCUMENT) {
            $this->params['have_doc'] = 1;
        }
    }
}