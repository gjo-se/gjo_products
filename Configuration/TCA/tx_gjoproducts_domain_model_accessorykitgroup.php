<?php
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

$ext = 'gjo_products';
$lll = 'LLL:EXT:' . $ext . '/Resources/Private/Language/locallang_db.xlf:';
$table = 'tx_gjoproducts_domain_model_accessorykitgroup';

return [

    'ctrl' => [
        'title' => $lll . $table,
        'label' => 'headline',

        'rootLevel' => 0, // 0 = PageTree, 1 = Root, -1 = All
        'iconfile' => 'EXT:' . $ext . '/Resources/Public/Icons/products_icon.png',
        'hideTable' => true,

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

        'product_set' => [
            'config' => [
                'type' => 'passthrough',
            ],
        ],

        'accessory_kits' => [
            'label' => $lll . $table . '.accessory_kits',
            'config' => [
                'type' => 'select',
                'renderType' => 'selectMultipleSideBySide',
                'foreign_table' => 'tx_gjoproducts_domain_model_productset',
                'foreign_table_where' => 'tx_gjoproducts_domain_model_productset.is_accessory_kit = 1 ORDER BY name',
                'MM' => 'tx_gjoproducts_productset_accessorykit_mm',
                'MM_opposite_field' => 'name',
                'size' => 10,
                'autoSizeMax' => 30,
                'maxitems' => 14,
                'multiple' => 0
            ],
        ],

        'headline' => [
            'label' => $lll . $table . '.headline',
            'config' => [
                'type' => 'input'
            ]
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
                            headline, 
                            accessory_kits,
                        --div--;LLL:EXT:core/Resources/Private/Language/Form/locallang_tabs.xlf:access, 
                            hidden,
            ',
        ]
    ],
];