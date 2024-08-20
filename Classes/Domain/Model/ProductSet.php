<?php

declare(strict_types=1);

namespace GjoSe\GjoProducts\Domain\Model;

use TYPO3\CMS\Extbase\Annotation\ORM\Lazy;
use TYPO3\CMS\Extbase\Persistence\ObjectStorage;
use TYPO3\CMS\Extbase\Domain\Model\FileReference;
use GjoSe\GjoSitePackage\Domain\Model\Pages;
use TYPO3\CMS\Extbase\DomainObject\AbstractEntity;

/**
 * Class ProductSet
 */
class ProductSet extends AbstractEntity
{
    /** @var ObjectStorage<ProductSetVariantGroup> */
    #[Lazy()]
    protected ObjectStorage $productSetVariantGroups;

    /** @var ObjectStorage<AccessorykitGroup> */
    #[Lazy()]
    protected ObjectStorage $accessorykitGroups;

    protected ?Pages $page = null;

    protected string $name = '';

    protected string $anchor = '';

    protected string $description = '';

    protected ?FileReference $image = null;

    protected ?FileReference $icon = null;

    protected bool $showTechnicalnots = false;

    protected string $maximumDoorWeight = '';

    protected string $minimumDoorWeight = '';

    protected string $height = '';

    protected int $minimumDoorThickness = 0;

    protected int $maximumDoorThickness = 0;

    protected int $minimumDoorWidth = 0;

    protected int $minimumDoorWidthSoftClose = 0;

    protected int $minimumDoorWidthSoftCloseLong = 0;

    protected int $minimumDoorWidthSoftCloseBoth = 0;

    protected int $maximumDoorWidth = 0;

    protected string $voltage = '';

    protected bool $showDin = false;

    protected string $useCategorie = '';

    protected string $durability = '';

    protected string $doorWeight = '';

    protected string $fireResistance = '';

    protected string $safety = '';

    protected string $corrosionResistance = '';

    protected string $security = '';

    protected string $doorType = '';

    protected string $initialFriction = '';

    protected string $invitationToTender = '';

    protected bool $isFeatured = false;

    protected bool $filterMaterialWood = false;

    protected bool $filterMaterialGlas = false;

    protected string $filterWingcount = '';

    /** @var ObjectStorage<FileReference> */
    #[Lazy()]
    protected ObjectStorage $downloads;

    /** @var ObjectStorage<FileReference> */
    #[Lazy()]
    protected ObjectStorage $downloadEngineeringDrawings;

    /** @var ObjectStorage<FileReference> */
    #[Lazy()]
    protected ObjectStorage $imageEngineeringDrawings;

    protected bool $filterDesignCustomer = false;

    protected bool $filterDesignAlu = false;

    protected bool $filterDesignDesign = false;

    protected bool $filterSoftClose = false;

    protected bool $filterEt3 = false;

    protected bool $filterTfold = false;

    protected bool $filterTclose = false;

    protected bool $filterTmaster = false;

    protected bool $filterSynchron = false;

    protected bool $filterTelescop2 = false;

    protected bool $filterTelescop3 = false;

    protected bool $filterMontageIn = false;

    protected bool $filterMontageWall = false;

    protected bool $filterMontageCeiling = false;

    public function __construct()
    {
        $this->initStorageObjects();
    }

