<?php

declare(strict_types=1);

use GjoSe\GjoSitePackage\Utility\TcaUtility;

return (function (): array {

    $ext = 'gjo_products';
    $lll = 'LLL:EXT:' . $ext . '/Resources/Private/Language/locallang_db.xlf:';
    $table = 'tx_gjoproducts_domain_model_product';

    return [

        'ctrl' => [
            'title' => $lll . $table,
            'label' => 'name',
            'label_alt' => 'article_number, additional_information',
            'label_alt_force' => 1,

            'rootLevel' => 0, // 0 = PageTree, 1 = Root, -1 = All
            'iconfile' => 'EXT:' . $ext . '/Resources/Public/Icons/products_icon.png',
            'default_sortby' => 'name ASC, article_number ASC',
            'searchFields' => 'name, article_number',

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

            'additional_information' => [
                'label' => $lll . $table . '.additional_information',
                'description' => $lll . $table . '.additional_information',
                'l10n_mode' => 'prefixLangTitle',
                'config' => [
                    'type' => 'input',
                ],
            ],

            'image' => [
                'label' => $lll . $table . '.image',
                'config' => [
                    'type' => 'file',
                    'maxitems' => 6,
                    'allowed' => 'common-media-types',
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
                            additional_information,
                            image,
                        --div--;LLL:EXT:core/Resources/Private/Language/Form/locallang_tabs.xlf:access,
                            hidden,
                ',
            ],
        ],
    ];
})();
