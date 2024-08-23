<?php

declare(strict_types=1);

namespace GjoSe\GjoProducts\Domain\Model;

use TYPO3\CMS\Extbase\Annotation\ORM\Lazy;
use TYPO3\CMS\Extbase\DomainObject\AbstractEntity;
use TYPO3\CMS\Extbase\Persistence\ObjectStorage;

final class ProductSetType extends AbstractEntity
{
    #[Lazy]
    protected ?ProductGroup $productGroup = null;

    /** @var ObjectStorage<ProductSet> */
    #[Lazy]
    protected ObjectStorage $productSets;

    protected string $name = '';

    protected string $description = '';

    public function __construct()
    {
        $this->initStorageObjects();
    }

    private function initStorageObjects(): void
    {
        $this->productSets = new ObjectStorage();
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function getProductGroup(): ?ProductGroup
    {
        return $this->productGroup;
    }

    /** @return ObjectStorage<ProductSet> */
    public function getProductSets(): ObjectStorage
    {
        return $this->productSets;
    }
}
