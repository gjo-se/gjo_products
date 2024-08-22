<?php

declare(strict_types=1);

namespace GjoSe\GjoProducts\Controller;

use Doctrine\DBAL\Exception;
use GjoSe\GjoProducts\Domain\Repository\ProductGroupRepository;
use GjoSe\GjoProducts\Domain\Repository\ProductSetRepository;
use GjoSe\GjoProducts\Domain\Repository\ProductSetTypeRepository;
use GjoSe\GjoSitePackage\Controller\AbstractController;
use Psr\Http\Message\ResponseInterface;

final class ProductController extends AbstractController
{
    public function __construct(
        private readonly ProductGroupRepository $productGroupRepository,
        private readonly ProductSetRepository $productSetRepository,
        private readonly ProductSetTypeRepository $productSetTypeRepository,
    ) {}

    public function showProductGroupTeaserAction(): ResponseInterface
    {
        $this->assignCommonViewVariables([
            'productGroup' => $this->productGroupRepository->findByUid($this->settings['productGroup']),
        ]);

        return $this->htmlResponse();
    }

    public function showProductGroupAction(): ResponseInterface
    {
        $this->assignCommonViewVariables([
            'productGroup' => $this->productGroupRepository->findByUid($this->settings['productGroup']),
        ]);

        return $this->htmlResponse();
    }

    /**
     * @throws Exception
     */
    public function showProductSetAction(): ResponseInterface
    {
        $productSet = $this->productSetRepository->findByUid($this->settings['productSet']);

        $this->assignCommonViewVariables([
            'productSet' => $productSet,
            'productGroup' => $this->productSetTypeRepository->findProductGroupByProductSet($productSet),
        ]);

        return $this->htmlResponse();
    }

    public function productFinderAction(): ResponseInterface
    {
        $this->assignCommonViewVariables();

        return $this->htmlResponse();
    }
}
