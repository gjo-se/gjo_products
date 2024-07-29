<?php

declare(strict_types=1);

use TYPO3\CMS\Extbase\Utility\ExtensionUtility;
use TYPO3\CMS\Core\Utility\ExtensionManagementUtility;

call_user_func(
    static function (): void {

        $extensionKey = 'gjo_products';

        ExtensionUtility::registerPlugin(
            $extensionKey,
            'Product',
            'Produkte'
        );

        $quotationPluginSignature = str_replace('_', '', $extensionKey) . '_product';
        $GLOBALS['TCA']['tt_content']['types']['list']['subtypes_addlist'][$quotationPluginSignature] = 'pi_flexform';
        ExtensionManagementUtility::addPiFlexFormValue($quotationPluginSignature, 'FILE:EXT:' . $extensionKey . '/Configuration/FlexForms/product.xml');
    }
);
