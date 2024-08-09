<?php

declare(strict_types=1);

/*
 * This file is part of the TYPO3 CMS project.
 *
 * It is free software; you can redistribute it and/or modify it under
 * the terms of the GNU General Public License, either version 2
 * of the License, or any later version.
 *
 * For the full copyright and license information, please read the
 * LICENSE.txt file that was distributed with this source code.
 *
 * The TYPO3 project - inspiring people to share!
 */

namespace GjoSe\GjoProducts\Middleware;

use GjoSe\GjoProducts\Domain\Model\ProductSet;
use GjoSe\GjoProducts\Domain\Repository\ProductSetRepository;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Server\RequestHandlerInterface;
use TYPO3\CMS\Core\Http\HtmlResponse;
use TYPO3\CMS\Core\Site\Entity\Site;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Extbase\Persistence\Exception\InvalidQueryException;
use TYPO3\CMS\Extbase\Persistence\QueryResultInterface;
use TYPO3\CMS\Fluid\View\StandaloneView;

/**
 * This middleware can be used to retrieve a list of seasons with their according translation.
 * To get the correct translation the URL must be within a base path defined in site
 * handling. Some examples:
 * "/en/haiku-season-list.json" for English translation (if /en is the configured base path)
 * "/de/haiku-season-list.json" for German translation (if /de is the configured base path)
 * If the base path is not available in the according site the default language will be used.
 */
final class GetProductFinderListMiddleware implements MiddlewareInterface
{
    private const string QUERY_PARAM_KEY = 'middleware';

    private const string QUERY_PARAM_VALUE = 'getProductFinderList';

    private const int LIMIT = 6;

    private const int OFFSET = 0;

    /**
     * @throws InvalidQueryException
     */
    public function process(
        ServerRequestInterface $request,
        RequestHandlerInterface $handler
    ): ResponseInterface {

        /** @var string $queryParamValue */
        $queryParamValue = $request->getQueryParams()[self::QUERY_PARAM_KEY] ?? '';
        if ($queryParamValue !== self::QUERY_PARAM_VALUE) {
            return $handler->handle($request);
        }

        /** @var array<string, array<string>> $postParams */
        $postParams = $request->getParsedBody();

        /** @var array<string> $productFinderFilter */
        $productFinderFilter = $postParams['productFinderFilter'] ?? [];

        /** @var Site $site */
        $site = $request->getAttribute('site');
        $siteSettings = $site->getConfiguration()['settings'] ?? [];
        $siteView = $site->getConfiguration()['view'] ?? [];

        $offset = self::OFFSET;
        if (isset($postParams['offset']) && $postParams['offset'] !== 'NaN') {
            $offset = (int)$postParams['offset'];
        }

        /** @var ProductSetRepository $productSetRepository */
        $productSetRepository = GeneralUtility::makeInstance(ProductSetRepository::class);

        /** @var QueryResultInterface<ProductSet> $productSets */
        $productSets = $productSetRepository->findByFilter(
            $siteSettings,
            $productFinderFilter,
            (int)$offset,
            self::LIMIT
        );

        /** @var QueryResultInterface<ProductSet> $filteredProductSets */
        $filteredProductSets = $productSetRepository->findByFilter(
            $siteSettings,
            $productFinderFilter
        );
        $productSetsCount = $filteredProductSets->count();

        $breakpoints = [
            0 => ['cropVariant' => 'wideScreen', 'media' => '(min-width: 1200px)', 'srcset' => [0 => 1100]],
            1 => ['cropVariant' => 'desktop', 'media' => '(min-width: 992px)', 'srcset' => [0 => 950]],
            2 => ['cropVariant' => 'laptop', 'media' => '(min-width: 768px)', 'srcset' => [0 => 720]],
            3 => ['cropVariant' => 'tablet', 'media' => '(min-width: 576px)', 'srcset' => [0 => 540]],
            4 => ['cropVariant' => 'mobile', 'media' => '(min-width: 300px)', 'srcset' => [0 => 350]],
        ];

        /** @var StandaloneView $standAloneView */
        $standAloneView = GeneralUtility::makeInstance(StandaloneView::class);
        $standAloneView->setTemplatePathAndFilename(
            GeneralUtility::getFileAbsFileName($siteView['templateRootPaths'][0] . 'Product/ProductFinderList.html')
        );
        $standAloneView->setPartialRootPaths([
            GeneralUtility::getFileAbsFileName($siteView['partialRootPaths'][0]),
            GeneralUtility::getFileAbsFileName($siteView['partialRootPaths'][1] . 'ContentElements/'),
            GeneralUtility::getFileAbsFileName($siteView['partialRootPaths'][2]),
        ]);
        $standAloneView->assign('productSets', $productSets);
        $standAloneView->assign('productSetsCount', $productSetsCount);
        $standAloneView->assign('breakpoints', $breakpoints);

        return new HtmlResponse($standAloneView->render());
    }
}
