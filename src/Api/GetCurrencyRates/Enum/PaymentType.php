<?php

declare(strict_types=1);

namespace LogicPower\Api\GetCurrencyRates\Enum;

final class PaymentType
{
    /*
     * Без НДС.
     */
    public const CASH_DEFERRED = 'cashDeferred';

    /*
     * С НДС.
     */
    public const CASHLESS = 'cashless';

    /**
     * PaymentType конструктор.
     */
    private function __construct()
    {
    }
}
