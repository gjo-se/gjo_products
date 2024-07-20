<?php
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

use GjoSe\GjoBoilerplate\Domain\Repository\AbstractRepository as GjoBoilerplateAbstractRepository;

/**
 * Class ProductSetVariantRepository
 * @package GjoSe\GjoProducts\Domain\Repository
 */
class ProductSetVariantRepository extends AbstractRepository
{
    public function findByProductSetVariantGroupAndFilter($productSetVariantGroupUid, $productSetVariantFilter)
    {
        $query = $this->createQuery();
        $query->getQuerySettings()
              ->setRespectStoragePage(false);

        $constraints   = array();
        $constraints[] = $query->equals('product_set_variant_group', $productSetVariantGroupUid );

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

        $query->matching($query->logicalAnd($constraints));

        return $query->execute()->getFirst();
    }
}