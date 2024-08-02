<?php

declare(strict_types=1);

/***************************************************************
 *  created: 24.08.17 - 13:07
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

use GjoSe\GjoSitePackage\Utility\CroppingUtility;

return call_user_func(function (): array {

    $ext = 'gjo_products';
    $lll = 'LLL:EXT:' . $ext . '/Resources/Private/Language/locallang_db.xlf:';
    $table = 'tx_gjoproducts_domain_model_productgroup';

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
            'label' => 'header',

            'rootLevel' => 0, // 0 = PageTree, 1 = Root, -1 = All
            'iconfile' => 'EXT:' . $ext . '/Resources/Public/Icons/products_icon.png',
            'default_sortby' => 'header ASC',
            'searchFields' => 'header',

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

            'product_set_types' => [
                'label' => $lll . $table . '.product_set_types',
                'config' => [
                    'type' => 'inline',
                    'foreign_table' => 'tx_gjoproducts_domain_model_productsettype',
                    'foreign_field' => 'product_group', // passthrough
                    'maxitems' => 9999,
                    'appearance' => [
                        'collapseAll' => 1,
                        'expandSingle' => 1,
                        'levelLinksPosition' => 'top',
                        'showSynchronizationLink' => 1,
                        'showPossibleLocalizationRecords' => 1,
                        'showAllLocalizationLink' => 1,
                        'useSortable' => true,
                        'enabledControls' => [
                            'info' => true,
                            'new' => true,
                            'dragdrop' => true,
                            'sort' => true,
                            'hide' => true,
                            'delete' => true,
                            'localize' => true,
                        ],
                    ],
                ],

            ],

            'page' => [
                'label' => $lll . $table . '.pages',
                'description' => $lll . $table . '.pages',
                'config' => [
                    'type' => 'group',
                    'allowed' => 'pages',
                    'size' => 1,
                    'maxitems' => 1,
                    'minitems' => 1,
                ],
            ],

            'header' => [
                'label' => $lll . $table . '.header',
                'description' => $lll . $table . '.header',
                'l10n_mode' => 'prefixLangTitle',
                'config' => [
                    'type' => 'input'
                ],
            ],

            'sub_header' => [
                'label' => $lll . $table . '.sub_header',
                'description' => $lll . $table . '.sub_header',
                'l10n_mode' => 'prefixLangTitle',
                'config' => [
                    'type' => 'input'
                ],
            ],

            'description' => [
                'label' => $lll . $table . '.description',
                'description' => $lll . $table . '.description',
                'config' => [
                    'type' => 'text',
                    'cols' => 40,
                    'rows' => 6,
                    'enableRichtext' => true,
                ],
            ],

            'image' => [
                'label' => $lll . $table . '.image',
                'description' => $lll . $table . '.image',
                'config' => [
                    'type' => 'file',
                    'maxitems' => 1,
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

            'teaser_header' => [
                'label' => $lll . $table . '.teaser_header',
                'description' => $lll . $table . '.teaser_header',
                'l10n_mode' => 'prefixLangTitle',
                'config' => [
                    'type' => 'input'
                ],
            ],

            'teaser_description' => [
                'label' => $lll . $table . '.teaser_description',
                'description' => $lll . $table . '.teaser_description',
                'config' => [
                    'type' => 'text',
                    'cols' => 40,
                    'rows' => 6,
                    'enableRichtext' => true
                ],
            ],

            'teaser_image' => [
                'label' => $lll . $table . '.teaser_image',
                'description' => $lll . $table . '.teaser_image',
                'config' => [
                    'type' => 'file',
                    'maxitems' => 1,
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
                            header,
                            sub_header,
                            description,
                            image,
                            page,
                        --div--;' . $lll . $table . '.teaser,
                            teaser_header,
                            teaser_description,
                            teaser_image,
                        --div--;' . $lll . $table . '.product_set_type,
                            product_set_types,
                        --div--;LLL:EXT:core/Resources/Private/Language/Form/locallang_tabs.xlf:access, 
                            hidden,
            ',
            ],
        ],
    ];
});