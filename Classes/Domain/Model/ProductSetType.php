<?php
namespace GjoSe\GjoProducts\Domain\Model;

/***************************************************************
 *  created: 04.09.17 - 15:37
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
 * Class ProductSetType
 * @package GjoSe\GjoProducts\Domain\Model
 */
class ProductSetType extends AbstractModel
{

    /**
     * @var \GjoSe\GjoProducts\Domain\Model\ProductGroup
     */
    protected $productGroup = null;

    /**
     * @var \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\GjoSe\GjoProducts\Domain\Model\ProductSet>
     * @lazy
     */
    protected $productSets = null;

    /**
     * @var string
     */
    protected $name = '';

    /**
     * @var string
     */
    protected $description = '';

    public function __construct()
    {
        $this->initStorageObjects();
    }

    /**
     * @return void
     */
    protected function initStorageObjects()
    {
        $this->productSets = new ObjectStorage();
    }

    /**
     * @return \GjoSe\GjoProducts\Domain\Model\ProductGroup
     */
    public function getProductGroup()
    {
        return $this->productGroup;
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
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @return ObjectStorage
     */
    public function getProductSets()
    {
        return $this->productSets;
    }
}