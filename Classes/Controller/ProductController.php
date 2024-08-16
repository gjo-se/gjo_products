<?php

declare(strict_types=1);

namespace GjoSe\GjoProducts\Controller;

use GjoSe\GjoProducts\Domain\Repository\ProductGroupRepository;
use GjoSe\GjoProducts\Domain\Repository\ProductSetRepository;
use GjoSe\GjoProducts\Domain\Repository\ProductSetTypeRepository;
use GjoSe\GjoSitePackage\Controller\AbstractController;
use GjoSe\GjoSitePackage\Utility\CroppingUtility;
use Psr\Http\Message\ResponseInterface;
use TYPO3\CMS\Core\Context\Exception\AspectNotFoundException;

final class ProductController extends AbstractController
{
    public function __construct(
        private readonly ProductGroupRepository $productGroupRepository,
        private readonly ProductSetRepository $productSetRepository,
        private readonly ProductSetTypeRepository $productSetTypeRepository,
    ) {}

    public function showProductGroupTeaserAction(): ResponseInterface
    {
        $this->view->assignMultiple([
            'data' => $this->getCurrentContentObjectData(),
            'breakpoints' => CroppingUtility::getDefaultBreakpoints(),
            'productGroup' => $this->productGroupRepository->findByUid($this->settings['productGroup']),
        ]);

        return $this->htmlResponse();
    }

    public function showProductGroupAction(): ResponseInterface
    {
        $this->view->assignMultiple([
            'data' => $this->getCurrentContentObjectData(),
            'breakpoints' => CroppingUtility::getDefaultBreakpoints(),
            'productGroup' => $this->productGroupRepository->findByUid($this->settings['productGroup']),
        ]);

        return $this->htmlResponse();
    }

    public function showProductSetAction(): ResponseInterface
    {
        $productSet = $this->productSetRepository->findByUid($this->settings['productSet']);

        $productSetTypeUid = $this->productSetTypeRepository->findProductSetTypeUidByProductSetUid((int)$this->settings['productSet'], 1);
        $productSetType = $this->productSetTypeRepository->findByUid($productSetTypeUid);

        $productGroup = null;
        if ($productSetType) {
            $productGroup = $productSetType->getProductGroup();
        }

        $this->view->assignMultiple([
            'data' => $this->getCurrentContentObjectData(),
            'breakpoints' => CroppingUtility::getDefaultBreakpoints(),
            'productSet' => $productSet,
            'productGroup' => $productGroup,
        ]);

        return $this->htmlResponse();
    }

    /**
     * @throws AspectNotFoundException
     */
    public function productFinderAction(): ResponseInterface
    {
        $this->view->assignMultiple([
            'data' => $this->getCurrentContentObjectData(),
        ]);

        return $this->htmlResponse();
    }
}
