<?php
namespace GjoSe\GjoProducts\Domain\Repository;

use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Core\Database\ConnectionPool;

/***************************************************************
 *  created: 21.10.19 - 11:01
 *  Copyright notice
 *  (c) 2019 Gregory Jo Erdmann <gregory.jo@gjo-se.com>
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

/**
 * Class AccessorykitGroupRepository
 * @package GjoSe\GjoProducts\Domain\Repository
 */
class AccessorykitGroupRepository extends AbstractRepository
{

    /**
     * @return array
     */
    public function findAccessorykitUidsByAccessorykitGroupUid($accessorykitGroupUid)
    {
        $queryBuilder = GeneralUtility::makeInstance(ConnectionPool::class)->getQueryBuilderForTable('tx_gjoproducts_productset_accessorykit_mm');
        $queryBuilder
            ->select('uid_local')
            ->from('tx_gjoproducts_productset_accessorykit_mm')
            ->where(
                $queryBuilder->expr()->eq('uid_foreign', $queryBuilder->createNamedParameter($accessorykitGroupUid, \PDO::PARAM_INT))
            );

        $rows = $queryBuilder->execute()->fetchAll();

        $accessorykitUids = null;
        if(count($rows)){
            foreach ($rows as $row) {
                $accessorykitUids[] = $row['uid_local'];
            }
        }

        return $accessorykitUids;
    }
}