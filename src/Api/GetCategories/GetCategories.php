<?php

declare(strict_types=1);

namespace LogicPower\Api\GetCategories;

use LogicPower\Api\AbstractApi;
use LogicPower\Api\GetCategories\Resource\Category;
use LogicPower\HttpClient\Enum\RequestMethod;
use LogicPower\HttpClient\Exception\HttpClientException;
use LogicPower\HttpClient\Request;

class GetCategories extends AbstractApi
{
    /**
     * Получение категорий.
     *
     * @return Category[]
     *
     * @throws HttpClientException
     */
    public function getCategories(): array
    {
        $request = new Request(RequestMethod::GET, 'catalog/category/list/tree');

        $response = $this->getClient()->sendRequest($request);

        return Category::collectionFromArray($response->getData());
    }
}
