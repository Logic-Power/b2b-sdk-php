<?php

declare(strict_types=1);

namespace LogicPower\HttpClient\Enum;

final class RequestMethod
{
    /*
     * GET.
     */
    public const GET = 'GET';

    /*
     * POST
     */
    public const POST = 'POST';

    /**
     * RequestMethod конструктор.
     */
    private function __construct()
    {
    }
}
