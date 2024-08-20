<?php

declare(strict_types=1);

namespace GjoSe\GjoProducts\Domain\Model;

use TYPO3\CMS\Extbase\Persistence\ObjectStorage;
use TYPO3\CMS\Extbase\Annotation\ORM\Lazy;
use TYPO3\CMS\Extbase\DomainObject\AbstractEntity;

final class ProductSetVariant extends AbstractEntity
{
    /** @var ObjectStorage<ProductSetVariantGroup> */
    #[Lazy()]
    protected ObjectStorage $productSetVariantGroup;

    protected string $name = '';

    protected string $articleNumber = '';

    protected float $price = 0.0;

    protected string $material = '';

    protected int $length = 0;

    protected string $version = '';

    protected int $tax = 0;

    public function __construct()
    {
        $this->initStorageObjects();
    }

    private function initStorageObjects(): void
    {
        $this->productSetVariantGroup = new ObjectStorage();
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getArticleNumber(): string
    {
        return $this->articleNumber;
    }

    public function getPrice(): float
    {
        return $this->price;
    }

    public function getTax(): int
    {
        return $this->tax;
    }

    public function getMaterial(): string
    {
        return $this->material;
    }

    public function getLength(): int
    {
        return $this->length;
    }

    public function getVersion(): string
    {
        return $this->version;
    }

    /** @return ObjectStorage<ProductSetVariantGroup> */
    public function getProductSetVariantGroup(): ObjectStorage
    {
        return $this->productSetVariantGroup;
    }
}
