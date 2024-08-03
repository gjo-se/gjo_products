<?php

declare(strict_types=1);

use GjoSe\GjoProducts\Controller\ProductController;
use TYPO3\CMS\Extbase\Utility\ExtensionUtility;

defined('TYPO3') || die('Access denied.');

function configurePlugins(): void
{
    ExtensionUtility::configurePlugin(
        'GjoProducts',
        'ProductGroupTeaser',
        [ProductController::class => 'showProductGroupTeaser'],
        [],
        \TYPO3\CMS\Extbase\Utility\ExtensionUtility::PLUGIN_TYPE_CONTENT_ELEMENT
    );

    ExtensionUtility::configurePlugin(
        'GjoProducts',
        'ProductGroup',
        [ProductController::class => 'showProductGroup'],
        [],
        \TYPO3\CMS\Extbase\Utility\ExtensionUtility::PLUGIN_TYPE_CONTENT_ELEMENT
    );

    ExtensionUtility::configurePlugin(
        'GjoProducts',
        'ProductSet',
        [ProductController::class => 'showProductSet'],
        [],
        \TYPO3\CMS\Extbase\Utility\ExtensionUtility::PLUGIN_TYPE_CONTENT_ELEMENT
    );

}

configurePlugins();
