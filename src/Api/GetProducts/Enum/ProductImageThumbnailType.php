<?php

declare(strict_types=1);

namespace LogicPower\Api\GetProducts\Enum;

final class ProductImageThumbnailType
{
    /*
     * Плитка. Размер 256х256 пикселей.
     */
    public const TILE = 'tile';

    /*
     * Ячейка. Размер 100х100 пикселей.
     */
    public const CELL = 'cell';

    /**
     * ProductImageThumbnailType конструктор.
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
            self::TILE,
            self::CELL,
        ];
    }
}
