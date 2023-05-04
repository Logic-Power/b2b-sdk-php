<?php

declare(strict_types=1);

namespace LogicPower\Api\GetProducts\Enum;

final class ProductLabel
{
    /*
     * Новинка.
     */
    public const NOVELTY = 'novelty';

    /*
     * Акционный.
     */
    public const PROMOTION = 'promotion';

    /*
     * Бестселлер.
     */
    public const BEST_SELLER = 'bestSeller';

    /**
     * ProductLabel конструктор.
     */
    private function __construct()
    {
    }
}
