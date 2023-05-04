<?php

namespace LogicPower\Api\GetProducts;

use LogicPower\Api\AbstractApi;
use LogicPower\Api\GetProducts\Resource\Product;
use LogicPower\HttpClient\Enum\RequestMethod;
use LogicPower\HttpClient\Exception\HttpClientException;
use LogicPower\HttpClient\Request;

class GetProducts extends AbstractApi
{
    /**
     * Размер страницы.
     *
     * @var int
     */
    private const PAGE_SIZE = 500;

    /**
     * Получение товаров.
     *
     * @return Product[]
     *
     * @throws HttpClientException
     */
    public function getProducts(string $categoryId = null, string $searchQuery = null): array
    {
        $items = [];
        $pageNum = 1;

        do {
            $request = new Request(RequestMethod::GET, 'catalog/product/list/all', [
                'query' => [
                    'pageSize' => self::PAGE_SIZE,
                    'pageNum' => $pageNum,
                    'categoryId' => $categoryId,
                    'searchQuery' => $searchQuery,
                ],
            ]);

            $response = $this->getClient()->sendRequest($request);

            $data = $response->getData();

            $items = array_merge($data['items'], $items);
            $totalPage = (int) ceil($data['totalItems'] / self::PAGE_SIZE);

            ++$pageNum;
        } while ($pageNum <= $totalPage);

        return Product::collectionFromArray($items);
    }
}
