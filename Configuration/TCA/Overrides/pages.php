<?php

declare(strict_types=1);

use TYPO3\CMS\Core\Utility\ExtensionManagementUtility;

call_user_func(function(): void
{
    $extensionKey = 'gjo_products';

    ExtensionManagementUtility::registerPageTSConfigFile(
        $extensionKey,
        'Configuration/TsConfig/Page/Page.tsconfig',
        'GjoSe Products'
    );
});
