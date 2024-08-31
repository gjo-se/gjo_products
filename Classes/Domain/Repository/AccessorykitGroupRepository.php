<?php

declare(strict_types=1);

namespace GjoSe\GjoProducts\Domain\Repository;

use Doctrine\DBAL\Exception;
use GjoSe\GjoApi\Domain\Repository\AbstractRepository;
use TYPO3\CMS\Core\Database\Connection;
use TYPO3\CMS\Core\Database\ConnectionPool;

final class AccessorykitGroupRepository extends AbstractRepository
{
    public function __construct(
        private readonly ConnectionPool $connectionPool
    ) {
        parent::__construct();
    }

    /**
     * @return array<int>
     * @throws Exception
     */
    public function findAccessorykitUidsByAccessorykitGroupUid(int $accessorykitGroupUid): array
    {
        $queryBuilder = $this->connectionPool
            ->getQueryBuilderForTable('tx_gjoproducts_productset_accessorykit_mm');
        $queryBuilder
            ->select('uid_local')
            ->from('tx_gjoproducts_productset_accessorykit_mm')
            ->where(
                $queryBuilder->expr()->eq('uid_foreign', $queryBuilder->createNamedParameter($accessorykitGroupUid, Connection::PARAM_INT))
            );

        /** @var array<array<string, int>> $rows */
        $rows = $queryBuilder->executeQuery()->fetchAllAssociative();

        $accessorykitUids = [];
        if (count($rows) !== 0) {
            foreach ($rows as $row) {
                $accessorykitUids[] = $row['uid_local'];
            }
        }

        return $accessorykitUids;
    }
}
