<?php

call_user_func(
    static function (): void {

        $extensionKey = 'gjo_products';

        TYPO3\CMS\Extbase\Utility\ExtensionUtility::registerPlugin(
            $extensionKey,
            'Product',
            'Produkte'
        );

        $quotationPluginSignature = str_replace('_', '', $extensionKey) . '_product';
        $GLOBALS['TCA']['tt_content']['types']['list']['subtypes_addlist'][$quotationPluginSignature] = 'pi_flexform';
        TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addPiFlexFormValue($quotationPluginSignature, 'FILE:EXT:' . $extensionKey . '/Configuration/FlexForms/product.xml');
    }
);