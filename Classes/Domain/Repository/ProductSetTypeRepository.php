<?php

declare(strict_types=1);

namespace GjoSe\GjoProducts\Domain\Repository;

use Doctrine\DBAL\Exception;
use GjoSe\GjoSitePackage\Domain\Repository\AbstractRepository;
use TYPO3\CMS\Core\Database\Connection;
use TYPO3\CMS\Core\Database\ConnectionPool;

final class ProductSetTypeRepository extends AbstractRepository
{
    public function __construct(
        private readonly ConnectionPool $connectionPool
    ) {
        parent::__construct();
    }

    /**
     * @throws Exception
     */
    public function findProductSetTypeUidByProductSetUid(int $productSetUid, int $maxCount = 0): ?int
    {
        $queryBuilder = $this->connectionPool
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
