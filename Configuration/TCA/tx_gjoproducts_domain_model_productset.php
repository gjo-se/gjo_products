<?php
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

$ext   = 'gjo_products';
$lll   = 'LLL:EXT:' . $ext . '/Resources/Private/Language/locallang_db.xlf:';
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
            'label'  => $lll . $table . '.product_set_variant_groups',
            'config' => [
                'type'          => 'inline',
                'foreign_table' => 'tx_gjoproducts_domain_model_productsetvariantgroup',
                'foreign_field' => 'product_set',
                'maxitems'      => 9999,
                'appearance'    => [
                    'collapseAll'                     => 1,
                    'expandSingle'                    => 1,
                    'levelLinksPosition'              => 'top',
                    'showSynchronizationLink'         => 1,
                    'showPossibleLocalizationRecords' => 1,
                    'showAllLocalizationLink'         => 1,
                    'useSortable'                     => true,
                    'enabledControls'                 => [
                        'info'     => true,
                        'new'      => true,
                        'dragdrop' => true,
                        'sort'     => true,
                        'hide'     => true,
                        'delete'   => true,
                        'localize' => true,
                    ],
                ],
            ],
        ],

        'accessorykit_groups' => [
            'label'  => $lll . $table . '.accessorykit_groups',
            'displayCond' => 'FIELD:is_accessory_kit:REQ:false',
            'config' => [
                'type'          => 'inline',
                'foreign_table' => 'tx_gjoproducts_domain_model_accessorykitgroup',
                'foreign_field' => 'product_set',
                'maxitems'      => 9999,
                'appearance'    => [
                    'collapseAll'                     => 1,
                    'expandSingle'                    => 1,
                    'levelLinksPosition'              => 'top',
                    'showSynchronizationLink'         => 1,
                    'showPossibleLocalizationRecords' => 1,
                    'showAllLocalizationLink'         => 1,
                    'useSortable'                     => true,
                    'enabledControls'                 => [
                        'info'     => true,
                        'new'      => true,
                        'dragdrop' => true,
                        'sort'     => true,
                        'hide'     => true,
                        'delete'   => true,
                        'localize' => true,
                    ],
                ],
            ],
        ],

        'pages' => [
            'displayCond' => 'FIELD:is_accessory_kit:REQ:false',
            'label'  => $lll . $table . '.pages',
            'config' => [
                'type'          => 'group',
                'allowed'       => 'pages',
                'size'          => 1,
                'maxitems'      => 1,
                'minitems'      => 0,
                'default' => 0,
            ],
        ],

        'name' => [
            'label'  => $lll . $table . '.name',
            'config' => [
                'type' => 'input'
            ]
        ],

        'anchor' => [
            'label'  => $lll . $table . '.anchor',
            'displayCond' => 'FIELD:is_accessory_kit:REQ:true',
            'config' => [
                'type' => 'input'
            ]
        ],

        'is_accessory_kit' => [
            'label'  => $lll . $table . '.is_accessory_kit',
            'onChange' => 'reload',
            'config' => [
                'type' => 'check',
            ],
        ],

        'is_featured' => [
            'label'  => $lll . $table . '.is_featured',
            'displayCond' => 'FIELD:is_accessory_kit:REQ:false',
            'config' => [
                'type' => 'check',
            ],
        ],

        'description' => [
            'label'  => $lll . $table . '.description',
            'config' => [
                'type'           => 'text',
                'cols'           => 40,
                'rows'           => 6,
                'enableRichtext' => true
            ],
        ],

        'image' => [
            'label'  => $lll . $table . '.image',
            'config' => \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::getFileFieldTCAConfig(
                'image',
                [
                    'maxitems'         => 2,
                    'overrideChildTca' => [
                        'types' => [
                            \TYPO3\CMS\Core\Resource\File::FILETYPE_IMAGE => [
                                'showitem' => '
                                            --palette--;LLL:EXT:lang/Resources/Private/Language/locallang_tca.xlf:sys_file_reference.imageoverlayPalette;imageoverlayPalette,
                                            --palette--;;filePalette'
                            ],
                        ],
                    ],

                ],
                $GLOBALS['TYPO3_CONF_VARS']['GFX']['imagefile_ext']
            ),
        ],

        'icon' => [
            'displayCond' => 'FIELD:is_accessory_kit:REQ:true',
            'label'  => $lll . $table . '.icon',
            'config' => \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::getFileFieldTCAConfig(
                'icon',
                [
                    'maxitems'         => 1,
                    'overrideChildTca' => [
                        'types' => [
                            \TYPO3\CMS\Core\Resource\File::FILETYPE_IMAGE => [
                                'showitem' => '
                                            --palette--;LLL:EXT:lang/Resources/Private/Language/locallang_tca.xlf:sys_file_reference.imageoverlayPalette;imageoverlayPalette,
                                            --palette--;;filePalette'
                            ],
                        ],
                    ],

                ],
                $GLOBALS['TYPO3_CONF_VARS']['GFX']['imagefile_ext']
            ),
        ],


        'show_technicalnots' => [
            'label'    => $lll . $table . '.show_technicalnots',
            'config'   => [
                'type' => 'check',
            ],
            'onChange' => 'reload',
        ],

        'minimum_door_weight' => [
            'displayCond' => 'FIELD:show_technicalnots:REQ:true',
            'label'       => $lll . $table . '.minimum_door_weight',
            'config'      => [
                'type' => 'input',

            ]
        ],

        'maximum_door_weight' => [
            'displayCond' => 'FIELD:show_technicalnots:REQ:true',
            'label'       => $lll . $table . '.maximum_door_weight',
            'config'      => [
                'type' => 'input',

            ]
        ],

        'height' => [
            'displayCond' => 'FIELD:show_technicalnots:REQ:true',
            'label'       => $lll . $table . '.height',
            'config'      => [
                'type' => 'input'
            ]
        ],

        'minimum_door_thickness' => [
            'displayCond' => 'FIELD:show_technicalnots:REQ:true',
            'label'       => $lll . $table . '.minimum_door_thickness',
            'config'      => [
                'type' => 'input'
            ]
        ],

        'maximum_door_thickness' => [
            'displayCond' => 'FIELD:show_technicalnots:REQ:true',
            'label'       => $lll . $table . '.maximum_door_thickness',
            'config'      => [
                'type' => 'input'
            ]
        ],

        'minimum_door_width' => [
            'displayCond' => 'FIELD:show_technicalnots:REQ:true',
            'label'       => $lll . $table . '.minimum_door_width',
            'config'      => [
                'type' => 'input'
            ]
        ],

        'maximum_door_width' => [
            'displayCond' => 'FIELD:show_technicalnots:REQ:true',
            'label'       => $lll . $table . '.maximum_door_width',
            'config'      => [
                'type' => 'input'
            ]
        ],

        'minimum_door_width_soft_close' => [
            'displayCond' => 'FIELD:show_technicalnots:REQ:true',
            'label'       => $lll . $table . '.minimum_door_width_soft_close',
            'config'      => [
                'type' => 'input'
            ]
        ],

        'minimum_door_width_soft_close_long' => [
            'displayCond' => 'FIELD:show_technicalnots:REQ:true',
            'label'       => $lll . $table . '.minimum_door_width_soft_close_long',
            'config'      => [
                'type' => 'input'
            ]
        ],

        'minimum_door_width_soft_close_both' => [
            'displayCond' => 'FIELD:show_technicalnots:REQ:true',
            'label'       => $lll . $table . '.minimum_door_width_soft_close_both',
            'config'      => [
                'type' => 'input'
            ]
        ],

        'voltage' => [
            'displayCond' => 'FIELD:show_technicalnots:REQ:true',
            'label'       => $lll . $table . '.voltage',
            'config'      => [
                'type' => 'input'
            ]
        ],

        'show_din' => [
            'label'    => $lll . $table . '.show_din',
            'config'   => [
                'type' => 'check',
            ],
            'onChange' => 'reload',
        ],

        'use_categorie' => [
            'displayCond' => 'FIELD:show_din:REQ:true',
            'label'       => $lll . $table . '.use_categorie',
            'config'      => [
                'type' => 'input'
            ]
        ],

        'durability' => [
            'displayCond' => 'FIELD:show_din:REQ:true',
            'label'       => $lll . $table . '.durability',
            'config'      => [
                'type' => 'input'
            ]
        ],

        'door_weight' => [
            'displayCond' => 'FIELD:show_din:REQ:true',
            'label'       => $lll . $table . '.door_weight',
            'config'      => [
                'type' => 'input'
            ]
        ],

        'fire_resistance' => [
            'displayCond' => 'FIELD:show_din:REQ:true',
            'label'       => $lll . $table . '.fire_resistance',
            'config'      => [
                'type' => 'input'
            ]
        ],

        'safety' => [
            'displayCond' => 'FIELD:show_din:REQ:true',
            'label'       => $lll . $table . '.safety',
            'config'      => [
                'type' => 'input'
            ]
        ],

        'corrosion_resistance' => [
            'displayCond' => 'FIELD:show_din:REQ:true',
            'label'       => $lll . $table . '.corrosion_resistance',
            'config'      => [
                'type' => 'input'
            ]
        ],

        'security' => [
            'displayCond' => 'FIELD:show_din:REQ:true',
            'label'       => $lll . $table . '.security',
            'config'      => [
                'type' => 'input'
            ]
        ],

        'door_type' => [
            'displayCond' => 'FIELD:show_din:REQ:true',
            'label'       => $lll . $table . '.door_type',
            'config'      => [
                'type' => 'input'
            ]
        ],

        'initial_friction' => [
            'displayCond' => 'FIELD:show_din:REQ:true',
            'label'       => $lll . $table . '.initial_friction',
            'config'      => [
                'type' => 'input'
            ]
        ],

        'invitation_to_tender' => [
            'label'  => $lll . $table . '.invitation_to_tender',
            'config' => [
                'type'           => 'text',
                'cols'           => 40,
                'rows'           => 6,
                'enableRichtext' => true
            ],
        ],

        'download' => [
            'label'  => $lll . $table . '.download',
            'config' => \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::getFileFieldTCAConfig(
                'download',
                [
                    'maxitems' => 99
                ],
                'pdf, dwg, dxf'
            ),
        ],

        'download_engineering_drawing' => [
            'label'  => $lll . $table . '.download_engineering_drawing',
            'config' => \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::getFileFieldTCAConfig(
                'download_engineering_drawing',
                [
                    'maxitems' => 99
                ],
                'pdf, dwg, dxf'
            ),
        ],

        'image_engineering_drawing' => [
            'label'  => $lll . $table . '.image_engineering_drawing',
            'config' => \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::getFileFieldTCAConfig(
                'image_engineering_drawing',
                [
                    'maxitems'         => 10,
                    'overrideChildTca' => [
                        'types' => [
                            \TYPO3\CMS\Core\Resource\File::FILETYPE_IMAGE => [
                                'showitem' => '
                                            --palette--;LLL:EXT:lang/Resources/Private/Language/locallang_tca.xlf:sys_file_reference.imageoverlayPalette;imageoverlayPalette,
                                            --palette--;;filePalette'
                            ],
                        ],
                    ],

                ],
                $GLOBALS['TYPO3_CONF_VARS']['GFX']['imagefile_ext']
            ),
        ],

        'filter_montage_wall' => [
            'displayCond' => 'FIELD:is_accessory_kit:REQ:false',
            'label'  => $lll . $table . '.filter_montage_wall',
            'config' => [
                'type' => 'check',
            ],
        ],

        'filter_montage_ceiling' => [
            'displayCond' => 'FIELD:is_accessory_kit:REQ:false',
            'label'  => $lll . $table . '.filter_montage_ceiling',
            'config' => [
                'type' => 'check',
            ],
        ],

        'filter_montage_in' => [
            'displayCond' => 'FIELD:is_accessory_kit:REQ:false',
            'label'  => $lll . $table . '.filter_montage_in',
            'config' => [
                'type' => 'check',
            ],
        ],

        ###############################################################################

        'sys_language_uid' => [
            'label'   => 'LLL:EXT:lang/Resources/Private/Language/locallang_general.xlf:LGL.language',
            'config' => [
                'type' => 'language',
            ]
        ],

        'l10n_parent'      => [
            'displayCond' => 'FIELD:sys_language_uid:>:0',
            'label'       => 'LLL:EXT:lang/Resources/Private/Language/locallang_general.xlf:LGL.l18n_parent',
            'config'      => [
                'type'                => 'select',
                'renderType'          => 'selectSingle',
                'items'               => [
                    [
                        'label' => '',
                        'value' => 0
                    ],
                ],
                'foreign_table'       => $table,
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
            'label'   => 'LLL:EXT:lang/Resources/Private/Language/locallang_general.xlf:LGL.hidden',
            'config'  => [
                'type' => 'check',
            ],
        ],

        'filter_material_wood' => [
            'displayCond' => 'FIELD:is_accessory_kit:REQ:false',
            'label'  => $lll . $table . '.filter_material_wood',
            'config' => [
                'type' => 'check'
            ]
        ],

        'filter_material_glas' => [
            'displayCond' => 'FIELD:is_accessory_kit:REQ:false',
            'label'  => $lll . $table . '.filter_material_glas',
            'config' => [
                'type' => 'check',
            ],
        ],

        'filter_wingcount' => [
            'displayCond' => 'FIELD:is_accessory_kit:REQ:false',
            'label'  => $lll . $table . '.filter_wingcount',
            'config' => [
                'type'       => 'select',
                'renderType' => 'selectSingleBox',
                'items'      => [
                    ['label' => '1-flügelig','value' => 1],
                    ['label' => '2-flügelig','value' => 2],
                    ['label' => '3-flügelig','value' => 3]
                ],
            ],
        ],

        'filter_design_customer' => [
            'displayCond' => 'FIELD:is_accessory_kit:REQ:false',
            'label'  => $lll . $table . '.filter_design_customer',
            'config' => [
                'type' => 'check',
            ],
        ],

        'filter_design_alu' => [
            'displayCond' => 'FIELD:is_accessory_kit:REQ:false',
            'label'  => $lll . $table . '.filter_design_alu',
            'config' => [
                'type' => 'check',
            ],
        ],

        'filter_design_design' => [
            'displayCond' => 'FIELD:is_accessory_kit:REQ:false',
            'label'  => $lll . $table . '.filter_design_design',
            'config' => [
                'type' => 'check',
            ],
        ],

        'filter_soft_close' => [
            'displayCond' => 'FIELD:is_accessory_kit:REQ:false',
            'label'  => $lll . $table . '.filter_soft_close',
            'config' => [
                'type' => 'check',
            ],
        ],

        'filter_et3' => [
            'displayCond' => 'FIELD:is_accessory_kit:REQ:false',
            'label'  => $lll . $table . '.filter_et3',
            'config' => [
                'type' => 'check',
            ],
        ],

        'filter_tclose' => [
            'displayCond' => 'FIELD:is_accessory_kit:REQ:false',
            'label'  => $lll . $table . '.filter_tclose',
            'config' => [
                'type' => 'check',
            ],
        ],

        'filter_tmaster' => [
            'displayCond' => 'FIELD:is_accessory_kit:REQ:false',
            'label'  => $lll . $table . '.filter_tmaster',
            'config' => [
                'type' => 'check',
            ],
        ],

        'filter_tfold' => [
            'displayCond' => 'FIELD:is_accessory_kit:REQ:false',
            'label'  => $lll . $table . '.filter_tfold',
            'config' => [
                'type' => 'check',
            ],
        ],

        'filter_synchron' => [
            'displayCond' => 'FIELD:is_accessory_kit:REQ:false',
            'label'  => $lll . $table . '.filter_synchron',
            'config' => [
                'type' => 'check',
            ],
        ],

        'filter_telescop2' => [
            'displayCond' => 'FIELD:is_accessory_kit:REQ:false',
            'label'  => $lll . $table . '.filter_telescop2',
            'config' => [
                'type' => 'check',
            ],
        ],

        'filter_telescop3' => [
            'displayCond' => 'FIELD:is_accessory_kit:REQ:false',
            'label'  => $lll . $table . '.filter_telescop3',
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
                              pages,
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
                              image_engineering_drawing,
                              download,  
                              download_engineering_drawing,
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
        'basics'      => [
            'showitem' => '
                name,
                is_accessory_kit
        '
        ],
        'material'      => [
            'showitem' => '
                filter_material_wood,
                filter_material_glas
        '
        ],
        'design'        => [
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
        'montage'       => [
            'showitem' => '
                filter_montage_wall,
                filter_montage_ceiling,
                filter_montage_in
        '
        ],
    ],

];