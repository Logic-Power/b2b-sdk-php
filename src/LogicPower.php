<?php

declare(strict_types=1);

namespace LogicPower;

use LogicPower\Api\AbstractApi;
use LogicPower\Api\GetCategories\GetCategories;
use LogicPower\Api\GetCurrencyRates\GetCurrencyRates;
use LogicPower\Api\GetProducts\GetProducts;
use LogicPower\HttpClient\CurlHttpClient;
use LogicPower\HttpClient\Exception\HttpClientException;
use LogicPower\HttpClient\HttpClientInterface;
use LogicPower\HttpClient\Request;
use LogicPower\HttpClient\Response;

/**
 * @mixin GetCurrencyRates
 * @mixin GetCategories
 * @mixin GetProducts
 */
class LogicPower
{
    /**
     * API-ключ.
     *
     * @var string
     */
    private $apiKey;

    /**
     * Методы.
     *
     * @template T of AbstractApi
     *
     * @var class-string<T>
     */
    private $methods = [
        GetCurrencyRates::class,
        GetCategories::class,
        GetProducts::class,
    ];

    /**
     * HTTP-клиент.
     *
     * @var HttpClientInterface|null
     */
    private $httpClient;

    /**
     * LogicPower конструктор.
     */
    public function __construct(string $apiKey)
    {
        $this->apiKey = $apiKey;
    }

    /**
     * Получение HTTP-клиента.
     */
    public function getHttpClient(): HttpClientInterface
    {
        if (null === $this->httpClient) {
            $this->httpClient = new CurlHttpClient();
        }

        return $this->httpClient;
    }

    /**
     * Установка HTTP-клиента.
     */
    public function setHttpClient(HttpClientInterface $httpClient): self
    {
        $this->httpClient = $httpClient;

        return $this;
    }

    /**
     * Отправка запроса.
     *
     * @throws HttpClientException
     */
    public function sendRequest(Request $request): Response
    {
        $request->mergeOptions([
            'headers' => [
                'X-Api-Key' => $this->apiKey,
                'X-Sdk-Version' => Version::getVersion(),
            ],
        ]);

        return $this->getHttpClient()->request($request);
    }

    /**
     * Динамический вызов метода.
     *
     * @throws \ReflectionException
     */
    public function __call(string $name, array $arguments)
    {
        $name = ucfirst($name);

        foreach ($this->methods as $method) {
            $methodName = (new \ReflectionClass($method))->getShortName();

            if ($methodName === $name) {
                return call_user_func_array([new $method($this), $name], $arguments);
            }
        }

        throw new \RuntimeException(sprintf('Вызов неизвестного метода [%s]', self::class.'::'.$name));
    }
}
