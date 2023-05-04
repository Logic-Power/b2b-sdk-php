<?php

declare(strict_types=1);

namespace LogicPower\Api\Shared\Resource;

trait ArrayTransformerTrait
{
    /**
     * Создание коллекции на основе массива.
     *
     * @return static[]
     */
    public static function collectionFromArray(array $collectionArray): array
    {
        return array_map(static function (array $array): self {
            return self::fromArray($array);
        }, $collectionArray);
    }

    /**
     * Создание на основе массива.
     *
     * @return static
     */
    abstract public static function fromArray(array $array): self;
}
