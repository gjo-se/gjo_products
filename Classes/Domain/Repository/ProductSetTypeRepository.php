<?php

declare(strict_types=1);

namespace GjoSe\GjoProducts\Domain\Repository;

/***************************************************************
 *  created: 04.09.17 - 15:40
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

use Doctrine\DBAL\Exception;
use GjoSe\GjoBase\Domain\Repository\AbstractRepository;
use TYPO3\CMS\Core\Database\Connection;
use TYPO3\CMS\Core\Database\ConnectionPool;
use TYPO3\CMS\Core\Utility\GeneralUtility;

class ProductSetTypeRepository extends AbstractRepository
{
    /**
     * @param int $productSetUid
     * @param int $maxCount
     *
     * @return int|null
     * @throws Exception
     */
    public function findProductSetTypeUidByProductSetUid(int $productSetUid, int $maxCount = 0): ?int
    {
        $queryBuilder = GeneralUtility::makeInstance(ConnectionPool::class)
            ->getQueryBuilderForTable('tx_gjoproducts_productset_productsettype_mm');
        $queryBuilder
            ->select('uid_foreign')
            ->from('tx_gjoproducts_productset_productsettype_mm')
            ->where(
                $queryBuilder->expr()->eq('uid_local', $queryBuilder->createNamedParameter($productSetUid, Connection::PARAM_INT))
            );

        if ($maxCount !== 0) {
            $queryBuilder->setMaxResults($maxCount);
        }

        /** @var array<array<string, int>> $rows */
        $rows = $queryBuilder->executeQuery()->fetchAllAssociative();

        return $rows ? (int)$rows[0]['uid_foreign'] : null;
    }
}
