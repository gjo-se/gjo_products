<?php

declare(strict_types=1);

use TYPO3\CMS\Core\Utility\ExtensionManagementUtility;

(function (): void {
    $extensionKey = 'gjo_products';

    ExtensionManagementUtility::registerPageTSConfigFile(
        $extensionKey,
        'Configuration/TsConfig/Page/_Page.tsconfig',
        'GjoSe Products'
    );
})();
