<?php

declare(strict_types=1);

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

use GjoSe\GjoBase\Domain\Model\AbstractModel as GjoBaseAbstractModel;
use TYPO3\CMS\Extbase\Persistence\ObjectStorage;

/**
 * Class ProductSetType
 */
class ProductSetType extends GjoBaseAbstractModel
{
    protected string $name = '';
    protected string $description = '';
    protected ?ProductGroup $productGroup = null;

    /**
     * @var ObjectStorage<ProductSet>
     * @Extbase\ORM\Lazy
     */
    protected ObjectStorage $productSets;

    public function __construct()
    {
        $this->initStorageObjects();
    }

    protected function initStorageObjects(): void
    {
        $this->productSets = new ObjectStorage();
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function getProductGroup(): ?ProductGroup
    {
        return $this->productGroup;
    }

    /**
     * @return ObjectStorage<ProductSet>
     */
    public function getProductSets(): ObjectStorage
    {
        return $this->productSets;
    }
}
