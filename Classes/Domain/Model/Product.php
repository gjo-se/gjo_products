<?php

namespace GjoSe\GjoProducts\Domain\Model;

/***************************************************************
 *  created: 04.09.17 - 10:26
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
use TYPO3\CMS\Extbase\Domain\Model\FileReference;

/**
 * Class Product
 */
class Product extends GjoBaseAbstractModel
{
    protected string $name = '';
    protected string $articleNumber = '';
    protected string $additionalInformation = '';
    protected ?FileReference $image = null;

    public function getName(): string
    {
        return $this->name;
    }

    public function getArticleNumber(): string
    {
        return $this->articleNumber;
    }

    public function getAdditionalInformation(): string
    {
        return $this->additionalInformation;
    }

    public function getImage(): ?FileReference
    {
        return $this->image;
    }
}
