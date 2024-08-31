<?php

declare(strict_types=1);

namespace GjoSe\GjoProducts\Middleware;

use GjoSe\GjoApi\Service\Site\SiteSettingsService;
use GjoSe\GjoApi\Service\Template\StandaloneViewService;
use GjoSe\GjoApi\Utility\CroppingUtility;
use GjoSe\GjoProducts\Domain\Model\ProductSet;
use GjoSe\GjoProducts\Domain\Repository\ProductSetRepository;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Server\RequestHandlerInterface;
use TYPO3\CMS\Core\Http\HtmlResponse;
use TYPO3\CMS\Extbase\Persistence\Exception\InvalidQueryException;
use TYPO3\CMS\Extbase\Persistence\QueryResultInterface;

final class GetProductFinderListMiddleware extends AbstractMiddleware implements MiddlewareInterface
{
    private const string QUERY_PARAM_SEARCH_VALUE = 'getProductFinderList';

    // @todo-next-iteration:
    // - Move LIMIT and OFFSET to a configuration file
    private const int LIMIT = 6;

    private const int OFFSET = 0;

    private const string TEMPLATE = 'Product/ProductFinderList.html';

    public function __construct(
        private readonly ProductSetRepository $productSetRepository,
        private readonly StandaloneViewService $standaloneViewService,
        private readonly SiteSettingsService $siteSettingsService,
    ) {}

    /**
     * @throws InvalidQueryException
     */
    public function process(
        ServerRequestInterface $request,
        RequestHandlerInterface $handler
    ): ResponseInterface {

        $this->request = $request;

        if (!$this->checkRequestHasQueryParamSearchValue(self::QUERY_PARAM_SEARCH_VALUE)) {
            return $handler->handle($this->request);
        }

        $standaloneView = $this->standaloneViewService->configureStandaloneView(self::TEMPLATE);
        $standaloneView->assignMultiple([
            'productSets' => $this->getProductSets(),
            'productSetsCount' => $this->getProductSetsCount(),
            'breakpoints' => CroppingUtility::getDefaultBreakpoints(),
        ]);

        return new HtmlResponse($standaloneView->render());
    }

    /**
     * @return ?QueryResultInterface<ProductSet>
     * @throws InvalidQueryException
     */
    private function getProductSets(): ?QueryResultInterface
    {
        return $this->productSetRepository->findByFilter(
            $this->siteSettingsService->getSiteSettings(),
            $this->getProductFinderFilter(),
            $this->getOffset(),
            self::LIMIT
        );
    }

    private function getProductFinderFilter(): array
    {
        $postParams = $this->getPostParams();
        return is_array($postParams) ? ($postParams['productFinderFilter'] ?? []) : [];
    }

    private function getOffset(): int
    {
        $postParams = $this->getPostParams();
        return is_array($postParams) && isset($postParams['offset']) && $postParams['offset'] !== 'NaN' ? (int)$postParams['offset'] : self::OFFSET;
    }

    /**
     * @throws InvalidQueryException
     */
    private function getProductSetsCount(): int
    {
        $filteredProductSets = $this->productSetRepository->findByFilter(
            $this->siteSettingsService->getSiteSettings(),
            $this->getProductFinderFilter()
        );

        return $filteredProductSets instanceof QueryResultInterface ? $filteredProductSets->count() : 0;
    }
}
