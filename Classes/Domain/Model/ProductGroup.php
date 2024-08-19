<?php

declare(strict_types=1);

namespace GjoSe\GjoProducts\Domain\Model;

use GjoSe\GjoSitePackage\Domain\Model\Pages;
use TYPO3\CMS\Extbase\Annotation\ORM\Lazy;
use TYPO3\CMS\Extbase\Domain\Model\FileReference;
use TYPO3\CMS\Extbase\Persistence\ObjectStorage;
use TYPO3\CMS\Extbase\DomainObject\AbstractEntity;

final class ProductGroup extends AbstractEntity
{
    /** @var ObjectStorage<ProductSetType> */
    #[Lazy()]
    protected ObjectStorage $productSetTypes;

    protected ?Pages $page = null;

    protected string $header = '';

    protected string $subHeader = '';

    protected string $description = '';

    protected ?FileReference $image = null;

    protected string $teaserHeader = '';

    protected string $teaserDescription = '';

    protected ?FileReference $teaserImage = null;


    private function __construct()
    {
        $this->initStorageObjects();
    }

    private function initStorageObjects(): void
    {
        $this->productSetTypes = new ObjectStorage();
    }

    public function getHeader(): string
    {
        return $this->header;
    }

    public function getSubHeader(): string
    {
        return $this->subHeader;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function getImage(): ?FileReference
    {
        return $this->image;
    }

    public function getTeaserHeader(): string
    {
        return $this->teaserHeader;
    }

    public function getTeaserDescription(): string
    {
        return $this->teaserDescription;
    }

    public function getTeaserImage(): ?FileReference
    {
        return $this->teaserImage;
    }

    /** @return ObjectStorage<ProductSetType> */
    public function getProductSetTypes(): ObjectStorage
    {
        return $this->productSetTypes;
    }

    public function getPage(): ?Pages
    {
        return $this->page;
    }
}
