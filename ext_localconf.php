<?php

declare(strict_types=1);

use GjoSe\GjoProducts\Controller\ProductController;
use TYPO3\CMS\Extbase\Utility\ExtensionUtility;

(function (): void {
    $extensionKey = 'gjo_products';

    $configurePlugin = function (string $pluginName, string $controllerAction) use ($extensionKey): void {
        ExtensionUtility::configurePlugin(
            $extensionKey,
            $pluginName,
            [ProductController::class => $controllerAction],
            [],
            ExtensionUtility::PLUGIN_TYPE_CONTENT_ELEMENT
        );
    };

    $configurePlugin('ProductGroupTeaser', 'showProductGroupTeaser');
    $configurePlugin('ProductGroup', 'showProductGroup');
    $configurePlugin('ProductSet', 'showProductSet');
    $configurePlugin('ProductFinder', 'productFinder');

})();
