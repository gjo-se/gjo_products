<?php

declare(strict_types=1);

namespace GjoSe\GjoProducts\Controller;

/***************************************************************
 *  created: 05.09.17 - 14:46
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

use GjoSe\GjoBase\Controller\AbstractController;
use GjoSe\GjoProducts\Domain\Repository\AccessorykitGroupRepository;
use GjoSe\GjoProducts\Domain\Repository\ProductGroupRepository;
use GjoSe\GjoProducts\Domain\Repository\ProductSetRepository;
use GjoSe\GjoProducts\Domain\Repository\ProductSetTypeRepository;
use GjoSe\GjoProducts\Domain\Repository\ProductSetVariantRepository;
use Psr\Http\Message\ResponseInterface;
use TYPO3\CMS\Core\Context\Context;
use TYPO3\CMS\Core\Context\Exception\AspectNotFoundException;
use TYPO3\CMS\Core\Localization\LocalizationFactory;
use TYPO3\CMS\Core\Routing\PageArguments;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Extbase\Configuration\ConfigurationManagerInterface;
use TYPO3\CMS\Extbase\Persistence\Exception\InvalidQueryException;
use TYPO3\CMS\Extbase\Persistence\QueryResultInterface;

final class ProductController extends AbstractController
{
    public function __construct(
        private readonly AccessorykitGroupRepository $accessorykitGroupRepository,
        private readonly ProductGroupRepository $productGroupRepository,
        private readonly ProductSetRepository $productSetRepository,
        private readonly ProductSetTypeRepository $productSetTypeRepository,
        private readonly ProductSetVariantRepository $productSetVariantRepository,
        private readonly Context $context,
        LocalizationFactory $localizationFactory
    ) {}

    public function showProductGroupTeaserAction(): ResponseInterface
    {
        // todo-a: move to MediaUtility
        $breakpoints = [
            0 => ['cropVariant' => 'wideScreen', 'media' => '(min-width: 1200px)', 'srcset' => [0 => 1100]],
            1 => ['cropVariant' => 'desktop', 'media' => '(min-width: 992px)', 'srcset' => [0 => 950]],
            2 => ['cropVariant' => 'laptop', 'media' => '(min-width: 768px)', 'srcset' => [0 => 720]],
            3 => ['cropVariant' => 'tablet', 'media' => '(min-width: 576px)', 'srcset' => [0 => 540]],
            4 => ['cropVariant' => 'mobile', 'media' => '(min-width: 300px)', 'srcset' => [0 => 350]],
        ];

        // todo-a: move to __constuct()
        /**
         * @var \TYPO3\CMS\Frontend\ContentObject\ContentObjectRenderer $currentContentObject
         */
        $currentContentObject = $this->request->getAttribute('currentContentObject');

        $this->view->assignMultiple([
            'data' => $currentContentObject->data,
            'breakpoints' => $breakpoints,
            'productGroup' => $this->productGroupRepository->findByUid($this->settings['productGroup']),
        ]);

        return $this->htmlResponse();
    }

    public function showProductGroupAction(): ResponseInterface
    {
        // todo-a: move to MediaUtility
        $breakpoints = [
            0 => ['cropVariant' => 'wideScreen', 'media' => '(min-width: 1200px)', 'srcset' => [0 => 1100]],
            1 => ['cropVariant' => 'desktop', 'media' => '(min-width: 992px)', 'srcset' => [0 => 950]],
            2 => ['cropVariant' => 'laptop', 'media' => '(min-width: 768px)', 'srcset' => [0 => 720]],
            3 => ['cropVariant' => 'tablet', 'media' => '(min-width: 576px)', 'srcset' => [0 => 540]],
            4 => ['cropVariant' => 'mobile', 'media' => '(min-width: 300px)', 'srcset' => [0 => 350]],
        ];

        // todo-a: move to __constuct()
        /**
         * @var \TYPO3\CMS\Frontend\ContentObject\ContentObjectRenderer $currentContentObject
         */
        $currentContentObject = $this->request->getAttribute('currentContentObject');

        $this->view->assignMultiple([
            'data' => $currentContentObject->data,
            'breakpoints' => $breakpoints,
            'productGroup' => $this->productGroupRepository->findByUid($this->settings['productGroup']),
        ]);

        return $this->htmlResponse();
    }

    public function showProductSetAction(): ResponseInterface
    {
        $productSet = $this->productSetRepository->findByUid($this->settings['productSet']);

        $productSetTypeUid = $this->productSetTypeRepository->findProductSetTypeUidByProductSetUid((int)$this->settings['productSet'], 1);
        $productSetType = $this->productSetTypeRepository->findByUid($productSetTypeUid);

        // todo-a: move to MediaUtility
        $breakpoints = [
            0 => ['cropVariant' => 'wideScreen', 'media' => '(min-width: 1200px)', 'srcset' => [0 => 1100]],
            1 => ['cropVariant' => 'desktop', 'media' => '(min-width: 992px)', 'srcset' => [0 => 950]],
            2 => ['cropVariant' => 'laptop', 'media' => '(min-width: 768px)', 'srcset' => [0 => 720]],
            3 => ['cropVariant' => 'tablet', 'media' => '(min-width: 576px)', 'srcset' => [0 => 540]],
            4 => ['cropVariant' => 'mobile', 'media' => '(min-width: 300px)', 'srcset' => [0 => 350]],
        ];

        // todo-a: move to __constuct()
        /**
         * @var \TYPO3\CMS\Frontend\ContentObject\ContentObjectRenderer $currentContentObject
         */
        $currentContentObject = $this->request->getAttribute('currentContentObject');

        $productGroup = null;
        if ($productSetType) {
            $productGroup = $productSetType->getProductGroup();
        }

        /**
         * @var PageArguments $siteRoute
         */
        $siteRoute = $this->request->getAttribute('routing');
        $pageUid = $siteRoute->getPageId();

        $this->view->assignMultiple([
            'data' => $currentContentObject->data,
            'breakpoints' => $breakpoints,
            'productSet' => $productSet,
            'productGroup' => $productGroup,
            'is_shop' => $this->request->getQueryParams()['is_shop'] ?? false,
            'pageUid' => $pageUid,
        ]);
        return $this->htmlResponse();
    }

    public function ajaxProductSetAction(): ResponseInterface
    {
        $limit = 0;
        $postParams = $this->request->getParsedBody();
        $searchString = $postParams['searchString'];
        $productSets = $this->productSetRepository->findBySearchString($searchString, $limit);

        $productSetsArr = [];

        foreach ($productSets as $productSet) {

            $accessoryKitUids = [];
            $pageUid = 0;
            if ($productSet->getPages()) {
                $pageUid = $productSet->getPages()->getUid();

                if ($pageUid) {
                    $productSetsArr[$productSet->getUid()] = [
                        'name' => $productSet->getName(),
                        'pageUid' => $pageUid,
                    ];
                }

                $accessorykitGroups = $productSet->getAccessorykitGroups();
                $accessorykitGroupUids = [];
                if ($accessorykitGroups) {
                    foreach ($accessorykitGroups as $accessorykitGroup) {
                        $accessorykitGroupUids[] = $accessorykitGroup->getUid();
                    }
                }

                $accessorykitUids = [];
                foreach ($accessorykitGroupUids as $accessorykitGroupUid) {
                    $accessorykitUidsTemp = $this->accessorykitGroupRepository->findAccessorykitUidsByAccessorykitGroupUid($accessorykitGroupUid);
                    foreach ($accessorykitUidsTemp as $accessorykitUidTemp) {
                        $accessorykitUids[] = $accessorykitUidTemp;
                    }
                }

                if ($accessorykitUids !== []) {
                    $productSetAccessoryKits = $this->productSetRepository->findAccessoryKitByProductSetAndSearchString(
                        $accessorykitUids,
                        $searchString,
                        $limit
                    );

                    if ($productSetAccessoryKits instanceof QueryResultInterface) {
                        foreach ($productSetAccessoryKits as $productSetAccessoryKit) {
                            $productSetsArr[$productSet->getUid()]['accessoryKits'][$productSetAccessoryKit->getUid()] = [
                                'name' => $productSetAccessoryKit->getName(),
                                'anchor' => $productSetAccessoryKit->getAnchor(),
                            ];
                        }
                    }
                }

                $this->view->assign('productSetsArr', $productSetsArr);

            }
        }

        $this->view->assign('searchString', $searchString);
        $this->view->assign('searchNoProductSetsFound1', $this->translate('search.noProductSetsFound.1'));
        $this->view->assign('searchNoProductSetsFound2', $this->translate('search.noProductSetsFound.2'));
        return $this->htmlResponse();

    }

    /**
     * Returns the translation of $key from the specified language file
     *
     * @param string $key The key from the localization file
     * @param string $language The language to use (default is 'default')
     * @return string The translated string
     */
    public function translate($key, $language = 'default')
    {
        $localizationReference = 'LLL:LLL:EXT:gjo_products/Resources/Private/Language/locallang.xlf';
        $translation = $this->localizationFactory->getParsedData($localizationReference, $language)[0][$key][0]['target'];
        return $translation ?: $key;
    }

    /**
     * @throws AspectNotFoundException
     */
    public function productFinderAction(): ResponseInterface
    {
//        $configurationManager = GeneralUtility::makeInstance(ConfigurationManagerInterface::class);
//        $config = $configurationManager->getConfiguration(
//            ConfigurationManagerInterface::CONFIGURATION_TYPE_FRAMEWORK,
//            'gjoproducts'
//        );


//       debug($config, '$config ausController');

        // todo-a: move to __constuct()
        /**
         * @var \TYPO3\CMS\Frontend\ContentObject\ContentObjectRenderer $currentContentObject
         */
        $currentContentObject = $this->request->getAttribute('currentContentObject');
        $sysLanguageUid = $this->context->getPropertyFromAspect('language', 'id');

        $this->view->assignMultiple([
            'data' => $currentContentObject->data,
            'sysLanguageUid' => $sysLanguageUid,
        ]);

        return $this->htmlResponse();
    }


    /**
     * @throws AspectNotFoundException
     */
    public function ajaxGetProductSetVariantAction(): ResponseInterface
    {
        $json = [];
        $productSetVariantListPrice = 0;
        $feUserDiscount = 0;

        $postParams = $this->request->getParsedBody();
        $productSetVariantGroupUid = $postParams['productSetVariantGroupUid'];
        $productSetVariantFilter = [];

        if ($postParams['productSetVariantFilterTypValueNoFilterTyp']) {
            $productSetVariantFilter['noFilterTyp'] = $postParams['productSetVariantFilterTypValueNoFilterTyp'];
        }

        if ($postParams['productSetVariantFilterTypValueLength']) {
            $productSetVariantFilter['length'] = $postParams['productSetVariantFilterTypValueLength'];
        }

        if ($postParams['productSetVariantFilterTypValueMaterial']) {
            $productSetVariantFilter['material'] = $postParams['productSetVariantFilterTypValueMaterial'];
        }

        if ($postParams['productSetVariantFilterTypValueVersion']) {
            $productSetVariantFilter['version'] = $postParams['productSetVariantFilterTypValueVersion'];
        }

        $productSetVariant = $this->productSetVariantRepository->findByProductSetVariantGroupAndFilter(
            $productSetVariantGroupUid,
            $productSetVariantFilter
        );

        if ($productSetVariant instanceof ProductSetVariant) {

            $feUserId = $this->context->getPropertyFromAspect('frontend.user', 'id');
            $feUserObj = $this->feUserRepository->findByUid($feUserId);
            $productSetVariantListPrice = $productSetVariant->getPrice() + ($productSetVariant->getPrice() * $productSetVariant->getTax() / 100);

            if ($feUserObj) {
                $feUserGroupsObj = $feUserObj->getUserGroup();

                $discounts = [];
                foreach ($feUserGroupsObj as $feUserGroupObj) {

                    if ($feUserGroupObj) {
                        $discounts[] = $feUserGroupObj->getTxGjoExtendsFemanagerDiscount();
                    }

                    if (!$feUserGroupObj->isTxGjoExtendsFemanagerVatIncl()) {
                        $productSetVariantListPrice = $productSetVariant->getPrice();
                    }
                }

                $feUserDiscount = max($discounts);
            }

            $json['productSetVariantUid'] = $productSetVariant->getUid();
            $json['productSetVariantArticleNumber'] = $productSetVariant->getArticleNumber();
        }

        if ($feUserDiscount) {
            $productSetVariantBuyPrice = $productSetVariantListPrice - ($productSetVariantListPrice * $feUserDiscount / 100);
            $json['productSetVariantBuyPrice'] = number_format($productSetVariantBuyPrice, 2, ',', '.');
        }

        $json['productSetVariantGroupUid'] = $productSetVariantGroupUid;
        $json['productSetVariantListPrice'] = number_format($productSetVariantListPrice, 2, ',', '.');

        return $this->jsonResponse(json_encode($json));
    }
}
