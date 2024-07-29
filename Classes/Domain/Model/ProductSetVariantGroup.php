<?php

declare(strict_types=1);

namespace GjoSe\GjoProducts\Domain\Model;

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

use GjoSe\GjoBase\Domain\Model\AbstractModel as GjoBaseAbstractModel;
use TYPO3\CMS\Extbase\Persistence\ObjectStorage;

/**
 * Class ProductSetVariantGroup
 */
class ProductSetVariantGroup extends GjoBaseAbstractModel
{
    protected string $headline = '';

    protected string $description = '';

    protected string $tableHeadline = '';

    protected ?ProductSet $productSet = null;

    /**
     * @var ObjectStorage<ProductSetVariant>
     * @Extbase\ORM\Lazy
     */
    protected ObjectStorage $productSetVariants;

    /**
     * @var ObjectStorage<Product>
     * @Extbase\ORM\Lazy
     */
    protected ObjectStorage $products;

    public function __construct()
    {
        $this->initStorageObjects();
    }

    protected function initStorageObjects(): void
    {
        $this->productSetVariants = new ObjectStorage();
        $this->products = new ObjectStorage();
    }

    public function getHeadline(): string
    {
        return $this->headline;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function getTableHeadline(): string
    {
        return $this->tableHeadline;
    }

    public function getProductSet(): ?ProductSet
    {
        return $this->productSet;
    }

    /**
     * @return ObjectStorage<ProductSetVariant>
     */
    public function getProductSetVariants(): ObjectStorage
    {
        return $this->productSetVariants;
    }

    /**
     * @return ObjectStorage<Product>
     */
    public function getProducts(): ObjectStorage
    {
        return $this->products;
    }
}
