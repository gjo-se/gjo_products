<?php

declare(strict_types=1);

namespace GjoSe\GjoProducts\Middleware;

use Psr\Http\Message\ServerRequestInterface;

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
}
