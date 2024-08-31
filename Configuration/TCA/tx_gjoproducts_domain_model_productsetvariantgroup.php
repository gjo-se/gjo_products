<?php

declare(strict_types=1);

use GjoSe\GjoApi\Utility\TcaUtility;

return (function (): array {

    $ext = 'gjo_products';
    $lll = 'LLL:EXT:' . $ext . '/Resources/Private/Language/locallang_db.xlf:';
    $table = 'tx_gjoproducts_domain_model_productsetvariantgroup';

    return [

        'ctrl' => [
            'title' => $lll . $table,
            'label' => 'table_headline',

            'rootLevel' => 0, // 0 = PageTree, 1 = Root, -1 = All
            'iconfile' => 'EXT:' . $ext . '/Resources/Public/Icons/products_icon.png',
            'default_sortby' => 'headline ASC',
            'searchFields' => 'headline',
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

            'product_set_variants' => [
                'label' => $lll . $table . '.product_set_variants',
                'config' => [
                    'type' => 'inline',
                    'foreign_table' => 'tx_gjoproducts_domain_model_productsetvariant',
                    'foreign_field' => 'product_set_variant_group', // passthrough
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

            'products' => [
                'label' => $lll . $table . '.products',
                'config' => [
                    'type' => 'select',
                    'renderType' => 'selectMultipleSideBySide',
                    'foreign_table' => 'tx_gjoproducts_domain_model_product',
                    'foreign_table_where' => 'tx_gjoproducts_domain_model_product.sys_language_uid = ###REC_FIELD_sys_language_uid### ORDER BY tx_gjoproducts_domain_model_product.name, tx_gjoproducts_domain_model_product.article_number',
                    'MM_opposite_field' => 'product_set_variantgroups',
                    'MM' => 'tx_gjoproducts_product_productsetvariantgroup_mm',
                    'size' => 10,
                    'autoSizeMax' => 30,
                    'maxitems' => 9999,
                    'multiple' => 0,
                    'fieldControl' => [
                        'editPopup' => [
                            'disabled' => false,
                        ],
                        'addRecord' => [
                            'disabled' => false,
                        ],
                        'listModule' => [
                            'disabled' => false,
                        ],
                    ],
                    'fieldWizard' => [
                        'recordsOverview' => [
                            'disabled' => false,
                        ],
                        'selectIcons' => [
                            'disabled' => false,
                        ],
                    ],
                ],
            ],

            'headline' => [
                'label' => $lll . $table . '.headline',
                'description' => $lll . $table . '.headline',
                'l10n_mode' => 'prefixLangTitle',
                'config' => [
                    'type' => 'input',
                ],
            ],

            'description' => [
                'label' => $lll . $table . '.description',
                'description' => $lll . $table . '.description',
                'l10n_mode' => 'prefixLangTitle',
                'config' => [
                    'type' => 'text',
                    'cols' => 40,
                    'rows' => 6,
                    'enableRichtext' => true,
                ],
            ],

            'table_headline' => [
                'label' => $lll . $table . '.table_headline',
                'description' => $lll . $table . '.table_headline',
                'l10n_mode' => 'prefixLangTitle',
                'config' => [
                    'type' => 'input',
                ],
            ],

            ...TcaUtility::getDefaultTcaColumns($table),

        ],

        'types' => [
            '0' => [
                'showitem' => '
                        --div--;LLL:EXT:core/Resources/Private/Language/Form/locallang_tabs.xlf:general,
                            table_headline,
                            products,
                            product_set_variants,
                        --div--;LLL:EXT:core/Resources/Private/Language/Form/locallang_tabs.xlf:access,
                            hidden,
            ',
            ],
        ],
    ];
})();
