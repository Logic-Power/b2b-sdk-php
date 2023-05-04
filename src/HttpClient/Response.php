<?php

declare(strict_types=1);

namespace LogicPower\HttpClient;

class Response
{
    /**
     * Содержание.
     *
     * @var string
     */
    private $content;

    /**
     * Response конструктор.
     */
    public function __construct(string $content)
    {
        $this->content = $content;
    }

    /**
     * Получение данных.
     */
    public function getData(): array
    {
        $contentArray = json_decode($this->content, true);

        return $contentArray['data'];
    }
}
