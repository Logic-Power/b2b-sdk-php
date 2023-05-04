<?php

declare(strict_types=1);

namespace LogicPower\HttpClient;

use LogicPower\HttpClient\Enum\RequestMethod;

class Request
{
    /**
     * Базовый URI-адрес.
     *
     * @var string
     */
    private $baseUri = 'https://api.b2b.logicpower.ua/external';

    /**
     * Метод.
     *
     * @see RequestMethod
     *
     * @var string
     */
    private $method;

    /**
     * URI-адрес.
     *
     * @var string
     */
    private $uri;

    /**
     * Опции.
     *
     * @var array
     */
    private $options;

    /**
     * Request конструктор.
     */
    public function __construct(
        string $method,
        string $uri,
        array $options = []
    ) {
        $this->method = $method;
        $this->uri = $uri;
        $this->options = $options;
    }

    /**
     * Получение метода.
     *
     * @see RequestMethod
     */
    public function getMethod(): string
    {
        return $this->method;
    }

    /**
     * Получение опции.
     *
     * @return mixed
     */
    public function getOption(string $key, $default = null)
    {
        return $this->options[$key] ?? $default;
    }

    /**
     * Слияние опций.
     */
    public function mergeOptions(array $options): self
    {
        $this->options = array_merge_recursive($this->options, $options);

        return $this;
    }

    /**
     * Построение URI-адреса.
     */
    public function buildUri(): string
    {
        $uri = $this->baseUri.'/'.$this->uri;

        $query = $this->getOption('query');

        if (null !== $query) {
            $uri .= '?'.http_build_query($query);
        }

        return $uri;
    }
}
