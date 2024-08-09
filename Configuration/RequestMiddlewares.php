<?php

return [
    'frontend' => [
        'gjo-se/gjo-products/get-product-finder-list' => [
            'target' => \GjoSe\GjoProducts\Middleware\GetProductFinderListMiddleware::class,
            'after' => [
                'typo3/cms-frontend/backend-user-authentication',
            ],
//            'before' => [
//                'typo3/cms-frontend/authentication',
//            ],
        ],
    ],
];
