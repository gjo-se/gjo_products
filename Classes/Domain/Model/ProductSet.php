<?php
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

use \TYPO3\CMS\Extbase\Persistence\ObjectStorage;

/**
 * Class ProductSet
 * @package GjoSe\GjoProducts\Domain\Model
 */
class ProductSet extends AbstractModel
{
    /**
     * @var \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\GjoSe\GjoProducts\Domain\Model\ProductSetVariantGroup>
     */
    protected $productSetVariantGroups = null;

    /**
     * @var \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\GjoSe\GjoProducts\Domain\Model\AccessorykitGroup>
     */
    protected $accessorykitGroups = null;
	
	/**
     * @var \GjoSe\GjoBoilerplate\Domain\Model\Pages
     */
    protected $pages = null;

    /**
     * @var string
     */
    protected $name = '';

    /**
     * @var string
     */
    protected $anchor = '';

    /**
     * @var string
     */
    protected $description = '';

    /**
     * @var \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\TYPO3\CMS\Extbase\Domain\Model\FileReference>
     * @lazy
     */
    protected $image = null;

    /**
     * @var \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\TYPO3\CMS\Extbase\Domain\Model\FileReference>
     * @lazy
     */
    protected $icon = null;

    /**
     * @var bool
     */
    protected $showTechnicalnots = false;

    /**
     * @var string
     */
    protected $maximumDoorWeight = '';

    /**
     * @var string
     */
    protected $minimumDoorWeight = '';

    /**
     * @var string
     */
    protected $height = '';

    /**
     * @var int
     */
    protected $minimumDoorThickness = 0;

    /**
     * @var int
     */
    protected $maximumDoorThickness = 0;

    /**
     * @var int
     */
    protected $minimumDoorWidth = 0;

    /**
     * @var int
     */
    protected $minimumDoorWidthSoftClose = 0;

    /**
     * @var int
     */
    protected $minimumDoorWidthSoftCloseLong = 0;

    /**
     * @var int
     */
    protected $minimumDoorWidthSoftCloseBoth = 0;

    /**
     * @var int
     */
    protected $maximumDoorWidth = 0;

    /**
     * @var string
     */
    protected $voltage = '';

    /**
     * @var bool
     */
    protected $showDin = false;

    /**
     * @var string
     */
    protected $useCategorie = '';

    /**
     * @var string
     */
    protected $durability = '';

    /**
     * @var string
     */
    protected $doorWeight = '';

    /**
     * @var string
     */
    protected $fireResistance = '';

    /**
     * @var string
     */
    protected $safety = '';

    /**
     * @var string
     */
    protected $corrosionResistance = '';

    /**
     * @var string
     */
    protected $security = '';

    /**
     * @var string
     */
    protected $doorType = '';

    /**
     * @var string
     */
    protected $initialFriction = '';

    /**
     * @var string
     */
    protected $invitationToTender = '';

    /**
     * @var bool
     */
    protected $isFeatured = false;

    /**
     * @var bool
     */
    protected $filterMaterialWood = false;

    /**
     * @var bool
     */
    protected $filterMaterialGlas = false;

    /**
     * @var string
     */
    protected $filterWingcount = '';

    /**
     * @var \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\TYPO3\CMS\Extbase\Domain\Model\FileReference>
     * @lazy
     */
    protected $download = null;

    /**
     * @var \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\TYPO3\CMS\Extbase\Domain\Model\FileReference>
     * @lazy
     */
    protected $downloadEngineeringDrawing = null;

    /**
     * @var \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\TYPO3\CMS\Extbase\Domain\Model\FileReference>
     * @lazy
     */
    protected $imageEngineeringDrawing = null;

    /**
     * @var bool
     */
    protected $filterDesignCustomer = false;

    /**
     * @var bool
     */
    protected $filterDesignAlu = false;

    /**
     * @var bool
     */
    protected $filterDesignDesign = false;

    /**
     * @var bool
     */
    protected $filterSoftClose = false;

    /**
     * @var bool
     */
    protected $filterEt3 = false;

