<?php

declare(strict_types=1);

use GjoSe\GjoApi\Utility\TcaUtility;

return (function (): array {

    $ext = 'gjo_products';
    $lll = 'LLL:EXT:' . $ext . '/Resources/Private/Language/locallang_db.xlf:';
    $table = 'tx_gjoproducts_domain_model_productsettype';

    return [

        'ctrl' => [
            'title' => $lll . $table,
            'label' => 'name',

            'rootLevel' => 0, // 0 = PageTree, 1 = Root, -1 = All
            'iconfile' => 'EXT:' . $ext . '/Resources/Public/Icons/products_icon.png',
            'default_sortby' => 'name ASC',
            'searchFields' => 'name',
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

            'product_group' => [
                'config' => [
                    'type' => 'passthrough',
                ],
            ],

            'product_sets' => [
                'label' => $lll . $table . '.product_sets',
                'description' => $lll . $table . '.product_sets',
                'config' => [
                    'type' => 'select',
                    'renderType' => 'selectMultipleSideBySide',
                    'foreign_table' => 'tx_gjoproducts_domain_model_productset',
                    'foreign_table_where' => 'tx_gjoproducts_domain_model_productset.sys_language_uid = ###REC_FIELD_sys_language_uid### ORDER BY tx_gjoproducts_domain_model_productset.name',
                    'MM_opposite_field' => 'product_set_type',
                    'MM' => 'tx_gjoproducts_productset_productsettype_mm',
                    'size' => 10,
                    'autoSizeMax' => 30,
                    'maxitems' => 9999,
                    'multiple' => 0,
                ],
            ],

            'name' => [
                'label' => $lll . $table . '.name',
                'description' => $lll . $table . '.name',
                'l10n_mode' => 'prefixLangTitle',
                'config' => [
                    'type' => 'input',
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

            ...TcaUtility::getDefaultTcaColumns($table),

        ],

        'types' => [
            '0' => [
                'showitem' => '
                        --div--;LLL:EXT:core/Resources/Private/Language/Form/locallang_tabs.xlf:general,
                            product_group,
                            name,
                            product_sets,
                        --div--;LLL:EXT:core/Resources/Private/Language/Form/locallang_tabs.xlf:access,
                            hidden,
            ',
            ],
        ],
    ];
})();
