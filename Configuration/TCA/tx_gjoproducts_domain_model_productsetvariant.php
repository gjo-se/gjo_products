<?php

declare(strict_types=1);

use GjoSe\GjoApi\Utility\TcaUtility;

return (function (): array {

    $ext = 'gjo_products';
    $lll = 'LLL:EXT:' . $ext . '/Resources/Private/Language/locallang_db.xlf:';
    $table = 'tx_gjoproducts_domain_model_productsetvariant';

    return [

        'ctrl' => [
            'title' => $lll . $table,
            'label' => 'name',

            'rootLevel' => 0, // 0 = PageTree, 1 = Root, -1 = All
            'iconfile' => 'EXT:' . $ext . '/Resources/Public/Icons/products_icon.png',
            'default_sortby' => 'name ASC, article_number ASC',
            'searchFields' => 'name, article_number',
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

            'product_set_variant_group' => [
                'config' => [
                    'type' => 'passthrough',
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

            'article_number' => [
                'label' => $lll . $table . '.article_number',
                'description' => $lll . $table . '.article_number',
                'l10n_mode' => 'prefixLangTitle',
                'config' => [
                    'type' => 'input',
                ],
            ],

            'price' => [
                'label' => $lll . $table . '.price',
                'description' => $lll . $table . '.price',
                'config' => [
                    'type' => 'number',
                    'eval' => 'double2',
                    'size' => 10,
                    'default' => 0,
                ],
            ],

            'tax' => [
                'label' => $lll . $table . '.tax',
                'description' => $lll . $table . '.tax',
                'l10n_mode' => 'prefixLangTitle',
                'config' => [
                    'type' => 'input',
                    'default' => 0,
                ],
            ],

            'material' => [
                'label' => $lll . $table . '.material',
                'description' => $lll . $table . '.material',
                'config' => [
                    'type' => 'select',
                    'renderType' => 'selectSingle',
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
                'label' => $lll . $table . '.length',
                'description' => $lll . $table . '.length',
                'l10n_mode' => 'prefixLangTitle',
                'config' => [
                    'type' => 'input',
                    'default' => 0,
                ],
            ],

            'version' => [
                'label' => $lll . $table . '.version',
                'description' => $lll . $table . '.version',
                'config' => [
                    'type' => 'select',
                    'renderType' => 'selectSingle',
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
                            'label' => 'Ergänzungsset',
                            'value' => 'accessoryKit',
                        ],
                        [
                            'label' => 'Kartongarnitur',
                            'value' => 'boxed-set',
                        ],
                    ],
                    'default' => 0,
                ],
            ],

            ...TcaUtility::getDefaultTcaColumns($table),

        ],

        'types' => [
            '0' => [
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
            ],
        ],
    ];
})();
