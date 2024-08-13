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
    $table = 'tx_gjoproducts_domain_model_productset';

    return [

        'ctrl' => [
            'title' => $lll . $table,
            'label' => 'name',

            'rootLevel' => 0, // 0 = PageTree, 1 = Root, -1 = All
            'iconfile' => 'EXT:' . $ext . '/Resources/Public/Icons/products_icon.png',
            'default_sortby' => 'name ASC',
            'searchFields' => 'name',

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

            'product_set_variant_groups' => [
                'label' => $lll . $table . '.product_set_variant_groups',
                'description' => $lll . $table . '.product_set_variant_groups',
                'config' => [
                    'type' => 'inline',
                    'foreign_table' => 'tx_gjoproducts_domain_model_productsetvariantgroup',
                    'foreign_field' => 'product_set', // passthrough
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

            'accessorykit_groups' => [
                'label' => $lll . $table . '.accessorykit_groups',
                'description' => $lll . $table . '.accessorykit_groups',
                'displayCond' => 'FIELD:is_accessory_kit:REQ:false',
                'config' => [
                    'type' => 'inline',
                    'foreign_table' => 'tx_gjoproducts_domain_model_accessorykitgroup',
                    'foreign_field' => 'product_set', // passthrough
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
                'label' => $lll . $table . '.page',
                'description' => $lll . $table . '.page',
                'displayCond' => 'FIELD:is_accessory_kit:REQ:false',
                'config' => [
                    'type' => 'group',
                    'allowed' => 'pages',
                    'size' => 1,
                    'maxitems' => 1,
                    'minitems' => 0,
                ],
            ],

            'name' => [
                'label' => $lll . $table . '.name',
                'description' => $lll . $table . '.name',
                'l10n_mode' => 'prefixLangTitle',
                'config' => [
                    'type' => 'input'
                ]
            ],

            'anchor' => [
                'label' => $lll . $table . '.anchor',
                'description' => $lll . $table . '.name',
                'l10n_mode' => 'prefixLangTitle',
                'displayCond' => 'FIELD:is_accessory_kit:REQ:true',
                'config' => [
                    'type' => 'input'
                ]
            ],

            'is_accessory_kit' => [
                'label' => $lll . $table . '.is_accessory_kit',
                'description' => $lll . $table . '.is_accessory_kit',
                'onChange' => 'reload',
                'config' => [
                    'type' => 'check',
                ],
            ],

            'is_featured' => [
                'label' => $lll . $table . '.is_featured',
                'description' => $lll . $table . '.is_featured',
                'displayCond' => 'FIELD:is_accessory_kit:REQ:false',
                'config' => [
                    'type' => 'check',
                ],
            ],

            'description' => [
                'label' => $lll . $table . '.description',
                'description' => $lll . $table . '.description',
                'config' => [
                    'type' => 'text',
                    'cols' => 40,
                    'rows' => 6,
                    'enableRichtext' => true
                ],
            ],

            'image' => [
                'label' => $lll . $table . '.image',
                'description' => $lll . $table . '.image',
                'config' => [
                    'type' => 'file',
                    'maxitems' => 2,
                    'allowed' => 'common-media-types',
                ],
            ],

            'icon' => [
                'label' => $lll . $table . '.icon',
                'description' => $lll . $table . '.icon',
                'displayCond' => 'FIELD:is_accessory_kit:REQ:true',
                'config' => [
                    'type' => 'file',
                    'maxitems' => 1,
                    'allowed' => 'common-media-types',
                ],
            ],

            'show_technicalnots' => [
                'label' => $lll . $table . '.show_technicalnots',
                'description' => $lll . $table . '.show_technicalnots',
                'onChange' => 'reload',
                'config' => [
                    'type' => 'check',
                ],
            ],

            'minimum_door_weight' => [
                'label' => $lll . $table . '.minimum_door_weight',
                'description' => $lll . $table . '.minimum_door_weight',
                'l10n_mode' => 'prefixLangTitle',
                'displayCond' => 'FIELD:show_technicalnots:REQ:true',
                'config' => [
                    'type' => 'input',

                ]
            ],

            'maximum_door_weight' => [
                'label' => $lll . $table . '.maximum_door_weight',
                'description' => $lll . $table . '.maximum_door_weight',
                'l10n_mode' => 'prefixLangTitle',
                'displayCond' => 'FIELD:show_technicalnots:REQ:true',
                'config' => [
                    'type' => 'input',

                ]
            ],

            'height' => [
                'label' => $lll . $table . '.height',
                'description' => $lll . $table . '.height',
                'l10n_mode' => 'prefixLangTitle',
                'displayCond' => 'FIELD:show_technicalnots:REQ:true',
                'config' => [
                    'type' => 'input'
                ]
            ],

            'minimum_door_thickness' => [
                'label' => $lll . $table . '.minimum_door_thickness',
                'description' => $lll . $table . '.minimum_door_thickness',
                'l10n_mode' => 'prefixLangTitle',
                'displayCond' => 'FIELD:show_technicalnots:REQ:true',
                'config' => [
                    'type' => 'input'
                ]
            ],

            'maximum_door_thickness' => [
                'label' => $lll . $table . '.maximum_door_thickness',
                'description' => $lll . $table . '.maximum_door_thickness',
                'l10n_mode' => 'prefixLangTitle',
                'displayCond' => 'FIELD:show_technicalnots:REQ:true',
                'config' => [
                    'type' => 'input'
                ]
            ],

            'minimum_door_width' => [
                'label' => $lll . $table . '.minimum_door_width',
                'description' => $lll . $table . '.minimum_door_width',
                'l10n_mode' => 'prefixLangTitle',
                'displayCond' => 'FIELD:show_technicalnots:REQ:true',
                'config' => [
                    'type' => 'input'
                ]
            ],

            'maximum_door_width' => [
                'label' => $lll . $table . '.maximum_door_width',
                'description' => $lll . $table . '.maximum_door_width',
                'l10n_mode' => 'prefixLangTitle',
                'displayCond' => 'FIELD:show_technicalnots:REQ:true',
                'config' => [
                    'type' => 'input'
                ]
            ],

            'minimum_door_width_soft_close' => [
                'label' => $lll . $table . '.minimum_door_width_soft_close',
                'description' => $lll . $table . '.minimum_door_width_soft_close',
                'l10n_mode' => 'prefixLangTitle',
                'displayCond' => 'FIELD:show_technicalnots:REQ:true',
                'config' => [
                    'type' => 'input'
                ]
            ],

            'minimum_door_width_soft_close_long' => [
                'label' => $lll . $table . '.minimum_door_width_soft_close_long',
                'description' => $lll . $table . '.minimum_door_width_soft_close_long',
                'l10n_mode' => 'prefixLangTitle',
                'displayCond' => 'FIELD:show_technicalnots:REQ:true',
                'config' => [
                    'type' => 'input'
                ]
            ],

            'minimum_door_width_soft_close_both' => [
                'label' => $lll . $table . '.minimum_door_width_soft_close_both',
                'description' => $lll . $table . '.minimum_door_width_soft_close_both',
                'l10n_mode' => 'prefixLangTitle',
                'displayCond' => 'FIELD:show_technicalnots:REQ:true',
                'config' => [
                    'type' => 'input'
                ]
            ],

            'voltage' => [
                'label' => $lll . $table . '.voltage',
                'description' => $lll . $table . '.voltage',
                'l10n_mode' => 'prefixLangTitle',
                'displayCond' => 'FIELD:show_technicalnots:REQ:true',
                'config' => [
                    'type' => 'input'
                ]
            ],

            'show_din' => [
                'label' => $lll . $table . '.show_din',
                'description' => $lll . $table . '.show_din',
                'onChange' => 'reload',
                'config' => [
                    'type' => 'check',
                ],
            ],

            'use_categorie' => [
                'label' => $lll . $table . '.use_categorie',
                'description' => $lll . $table . '.use_categorie',
                'l10n_mode' => 'prefixLangTitle',
                'displayCond' => 'FIELD:show_din:REQ:true',
                'config' => [
                    'type' => 'input'
                ]
            ],

            'durability' => [
                'label' => $lll . $table . '.durability',
                'description' => $lll . $table . '.durability',
                'l10n_mode' => 'prefixLangTitle',
                'displayCond' => 'FIELD:show_din:REQ:true',
                'config' => [
                    'type' => 'input'
                ]
            ],

            'door_weight' => [
                'label' => $lll . $table . '.door_weight',
                'description' => $lll . $table . '.door_weight',
                'l10n_mode' => 'prefixLangTitle',
                'displayCond' => 'FIELD:show_din:REQ:true',
                'config' => [
                    'type' => 'input'
                ]
            ],

            'fire_resistance' => [
                'label' => $lll . $table . '.fire_resistance',
                'description' => $lll . $table . '.fire_resistance',
                'l10n_mode' => 'prefixLangTitle',
                'displayCond' => 'FIELD:show_din:REQ:true',
                'config' => [
                    'type' => 'input'
                ]
            ],

            'safety' => [
                'label' => $lll . $table . '.safety',
                'description' => $lll . $table . '.safety',
                'l10n_mode' => 'prefixLangTitle',
                'displayCond' => 'FIELD:show_din:REQ:true',
                'config' => [
                    'type' => 'input'
                ]
            ],

            'corrosion_resistance' => [
                'label' => $lll . $table . '.corrosion_resistance',
                'description' => $lll . $table . '.corrosion_resistance',
                'l10n_mode' => 'prefixLangTitle',
                'displayCond' => 'FIELD:show_din:REQ:true',
                'config' => [
                    'type' => 'input'
                ]
            ],

            'security' => [
                'label' => $lll . $table . '.security',
                'description' => $lll . $table . '.security',
                'l10n_mode' => 'prefixLangTitle',
                'displayCond' => 'FIELD:show_din:REQ:true',
                'config' => [
                    'type' => 'input'
                ]
            ],

            'door_type' => [
                'label' => $lll . $table . '.door_type',
                'description' => $lll . $table . '.door_type',
                'l10n_mode' => 'prefixLangTitle',
                'displayCond' => 'FIELD:show_din:REQ:true',
                'config' => [
                    'type' => 'input'
                ]
            ],

            'initial_friction' => [
                'label' => $lll . $table . '.initial_friction',
                'description' => $lll . $table . '.initial_friction',
                'l10n_mode' => 'prefixLangTitle',
                'displayCond' => 'FIELD:show_din:REQ:true',
                'config' => [
                    'type' => 'input'
                ]
            ],

            'invitation_to_tender' => [
                'label' => $lll . $table . '.invitation_to_tender',
                'description' => $lll . $table . '.invitation_to_tender',
                'config' => [
                    'type' => 'text',
                    'cols' => 40,
                    'rows' => 6,
                    'enableRichtext' => true
                ],
            ],

            'downloads' => [
                'label' => $lll . $table . '.downloads',
                'description' => $lll . $table . '.downloads',
                'config' => [
                    'type' => 'file',
                    'maxitems' => 99,
                    'allowed' => 'pdf, dwg, dxf',
                ],
            ],

            'download_engineering_drawings' => [
                'label' => $lll . $table . '.download_engineering_drawings',
                'description' => $lll . $table . '.download_engineering_drawings',
                'config' => [
                    'type' => 'file',
                    'maxitems' => 99,
                    'allowed' => 'pdf, dwg, dxf',
                ],
            ],

            'image_engineering_drawings' => [
                'label' => $lll . $table . '.image_engineering_drawings',
                'description' => $lll . $table . '.image_engineering_drawings',
                'config' => [
                    'type' => 'file',
                    'maxitems' => 10,
                    'allowed' => 'common-media-types',
                ],
            ],

            'filter_montage_wall' => [
                'label' => $lll . $table . '.filter_montage_wall',
                'description' => $lll . $table . '.filter_montage_wall',
                'displayCond' => 'FIELD:is_accessory_kit:REQ:false',
                'config' => [
                    'type' => 'check',
                ],
            ],

            'filter_montage_ceiling' => [
                'label' => $lll . $table . '.filter_montage_ceiling',
                'description' => $lll . $table . '.filter_montage_ceiling',
                'displayCond' => 'FIELD:is_accessory_kit:REQ:false',
                'config' => [
                    'type' => 'check',
                ],
            ],

            'filter_montage_in' => [
                'label' => $lll . $table . '.filter_montage_in',
                'description' => $lll . $table . '.filter_montage_in',
                'displayCond' => 'FIELD:is_accessory_kit:REQ:false',
                'config' => [
                    'type' => 'check',
                ],
            ],

            'filter_material_wood' => [
                'label' => $lll . $table . '.filter_material_wood',
                'description' => $lll . $table . '.filter_material_wood',
                'displayCond' => 'FIELD:is_accessory_kit:REQ:false',
                'config' => [
                    'type' => 'check'
                ]
            ],

            'filter_material_glas' => [
                'label' => $lll . $table . '.filter_material_glas',
                'description' => $lll . $table . '.filter_material_glas',
                'displayCond' => 'FIELD:is_accessory_kit:REQ:false',
                'config' => [
                    'type' => 'check',
                ],
            ],

            'filter_wingcount' => [
                'label' => $lll . $table . '.filter_wingcount',
                'description' => $lll . $table . '.filter_wingcount',
                'displayCond' => 'FIELD:is_accessory_kit:REQ:false',
                'config' => [
                    'type' => 'select',
                    'renderType' => 'selectSingleBox',
                    'items' => [
                        ['label' => '1-flügelig', 'value' => 1],
                        ['label' => '2-flügelig', 'value' => 2],
                        ['label' => '3-flügelig', 'value' => 3]
                    ],
                ],
            ],

            'filter_design_customer' => [
                'label' => $lll . $table . '.filter_design_customer',
                'description' => $lll . $table . '.filter_design_customer',
                'displayCond' => 'FIELD:is_accessory_kit:REQ:false',
                'config' => [
                    'type' => 'check',
                ],
            ],

            'filter_design_alu' => [
                'label' => $lll . $table . '.filter_design_alu',
                'description' => $lll . $table . '.filter_design_alu',
                'displayCond' => 'FIELD:is_accessory_kit:REQ:false',
                'config' => [
                    'type' => 'check',
                ],
            ],

            'filter_design_design' => [
                'label' => $lll . $table . '.filter_design_design',
                'description' => $lll . $table . '.filter_design_design',
                'displayCond' => 'FIELD:is_accessory_kit:REQ:false',
                'config' => [
                    'type' => 'check',
                ],
            ],

            'filter_soft_close' => [
                'label' => $lll . $table . '.filter_soft_close',
                'description' => $lll . $table . '.filter_soft_close',
                'displayCond' => 'FIELD:is_accessory_kit:REQ:false',
                'config' => [
                    'type' => 'check',
                ],
            ],

            'filter_et3' => [
                'label' => $lll . $table . '.filter_et3',
                'description' => $lll . $table . '.filter_et3',
                'displayCond' => 'FIELD:is_accessory_kit:REQ:false',
                'config' => [
                    'type' => 'check',
                ],
            ],

            'filter_tclose' => [
                'label' => $lll . $table . '.filter_tclose',
                'description' => $lll . $table . '.filter_tclose',
                'displayCond' => 'FIELD:is_accessory_kit:REQ:false',
                'config' => [
                    'type' => 'check',
                ],
            ],

            'filter_tmaster' => [
                'label' => $lll . $table . '.filter_tmaster',
                'description' => $lll . $table . '.filter_tmaster',
                'displayCond' => 'FIELD:is_accessory_kit:REQ:false',
                'config' => [
                    'type' => 'check',
                ],
            ],

            'filter_tfold' => [
                'label' => $lll . $table . '.filter_tfold',
                'description' => $lll . $table . '.filter_tfold',
                'displayCond' => 'FIELD:is_accessory_kit:REQ:false',
                'config' => [
                    'type' => 'check',
                ],
            ],

            'filter_synchron' => [
                'label' => $lll . $table . '.filter_synchron',
                'description' => $lll . $table . '.filter_synchron',
                'displayCond' => 'FIELD:is_accessory_kit:REQ:false',
                'config' => [
                    'type' => 'check',
                ],
            ],

            'filter_telescop2' => [
                'label' => $lll . $table . '.filter_telescop2',
                'description' => $lll . $table . '.filter_telescop2',
                'displayCond' => 'FIELD:is_accessory_kit:REQ:false',
                'config' => [
                    'type' => 'check',
                ],
            ],

            'filter_telescop3' => [
                'label' => $lll . $table . '.filter_telescop3',
                'description' => $lll . $table . '.filter_telescop3',
                'displayCond' => 'FIELD:is_accessory_kit:REQ:false',
                'config' => [
                    'type' => 'check',
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
                'label' => 'LLL:EXT:lang/Resources/Private/Language/locallang_general.xlf:LGL.l18n_parent',
                'displayCond' => 'FIELD:sys_language_uid:>:0',
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
                'label' => 'Translation source',
                'displayCond' => 'FIELD:sys_language_uid:>:0',
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
                              --palette--;' . $lll . $table . '.palettes.basics;basics,
                              is_featured,
                              description,
                              image,
                              icon,
                              page,
                              anchor,
                        --div--;' . $lll . $table . '.tabs.variants,
                              product_set_variant_groups,
                        --div--;' . $lll . $table . '.tabs.technicalNotes,
                              show_technicalnots,
                              minimum_door_weight,
                              maximum_door_weight,
                              height,
                              door_leaf_thickness,
                              maximum_door_width,
                              minimum_door_width,
                              minimum_door_width_soft_close,
                              minimum_door_width_soft_close_long,
                              minimum_door_width_soft_close_both,
                              minimum_door_thickness,
                              maximum_door_thickness,
                              voltage,
                        --div--;' . $lll . $table . '.tabs.dinEn1527,
                              show_din,
                              use_categorie,
                              durability,
                              door_weight,
                              fire_resistance,
                              safety,
                              corrosion_resistance,
                              security,
                              door_type,
                              initial_friction,
                        --div--;' . $lll . $table . '.tabs.invitation_to_tender,
                              invitation_to_tender,
                        --div--;' . $lll . $table . '.tabs.downloads,
                              image_engineering_drawings,
                              downloads,
                              download_engineering_drawings,
                        --div--;' . $lll . $table . '.tabs.accessory_kit,
                              accessorykit_groups,
                        --div--;' . $lll . $table . '.tabs.filter,
                              --palette--;' . $lll . $table . '.palettes.material;material,
                              filter_wingcount,
                              --palette--;' . $lll . $table . '.palettes.design;design,
                              --palette--;' . $lll . $table . '.palettes.configuration;configuration,
                              --palette--;' . $lll . $table . '.palettes.montage;montage,
                        --div--;LLL:EXT:core/Resources/Private/Language/Form/locallang_tabs.xlf:access,
                            hidden,
            ',
            ]
        ],

        'palettes' => [
            'basics' => [
                'showitem' => '
                name,
                is_accessory_kit
        '
            ],
            'material' => [
                'showitem' => '
                filter_material_wood,
                filter_material_glas
        '
            ],
            'design' => [
                'showitem' => '
                filter_design_customer,
                filter_design_alu,
                filter_design_design

         '
            ],
            'configuration' => [
                'showitem' => '
                  filter_soft_close,
                  filter_et3,
                  filter_tfold,
                  filter_synchron,
                  filter_telescop2,
                  filter_telescop3,
                  filter_tclose,
                  filter_tmaster
        '
            ],
            'montage' => [
                'showitem' => '
                filter_montage_wall,
                filter_montage_ceiling,
                filter_montage_in
        '
            ],
        ],
    ];
});
