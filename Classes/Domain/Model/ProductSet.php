<?php

declare(strict_types=1);

namespace GjoSe\GjoProducts\Domain\Model;

/***************************************************************
 *  created: 04.09.17 - 14:50
 *  Copyright notice
 *  (c) 2017 Gregory Jo Erdmann <gregory.jo@gjo-se.com>
 *  All rights reserved
 *  This script is part of the TYPO3 project. The TYPO3 project is
 *  free software; you can redistribute it and/or modify
 *  it under the terms of the GNU General Public License as published by
 *  the Free Software Foundation; either version 3 of the License, or
 *  (at your option) any later version.
 *  The GNU General Public License can be found at
 *  http://www.gnu.org/copyleft/gpl.html.
 *  This script is distributed in the hope that it will be useful,
 *  but WITHOUT ANY WARRANTY; without even the implied warranty of
 *  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 *  GNU General Public License for more details.
 *  This copyright notice MUST APPEAR in all copies of the script!
 ***************************************************************/

use GjoSe\GjoBase\Domain\Model\AbstractModel as GjoBaseAbstractModel;
use TYPO3\CMS\Extbase\Persistence\ObjectStorage;
use TYPO3\CMS\Extbase\Domain\Model\FileReference;
use GjoSe\GjoBase\Domain\Model\Pages;

/**
 * Class ProductSet
 */
class ProductSet extends GjoBaseAbstractModel
{
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
    protected ?FileReference $download = null;
    protected ?FileReference $downloadEngineeringDrawing = null;
    protected ?FileReference $imageEngineeringDrawing = null;
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

    /**
     * @var ObjectStorage<ProductSetVariantGroup>
     */
    protected ObjectStorage $productSetVariantGroups;

    /**
     * @var ObjectStorage<AccessorykitGroup>
     */
    protected ObjectStorage $accessorykitGroups;

    /**
     * @var ObjectStorage<Pages>
     */
    protected ObjectStorage $pages;

    public function __construct()
    {
        $this->initStorageObjects();
    }

    protected function initStorageObjects(): void
    {
        $this->productSetVariantGroups = new ObjectStorage();
        $this->accessorykitGroups = new ObjectStorage();
        $this->pages = new ObjectStorage();
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

    public function getDownload(): ?FileReference
    {
        return $this->download;
    }

    public function getDownloadEngineeringDrawing(): ?FileReference
    {
        return $this->downloadEngineeringDrawing;
    }

    public function getImageEngineeringDrawing(): ?FileReference
    {
        return $this->imageEngineeringDrawing;
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

    /**
     * @return ObjectStorage<ProductSetVariantGroup>
     */
    public function getProductSetVariantGroups(): ObjectStorage
    {
        return $this->productSetVariantGroups;
    }

    /**
     * @return ObjectStorage<AccessorykitGroup>
     */
    public function getAccessorykitGroups(): ObjectStorage
    {
        return $this->accessorykitGroups;
    }

    /**
     * @return ObjectStorage<Pages>
     */
    public function getPages(): ObjectStorage
    {
        return $this->pages;
    }
}
