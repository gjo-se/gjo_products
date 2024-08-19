<?php

declare(strict_types=1);

use TYPO3\CMS\Extbase\Utility\ExtensionUtility;

(function (): void {
    $extensionKey = 'gjo_products';

    ExtensionUtility::registerPlugin(
        $extensionKey,
        'ProductFinder',
        'GjoSe - ProductFinder',
        null,
        'gjose-products'
    );
})();
