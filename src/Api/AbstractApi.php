<?php

namespace LogicPower\Api;

use LogicPower\LogicPower;

abstract class AbstractApi
{
    /**
     * Клиент.
     *
     * @var LogicPower
     */
    private $client;

    /**
     * AbstractApi конструктор.
     */
    public function __construct(LogicPower $client)
    {
        $this->client = $client;
    }

    /**
     * Получение клиента.
     */
    protected function getClient(): LogicPower
    {
        return $this->client;
    }
}
