<?php

declare(strict_types=1);

namespace GjoSe\GjoProducts\Domain\Model;

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

use GjoSe\GjoBase\Domain\Model\AbstractModel as GjoBaseAbstractModel;
use GjoSe\GjoBase\Domain\Model\Pages;
use TYPO3\CMS\Extbase\Domain\Model\FileReference;
use TYPO3\CMS\Extbase\Persistence\ObjectStorage;

/**
 * Class ProductGroup
 */
class ProductGroup extends GjoBaseAbstractModel
{
    protected string $header = '';

    protected string $subHeader = '';

    protected string $description = '';

    protected ?FileReference $image = null;

    protected string $teaserHeader = '';

    protected string $teaserDescription = '';

    protected ?FileReference $teaserImage = null;

    /**
     * @var ObjectStorage<ProductSetType>
     */
    protected ObjectStorage $productSetTypes;

    protected Pages $page;

    public function __construct()
    {
        $this->initStorageObjects();
    }

    protected function initStorageObjects(): void
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

    /**
     * @return ObjectStorage<ProductSetType>
     */
    public function getProductSetTypes(): ObjectStorage
    {
        return $this->productSetTypes;
    }

    public function getPage(): Pages
    {
        return $this->page;
    }
}
