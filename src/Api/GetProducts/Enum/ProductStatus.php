<?php

declare(strict_types=1);

namespace LogicPower\Api\GetProducts\Enum;

final class ProductStatus
{
    /*
     * В наличии.
     */
    public const IN_STOCK = 'inStock';

    /*
     * Быстрое производство.
     */
    public const QUICK_PRODUCTION = 'quickProduction';

    /*
     * Предзаказ.
     */
    public const PRE_ORDER = 'preOrder';

    /*
     * Распродано.
     */
    public const OUT_OF_STOCK = 'outOfStock';

    /*
     * Снят с производства.
     */
    public const OUT_OF_PRODUCTION = 'outOfProduction';

    /**
     * ProductStatus конструктор.
     */
    private function __construct()
    {
    }
}
