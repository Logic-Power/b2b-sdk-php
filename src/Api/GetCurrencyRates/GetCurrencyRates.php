<?php

declare(strict_types=1);

namespace LogicPower\Api\GetCurrencyRates;

use LogicPower\Api\AbstractApi;
use LogicPower\Api\GetCurrencyRates\Resource\CurrencyRate;
use LogicPower\HttpClient\Enum\RequestMethod;
use LogicPower\HttpClient\Exception\HttpClientException;
use LogicPower\HttpClient\Request;

class GetCurrencyRates extends AbstractApi
{
    /**
     * Получение курсов валют.
     *
     * @return CurrencyRate[]
     *
     * @throws HttpClientException
     */
    public function getCurrencyRates(): array
    {
        $request = new Request(RequestMethod::GET, 'finance/currencyRates');

        $response = $this->getClient()->sendRequest($request);

        return CurrencyRate::collectionFromArray($response->getData());
    }
}
