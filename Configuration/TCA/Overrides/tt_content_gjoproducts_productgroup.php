<?php

declare(strict_types=1);

use TYPO3\CMS\Core\Utility\ExtensionManagementUtility;
use TYPO3\CMS\Extbase\Utility\ExtensionUtility;

function registerProductGroupPlugin(): void
{
    $pluginSignature = ExtensionUtility::registerPlugin(
        'GjoProducts',
        'ProductGroup',
        'GjoSe - ProductGroup',
        null,
        'gjose-products'
    );

    ExtensionManagementUtility::addPiFlexFormValue(
        '*',
        'FILE:EXT:gjo_products/Configuration/FlexForms/' . $pluginSignature . '.xml',
        $pluginSignature
    );

    $table = 'tt_content';
    $column = 'pi_flexform';
    ExtensionManagementUtility::addToAllTCAtypes($table, $column, $pluginSignature, 'after:header');
}

registerProductGroupPlugin();
