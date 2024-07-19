<?php

use TYPO3\CMS\Core\Utility\ExtensionManagementUtility;
use TYPO3\CMS\Extbase\Utility\ExtensionUtility;

defined('TYPO3') or die('Access denied.');

call_user_func(
    static function (): void {

        $extensionKey = 'gjo_tiger';

        ExtensionUtility::configurePlugin(
            $extensionKey,
            'Product',
            [
                'Product' => 'showProductGroupTeaser, showProductGroup, showProductSet, ajaxProductSet, productFinder, ajaxListProducts',
            ],
            [
                'Product' => 'showProductGroupTeaser, showProductGroup, showProductSet, ajaxProductSet, productFinder, ajaxListProducts',
            ]
        );

        ExtensionManagementUtility::addPageTSConfig(
            '<INCLUDE_TYPOSCRIPT: source="FILE:EXT:' . $extensionKey . '/Configuration/PageTS/Mod/Wizards/newContentElement.t3s">'
        );
    }
);