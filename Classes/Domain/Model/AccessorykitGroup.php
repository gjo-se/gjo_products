<?php

declare(strict_types=1);

namespace GjoSe\GjoProducts\Domain\Model;

use TYPO3\CMS\Extbase\Annotation\ORM\Lazy;
use TYPO3\CMS\Extbase\DomainObject\AbstractEntity;
use TYPO3\CMS\Extbase\Persistence\ObjectStorage;

final class AccessorykitGroup extends AbstractEntity
{
    #[Lazy]
    protected ?ProductSet $productSet = null;

    /** @var ObjectStorage<ProductSet> */
    #[Lazy]
    protected ObjectStorage $accessoryKits;

    protected string $headline = '';

    public function __construct()
    {
        $this->initStorageObjects();
    }

    private function initStorageObjects(): void
    {
        $this->accessoryKits = new ObjectStorage();
    }

    public function getHeadline(): string
    {
        return $this->headline;
    }

    public function getProductSet(): ?ProductSet
    {
        return $this->productSet;
    }

    /** @return ObjectStorage<ProductSet> */
    public function getAccessoryKits(): ObjectStorage
    {
        return $this->accessoryKits;
    }
}
