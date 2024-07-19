<?php
namespace GjoSe\GjoTiger\Domain\Model;

/***************************************************************
 *  created: 04.09.17 - 15:45
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
 * Class ProductSetVariantGroup
 * @package GjoSe\GjoTiger\Domain\Model
 */
class ProductSetVariantGroup extends AbstractModel
{
    /**
     * @var \GjoSe\GjoTiger\Domain\Model\ProductSet
     */
    protected $productSet = null;

    /**
     * @var \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\GjoSe\GjoTiger\Domain\Model\ProductSetVariant>
     * @lazy
     */
    protected $productSetVariants = null;

    /**
     * @var \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\GjoSe\GjoTiger\Domain\Model\Product>
     * @lazy
     */
    protected $products = null;

    /**
     * @var string
     */
    protected $headline = '';

    /**
     * @var string
     */
    protected $description = '';

    /**
     * @var string
     */
    protected $tableHeadline = '';

    public function __construct()
    {
        $this->initStorageObjects();
    }

    /**
     * @return void
     */
    protected function initStorageObjects()
    {
        $this->productSetVariants = new ObjectStorage();
        $this->products = new ObjectStorage();
    }

    /**
     * @return \GjoSe\GjoTiger\Domain\Model\ProductSet
     */
    public function getProductSet()
    {
        return $this->productSet;
    }

    /**
     * @return string
     */
    public function getHeadline()
    {
        return $this->headline;
    }

    /**
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @return string
     */
    public function getTableHeadline()
    {
        return $this->tableHeadline;
    }

    /**
     * @return ObjectStorage
     */
    public function getProductSetVariants()
    {
        return $this->productSetVariants;
    }

    /**
     * @return ObjectStorage
     */
    public function getProducts()
    {
        return $this->products;
    }
}