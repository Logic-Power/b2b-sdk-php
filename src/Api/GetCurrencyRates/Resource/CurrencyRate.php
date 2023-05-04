<?php

declare(strict_types=1);

namespace LogicPower\Api\GetCurrencyRates\Resource;

use LogicPower\Api\GetCurrencyRates\Enum\PaymentType;
use LogicPower\Api\Shared\Enum\Currency;
use LogicPower\Api\Shared\Resource\ArrayTransformerTrait;

class CurrencyRate
{
    use ArrayTransformerTrait;

    /**
     * Способ оплаты.
     *
     * @see PaymentType
     *
     * @var string
     */
    private $paymentType;

    /**
     * Исходная валюта.
     *
     * @see Currency
     *
     * @var string
     */
    private $sourceCurrency;

    /**
     * Целевая валюта.
     *
     * @see Currency
     *
     * @var string
     */
    private $targetCurrency;

    /**
     * Сумма.
     *
     * @var float
     */
    private $amount;

    /**
     * CurrencyRate конструктор.
     */
    public function __construct(string $paymentType, string $sourceCurrency, string $targetCurrency, float $amount)
    {
        $this->paymentType = $paymentType;
        $this->sourceCurrency = $sourceCurrency;
        $this->targetCurrency = $targetCurrency;
        $this->amount = $amount;
    }

    /**
     * Получение способа оплаты.
     *
     * @see PaymentType
     */
    public function getPaymentType(): string
    {
        return $this->paymentType;
    }

    /**
     * Получение исходной валюты.
     *
     * @see Currency
     */
    public function getSourceCurrency(): string
    {
        return $this->sourceCurrency;
    }

    /**
     * Получение ключевой валюты.
     *
     * @see Currency
     */
    public function getTargetCurrency(): string
    {
        return $this->targetCurrency;
    }

    /**
     * Получение суммы.
     */
    public function getAmount(): float
    {
        return $this->amount;
    }

    /**
     * Создание из массива.
     */
    public static function fromArray(array $array): self
    {
        return new self(
            $array['paymentType'],
            $array['sourceCurrency'],
            $array['targetCurrency'],
            $array['amount']
        );
    }
}
