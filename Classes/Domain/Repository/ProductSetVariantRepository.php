<?php

declare(strict_types=1);

namespace GjoSe\GjoProducts\Domain\Repository;

/***************************************************************
 *  created: 04.09.17 - 15:44
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

use GjoSe\GjoBase\Domain\Repository\AbstractRepository;
use GjoSe\GjoProducts\Domain\Model\ProductSetVariant;
use TYPO3\CMS\Extbase\Persistence\Exception\InvalidQueryException;

class ProductSetVariantRepository extends AbstractRepository
{
    /**
     * @param int $productSetVariantGroupUid
     * @param array<string> $productSetVariantFilter
     *
     * @return ProductSetVariant|null
     * @throws InvalidQueryException
     */
    public function findByProductSetVariantGroupAndFilter(int $productSetVariantGroupUid, array $productSetVariantFilter): ?ProductSetVariant
    {
        $query = $this->createQuery();
        $query->getQuerySettings()
              ->setRespectStoragePage(false);

        $constraints   = [];
        $constraints[] = $query->equals('product_set_variant_group', $productSetVariantGroupUid);

        if (isset($productSetVariantFilter['noFilterTyp'])) {
            $constraints[] = $query->like('name', '%%');
        }
        if (isset($productSetVariantFilter['length'])) {
            $constraints[] = $query->equals('length', $productSetVariantFilter['length']);
        }
        if (isset($productSetVariantFilter['material'])) {
            $constraints[] = $query->equals('material', $productSetVariantFilter['material']);
        }
        if (isset($productSetVariantFilter['version'])) {
            $constraints[] = $query->equals('version', $productSetVariantFilter['version']);
        }

        $query->matching($query->logicalAnd(...$constraints));

        return $query->execute()->getFirst();
    }
}
