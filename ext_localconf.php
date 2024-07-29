<?php

declare(strict_types=1);

use TYPO3\CMS\Core\Utility\ExtensionManagementUtility;
use TYPO3\CMS\Extbase\Utility\ExtensionUtility;

defined('TYPO3') || die('Access denied.');

call_user_func(
    static function (): void {

        $extensionKey = 'gjo_products';

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
    }
);