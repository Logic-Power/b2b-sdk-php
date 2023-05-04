<?php

declare(strict_types=1);

namespace LogicPower\Api\GetProducts\Resource;

use LogicPower\Api\Shared\Enum\Currency;

class Money
{
    /**
     * Сумма.
     *
     * @var float
     */
    private $amount;

    /**
     * Валюта.
     *
     * @see Currency
     *
     * @var string
     */
    private $currency;

    /**
     * Money конструктор.
     */
    public function __construct(float $amount, string $currency)
    {
        $this->amount = $amount;
        $this->currency = $currency;
    }

    /**
     * Получение суммы.
     */
    public function getAmount(): float
    {
        return $this->amount;
    }

    /**
     * Получение валюты.
     *
     * @see Currency
     */
    public function getCurrency(): string
    {
        return $this->currency;
    }

    /**
     * Создание из массива.
     */
    public static function fromArray(array $array): self
    {
        return new self($array['amount'], $array['currency']);
    }
}
