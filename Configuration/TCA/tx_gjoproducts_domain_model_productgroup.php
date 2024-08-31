<?php

declare(strict_types=1);

use GjoSe\GjoApi\Utility\TcaUtility;

return (function (): array {

    $ext = 'gjo_products';
    $lll = 'LLL:EXT:' . $ext . '/Resources/Private/Language/locallang_db.xlf:';
    $table = 'tx_gjoproducts_domain_model_productgroup';

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
                    'type' => 'input',
                ],
            ],

            'sub_header' => [
                'label' => $lll . $table . '.sub_header',
                'description' => $lll . $table . '.sub_header',
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

            'image' => [
                'label' => $lll . $table . '.image',
                'description' => $lll . $table . '.image',
                'config' => [
                    'type' => 'file',
                    'maxitems' => 1,
                    'allowed' => 'common-media-types',
                ],
            ],

            'teaser_header' => [
                'label' => $lll . $table . '.teaser_header',
                'description' => $lll . $table . '.teaser_header',
                'l10n_mode' => 'prefixLangTitle',
                'config' => [
                    'type' => 'input',
                ],
            ],

            'teaser_description' => [
                'label' => $lll . $table . '.teaser_description',
                'description' => $lll . $table . '.teaser_description',
                'config' => [
                    'type' => 'text',
                    'cols' => 40,
                    'rows' => 6,
                    'enableRichtext' => true,
                ],
            ],

            'teaser_image' => [
                'label' => $lll . $table . '.teaser_image',
                'description' => $lll . $table . '.teaser_image',
                'config' => [
                    'type' => 'file',
                    'maxitems' => 1,
                    'allowed' => 'common-media-types',
                ],
            ],

            ...TcaUtility::getDefaultTcaColumns($table),

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
})();
