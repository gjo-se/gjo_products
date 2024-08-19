<?php

declare(strict_types=1);

use GjoSe\GjoSitePackage\Utility\TcaUtility;

return (function (): array {

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
                    'multiple' => 0,
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

            ...TcaUtility::getDefaultTcaColumns($table),

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
            ],
        ],
    ];
})();
