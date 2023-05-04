<?php

declare(strict_types=1);

namespace LogicPower\HttpClient;

use LogicPower\HttpClient\Exception\HttpClientException;

class CurlHttpClient implements HttpClientInterface
{
    /**
     * {@inheritdoc}
     *
     * @throws HttpClientException
     */
    public function request(Request $request): Response
    {
        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, $request->buildUri());
        curl_setopt($ch, CURLOPT_TIMEOUT, 60);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HEADER, false);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $this->buildCurlHeaders($request));
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, $request->getMethod());

        $response = curl_exec($ch);
        $statusCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);

        if (false === $response) {
            $message = curl_error($ch);

            curl_close($ch);

            throw new HttpClientException(sprintf('Ошибка выполнения cURL-запроса к API [%s]', $message), $statusCode);
        }

        if (200 !== $statusCode) {
            throw new HttpClientException(sprintf('Недействительный статус-код результата выполнения запроса к API [%s] [%s]', $statusCode, $response), $statusCode);
        }

        curl_close($ch);

        return new Response($response);
    }

    /**
     * Построение cURL-заголовков.
     */
    private function buildCurlHeaders(Request $request): array
    {
        $curlHeaders = [];

        foreach ($request->getOption('headers', []) as $key => $value) {
            $curlHeaders[] = $key.': '.$value;
        }

        return $curlHeaders;
    }
}
