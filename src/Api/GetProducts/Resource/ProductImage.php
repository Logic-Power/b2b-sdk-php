<?php

declare(strict_types=1);

namespace LogicPower\Api\GetProducts\Resource;

use LogicPower\Api\GetProducts\Enum\ProductImageThumbnailType;
use LogicPower\Api\Shared\Resource\ArrayTransformerTrait;
use LogicPower\Exception\LogicPowerException;
use LogicPower\Translation\Enum\Locale;

class ProductImage
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
     * Миниатюры.
     *
     * @var array
     */
    private $thumbnails;

    /**
     * ProductImage конструктор.
     */
    public function __construct(array $locales, string $url, array $thumbnails)
    {
        $this->locales = $locales;
        $this->url = $url;
        $this->thumbnails = $thumbnails;
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
     * Получение URL-адреса миниатюры.
     *
     * @see ProductImageThumbnailType
     *
     * @throws LogicPowerException
     */
    public function getThumbnailUrl(string $type): ?string
    {
        if (!in_array($type, ProductImageThumbnailType::getAll(), true)) {
            throw new LogicPowerException(sprintf('Неподдерживаемый тип миниатюры изображения товара [%s]', $type));
        }

        foreach ($this->thumbnails as $thumbnail) {
            if ($thumbnail['type'] === $type) {
                return $thumbnail['url'];
            }
        }

        return null;
    }

    /**
     * {@inheritdoc}
     */
    public static function fromArray(array $array): self
    {
        return new self($array['locales'], $array['url'], $array['thumbnails']);
    }
}
