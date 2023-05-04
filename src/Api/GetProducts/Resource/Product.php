<?php

declare(strict_types=1);

namespace LogicPower\Api\GetProducts\Resource;

use LogicPower\Api\GetCategories\Resource\Category;
use LogicPower\Api\GetProducts\Enum\ProductLabel;
use LogicPower\Api\GetProducts\Enum\ProductPriceType;
use LogicPower\Api\GetProducts\Enum\ProductStatus;
use LogicPower\Api\Shared\Resource\ArrayTransformerTrait;
use LogicPower\Exception\LogicPowerException;
use LogicPower\Translation\Enum\Locale;
use LogicPower\Translation\Translator;

class Product
{
    use ArrayTransformerTrait;

    /**
     * Идентификатор.
     *
     * @var string
     */
    private $id;

    /**
     * Код.
     *
     * @var string
     */
    private $code;

    /**
     * Штрихкод.
     *
     * @var string|null
     */
    private $barcode;

    /**
     * Название.
     *
     * @var array
     */
    private $name;

    /**
     * Описание.
     *
     * @var array
     */
    private $description;

    /**
     * Статус.
     *
     * @see ProductStatus
     *
     * @var string
     */
    private $status;

    /**
     * Ярлыки.
     *
     * @see ProductLabel
     *
     * @var string[]
     */
    private $labels;

    /**
     * Производитель.
     *
     * @var string
     */
    private $manufacturer;

    /**
     * Розничнй URL-адрес.
     *
     * @var string|null
     */
    private $retailUrl;

    /**
     * Цены.
     *
     * @var array
     */
    private $prices;

    /**
     * Спецификации.
     *
     * @var array
     */
    private $specifications;

    /**
     * Категории.
     *
     * @var array
     */
    private $categories;

    /**
     * Изображения.
     *
     * @var array
     */
    private $images;

    /**
     * Вложения.
     *
     * @var array
     */
    private $attachments;

    /**
     * Product конструктор.
     */
    public function __construct(
        string $id,
        string $code,
        ?string $barcode,
        array $name,
        array $description,
        string $status,
        array $labels,
        string $manufacturer,
        ?string $retailUrl,
        array $prices,
        array $specifications,
        array $categories,
        array $images,
        array $attachments
    ) {
        $this->id = $id;
        $this->code = $code;
        $this->barcode = $barcode;
        $this->name = $name;
        $this->description = $description;
        $this->status = $status;
        $this->labels = $labels;
        $this->manufacturer = $manufacturer;
        $this->retailUrl = $retailUrl;
        $this->prices = $prices;
        $this->specifications = $specifications;
        $this->images = $images;
        $this->attachments = $attachments;
        $this->categories = $categories;
    }

    /**
     * Получение идентификатора.
     */
    public function getId(): string
    {
        return $this->id;
    }

    /**
     * Получение кода.
     */
    public function getCode(): string
    {
        return $this->code;
    }

    /**
     * Получение штрихкода.
     */
    public function getBarcode(): ?string
    {
        return $this->barcode;
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
     * Получение локализированного описания.
     *
     * @see Locale
     *
     * @throws LogicPowerException
     */
    public function getDescription(string $locale = null): string
    {
        return (string) Translator::translate($this->description, $locale);
    }

    /**
     * Получение статуса.
     *
     * @see ProductStatus
     */
    public function getStatus(): string
    {
        return $this->status;
    }

    /**
     * Получение ярлыков.
     *
     * @see ProductLabel
     *
     * @return string[]
     */
    public function getLabels(): array
    {
        return $this->labels;
    }

    /**
     * Получение производителя.
     */
    public function getManufacturer(): string
    {
        return $this->manufacturer;
    }

    /**
     * Получение розничного URL-адреса.
     */
    public function getRetailUrl(): ?string
    {
        return $this->retailUrl;
    }

    /**
     * Получение цены по типу.
     *
     * @throws LogicPowerException
     *
     * @see ProductPriceType
     */
    public function getPrice(string $type): ?Money
    {
        if (!in_array($type, ProductPriceType::getAll(), true)) {
            throw new LogicPowerException(sprintf('Неподдерживаемый тип цены товара [%s]', $type));
        }

        foreach ($this->prices as $price) {
            if ($price['type'] === $type) {
                return Money::fromArray($price['money']);
            }
        }

        return null;
    }

    /**
     * Получение спецификаций.
     *
     * @return ProductSpecification[]
     */
    public function getSpecifications(): array
    {
        return ProductSpecification::collectionFromArray($this->specifications);
    }

    /**
     * Получение категорий.
     *
     * @return Category[]
     */
    public function getCategories(): array
    {
        return Category::collectionFromArray($this->categories);
    }

    /**
     * Получение изображений.
     *
     * @return ProductImage[]
     */
    public function getImages(): array
    {
        return ProductImage::collectionFromArray($this->images);
    }

    /**
     * Получение вложений.
     *
     * @return ProductAttachment[]
     */
    public function getAttachments(): array
    {
        return array_reduce($this->attachments, static function (array $carry, array $item): array {
            return array_merge($carry, ProductAttachment::collectionFromArray($item['files']));
        }, []);
    }

    /**
     * {@inheritdoc}
     */
    public static function fromArray(array $array): self
    {
        return new self(
            $array['id'],
            $array['code'],
            $array['barcode'],
            $array['name'],
            $array['description'],
            $array['status'],
            $array['labels'],
            $array['manufacturer']['name'],
            $array['externalUrl'],
            $array['prices'],
            $array['specifications'],
            $array['categories'],
            $array['images'],
            $array['attachments']
        );
    }
}
