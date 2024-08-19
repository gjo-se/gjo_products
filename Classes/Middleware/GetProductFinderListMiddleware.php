<?php

declare(strict_types=1);

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
use GjoSe\GjoSitePackage\Utility\CroppingUtility;

final class GetProductFinderListMiddleware implements MiddlewareInterface
{
    private const string QUERY_PARAM_KEY = 'middleware';

    private const string QUERY_PARAM_VALUE = 'getProductFinderList';

    private const int LIMIT = 6;

    private const int OFFSET = 0;

    public function __construct(
        private readonly ProductSetRepository $productSetRepository,
        private readonly StandaloneView $standAloneView
    ) {}

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

        /** @var QueryResultInterface<ProductSet> $productSets */
        $productSets = $this->productSetRepository->findByFilter(
            $siteSettings,
            $productFinderFilter,
            (int)$offset,
            self::LIMIT
        );

        /** @var QueryResultInterface<ProductSet> $filteredProductSets */
        $filteredProductSets = $this->productSetRepository->findByFilter(
            $siteSettings,
            $productFinderFilter
        );
        $productSetsCount = $filteredProductSets->count();

        $this->standAloneView->setTemplatePathAndFilename(
            GeneralUtility::getFileAbsFileName($siteView['templateRootPaths'][0] . 'Product/ProductFinderList.html')
        );
        $this->standAloneView->setPartialRootPaths([
            GeneralUtility::getFileAbsFileName($siteView['partialRootPaths'][0]),
            GeneralUtility::getFileAbsFileName($siteView['partialRootPaths'][1] . 'ContentElements/'),
            GeneralUtility::getFileAbsFileName($siteView['partialRootPaths'][2]),
        ]);
        $this->standAloneView->assign('productSets', $productSets);
        $this->standAloneView->assign('productSetsCount', $productSetsCount);
        $this->standAloneView->assign('breakpoints', CroppingUtility::getDefaultBreakpoints());

        return new HtmlResponse($this->standAloneView->render());
    }
}
