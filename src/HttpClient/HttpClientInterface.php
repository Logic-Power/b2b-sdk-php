<?php

declare(strict_types=1);

namespace LogicPower\HttpClient;

use LogicPower\HttpClient\Exception\HttpClientException;

interface HttpClientInterface
{
    /**
     * Выполнение запроса.
     *
     * @throws HttpClientException
     */
    public function request(Request $request): Response;
}
