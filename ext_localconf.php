<?php

declare(strict_types=1);

use GjoSe\GjoProducts\Controller\ProductController;
use TYPO3\CMS\Extbase\Utility\ExtensionUtility;

(function (): void {
    $extensionKey = 'gjo_products';

    ExtensionUtility::configurePlugin(
        $extensionKey,
        'ProductGroupTeaser',
        [ProductController::class => 'showProductGroupTeaser'],
        [],
        ExtensionUtility::PLUGIN_TYPE_CONTENT_ELEMENT
    );

    ExtensionUtility::configurePlugin(
        $extensionKey,
        'ProductGroup',
        [ProductController::class => 'showProductGroup'],
        [],
        ExtensionUtility::PLUGIN_TYPE_CONTENT_ELEMENT
    );

    ExtensionUtility::configurePlugin(
        $extensionKey,
        'ProductSet',
        [ProductController::class => 'showProductSet'],
        [],
        ExtensionUtility::PLUGIN_TYPE_CONTENT_ELEMENT
    );

    ExtensionUtility::configurePlugin(
        $extensionKey,
        'ProductFinder',
        [ProductController::class => 'productFinder'],
        [],
        ExtensionUtility::PLUGIN_TYPE_CONTENT_ELEMENT
    );

})();
