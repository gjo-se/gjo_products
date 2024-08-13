<?php

declare(strict_types=1);

use TYPO3\CMS\Core\Utility\ExtensionManagementUtility;
use TYPO3\CMS\Extbase\Utility\ExtensionUtility;

function registerProductFinderPlugin(): void
{
    $pluginSignature = ExtensionUtility::registerPlugin(
        'GjoProducts',
        'ProductFinder',
        'GjoSe - ProductFinder',
        null,
        'gjose-products'
    );
}

registerProductFinderPlugin();
