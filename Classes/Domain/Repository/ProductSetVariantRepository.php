<?php

declare(strict_types=1);

namespace GjoSe\GjoProducts\Domain\Repository;

use GjoSe\GjoSitePackage\Domain\Repository\AbstractRepository;
use GjoSe\GjoProducts\Domain\Model\ProductSetVariant;
use TYPO3\CMS\Extbase\Persistence\Exception\InvalidQueryException;

final class ProductSetVariantRepository extends AbstractRepository
{
    /**
     * @param array<string> $productSetVariantFilter
     *
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
