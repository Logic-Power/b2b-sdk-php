<?php

declare(strict_types=1);

namespace LogicPower\Translation\Enum;

final class Locale
{
    /*
     * Русская.
     */
    public const RU = 'ru';

    /*
     * Украинская.
     */
    public const UK = 'uk';

    /**
     * Locale конструктор.
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
            self::RU,
            self::UK,
        ];
    }
}
