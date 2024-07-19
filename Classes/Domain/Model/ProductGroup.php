<?php
namespace GjoSe\GjoTiger\Domain\Model;

/***************************************************************
 *  created: 04.09.17 - 13:58
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
 * Class ProductGroup
 * @package GjoSe\GjoTiger\Domain\Model
 */
class ProductGroup extends AbstractModel
{
    /**
     * @var \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\GjoSe\GjoTiger\Domain\Model\ProductSetType>
     */
    protected $productSetTypes = null;

    /**
     * @var \GjoSe\GjoBoilerplate\Domain\Model\Pages
     */
    protected $pages = null;

    /**
     * @var string
     */
    protected $header = '';

    /**
     * @var string
     */
    protected $subHeader = '';

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
     * @var string
     */
    protected $teaserHeader = '';

    /**
     * @var string
     */
    protected $teaserDescription = '';

    /**
     * @var \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\TYPO3\CMS\Extbase\Domain\Model\FileReference>
     * @lazy
     */
    protected $teaserImage = null;

    public function __construct()
    {
        $this->initStorageObjects();
    }

    /**
     * @return void
     */
    protected function initStorageObjects()
    {
        $this->productSetTypes = new ObjectStorage();
        $this->image           = new ObjectStorage();
        $this->teaserImage = new ObjectStorage();
        $this->pages = new ObjectStorage();
    }

    /**
     * @return ObjectStorage
     */
    public function getProductSetTypes()
    {
        return $this->productSetTypes;
    }

    /**
     * @return string
     */
    public function getHeader()
    {
        return $this->header;
    }

    /**
     * @return string
     */
    public function getSubHeader()
    {
        return $this->subHeader;
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
     * @return string
     */
    public function getTeaserHeader()
    {
        return $this->teaserHeader;
    }

    /**
     * @return string
     */
    public function getTeaserDescription()
    {
        return $this->teaserDescription;
    }

    /**
     * @return ObjectStorage
     */
    public function getTeaserImage()
    {
        return $this->teaserImage;
    }

    /**
     * @return \GjoSe\GjoBoilerplate\Domain\Model\Pages
     */
    public function getPages()
    {
        return $this->pages;
    }
}