    /**
     * @var bool
     */
    protected $filterTfold = false;

    /**
     * @var bool
     */
    protected $filterTclose = false;

    /**
     * @var bool
     */
    protected $filterTmaster = false;

    /**
     * @var bool
     */
    protected $filterSynchron = false;

    /**
     * @var bool
     */
    protected $filterTelescop2 = false;

    /**
     * @var bool
     */
    protected $filterTelescop3 = false;

    /**
     * @var bool
     */
    protected $filterMontageIn = false;

    /**
     * @var bool
     */
    protected $filterMontageWall = false;

    /**
     * @var bool
     */
    protected $filterMontageCeiling = false;

    public function __construct()
    {
        $this->initStorageObjects();
    }

    /**
     * @return void
     */
    protected function initStorageObjects()
    {
        $this->productSetVariantGroups = new ObjectStorage();
        $this->accessorykitGroups = new ObjectStorage();
        $this->pages = new ObjectStorage();

        $this->image = new ObjectStorage();
        $this->icon = new ObjectStorage();
        $this->download = new ObjectStorage();
        $this->downloadEngineeringDrawing = new ObjectStorage();
        $this->imageEngineeringDrawing = new ObjectStorage();
    }

    /**
     * @return ObjectStorage
     */
    public function getProductSetVariantGroups()
    {
        return $this->productSetVariantGroups;
    }

