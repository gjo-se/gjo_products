<?php

declare(strict_types=1);

/***************************************************************
 *  created: 24.08.17 - 13:07
 *  Copyright notice
 *  (c] 2017 Gregory Jo Erdmann <gregory.jo@gjo-se.com>
 *  All rights reserved
 *  This script is part of the TYPO3 project. The TYPO3 project is
 *  free software; you can redistribute it and/or modify
 *  it under the terms of the GNU General Public License as published by
 *  the Free Software Foundation; either version 3 of the License, or
 *  (at your option] any later version.
 *  The GNU General Public License can be found at
 *  http://www.gnu.org/copyleft/gpl.html.
 *  This script is distributed in the hope that it will be useful,
 *  but WITHOUT ANY WARRANTY; without even the implied warranty of
 *  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 *  GNU General Public License for more details.
 *  This copyright notice MUST APPEAR in all copies of the script!
 ***************************************************************/

use GjoSe\GjoSitePackage\Utility\CroppingUtility;

return call_user_func(function (): array {

    $ext = 'gjo_products';
    $lll = 'LLL:EXT:' . $ext . '/Resources/Private/Language/locallang_db.xlf:';
    $table = 'tx_gjoproducts_domain_model_product';

    $defaultCropSettings = CroppingUtility::getDefaultCropSettings();

    $mobileCropSettings = $defaultCropSettings;
    $mobileCropSettings['title'] = $lll . 'cropVariant.mobile';
    $tabletCropSettings = $defaultCropSettings;
    $tabletCropSettings['title'] = $lll . 'cropVariant.tablet';
    $laptopCropSettings = $defaultCropSettings;
    $laptopCropSettings['title'] = $lll . 'cropVariant.laptop';
    $desktopCropSettings = $defaultCropSettings;
    $desktopCropSettings['title'] = $lll . 'cropVariant.desktop';
    $wideScreenCropSettings = $defaultCropSettings;
    $wideScreenCropSettings['title'] = $lll . 'cropVariant.wideScreen';

    return [

        'ctrl' => [
            'title' => $lll . $table,
            'label' => 'name',
            'label_alt' => 'article_number, additional_information',
            'label_alt_force' => 1,

            'rootLevel' => 0, // 0 = PageTree, 1 = Root, -1 = All
            'iconfile' => 'EXT:' . $ext . '/Resources/Public/Icons/products_icon.png',
            'default_sortby' => 'name ASC, article_number ASC',
            'searchFields' => 'name, article_number',

            'enablecolumns' => [
                'disabled' => 'hidden',
            ],

            'tstamp' => 'tstamp',
            'crdate' => 'crdate',
            'delete' => 'deleted',
            'origUid' => 't3_origuid',
            'languageField' => 'sys_language_uid',
            'transOrigPointerField' => 'l10n_parent',
            'transOrigDiffSourceField' => 'l10n_diffsource',
            'translationSource' => 'l10n_source',
        ],

        'columns' => [

            'name' => [
                'label' => $lll . $table . '.name',
                'description' => $lll . $table . '.name',
                'l10n_mode' => 'prefixLangTitle',
                'config' => [
                    'type' => 'input'
                ]
            ],

            'article_number' => [
                'label' => $lll . $table . '.article_number',
                'description' => $lll . $table . '.article_number',
                'l10n_mode' => 'prefixLangTitle',
                'config' => [
                    'type' => 'input'
                ]
            ],

            'additional_information' => [
                'label' => $lll . $table . '.additional_information',
                'description' => $lll . $table . '.additional_information',
                'l10n_mode' => 'prefixLangTitle',
                'config' => [
                    'type' => 'input'
                ]
            ],

            'image' => [
                'label' => $lll . $table . '.image',
                'config' => [
                    'type' => 'file',
                    'maxitems' => 6,
                    'allowed' => 'common-media-types',
                    'overrideChildTca' => [
                        'columns' => [
                            'crop' => [
                                'config' => [
                                    'cropVariants' => [
                                        'mobile' => $mobileCropSettings,
                                        'tablet' => $tabletCropSettings,
                                        'laptop' => $laptopCropSettings,
                                        'desktop' => $desktopCropSettings,
                                        'wideScreen' => $wideScreenCropSettings,
                                    ],
                                ],
                            ],

                        ],
                    ],
                ],
            ],

            ###############################################################################

            'sys_language_uid' => [
                'label' => 'LLL:EXT:lang/Resources/Private/Language/locallang_general.xlf:LGL.language',
                'config' => [
                    'type' => 'language',
                ]
            ],

            'l10n_parent' => [
                'displayCond' => 'FIELD:sys_language_uid:>:0',
                'label' => 'LLL:EXT:lang/Resources/Private/Language/locallang_general.xlf:LGL.l18n_parent',
                'config' => [
                    'type' => 'select',
                    'renderType' => 'selectSingle',
                    'items' => [
                        [
                            'label' => '',
                            'value' => 0
                        ],
                    ],
                    'foreign_table' => $table,
                    'foreign_table_where' => 'AND' . $table . '.pid=###CURRENT_PID### AND ' . $table . '.sys_language_uid IN (-1,0)',
                    'default' => 0,
                ],

            ],

            'l10n_source' => [
                'displayCond' => 'FIELD:sys_language_uid:>:0',
                'label' => 'Translation source',
                'config' => [
                    'type' => 'select',
                    'renderType' => 'selectSingle',
                    'items' => [
                        ['label' => '', 'value' => 0],
                    ],
                    'foreign_table' => $table,
                    'foreign_table_where' => 'AND' . $table . '.pid=###CURRENT_PID### AND ' . $table . '.uid!=###THIS_UID###',
                    'default' => 0,
                ],
            ],

            'l10n_diffsource' => [
                'config' => [
                    'type' => 'passthrough',
                    'default' => '',
                ],
            ],

            'hidden' => [
                'label' => 'LLL:EXT:lang/Resources/Private/Language/locallang_general.xlf:LGL.hidden',
                'config' => [
                    'type' => 'check',
                ],
            ],

        ],

        'types' => [
            '0' => [
                'showitem' => '
                        --div--;LLL:EXT:core/Resources/Private/Language/Form/locallang_tabs.xlf:general, 
                            name,
                            article_number,
                            additional_information,
                            image,
                        --div--;LLL:EXT:core/Resources/Private/Language/Form/locallang_tabs.xlf:access, 
                            hidden,
            ',
            ]
        ],
    ];
});