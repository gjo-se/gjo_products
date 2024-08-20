<?php

declare(strict_types=1);

namespace GjoSe\GjoProducts\Middleware;

use GjoSe\GjoProducts\Domain\Model\ProductSet;
use GjoSe\GjoProducts\Domain\Repository\ProductSetRepository;
use GjoSe\GjoSitePackage\Utility\CroppingUtility;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Server\RequestHandlerInterface;
use TYPO3\CMS\Core\Http\HtmlResponse;
use TYPO3\CMS\Extbase\Persistence\Exception\InvalidQueryException;
use TYPO3\CMS\Extbase\Persistence\QueryResultInterface;
use TYPO3\CMS\Fluid\View\StandaloneView;

final class GetProductFinderListMiddleware extends AbstractMiddleware implements MiddlewareInterface
{
    private const string QUERY_PARAM_SEARCH_VALUE = 'getProductFinderList';

    private const int LIMIT = 6;

    private const int OFFSET = 0;

    public function __construct(
        private readonly ProductSetRepository $productSetRepository,
        private readonly StandaloneView $standaloneView
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

        $this->configureStandaloneView($this->standaloneView);
        $this->standaloneView->assign('productSets', $this->getProductSets());
        $this->standaloneView->assign('productSetsCount', $this->getProductSetsCount());
        $this->standaloneView->assign('breakpoints', CroppingUtility::getDefaultBreakpoints());

        return new HtmlResponse($this->standaloneView->render());
    }

    /** @return array */
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
     *
     * @return ?QueryResultInterface<ProductSet>
     */
    private function getProductSets(): ?QueryResultInterface
    {
        return $this->productSetRepository->findByFilter(
            $this->getSiteSettings(),
            $this->getProductFinderFilter(),
            $this->getOffset(),
            self::LIMIT
        );
    }

    /**
     * @throws InvalidQueryException
     */
    private function getProductSetsCount(): int
    {
        $filteredProductSets = $this->productSetRepository->findByFilter(
            $this->getSiteSettings(),
            $this->getProductFinderFilter()
        );

        return $filteredProductSets ? $filteredProductSets->count() : 0;
    }
}