    /**
     * @return ObjectStorage
     */
    public function getAccessorykitGroups()
    {
        return $this->accessorykitGroups;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @return string
     */
    public function getAnchor(): string
    {
        return $this->anchor;
    }

    /**
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @return ObjectStorage
     */
    public function getImage()
    {
        return $this->image;
    }

    /**
     * @return ObjectStorage
     */
    public function getIcon()
    {
        return $this->icon;
    }

    /**
     * @return bool
     */
    public function isShowTechnicalnots()
    {
        return $this->showTechnicalnots;
    }

    /**
     * @return string
     */
    public function getMaximumDoorWeight()
    {
        return $this->maximumDoorWeight;
    }

    /**
     * @return string
     */
    public function getMinimumDoorWeight()
    {
        return $this->minimumDoorWeight;
    }

    /**
     * @return string
     */
    public function getHeight()
    {
        return $this->height;
    }

    /**
     * @return int
     */
    public function getMinimumDoorThickness()
    {
        return $this->minimumDoorThickness;
    }

    /**
     * @return int
     */
    public function getMaximumDoorThickness()
    {
        return $this->maximumDoorThickness;
    }

    /**
     * @return integer
     */
    public function getMinimumDoorWidth()
    {
        return $this->minimumDoorWidth;
    }

    /**
     * @return integer
     */
    public function getMinimumDoorWidthSoftClose()
    {
        return $this->minimumDoorWidthSoftClose;
    }

    /**
     * @return integer
     */
    public function getMinimumDoorWidthSoftCloseLong()
    {
        return $this->minimumDoorWidthSoftCloseLong;
    }

    /**
     * @return integer
     */
    public function getMinimumDoorWidthSoftCloseBoth()
    {
        return $this->minimumDoorWidthSoftCloseBoth;
    }

    /**
     * @return integer
     */
    public function getMaximumDoorWidth()
    {
        return $this->maximumDoorWidth;
    }

    /**
     * @return string
     */
    public function getVoltage()
    {
        return $this->voltage;
    }

    /**
     * @return bool
     */
    public function isShowDin()
    {
        return $this->showDin;
    }

    /**
     * @return string
     */
    public function getUseCategorie()
    {
        return $this->useCategorie;
    }

    /**
     * @return string
     */
    public function getDurability()
    {
        return $this->durability;
    }

    /**
     * @return string
     */
    public function getDoorWeight()
    {
        return $this->doorWeight;
    }

    /**
     * @return string
     */
    public function getFireResistance()
    {
        return $this->fireResistance;
    }

    /**
     * @return string
     */
    public function getSafety()
    {
        return $this->safety;
    }

    /**
     * @return string
     */
    public function getCorrosionResistance()
    {
        return $this->corrosionResistance;
    }

    /**
     * @return string
     */
    public function getSecurity()
    {
        return $this->security;
    }

    /**
     * @return string
     */
    public function getDoorType()
    {
        return $this->doorType;
    }

    /**
     * @return string
     */
    public function getInitialFriction()
    {
        return $this->initialFriction;
    }

    /**
     * @return string
     */
    public function getInvitationToTender()
    {
        return $this->invitationToTender;
    }

    /**
     * @return ObjectStorage
     */
    public function getDownload()
    {
        return $this->download;
    }

    /**
     * @return ObjectStorage
     */
    public function getDownloadEngineeringDrawing()
    {
        return $this->downloadEngineeringDrawing;
    }

    /**
     * @return \GjoSe\GjoBoilerplate\Domain\Model\Pages
     */
    public function getPages()
    {
        return $this->pages;
    }

    /**
     * @return ObjectStorage
     */
    public function getImageEngineeringDrawing()
    {
        return $this->imageEngineeringDrawing;
    }

    /**
     * @return bool
     */
    public function isIsFeatured()
    {
        return $this->isFeatured;
    }

    /**
     * @param bool $isFeatured
     *
     * @return void
     */
    public function setIsFeatured($isFeatured)
    {
        $this->isFeatured = $isFeatured;
    }

    /**
     * @return bool
     */
    public function isFilterMaterialWood()
    {
        return $this->filterMaterialWood;
    }

    /**
     * @param bool $filterMaterialWood
     *
     * @return void
     */
    public function setFilterMaterialWood($filterMaterialWood)
    {
        $this->filterMaterialWood = $filterMaterialWood;
    }

    /**
     * @return bool
     */
    public function isFilterMaterialGlas()
    {
        return $this->filterMaterialGlas;
    }

    /**
     * @param bool $filterMaterialGlas
     *
     * @return void
     */
    public function setFilterMaterialGlas($filterMaterialGlas)
    {
        $this->filterMaterialGlas = $filterMaterialGlas;
    }

    /**
     * @return string
     */
    public function getFilterWingcount()
    {
        return $this->filterWingcount;
    }

    /**
     * @param string $filterWingcount
     *
     * @return void
     */
    public function setFilterWingcount($filterWingcount)
    {
        $this->filterWingcount = $filterWingcount;
    }

    /**
     * @return bool
     */
    public function isFilterMontageIn()
    {
        return $this->filterMontageIn;
    }

    /**
     * @return bool
     */
    public function isFilterMontageWall()
    {
        return $this->filterMontageWall;
    }

    /**
     * @return bool
     */
    public function isFilterMontageCeiling()
    {
        return $this->filterMontageCeiling;
    }

    /**
     * @return bool
     */
    public function isFilterDesignCustomer()
    {
        return $this->filterDesignCustomer;
    }

    /**
     * @return bool
     */
    public function isFilterDesignAlu()
    {
        return $this->filterDesignAlu;
    }

    /**
     * @return bool
     */
    public function isFilterDesignDesign()
    {
        return $this->filterDesignDesign;
    }

    /**
     * @return bool
     */
    public function isFilterSoftClose()
    {
        return $this->filterSoftClose;
    }

    /**
     * @return bool
     */
    public function isFilterEt3()
    {
        return $this->filterEt3;
    }

    /**
     * @return bool
     */
    public function isFilterTfold()
    {
        return $this->filterTfold;
    }

    /**
     * @return bool
     */
    public function isFilterTclose()
    {
        return $this->filterTclose;
    }

    /**
     * @return bool
     */
    public function isFilterTmaster()
    {
        return $this->filterTmaster;
    }

    /**
     * @return bool
     */
    public function isFilterSynchron()
    {
        return $this->filterSynchron;
    }

    /**
     * @return bool
     */
    public function isFilterTelescop2()
    {
        return $this->filterTelescop2;
    }

    /**
     * @return bool
     */
    public function isFilterTelescop3()
    {
        return $this->filterTelescop3;
    }
}