    private function initStorageObjects(): void
    {
        $this->productSetVariantGroups = new ObjectStorage();
        $this->accessorykitGroups = new ObjectStorage();
        $this->downloads = new ObjectStorage();
        $this->downloadEngineeringDrawings = new ObjectStorage();
        $this->imageEngineeringDrawings = new ObjectStorage();
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getAnchor(): string
    {
        return $this->anchor;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function getImage(): ?FileReference
    {
        return $this->image;
    }

    public function getIcon(): ?FileReference
    {
        return $this->icon;
    }

    public function isShowTechnicalnots(): bool
    {
        return $this->showTechnicalnots;
    }

    public function getMaximumDoorWeight(): string
    {
        return $this->maximumDoorWeight;
    }

    public function getMinimumDoorWeight(): string
    {
        return $this->minimumDoorWeight;
    }

    public function getHeight(): string
    {
        return $this->height;
    }

    public function getMinimumDoorThickness(): int
    {
        return $this->minimumDoorThickness;
    }

    public function getMaximumDoorThickness(): int
    {
        return $this->maximumDoorThickness;
    }

    public function getMinimumDoorWidth(): int
    {
        return $this->minimumDoorWidth;
    }

    public function getMinimumDoorWidthSoftClose(): int
    {
        return $this->minimumDoorWidthSoftClose;
    }

    public function getMinimumDoorWidthSoftCloseLong(): int
    {
        return $this->minimumDoorWidthSoftCloseLong;
    }

    public function getMinimumDoorWidthSoftCloseBoth(): int
    {
        return $this->minimumDoorWidthSoftCloseBoth;
    }

    public function getMaximumDoorWidth(): int
    {
        return $this->maximumDoorWidth;
    }

    public function getVoltage(): string
    {
        return $this->voltage;
    }

    public function isShowDin(): bool
    {
        return $this->showDin;
    }

    public function getUseCategorie(): string
    {
        return $this->useCategorie;
    }

    public function getDurability(): string
    {
        return $this->durability;
    }

    public function getDoorWeight(): string
    {
        return $this->doorWeight;
    }

    public function getFireResistance(): string
    {
        return $this->fireResistance;
    }

    public function getSafety(): string
    {
        return $this->safety;
    }

    public function getCorrosionResistance(): string
    {
        return $this->corrosionResistance;
    }

    public function getSecurity(): string
    {
        return $this->security;
    }

    public function getDoorType(): string
    {
        return $this->doorType;
    }

    public function getInitialFriction(): string
    {
        return $this->initialFriction;
    }

    public function getInvitationToTender(): string
    {
        return $this->invitationToTender;
    }

    /** @return ObjectStorage<FileReference> */
    public function getDownloads(): ObjectStorage
    {
        return $this->downloads;
    }

    /** @return ObjectStorage<FileReference> */
    public function getDownloadEngineeringDrawings(): ObjectStorage
    {
        return $this->downloadEngineeringDrawings;
    }

    /** @return ObjectStorage<FileReference> */
    public function getImageEngineeringDrawings(): ObjectStorage
    {
        return $this->imageEngineeringDrawings;
    }

    public function isIsFeatured(): bool
    {
        return $this->isFeatured;
    }

    public function isFilterMaterialWood(): bool
    {
        return $this->filterMaterialWood;
    }

    public function isFilterMaterialGlas(): bool
    {
        return $this->filterMaterialGlas;
    }

    public function getFilterWingcount(): string
    {
        return $this->filterWingcount;
    }

    public function isFilterMontageIn(): bool
    {
        return $this->filterMontageIn;
    }

    public function isFilterMontageWall(): bool
    {
        return $this->filterMontageWall;
    }

    public function isFilterMontageCeiling(): bool
    {
        return $this->filterMontageCeiling;
    }

    public function isFilterDesignCustomer(): bool
    {
        return $this->filterDesignCustomer;
    }

    public function isFilterDesignAlu(): bool
    {
        return $this->filterDesignAlu;
    }

    public function isFilterDesignDesign(): bool
    {
        return $this->filterDesignDesign;
    }

    public function isFilterSoftClose(): bool
    {
        return $this->filterSoftClose;
    }

    public function isFilterEt3(): bool
    {
        return $this->filterEt3;
    }

    public function isFilterTfold(): bool
    {
        return $this->filterTfold;
    }

    public function isFilterTclose(): bool
    {
        return $this->filterTclose;
    }

    public function isFilterTmaster(): bool
    {
        return $this->filterTmaster;
    }

    public function isFilterSynchron(): bool
    {
        return $this->filterSynchron;
    }

    public function isFilterTelescop2(): bool
    {
        return $this->filterTelescop2;
    }

    public function isFilterTelescop3(): bool
    {
        return $this->filterTelescop3;
    }

    /** @return ObjectStorage<ProductSetVariantGroup> */
    public function getProductSetVariantGroups(): ObjectStorage
    {
        return $this->productSetVariantGroups;
    }

    /** @return ObjectStorage<AccessorykitGroup> */
    public function getAccessorykitGroups(): ObjectStorage
    {
        return $this->accessorykitGroups;
    }

    public function getPage(): ?Pages
    {
        return $this->page;
    }
}
