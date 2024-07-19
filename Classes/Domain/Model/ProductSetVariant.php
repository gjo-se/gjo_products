<?php
namespace GjoSe\GjoTiger\Domain\Model;

/***************************************************************
 *  created: 04.09.17 - 15:41
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
 * Class ProductSetVariant
 * @package GjoSe\GjoTiger\Domain\Model
 */
class ProductSetVariant extends AbstractModel
{

    /**
     * @var \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\GjoSe\GjoTiger\Domain\Model\ProductSetVariantGroup>
     * @lazy
     */
    protected $productSetVariantGroup = null;

    /**
     * @var string
     */
    protected $name = '';

    /**
     * @var string
     */
    protected $articleNumber = '';

    /**
     * @var double
     */
    protected $price = 0;

    /**
     * @var string
     */
    protected $material = '';

    /**
     * @var int
     */
    protected $length = 0;

    /**
     * @var string
     */
    protected $version = '';

    /**
     * @var int
     */
    protected $tax = 0;

    public function __construct()
    {
        $this->initStorageObjects();
    }

    /**
     * @return void
     */
    protected function initStorageObjects()
    {
        $this->productSetVariantGroup = new ObjectStorage();
    }

    /**
     * @return ObjectStorage
     */
    public function getProductSetVariantGroup()
    {
        return $this->productSetVariantGroup;
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
    public function getArticleNumber()
    {
        return $this->articleNumber;
    }

    /**
     * @return float
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * @return int
     */
    public function getTax()
    {
        return $this->tax;
    }

    /**
     * @return string
     */
    public function getMaterial(): string
    {
        return $this->material;
    }

    /**
     * @param string $material
     *
     * @return void
     */
    public function setMaterial($material)
    {
        $this->material = $material;
    }

    /**
     * @return int
     */
    public function getLength(): int
    {
        return $this->length;
    }

    /**
     * @param int $length
     *
     * @return void
     */
    public function setLength($length)
    {
        $this->length = $length;
    }

    /**
     * @return string
     */
    public function getVersion(): string
    {
        return $this->version;
    }

    /**
     * @param string $version
     *
     * @return void
     */
    public function setVersion($version)
    {
        $this->version = $version;
    }
}