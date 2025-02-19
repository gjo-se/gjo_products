<?php

declare(strict_types=1);

namespace GjoSe\GjoProducts\Domain\Repository;

use GjoSe\GjoProducts\Domain\Model\ProductSet;
use GjoSe\GjoApi\Domain\Repository\AbstractRepository;
use TYPO3\CMS\Extbase\Persistence\Exception\InvalidQueryException;
use TYPO3\CMS\Extbase\Persistence\QueryInterface;
use TYPO3\CMS\Extbase\Persistence\QueryResultInterface;

final class ProductSetRepository extends AbstractRepository
{
    /**
     *
     * @return QueryResultInterface<ProductSet>|null
     *
     * @throws InvalidQueryException
     */
    public function findByFilter(array $siteSettings, array $productFinderFilter = [], int $offset = 0, int $limit = 0): ?QueryResultInterface
    {
        $query = $this->createQuery();
        $query->getQuerySettings()
            ->setRespectStoragePage(false);

        $pluginSignature = 'tx_gjoproducts_productfinder[';
        $constraints = [];
        $constraints[] = $query->equals('is_accessory_kit', 0);

        if ($productFinderFilter !== []) {

            if (isset($productFinderFilter[$pluginSignature . 'wood']) && $productFinderFilter[$pluginSignature . 'wood'] === '1') {
                $constraints[] = $query->equals('filterMaterialWood', 1);
            }

            if (isset($productFinderFilter[$pluginSignature . 'glass']) && $productFinderFilter[$pluginSignature . 'glass'] === '1') {
                $constraints[] = $query->equals('filterMaterialGlas', 1);
            }

            if (isset($productFinderFilter[$pluginSignature . 'wingCount']) && ($productFinderFilter[$pluginSignature . 'wingCount'] !== '' && $productFinderFilter[$pluginSignature . 'wingCount'] !== '0')) {
                $constraints[] = $query->like('filterWingcount', '%' . $productFinderFilter[$pluginSignature . 'wingCount'] . '%');
            }

            if (isset($productFinderFilter[$pluginSignature . 'doorWidth']) && ($productFinderFilter[$pluginSignature . 'doorWidth'] !== '' && $productFinderFilter[$pluginSignature . 'doorWidth'] !== '0')) {
                $constraints[] = $query->lessThanOrEqual(
                    'minimumDoorWidth',
                    (int)($productFinderFilter[$pluginSignature . 'doorWidth'])
                );
                $constraints[] = $query->greaterThanOrEqual('maximumDoorWidth', $productFinderFilter[$pluginSignature . 'doorWidth']);
            }

            if (isset($productFinderFilter[$pluginSignature . 'doorThickness']) && ($productFinderFilter[$pluginSignature . 'doorThickness'] !== '' && $productFinderFilter[$pluginSignature . 'doorThickness'] !== '0')) {
                $constraints[] = $query->lessThanOrEqual(
                    'minimumDoorThickness',
                    (int)($productFinderFilter[$pluginSignature . 'doorThickness'])
                );
                $constraints[] = $query->greaterThanOrEqual(
                    'maximumDoorThickness',
                    (int)$productFinderFilter[$pluginSignature . 'doorThickness']
                );
            }

            if (isset($productFinderFilter[$pluginSignature . 'doorWeight']) && ($productFinderFilter[$pluginSignature . 'doorWeight'] !== '' && $productFinderFilter[$pluginSignature . 'doorWeight'] !== '0')) {
                $constraints[] = $query->lessThanOrEqual(
                    'minimumDoorWeight',
                    (int)($productFinderFilter[$pluginSignature . 'doorWeight'])
                );
                $constraints[] = $query->greaterThanOrEqual('maximumDoorWeight', $productFinderFilter[$pluginSignature . 'doorWeight']);
            }

            if (isset($productFinderFilter[$pluginSignature . 'customer']) && $productFinderFilter[$pluginSignature . 'customer'] === '1') {
                $constraints[] = $query->equals('filterDesignCustomer', 1);
            }

            if (isset($productFinderFilter[$pluginSignature . 'alu']) && $productFinderFilter[$pluginSignature . 'alu'] === '1') {
                $constraints[] = $query->equals('filterDesignAlu', 1);
            }

            if (isset($productFinderFilter[$pluginSignature . 'design']) && $productFinderFilter[$pluginSignature . 'design'] === '1') {
                $constraints[] = $query->equals('filterDesignDesign', 1);
            }

            if (isset($productFinderFilter[$pluginSignature . 'soft-close']) && $productFinderFilter[$pluginSignature . 'soft-close'] === '1') {
                $constraintsFilterSoftClose = $query->equals('filterSoftClose', 1);
                if ($productFinderFilter[$pluginSignature . 'doorWidth'] !== '' && $productFinderFilter[$pluginSignature . 'doorWidth'] !== '0') {
                    $constraintsMinimumDoorWidth = $query->lessThanOrEqual('minimumDoorWidthSoftClose', (int)($productFinderFilter[$pluginSignature . 'doorWidth']));
                } else {
                    $constraintsMinimumDoorWidth = $query->lessThanOrEqual('minimumDoorWidthSoftClose', 9999);
                }

                $constraintsAlu80SoftClose = $query->equals('filterSoftClose', 1);
                if (isset($productFinderFilter[$pluginSignature . 'telescop2']) && $productFinderFilter[$pluginSignature . 'telescop2'] == 1) {
                    $constraintsAlu80SoftClose = $query->logicalNot(
                        $query->equals('name', 'ALU 80 NEO')
                    );
                }

                if (isset($productFinderFilter[$pluginSignature . 'telescop3']) && $productFinderFilter[$pluginSignature . 'telescop3'] == 1) {
                    $constraintsAlu80SoftClose = $query->logicalNot(
                        $query->equals('name', 'ALU 80 NEO')
                    );
                }

                $constraints[] = $query->logicalAnd(
                    $constraintsFilterSoftClose,
                    $constraintsAlu80SoftClose,
                    $constraintsMinimumDoorWidth
                );
            }

            if (isset($productFinderFilter[$pluginSignature . 'et3']) && $productFinderFilter[$pluginSignature . 'et3'] === '1') {
                $constraints[] = $query->equals('filterEt3', 1);
            }

            if (isset($productFinderFilter[$pluginSignature . 't-fold']) && $productFinderFilter[$pluginSignature . 't-fold'] === '1') {
                $constraints[] = $query->equals('filterTfold', 1);
            }

            if (isset($productFinderFilter[$pluginSignature . 'synchron']) && $productFinderFilter[$pluginSignature . 'synchron'] === '1') {
                $constraintsAlu80Syncron = $query->equals('filterSynchron', 1);
                if (isset($siteSettings['gjoproducts_productfinder']['synchron']['alu-80']['maximumDoorWidth'])
                    && (int)$productFinderFilter[$pluginSignature . 'doorWidth'] > (int)$siteSettings['gjoproducts_productfinder']['synchron']['alu-80']['maximumDoorWidth']) {
                    $constraintsAlu80Syncron = $query->logicalNot(
                        $query->equals('name', 'ALU 80 NEO')
                    );
                }

                if (isset($productFinderFilter[$pluginSignature . 'soft-close']) && (int)$productFinderFilter[$pluginSignature . 'soft-close'] === 1) {
                    $constraintsAlu80Syncron = $query->logicalNot(
                        $query->equals('name', 'ALU 80 NEO')
                    );
                }

                if (isset($productFinderFilter[$pluginSignature . 'telescop2']) && (int)$productFinderFilter[$pluginSignature . 'telescop2'] === 1) {
                    $constraintsAlu80Syncron = $query->logicalNot(
                        $query->equals('name', 'ALU 80 NEO')
                    );
                }

                if (isset($productFinderFilter[$pluginSignature . 'telescop3']) && (int)$productFinderFilter[$pluginSignature . 'telescop3'] === 1) {
                    $constraintsAlu80Syncron = $query->logicalNot(
                        $query->equals('name', 'ALU 80 NEO')
                    );
                }

                $constraintsAlu250Syncron = $query->equals('filterSynchron', 1);
                if (isset($siteSettings['gjoproducts_productfinder']['synchron']['alu-250']['maximumDoorWeight'])
                    && (int)$productFinderFilter[$pluginSignature . 'doorWeight'] > (int)$siteSettings['gjoproducts_productfinder']['synchron']['alu-250']['maximumDoorWeight']) {
                    $constraintsAlu250Syncron = $query->logicalNot(
                        $query->like('name', '%Alu 250%')
                    );
                }

                $constraints[] = $query->logicalAnd(
                    $query->equals('filterSynchron', 1),
                    $constraintsAlu80Syncron,
                    $constraintsAlu250Syncron
                );
            }

            if (isset($productFinderFilter[$pluginSignature . 'telescop2']) && (int)$productFinderFilter[$pluginSignature . 'telescop2'] === 1) {
                $constraintsAlu80Telescop2 = $query->equals('filterTelescop2', 1);

                $doorWidth = $productFinderFilter[$pluginSignature . 'doorWidth'] ?? 0;
                $minimumDoorWidth = $siteSettings['gjoproducts_productfinder']['telescop2']['minimumDoorWidth'] ?? 0;
                $maximumDoorWidth = $siteSettings['gjoproducts_productfinder']['telescop2']['maximumDoorWidth'] ?? 0;

                $doorThickness = $productFinderFilter[$pluginSignature . 'doorThickness'] ?? 0;
                $minimumDoorThickness = $siteSettings['gjoproducts_productfinder']['telescop2']['minimumDoorThickness'] ?? 0;
                $maximumDoorThickness = $siteSettings['gjoproducts_productfinder']['telescop2']['maximumDoorThickness'] ?? 0;

                if (
                    $doorWidth > 0 && $doorWidth < $minimumDoorWidth
                    || $doorWidth > 0 && $doorWidth > $maximumDoorWidth
                    || $doorThickness > 0 && $doorThickness < $minimumDoorThickness
                    || $doorThickness > 0 && $doorThickness > $maximumDoorThickness
                ) {

                    $constraintsAlu80Telescop2 = $query->logicalNot(
                        $query->equals('name', 'ALU 80 NEO')
                    );
                }

                $constraints[] = $query->logicalAnd(
                    $query->equals('filterTelescop2', 1),
                    $constraintsAlu80Telescop2
                );
            }

            if (isset($productFinderFilter[$pluginSignature . 'telescop3']) && (int)$productFinderFilter[$pluginSignature . 'telescop3'] === 1) {
                $constraintsAlu80Telescop3 = $query->equals('filterTelescop3', 1);

                $doorWidth = $productFinderFilter[$pluginSignature . 'doorWidth'] ?? 0;
                $minimumDoorWidth = $siteSettings['gjoproducts_productfinder']['telescop3']['minimumDoorWidth'] ?? 0;
                $maximumDoorWidth = $siteSettings['gjoproducts_productfinder']['telescop3']['maximumDoorWidth'] ?? 0;

                $doorThickness = $productFinderFilter[$pluginSignature . 'doorThickness'] ?? 0;
                $minimumDoorThickness = $siteSettings['gjoproducts_productfinder']['telescop3']['minimumDoorThickness'] ?? 0;
                $maximumDoorThickness = $siteSettings['gjoproducts_productfinder']['telescop3']['maximumDoorThickness'] ?? 0;

                $doorWeight = $productFinderFilter[$pluginSignature . 'doorWeight'] ?? 0;
                $maximumDoorWeight = $siteSettings['gjoproducts_productfinder']['telescop3']['maximumDoorWeight'] ?? 0;

                if (
                    $doorWidth > 0 && $doorWidth < $minimumDoorWidth
                    || $doorWidth > 0 && $doorWidth > $maximumDoorWidth
                    || $doorThickness > 0 && $doorThickness < $minimumDoorThickness
                    || $doorThickness > 0 && $doorThickness > $maximumDoorThickness
                    || $doorWeight > 0 && $doorWeight > $maximumDoorWeight
                ) {
                    $constraintsAlu80Telescop3 = $query->logicalNot(
                        $query->equals('name', 'ALU 80 NEO')
                    );
                }

                $constraints[] = $query->logicalAnd(
                    $query->equals('filterTelescop3', 1),
                    $constraintsAlu80Telescop3
                );
            }

            if (isset($productFinderFilter[$pluginSignature . 't-close']) && $productFinderFilter[$pluginSignature . 't-close'] === '1') {
                $constraints[] = $query->equals('filterTclose', 1);
            }

            if (isset($productFinderFilter[$pluginSignature . 't-master']) && $productFinderFilter[$pluginSignature . 't-master'] === '1') {
                $constraints[] = $query->equals('filterTmaster', 1);
            }

            if (isset($productFinderFilter[$pluginSignature . 'montage-wall']) && $productFinderFilter[$pluginSignature . 'montage-wall'] === '1') {
                $constraints[] = $query->equals('filterMontageWall', 1);
            }

            if (isset($productFinderFilter[$pluginSignature . 'montage-ceiling']) && $productFinderFilter[$pluginSignature . 'montage-ceiling'] === '1') {
                $constraints[] = $query->equals('filterMontageCeiling', 1);
            }

            if (isset($productFinderFilter[$pluginSignature . 'montage-in-wall']) && $productFinderFilter[$pluginSignature . 'montage-in-wall'] === '1') {
                $constraints[] = $query->equals('filterMontageIn', 1);
            }

        }

        $query->matching($query->logicalAnd(...$constraints));

        if ($offset !== 0) {
            $query->setOffset($offset);
        }

        if ($limit !== 0) {
            $query->setLimit($limit);
        }

        $query->setOrderings(
            [
                'is_featured' => QueryInterface::ORDER_ASCENDING,
                'name' => QueryInterface::ORDER_ASCENDING,
            ]
        );

        return $query->execute();
    }
}
