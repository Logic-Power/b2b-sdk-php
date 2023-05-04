<?php

declare(strict_types=1);

namespace LogicPower\Api\GetCategories\Resource;

use LogicPower\Api\Shared\Resource\ArrayTransformerTrait;
use LogicPower\Exception\LogicPowerException;
use LogicPower\Translation\Enum\Locale;
use LogicPower\Translation\Translator;

class Category
{
    use ArrayTransformerTrait;

    /**
     * Идентификатор.
     *
     * @var string
     */
    private $id;

    /**
     * Название.
     *
     * @var array
     */
    private $name;

    /**
     * Дочерние категории.
     *
     * @var self[]
     */
    private $children;

    /**
     * Category конструктор.
     *
     * @param self[] $children
     */
    public function __construct(string $id, array $name, array $children)
    {
        $this->id = $id;
        $this->name = $name;
        $this->children = $children;
    }

    /**
     * Получение идентификатора.
     */
    public function getId(): string
    {
        return $this->id;
    }

    /**
     * Получение локализированного названия.
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
     * Получение дочерних категорий.
     *
     * @return self[]
     */
    public function getChildren(): array
    {
        return $this->children;
    }

    /**
     * {@inheritdoc}
     */
    public static function fromArray(array $array): self
    {
        $children = array_map(static function (array $array): self {
            return self::fromArray($array);
        }, $array['children'] ?? []);

        return new self($array['id'], $array['name'], $children);
    }
}
