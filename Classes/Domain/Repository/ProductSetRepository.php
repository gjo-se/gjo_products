<?php

declare(strict_types=1);

namespace GjoSe\GjoProducts\Domain\Repository;

/***************************************************************
 *  created: 04.09.17 - 15:37
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
use GjoSe\GjoBase\Utility\SettingsUtility;
use GjoSe\GjoProducts\Domain\Model\ProductSet;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Extbase\Persistence\Exception\InvalidQueryException;
use TYPO3\CMS\Extbase\Persistence\QueryInterface;
use TYPO3\CMS\Extbase\Persistence\QueryResultInterface;

class ProductSetRepository extends AbstractRepository
{
    private const int SYS_LANGUAGE_UID_DE = 0;

    /**
     *
     * @return QueryResultInterface<ProductSet>|null
     *
     * @throws InvalidQueryException
     */
    public function findBySearchString(string $searchString = '', int $limit = 0): ?QueryResultInterface
    {
        $query = $this->createQuery();
        $query->getQuerySettings()
            ->setRespectStoragePage(false);

        $productSetName = [];
        $accessorykitName = [];
        $searchStringArr = explode(' ', $searchString);
        foreach ($searchStringArr as $searchStringArrVal) {
            $productSetName[] = $query->like('name', '%' . $searchStringArrVal . '%');
            $accessorykitName[] = $query->like('accessorykitGroups.accessoryKits.name', '%' . $searchStringArrVal . '%');
        }

        $query->matching(
            $query->logicalAnd(
                $query->logicalOr(
                    // productSet
                    $query->logicalAnd(...$productSetName),
                    $query->like('productSetVariantGroups.productSetVariants.name', '%' . $searchString . '%'),
                    $query->like('productSetVariantGroups.productSetVariants.articleNumber', '%' . $searchString . '%'),
                    $query->like('productSetVariantGroups.products.name', '%' . $searchString . '%'),
                    $query->like('productSetVariantGroups.products.articleNumber', '%' . $searchString . '%'),
                    // accessoryKit
                    $query->logicalAnd(...$accessorykitName),
                    $query->like('accessorykitGroups.accessoryKits.productSetVariantGroups.productSetVariants.name', '%' . $searchString . '%'),
                    $query->like('accessorykitGroups.accessoryKits.productSetVariantGroups.productSetVariants.articleNumber', '%' . $searchString . '%'),
                    $query->like('accessorykitGroups.accessoryKits.productSetVariantGroups.products.name', '%' . $searchString . '%'),
                    $query->like('accessorykitGroups.accessoryKits.productSetVariantGroups.products.articleNumber', '%' . $searchString . '%')
                ),
                $query->equals('is_accessory_kit', 0)
            )
        );

        $query->setOrderings(
            [
                'is_featured' => QueryInterface::ORDER_DESCENDING,
                'name' => QueryInterface::ORDER_ASCENDING,
            ]
        );

        if ($limit !== 0) {
            $query->setLimit($limit);
        }

        // TODO-a: - Notwenigkeit prüfen
        //        /** @var Context $context */
        //        $context = GeneralUtility::makeInstance(Context::class);
        //        $languageUid = $GLOBALS['TSFE']->sys_language_uid;
        //        /** @var LanguageAspect $languageAspect */
        //        $languageAspect = GeneralUtility::makeInstance(LanguageAspect::class, $languageUid);
        //        $context->setAspect('language', $languageAspect);
        //        $query->getQuerySettings()->setLanguageAspect($context->getAspect('language'));

        return $query->execute();
    }

    /**
     * @param array<int> $accessoryKitUidList
     *
     * @return QueryResultInterface<ProductSet>|null
     *
     * @throws InvalidQueryException
     */
    public function findAccessoryKitByProductSetAndSearchString(array $accessoryKitUidList, string $searchString, int $limit): ?QueryResultInterface
    {
        $sysLanguageUid = $GLOBALS['TSFE']->sys_language_uid;

        $query = $this->createQuery();
        $query->getQuerySettings()
            ->setRespectStoragePage(false);

        if ($sysLanguageUid != self::SYS_LANGUAGE_UID_DE) {
            $accessoryKitList = $query->in('l10n_parent', $accessoryKitUidList);
        } else {
            $accessoryKitList = $query->in('uid', $accessoryKitUidList);
        }

        $accessoryKitName = [];
        $searchStringArr = explode(' ', $searchString);
        foreach ($searchStringArr as $searchStringArrVal) {
            $accessoryKitName[] = $query->like('name', '%' . $searchStringArrVal . '%');
        }

        $query->matching(
            $query->logicalAnd(
                $query->equals('is_accessory_kit', 1),
                $accessoryKitList,
                $query->logicalOr(
                    $query->logicalAnd(...$accessoryKitName),
                    $query->like('productSetVariantGroups.productSetVariants.name', '%' . $searchString . '%'),
                    $query->like('productSetVariantGroups.productSetVariants.articleNumber', '%' . $searchString . '%'),
                    $query->like('productSetVariantGroups.products.name', '%' . $searchString . '%'),
                    $query->like('productSetVariantGroups.products.articleNumber', '%' . $searchString . '%')
                )
            )
        );

        $query->setOrderings(
            [
                'productSetVariantGroups.products.name' => QueryInterface::ORDER_ASCENDING,
            ]
        );

        if ($limit !== 0) {
            $query->setLimit($limit);
        }

        //        $context = GeneralUtility::makeInstance(Context::class);
        //        $languageAspect = GeneralUtility::makeInstance(LanguageAspect::class, $sysLanguageUid);
        //        $context->setAspect('language', $languageAspect);
        //        $query->getQuerySettings()->setLanguageAspect($context->getAspect('language'));

        return $query->execute();
    }

    /**
     * @param array<string> $productFinderFilter
     *
     * @return QueryResultInterface<ProductSet>|null
     *
     * @throws InvalidQueryException
     */
    public function findByFilter(int $sysLanguageUid, array $productFinderFilter = [], int $offset = 0, int $limit = 0): ?QueryResultInterface
    {
        // todo-b: Settings aus typoscript in yaml
        $settings = GeneralUtility::makeInstance(SettingsUtility::class)->getSettings();
        $pluginSignature = 'tx_gjoproducts_product[';
        $query = $this->createQuery();

        $constraints = [];
        $constraints[] = $query->equals('is_accessory_kit', 0);

        if ($productFinderFilter !== []) {

            if (isset($productFinderFilter[$pluginSignature . 'wood'])) {
                if ($productFinderFilter[$pluginSignature . 'wood'] == '1') {
                    $constraints[] = $query->equals('filterMaterialWood', 1);
                }
            }

            if (isset($productFinderFilter[$pluginSignature . 'glass'])) {
                if ($productFinderFilter[$pluginSignature . 'glass'] == '1') {
                    $constraints[] = $query->equals('filterMaterialGlas', 1);
                }
            }

            if (isset($productFinderFilter[$pluginSignature . 'wingCount'])) {
                if ($productFinderFilter[$pluginSignature . 'wingCount'] !== '' && $productFinderFilter[$pluginSignature . 'wingCount'] !== '0') {
                    $constraints[] = $query->like('filterWingcount', '%' . $productFinderFilter[$pluginSignature . 'wingCount'] . '%');
                }
            }

            if (isset($productFinderFilter[$pluginSignature . 'doorWidth'])) {
                if ($productFinderFilter[$pluginSignature . 'doorWidth'] !== '' && $productFinderFilter[$pluginSignature . 'doorWidth'] !== '0') {
                    $constraints[] = $query->lessThanOrEqual(
                        'minimumDoorWidth',
                        (int)($productFinderFilter[$pluginSignature . 'doorWidth'])
                    );
                    $constraints[] = $query->greaterThanOrEqual('maximumDoorWidth', $productFinderFilter[$pluginSignature . 'doorWidth']);
                }
            }

            if (isset($productFinderFilter[$pluginSignature . 'doorThickness'])) {
                if ($productFinderFilter[$pluginSignature . 'doorThickness'] !== '' && $productFinderFilter[$pluginSignature . 'doorThickness'] !== '0') {
                    $constraints[] = $query->lessThanOrEqual(
                        'minimumDoorThickness',
                        (int)($productFinderFilter[$pluginSignature . 'doorThickness'])
                    );
                    $constraints[] = $query->greaterThanOrEqual(
                        'maximumDoorThickness',
                        $productFinderFilter[$pluginSignature . 'doorThickness']
                    );
                }
            }

            if (isset($productFinderFilter[$pluginSignature . 'doorWeight'])) {
                if ($productFinderFilter[$pluginSignature . 'doorWeight'] !== '' && $productFinderFilter[$pluginSignature . 'doorWeight'] !== '0') {
                    $constraints[] = $query->lessThanOrEqual(
                        'minimumDoorWeight',
                        (int)($productFinderFilter[$pluginSignature . 'doorWeight'])
                    );
                    $constraints[] = $query->greaterThanOrEqual('maximumDoorWeight', $productFinderFilter[$pluginSignature . 'doorWeight']);
                }
            }

            if (isset($productFinderFilter[$pluginSignature . 'customer'])) {
                if ($productFinderFilter[$pluginSignature . 'customer'] == '1') {
                    $constraints[] = $query->equals('filterDesignCustomer', 1);
                }
            }

            if (isset($productFinderFilter[$pluginSignature . 'alu'])) {
                if ($productFinderFilter[$pluginSignature . 'alu'] == '1') {
                    $constraints[] = $query->equals('filterDesignAlu', 1);
                }
            }

            if (isset($productFinderFilter[$pluginSignature . 'design'])) {
                if ($productFinderFilter[$pluginSignature . 'design'] == '1') {
                    $constraints[] = $query->equals('filterDesignDesign', 1);
                }
            }

            if (isset($productFinderFilter[$pluginSignature . 'soft-close'])) {
                if ($productFinderFilter[$pluginSignature . 'soft-close'] == '1') {

                    $constraintsFilterSoftClose = $query->equals('filterSoftClose', 1);

                    if ($productFinderFilter[$pluginSignature . 'doorWidth'] !== '' && $productFinderFilter[$pluginSignature . 'doorWidth'] !== '0') {
                        $constraintsMinimumDoorWidth = $query->lessThanOrEqual('minimumDoorWidthSoftClose', (int)($productFinderFilter[$pluginSignature . 'doorWidth']));
                    } else {
                        $constraintsMinimumDoorWidth = $query->lessThanOrEqual('minimumDoorWidthSoftClose', 9999);
                    }

                    $constraintsAlu80SoftClose = $query->equals('filterSoftClose', 1);
                    if ($productFinderFilter[$pluginSignature . 'telescop2'] == $settings['productset']['alu-80']['softClose']['telescop2']) {
                        $constraintsAlu80SoftClose = $query->logicalNot(
                            $query->equals('name', 'ALU 80 NEO')
                        );
                    }
                    if ($productFinderFilter[$pluginSignature . 'telescop3'] == $settings['productset']['alu-80']['softClose']['telescop3']) {
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
            }

            if (isset($productFinderFilter[$pluginSignature . 'et3'])) {
                if ($productFinderFilter[$pluginSignature . 'et3'] == '1') {
                    $constraints[] = $query->equals('filterEt3', 1);
                }
            }

            if (isset($productFinderFilter[$pluginSignature . 't-fold'])) {
                if ($productFinderFilter[$pluginSignature . 't-fold'] == '1') {
                    $constraints[] = $query->equals('filterTfold', 1);
                }
            }

            if (isset($productFinderFilter[$pluginSignature . 'synchron'])) {
                if ($productFinderFilter[$pluginSignature . 'synchron'] == '1') {

                    $constraintsAlu80Syncron = $query->equals('filterSynchron', 1);
                    if ($productFinderFilter[$pluginSignature . 'doorWidth'] > $settings['productset']['alu-80']['synchron']['maximumDoorWidth']) {
                        $constraintsAlu80Syncron = $query->logicalNot(
                            $query->equals('name', 'ALU 80 NEO')
                        );
                    }
                    if ($productFinderFilter[$pluginSignature . 'soft-close'] == $settings['productset']['alu-80']['synchron']['softClose']) {
                        $constraintsAlu80Syncron = $query->logicalNot(
                            $query->equals('name', 'ALU 80 NEO')
                        );
                    }
                    if ($productFinderFilter[$pluginSignature . 'telescop2'] == $settings['productset']['alu-80']['synchron']['telescop2']) {
                        $constraintsAlu80Syncron = $query->logicalNot(
                            $query->equals('name', 'ALU 80 NEO')
                        );
                    }
                    if ($productFinderFilter[$pluginSignature . 'telescop3'] == $settings['productset']['alu-80']['synchron']['telescop3']) {
                        $constraintsAlu80Syncron = $query->logicalNot(
                            $query->equals('name', 'ALU 80 NEO')
                        );
                    }

                    $constraintsAlu250Syncron = $query->equals('filterSynchron', 1);
                    if ($productFinderFilter[$pluginSignature . 'doorWeight'] > $settings['productset']['alu-250']['synchron']['maximumDoorWeight']) {
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
            }

            if (isset($productFinderFilter[$pluginSignature . 'telescop2'])) {
                if ($productFinderFilter[$pluginSignature . 'telescop2'] !== '' && $productFinderFilter[$pluginSignature . 'telescop2'] !== '0') {

                    $constraintsAlu80Telescop2 = $query->equals('filterTelescop2', 1);

                    $doorWidth = $productFinderFilter[$pluginSignature . 'doorWidth'];
                    $minimumDoorWidth = $settings['productset']['alu-80']['telescop2']['minimumDoorWidth'];
                    $maximumDoorWidth = $settings['productset']['alu-80']['telescop2']['maximumDoorWidth'];

                    $doorThickness = $productFinderFilter[$pluginSignature . 'doorThickness'];
                    $minimumDoorThickness = $settings['productset']['alu-80']['telescop2']['minimumDoorThickness'];
                    $maximumDoorThickness = $settings['productset']['alu-80']['telescop2']['maximumDoorThickness'];

                    if (($doorWidth > 0 && $doorWidth < $minimumDoorWidth) or
                        ($doorWidth > 0 && $doorWidth > $maximumDoorWidth) or
                        ($doorThickness > 0 && $doorThickness < $minimumDoorThickness) or
                        ($doorThickness > 0 && $doorThickness > $maximumDoorThickness)
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
            }

            if (isset($productFinderFilter[$pluginSignature . 'telescop3'])) {
                if ($productFinderFilter[$pluginSignature . 'telescop3'] !== '' && $productFinderFilter[$pluginSignature . 'telescop3'] !== '0') {

                    $constraintsAlu80Telescop3 = $query->equals('filterTelescop3', 1);

                    $doorWidth = $productFinderFilter[$pluginSignature . 'doorWidth'];
                    $minimumDoorWidth = $settings['productset']['alu-80']['telescop3']['minimumDoorWidth'];
                    $maximumDoorWidth = $settings['productset']['alu-80']['telescop3']['maximumDoorWidth'];

                    $doorThickness = $productFinderFilter[$pluginSignature . 'doorThickness'];
                    $minimumDoorThickness = $settings['productset']['alu-80']['telescop3']['minimumDoorThickness'];
                    $maximumDoorThickness = $settings['productset']['alu-80']['telescop3']['maximumDoorThickness'];

                    $doorWeight = $productFinderFilter[$pluginSignature . 'doorWeight'];
                    $maximumDoorWeight = $settings['productset']['alu-80']['telescop3']['maximumDoorWeight'];

                    if (($doorWidth > 0 && $doorWidth < $minimumDoorWidth) or
                        ($doorWidth > 0 && $doorWidth > $maximumDoorWidth) or
                        ($doorThickness > 0 && $doorThickness < $minimumDoorThickness) or
                        ($doorThickness > 0 && $doorThickness > $maximumDoorThickness) or
                        ($doorWeight > 0 && $doorWeight > $maximumDoorWeight)
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
            }

            if (isset($productFinderFilter[$pluginSignature . 't-close'])) {
                if ($productFinderFilter[$pluginSignature . 't-close'] == '1') {
                    $constraints[] = $query->equals('filterTclose', 1);
                }
            }

            if (isset($productFinderFilter[$pluginSignature . 't-master'])) {
                if ($productFinderFilter[$pluginSignature . 't-master'] == '1') {
                    $constraints[] = $query->equals('filterTmaster', 1);
                }
            }

            if (isset($productFinderFilter[$pluginSignature . 'montage-wall'])) {
                if ($productFinderFilter[$pluginSignature . 'montage-wall'] == '1') {
                    $constraints[] = $query->equals('filterMontageWall', 1);
                }
            }

            if (isset($productFinderFilter[$pluginSignature . 'montage-ceiling'])) {
                if ($productFinderFilter[$pluginSignature . 'montage-ceiling'] == '1') {
                    $constraints[] = $query->equals('filterMontageCeiling', 1);
                }
            }

            if (isset($productFinderFilter[$pluginSignature . 'montage-in-wall'])) {
                if ($productFinderFilter[$pluginSignature . 'montage-in-wall'] == '1') {
                    $constraints[] = $query->equals('filterMontageIn', 1);
                }
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
                'is_featured' => QueryInterface::ORDER_DESCENDING,
                'name' => QueryInterface::ORDER_ASCENDING,
            ]
        );

        //        $context = GeneralUtility::makeInstance(Context::class);
        //        $languageAspect = GeneralUtility::makeInstance(LanguageAspect::class, $sysLanguageUid);
        //        $context->setAspect('language', $languageAspect);
        //        $query->getQuerySettings()->setLanguageAspect($context->getAspect('language'));

        return $query->execute();
    }

    /**
     * @return array<string>
     */
    public function findAllWithVariants(): array
    {
        $query = $this->createQuery();
        $query->getQuerySettings()
            ->setRespectStoragePage(false);

        $query->setOrderings(
            [
                'name' => QueryInterface::ORDER_ASCENDING,
            ]
        );

        $queryResult = $query->execute();

        $productSetWithVariants = [];
        if ($queryResult->count()) {
            /** @var ProductSet $productSet */
            foreach ($queryResult as $productSet) {

                $productSetVariantGroups = $productSet->getProductSetVariantGroups();
                if ($productSetVariantGroups !== null) {
                    foreach ($productSetVariantGroups as $productSetVariantGroup) {
                        $productSetVariants = $productSetVariantGroup->getProductSetVariants();

                        if ($productSetVariants !== null) {
                            foreach ($productSetVariants as $productSetVariant) {
                                $productSetWithVariants [$productSetVariant->getArticleNumber()] = $productSet->getName() . ' - ' . $productSetVariantGroup->getTableHeadline() . ' - ' . $productSetVariant->getName();
                            }
                        }
                    }
                }
            }
        }

        return $productSetWithVariants;
    }
}
