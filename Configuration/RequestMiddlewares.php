<?php

declare(strict_types=1);

use GjoSe\GjoProducts\Middleware\GetProductFinderListMiddleware;

return (function (): array {
    return [
        'frontend' => [
            'gjo-se/gjo-products/get-product-finder-list' => [
                'target' => GetProductFinderListMiddleware::class,
                'after' => [
                    'typo3/cms-frontend/backend-user-authentication',
                ],
                //            'before' => [
                //                'typo3/cms-frontend/authentication',
                //            ],
            ],
        ],
    ];
})();
