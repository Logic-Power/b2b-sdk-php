<?php

declare(strict_types=1);

namespace LogicPower\Api\GetProducts\Resource;

use LogicPower\Api\Shared\Resource\ArrayTransformerTrait;
use LogicPower\Exception\LogicPowerException;
use LogicPower\Translation\Enum\Locale;
use LogicPower\Translation\Translator;

class ProductAttachment
{
    use ArrayTransformerTrait;

    /**
     * Локали.
     *
     * @see Locale
     *
     * @var string[]
     */
    private $locales;

    /**
     * URL-адрес.
     *
     * @var string
     */
    private $url;

    /**
     * Название.
     *
     * @var array
     */
    private $name;

    /**
     * ProductAttachment конструктор.
     */
    public function __construct(array $locales, string $url, array $name)
    {
        $this->locales = $locales;
        $this->url = $url;
        $this->name = $name;
    }

    /**
     * Получение локалей.
     *
     * @see Locale
     *
     * @return string[]
     */
    public function getLocales(): array
    {
        return $this->locales;
    }

    /**
     * Получение URL-адреса.
     */
    public function getUrl(): string
    {
        return $this->url;
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
     * {@inheritdoc}
     */
    public static function fromArray(array $array): self
    {
        return new self($array['locales'], $array['url'], $array['name']);
    }
}
