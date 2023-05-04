<?php

declare(strict_types=1);

namespace LogicPower\Api\GetProducts\Enum;

final class ProductPriceType
{
    /**
     * Персональный.
     */
    public const PERSONAL = 'personal';

    /**
     * Рекомендуемый розничный.
     */
    public const RECOMMENDED_RETAIL = 'recommendedRetail';

    /**
     * ProductPriceType конструктор.
     */
    private function __construct()
    {
    }

    /**
     * Получение всех.
     *
     * @return string[]
     */
    public static function getAll(): array
    {
        return [
            self::PERSONAL,
            self::RECOMMENDED_RETAIL,
        ];
    }
}
