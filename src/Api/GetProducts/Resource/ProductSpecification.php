<?php

declare(strict_types=1);

namespace LogicPower\Api\GetProducts\Resource;

use LogicPower\Api\Shared\Resource\ArrayTransformerTrait;
use LogicPower\Exception\LogicPowerException;
use LogicPower\Translation\Enum\Locale;
use LogicPower\Translation\Translator;

class ProductSpecification
{
    use ArrayTransformerTrait;

    /**
     * Название.
     *
     * @var array
     */
    private $name;

    /**
     * Значение.
     *
     * @var array
     */
    private $value;

    /**
     * ProductSpecification конструктор.
     */
    public function __construct(array $name, array $value)
    {
        $this->name = $name;
        $this->value = $value;
    }

    /**
     * Получение локализирвоанного названия.
     *
     * @see Locale
     *
     * @throws LogicPowerException
     */
    public function getName(string $locale = null): string
    {
        return (string) Translator::translate($this->name, $locale);
    }

    /**
     * Получение локализирвоанного значения.
     *
     * @see Locale
     *
     * @throws LogicPowerException
     */
    public function getValue(string $locale = null): string
    {
        return (string) Translator::translate($this->value, $locale);
    }

    /**
     * {@inheritdoc}
     */
    public static function fromArray(array $array): self
    {
        return new self($array['name'], $array['option']['value']);
    }
}
