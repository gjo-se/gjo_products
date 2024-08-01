<?php

declare(strict_types=1);

use TYPO3\CMS\Core\Utility\ExtensionManagementUtility;
use TYPO3\CMS\Extbase\Utility\ExtensionUtility;

function registerProductGroupTeaserPlugin(): void
{
    $pluginSignature = ExtensionUtility::registerPlugin(
        'GjoProducts',
        'ProductGroupTeaser',
        'GjoSe - ProductGroupTeaser',
        null,
        'GjoSe'
    );

    ExtensionManagementUtility::addPiFlexFormValue(
        '*',
        'FILE:EXT:gjo_products/Configuration/FlexForms/' . $pluginSignature . '.xml',
        $pluginSignature
    );

    $GLOBALS['TCA']['tt_content']['types'][$pluginSignature]['showitem'] = '
        --div--;LLL:EXT:core/Resources/Private/Language/Form/locallang_tabs.xlf:general,
            --palette--;;general,
            --palette--;;headers,
        --div--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:tabs.plugin,
            pi_flexform,
        --div--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:tabs.appearance,
            --palette--;;frames,
            tx_gjositepackage_additional_css,
        --div--;LLL:EXT:core/Resources/Private/Language/Form/locallang_tabs.xlf:language,
            --palette--;;language,
        --div--;LLL:EXT:core/Resources/Private/Language/Form/locallang_tabs.xlf:access,
            --palette--;;hidden,
            --palette--;;access,
    ';
}

registerProductGroupTeaserPlugin();
