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
$table = 'tx_gjoproducts_domain_model_productsetvariant';

return [

    'ctrl' => [
        'title' => $lll . $table,
        'label' => 'name',

        'rootLevel' => 0, // 0 = PageTree, 1 = Root, -1 = All
        'iconfile' => 'EXT:' . $ext . '/Resources/Public/Icons/products_icon.png',
        'default_sortby' => 'name ASC, article_number ASC, additional_information ASC',
        'searchFields' => 'name, article_number',
        'hideTable'        => true,

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

        'product_set_variant_group' => [
            'config' => [
                'type' => 'passthrough',
            ],
        ],

        'name' => [
            'label'  => $lll . $table . '.name',
            'config' => [
                'type' => 'input'
            ]
        ],

        'article_number' => [
            'label'  => $lll . $table . '.article_number',
            'config' => [
                'type' => 'input'
            ]
        ],

        'price' => [
            'label'  => $lll . $table . '.price',
            'config' => [
                'type' => 'number',
                'eval' => 'double2',
                'size' => 10,
                'default' => 0,
            ],
        ],

        'tax' => [
            'label'  => $lll . $table . '.tax',
            'config' => [
                'type' => 'input',
                'default' => 0,
            ]
        ],

        'material' => [
            'label'  => $lll . $table . '.material',
            'config'      => [
                'type'                => 'select',
                'renderType'          => 'selectSingle',
                'items' => [
                    [
                        'label' => '---',
                        'value' => '0',
                    ],
                    [
                        'label' => 'ALU',
                        'value' => 'alu',
                    ],
                    [
                        'label' => 'EV1',
                        'value' => 'ev1',
                    ],
                    [
                        'label' => 'C31',
                        'value' => 'c31',
                    ],
                    [
                        'label' => 'schwarz',
                        'value' => 'black',
                    ],
                    [
                        'label' => 'silber',
                        'value' => 'silver',
                    ],
                    [
                        'label' => 'weiß',
                        'value' => 'white',
                    ],
                ],
                'default' => 0,
            ],

        ],

        'length' => [
            'label'  => $lll . $table . '.length',
            'config' => [
                'type' => 'input',
                'default' => 0,
            ]
        ],

        'version' => [
            'label'  => $lll . $table . '.version',
            'config' => [
                'type'                => 'select',
                'renderType'          => 'selectSingle',
                'items' => [
                    [
                        'label' => '---',
                        'value' => '0',
                    ],
                    [
                        'label' => '---ET3-Zubehör---',
                        'value' => '---',
                    ],
                    [
                        'label' => '1-Kanal',
                        'value' => '1-Channel',
                    ],
                    [
                        'label' => '4-Kanal',
                        'value' => '4-Channel',
                    ],
                    [
                        'label' => 'CleanSwitch',
                        'value' => 'cleanSwitch',
                    ],
                    [
                        'label' => 'Push Plate',
                        'value' => 'pushPlate',
                    ],
                    [
                        'label' => 'Taster',
                        'value' => 'button',
                    ],
                    [
                        'label' => '---DÄMPFUNG---',
                        'value' => '---',
                    ],
                    [
                        'label' => 'einseitig',
                        'value' => 'one-sided',
                    ],
                    [
                        'label' => 'einseitig kurz',
                        'value' => 'one-side-short',
                    ],
                    [
                        'label' => 'einseitig lang',
                        'value' => 'one-side-long',
                    ],
                    [
                        'label' => 'zweiseitig',
                        'value' => 'two-sided',
                    ],
                    [
                        'label' => '---WANDWINKEL---',
                        'value' => '---',
                    ],
                    [
                        'label' => 'fest',
                        'value' => 'fix',
                    ],
                    [
                        'label' => 'verstellbar',
                        'value' => 'adjustable',
                    ],
                    [
                        'label' => '---ENDKAPPEN FÜR---',
                        'value' => '---',
                    ],
                    [
                        'label' => 'Holz',
                        'value' => 'wood',
                    ],
                    [
                        'label' => 'Holz MX',
                        'value' => 'wood_mx',
                    ],
                    [
                        'label' => 'Glas',
                        'value' => 'glass',
                    ],
                    [
                        'label' => 'ET3 Holz',
                        'value' => 'et3_wood',
                    ],
                    [
                        'label' => 'ET3 Glas',
                        'value' => 'et3_glass',
                    ],
                    [
                        'label' => '---Sonstiges---',
                        'value' => '---',
                    ],
                    [
                        'label' => 'MX',
                        'value' => 'mx',
                    ],
                    [
                        'label' => 'System-Set',
                        'value' => 'system-set',
                    ],
                    [
                        'label' => 'Ergänzungs-Set',
                        'value' => 'accessoryKit',
                    ],
                    [
                        'label' => 'Kartongarnitur',
                        'value' => 'boxed-set',
                    ],
                ],
                'default' => 0,
            ]
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
                'foreign_table_where' => 'AND' . $table . '.pid=###CURRENT_PID### AND ' . $table . '.sys_language_uid IN (-1,0]',
                'default' => 0,
            ],
        ],
        'l10n_diffsource'  => [
            'config' => [
                'type' => 'passthrough',
            ],
        ],

        'hidden' => [
            'label'   => 'LLL:EXT:lang/Resources/Private/Language/locallang_general.xlf:LGL.hidden',
            'config'  => [
                'type' => 'check',
            ],
        ],

    ],

    'types' => [
        '1' => [
            'showitem' => '
                        --div--;LLL:EXT:core/Resources/Private/Language/Form/locallang_tabs.xlf:general, 
                            name, 
                            article_number, 
                            material,
                            length,
                            version,
                        --div--;' . $lll . $table . '.tabs.price, 
                            price,
                            tax, 
                        --div--;LLL:EXT:core/Resources/Private/Language/Form/locallang_tabs.xlf:access, 
                            hidden,
            ',
        ]
    ],
];