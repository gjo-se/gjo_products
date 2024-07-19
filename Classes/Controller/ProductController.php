<?php

namespace GjoSe\GjoTiger\Controller;

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

use \TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Lang\LanguageService;

/**
 * Class ProductController
 * @package GjoSe\GjoTiger\Controller
 */
class ProductController extends AbstractController
{
    /**
     * @var LanguageService
     */
    protected $languageService;

    /**
     * return void
     */
    public function showProductGroupTeaserAction()
    {
        $this->view->assignMultiple([
            'productGroup' => $this->productGroupRepository->findByUid($this->settings['productGroup'])
        ]);
    }

    public function showProductGroupAction()
    {
        $this->view->assignMultiple([
            'productGroup' => $this->productGroupRepository->findByUid($this->settings['productGroup'])
        ]);
    }

    public function showProductSetAction()
    {
        $productSet = $this->productSetRepository->findByUid($this->settings['productSet']);

        $productSetTypeUid = $this->productSetTypeRepository->findProductSetTypeUidByProductSetUid($this->settings['productSet'], 1);
        $productSetType    = $this->productSetTypeRepository->findByUid($productSetTypeUid);

        $productGroup = null;
        if ($productSetType) {
            $productGroup = $productSetType->getProductGroup();
        }

        $this->view->assignMultiple([
            'productSet'   => $productSet,
            'productGroup' => $productGroup,
            'is_shop'      => GeneralUtility::_GET()['is_shop'],
            'pageUid'      => $GLOBALS['TSFE']->id
        ]);
    }

    public function ajaxProductSetAction()
    {
        $limit          = 0;
        $postParams     = GeneralUtility::_POST();
        $searchString   = $postParams['searchString'];
        $sysLanguageUid = $postParams['sysLanguageUid'];
        $productSets    = $this->productSetRepository->findBySearchString($searchString, $limit);

        $this->languageService = GeneralUtility::makeInstance(LanguageService::class);

        if ($sysLanguageUid == '0') {
            $sysLanguage = 'de';
        } elseif ($sysLanguageUid == '1') {
            $sysLanguage = 'en';
        }
        $this->languageService->init($sysLanguage);

        $productSetsArr = array();

        foreach ($productSets as $productSet) {

            $accessoryKitUids = array();
            $pageUid          = 0;
            if ($productSet->getPages()) {
                $pageUid = $productSet->getPages()->getUid();

                if($pageUid){
                    $productSetsArr[$productSet->getUid()] = array(
                        'name'    => $productSet->getName(),
                        'pageUid' => $pageUid
                    );
                }

                $accessorykitGroups    = $productSet->getAccessorykitGroups();
                $accessorykitGroupUids = array();
                if ($accessorykitGroups) {
                    foreach ($accessorykitGroups as $accessorykitGroup) {
                        $accessorykitGroupUids[] = $accessorykitGroup->getUid();
                    }
                }

                $accessorykitUids = array();
                if ($accessorykitGroupUids) {
                    foreach ($accessorykitGroupUids as $key => $accessorykitGroupUid) {
                        $accessorykitUidsTemp = $this->accessorykitGroupRepository->findAccessorykitUidsByAccessorykitGroupUid($accessorykitGroupUid);
                        foreach ($accessorykitUidsTemp as $accessorykitUidTemp) {
                            array_push($accessorykitUids, $accessorykitUidTemp);
                        }
                    }
                }

                if ($accessorykitUids) {
                    $productSetAccessoryKits = $this->productSetRepository->findAccessoryKitByProductSetAndSearchString($accessorykitUids,
                        $searchString, $limit);

                    if ($productSetAccessoryKits) {
                        foreach ($productSetAccessoryKits as $productSetAccessoryKit) {
                            $productSetsArr[$productSet->getUid()]['accessoryKits'][$productSetAccessoryKit->getUid()] = array(
                                'name'   => $productSetAccessoryKit->getName(),
                                'anchor' => $productSetAccessoryKit->getAnchor()
                            );
                        }
                    }
                }

                $this->view->assign('productSetsArr', $productSetsArr);

            }
        }

        $this->view->assign('searchString', $searchString);
        $this->view->assign('searchNoProductSetsFound1', $this->translate('search.noProductSetsFound.1'));
        $this->view->assign('searchNoProductSetsFound2', $this->translate('search.noProductSetsFound.2'));

    }

