<?php

declare(strict_types=1);

use TYPO3\CMS\Core\Imaging\IconProvider\SvgIconProvider;

// @todo-methodClean:
// foreach file in folder

return (function (): array {
    $iconList = [];
    foreach ([
        'actions-approve' => 'actions-approve.svg',
        'actions-decline' => 'actions-decline.svg',
        'extension' => 'extension.svg',
        'plugin-products' => 'plugin-products.svg',
    ] as $identifier => $path) {
        $iconList[$identifier] = [
            'provider' => SvgIconProvider::class,
            'source' => 'EXT:gjo_products/Resources/Public/Icons/' . $path,
        ];
    }

    return $iconList;
})();
