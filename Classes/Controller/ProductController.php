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
use Psr\Http\Message\ResponseInterface;
use TYPO3\CMS\Extbase\Persistence\QueryResultInterface;
use TYPO3\CMS\Core\Localization\LocalizationFactory;
use TYPO3\CMS\Core\Utility\GeneralUtility;

final class ProductController extends AbstractController
{
    private readonly LocalizationFactory $localizationFactory;

    public function __construct(?LocalizationFactory $localizationFactory = null)
    {
        $this->localizationFactory = $localizationFactory instanceof LocalizationFactory ? $localizationFactory : GeneralUtility::makeInstance(LocalizationFactory::class);
    }

    /**
     * return void
     */
    public function showProductGroupTeaserAction(): ResponseInterface
    {
        $this->view->assignMultiple([
            'productGroup' => $this->productGroupRepository->findByUid($this->settings['productGroup']),
        ]);
        return $this->htmlResponse();
    }

    public function showProductGroupAction(): ResponseInterface
    {
        $this->view->assignMultiple([
            'productGroup' => $this->productGroupRepository->findByUid($this->settings['productGroup']),
        ]);
        return $this->htmlResponse();
    }

    public function showProductSetAction(): ResponseInterface
    {
        $productSet = $this->productSetRepository->findByUid($this->settings['productSet']);

        $productSetTypeUid = $this->productSetTypeRepository->findProductSetTypeUidByProductSetUid((int)$this->settings['productSet'], 1);
        $productSetType    = $this->productSetTypeRepository->findByUid($productSetTypeUid);

        $productGroup = null;
        if ($productSetType) {
            $productGroup = $productSetType->getProductGroup();
        }

        $this->view->assignMultiple([
            'productSet'   => $productSet,
            'productGroup' => $productGroup,
            'is_shop'      => $this->request->getQueryParams()['is_shop'],
            'pageUid'      => $GLOBALS['TSFE']->id,
        ]);
        return $this->htmlResponse();
    }

    public function ajaxProductSetAction(): ResponseInterface
    {
        $limit          = 0;
        $postParams     = $this->request->getParsedBody();
        $searchString   = $postParams['searchString'];
        $productSets    = $this->productSetRepository->findBySearchString($searchString, $limit);

        $productSetsArr = [];

        foreach ($productSets as $productSet) {

            $accessoryKitUids = [];
            $pageUid          = 0;
            if ($productSet->getPages()) {
                $pageUid = $productSet->getPages()->getUid();

                if ($pageUid) {
                    $productSetsArr[$productSet->getUid()] = [
                        'name'    => $productSet->getName(),
                        'pageUid' => $pageUid,
                    ];
                }

                $accessorykitGroups    = $productSet->getAccessorykitGroups();
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
                                'name'   => $productSetAccessoryKit->getName(),
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

    public function productFinderAction(): ResponseInterface
    {
        // todo-a: Lösung: https://docs.typo3.org/c/typo3/cms-core/main/en-us/Changelog/9.4/Deprecation-85543-Language-relatedPropertiesInTypoScriptFrontendControllerAndPageRepository.html
        $this->view->assign('sysLanguageUid', $GLOBALS['TSFE']->sys_language_uid);
        $this->view->assign('sysLanguage', $GLOBALS['TSFE']->lang);
        return $this->htmlResponse();
    }

    public function ajaxListProductsAction(): ResponseInterface
    {

        $postParams          = $this->request->getParsedBody();
        $productFinderFilter = $postParams['productFinderFilter'];

        $sysLanguageUid      = $postParams['sysLanguageUid'];

        $offset = $postParams['offset'] ?: $this->settings['ajaxListProducts']['offset'];

        $productSets      = $this->productSetRepository->findByFilter(
            $sysLanguageUid,
            $productFinderFilter,
            $offset,
            $this->settings['ajaxListProducts']['limit']
        );
        $productSetsCount = $this->productSetRepository->findByFilter($sysLanguageUid, $productFinderFilter)->count();

        $vatTextTranslationKey = 'priceInclVat';

        $feUserData = $GLOBALS['TSFE']->fe_user->user;
        $user = $this->feUserRepository->findByUid($feUserData['uid']);

        if ($user) {
            $feUserGroupsObj = $user->getUserGroup();

            foreach ($feUserGroupsObj as $feUserGroupObj) {
                if (!$feUserGroupObj->isTxGjoExtendsFemanagerVatIncl()) {
                    $vatTextTranslationKey = 'priceExclVat';
                }
            }
        }

        $this->view->assign('sysLanguageUid', $sysLanguageUid);
        $this->view->assign('productFinderListWings', $this->translate('productFinder.list.wings'));
        $this->view->assign('productFinderListDoorWidth', $this->translate('productFinder.list.doorWidth'));
        $this->view->assign('productFinderListDoorThickness', $this->translate('productFinder.list.doorThickness'));
        $this->view->assign('productFinderListDoorWeight', $this->translate('productFinder.list.doorWeight'));
        $this->view->assign('productsSeeProduct', $this->translate('products.seeProduct'));
        $this->view->assign('productFinderListPriceFrom', $this->translate('productFinder.list.price.from'));
        $this->view->assign('productFinderListPriceAvailableOnRequest', $this->translate('productFinder.list.price.availableOnRequest'));
        $this->view->assign('productSetVariantGroupPrice', $this->translate('productSetVariantGroup.price'));
        $this->view->assign('productSetVariantGroupDiscount', $this->translate('productSetVariantGroup.discount'));
        $this->view->assign('productSetVariantGroupVatText', $this->translate('productSetVariantGroup.' . $vatTextTranslationKey));

        $this->view->assign('productSets', $productSets);
        $this->view->assign('productSetsCount', $productSetsCount);
        $this->view->assign('isShop', (int)$postParams['isShop']);
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

    public function ajaxGetProductSetVariantAction(): ResponseInterface
    {
        $json = [];
        $productSetVariantListPrice = 0;
        $feUserDiscount             = 0;

        $postParams                = $this->request->getParsedBody();
        $productSetVariantGroupUid = $postParams['productSetVariantGroupUid'];
        $productSetVariantFilter   = [];

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

            $feUserData                 = $GLOBALS['TSFE']->fe_user->user;
            $feUserObj                  = $this->feUserRepository->findByUid($feUserData['uid']);
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

            $json['productSetVariantUid']           = $productSetVariant->getUid();
            $json['productSetVariantArticleNumber'] = $productSetVariant->getArticleNumber();
        }

        if ($feUserDiscount) {
            $productSetVariantBuyPrice         = $productSetVariantListPrice - ($productSetVariantListPrice * $feUserDiscount / 100);
            $json['productSetVariantBuyPrice'] = number_format($productSetVariantBuyPrice, 2, ',', '.');
        }

        $json['productSetVariantGroupUid']  = $productSetVariantGroupUid;
        $json['productSetVariantListPrice'] = number_format($productSetVariantListPrice, 2, ',', '.');

        return $this->jsonResponse(json_encode($json));
    }
}