    public function productFinderAction()
    {
        $this->view->assign('sysLanguageUid', $GLOBALS['TSFE']->sys_language_uid);
        $this->view->assign('sysLanguage', $GLOBALS['TSFE']->lang);
    }

    public function ajaxListProductsAction()
    {

        // auch das kann ins Abstract
        $postParams          = GeneralUtility::_POST();
        $productFinderFilter = $postParams['productFinderFilter'];

        // TODO: wenn ich bei den TESTS bin, hier mit ajaxProductSetAction generischer gestalten
        //  - locallang-helper-sysLanguageUid ist 2x im Quellcode
        //  - locallang-helper-sysLanguage ist redundant und kann raus
        //  - nachfolgenden Zeilen in AbstractController verschieben (Boilerpalte) => wird immer im Ajaxfall gebraucht
        //  - siehe auch translate() hier im File
        $sysLanguageUid      = $postParams['sysLanguageUid'];
        $this->languageService = GeneralUtility::makeInstance(LanguageService::class);
        $this->languageService->init(trim($postParams['sysLanguage']));

        if ($postParams['offset']) {
            $offset = $postParams['offset'];
        } else {
            $offset = $this->settings['ajaxListProducts']['offset'];
        }

        $productSets      = $this->productSetRepository->findByFilter($sysLanguageUid, $productFinderFilter, $offset,
            $this->settings['ajaxListProducts']['limit']);
        $productSetsCount = $this->productSetRepository->findByFilter($sysLanguageUid, $productFinderFilter)->count();

        $vatTextTranslationKey = 'priceInclVat';

        $feUserData = $GLOBALS['TSFE']->fe_user->user;
        $feUserObj = $this->feUserRepository->findByUid($feUserData['uid']);

        if($feUserObj){
            $feUserGroupsObj = $feUserObj->getUserGroup();

            foreach ($feUserGroupsObj as $feUserGroup) {
                if(!$feUserGroup->isTxGjoExtendsFemanagerVatIncl()){
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
    }

    /**
     * Returns the translation of $key
     *
     * @param string $key
     * @return string
     */
    protected function translate($key)
    {
        // TODO: abstract machen
        return $this->languageService->sL('LLL:EXT:gjo_tiger/Resources/Private/Language/locallang.xlf:' . $key);
    }

    public function ajaxGetProductSetVariantAction()
    {
        $json = array();

        $postParams                = GeneralUtility::_POST();
        $productSetVariantGroupUid = $postParams['productSetVariantGroupUid'];
        $productSetVariantFilter   = array();

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

        $productSetVariant = $this->productSetVariantRepository->findByProductSetVariantGroupAndFilter($productSetVariantGroupUid,
            $productSetVariantFilter);

        if ($productSetVariant) {

            $feUserData                 = $GLOBALS['TSFE']->fe_user->user;
            $feUserObj                  = $this->feUserRepository->findByUid($feUserData['uid']);
            $feUserDiscount             = 0;
            $productSetVariantListPrice = $productSetVariant->getPrice() + ($productSetVariant->getPrice() * $productSetVariant->getTax() / 100);

            if ($feUserObj) {
                $feUserGroupsObj = $feUserObj->getUserGroup();

                $discounts = array();
                foreach ($feUserGroupsObj as $feUserGroup) {

                    if ($feUserGroup) {
                        array_push($discounts, $feUserGroup->getTxGjoExtendsFemanagerDiscount());
                    }

                    if (!$feUserGroup->isTxGjoExtendsFemanagerVatIncl()) {
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

        return json_encode($json);
    }
}