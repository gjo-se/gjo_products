<?php

declare(strict_types=1);

use TYPO3\CMS\Core\Utility\ExtensionManagementUtility;

call_user_func(function (): void {

    $ext   = 'gjo_products';
    $lll   = 'LLL:EXT:' . $ext . '/Resources/Private/Language/';

    ExtensionManagementUtility::addTcaSelectItemGroup(
        'tt_content',
        'CType',
        'gjose-products',
        $lll . 'locallang_be.xlf:plugin.group.products',
        'after:gjose-content-elements'
    );

});
