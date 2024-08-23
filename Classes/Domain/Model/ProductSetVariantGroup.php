<?php

declare(strict_types=1);

namespace GjoSe\GjoProducts\Domain\Model;

use TYPO3\CMS\Extbase\Annotation\ORM\Lazy;
use TYPO3\CMS\Extbase\DomainObject\AbstractEntity;
use TYPO3\CMS\Extbase\Persistence\ObjectStorage;

final class ProductSetVariantGroup extends AbstractEntity
{
    /** @var ObjectStorage<ProductSetVariant> */
    #[Lazy]
    protected ObjectStorage $productSetVariants;

    /** @var ObjectStorage<Product> */
    #[Lazy]
    protected ObjectStorage $products;

    #[Lazy]
    protected ?ProductSet $productSet = null;

    protected string $headline = '';

    protected string $description = '';

    protected string $tableHeadline = '';

    public function __construct()
    {
        $this->initStorageObjects();
    }

    private function initStorageObjects(): void
    {
        $this->productSetVariants = new ObjectStorage();
        $this->products = new ObjectStorage();
    }

    public function getHeadline(): string
    {
        return $this->headline;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function getTableHeadline(): string
    {
        return $this->tableHeadline;
    }

    public function getProductSet(): ?ProductSet
    {
        return $this->productSet;
    }

    /** @return ObjectStorage<ProductSetVariant> */
    public function getProductSetVariants(): ObjectStorage
    {
        return $this->productSetVariants;
    }

    /** @return ObjectStorage<Product> */
    public function getProducts(): ObjectStorage
    {
        return $this->products;
    }
}
