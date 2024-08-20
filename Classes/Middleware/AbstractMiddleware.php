<?php

declare(strict_types=1);

namespace GjoSe\GjoProducts\Middleware;

use Psr\Http\Message\ServerRequestInterface;
use TYPO3\CMS\Core\Site\Entity\Site;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Fluid\View\StandaloneView;

abstract class AbstractMiddleware
{
    protected const string QUERY_PARAM_KEY = 'middleware';

    protected ServerRequestInterface $request;

    protected function checkRequestHasQueryParamSearchValue(string $queryParamSearchValue): bool
    {
        return ($this->request->getQueryParams()[self::QUERY_PARAM_KEY] ?? '') === $queryParamSearchValue;
    }

    protected function getPostParams(): array|null|object
    {
        return $this->request->getParsedBody();
    }

    protected function getSiteSettings(): array
    {
        $site = $this->getSite();
        return $site ? ($site->getConfiguration()['settings'] ?? []) : [];
    }

    protected function getSiteView(ServerRequestInterface $request): array
    {
        $site = $this->getSite();
        return $site ? ($site->getConfiguration()['view'] ?? []) : [];
    }

    private function getSite(): ?Site
    {
        return $this->request->getAttribute('site');
    }

    protected function configureStandaloneView(StandaloneView $standaloneView): void
    {
        $standaloneView->setTemplatePathAndFilename(
            GeneralUtility::getFileAbsFileName($this->getSiteView($this->request)['templateRootPaths'][0] . 'Product/ProductFinderList.html')
        );
        $standaloneView->setPartialRootPaths([
            GeneralUtility::getFileAbsFileName($this->getSiteView($this->request)['partialRootPaths'][0]),
            GeneralUtility::getFileAbsFileName($this->getSiteView($this->request)['partialRootPaths'][1] . 'ContentElements/'),
            GeneralUtility::getFileAbsFileName($this->getSiteView($this->request)['partialRootPaths'][2]),
        ]);
    }


}
