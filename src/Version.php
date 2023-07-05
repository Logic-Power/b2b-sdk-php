<?php

declare(strict_types=1);

namespace LogicPower;

class Version
{
    /**
     * Версия.
     *
     * @var string
     */
    private const VERSION = '1.0.2';

    /**
     * Получение версии.
     */
    public static function getVersion(): string
    {
        return sprintf('logic-power/b2b-sdk-php:%s, PHP:%s', self::VERSION, PHP_VERSION);
    }
}
