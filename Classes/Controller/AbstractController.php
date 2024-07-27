<?php
namespace GjoSe\GjoProducts\Controller;

/***************************************************************
 *  created: 05.09.17 - 14:47
 *  Copyright notice
 *  (c) 2017 Gregory Jo Erdmann <gregory.jo@gjo-se.com>
 *  All rights reserved
 *  This script is part of the TYPO3 project. The TYPO3 project is
 *  free software; you can redistribute it and/or modify
 *  it under the terms of the GNU General Public License as published by
 *  the Free Software Foundation; either version 3 of the License, or
 *  (at your option) any later version.
 *  The GNU General Public License can be found at
 *  http://www.gnu.org/copyleft/gpl.html.
 *  This script is distributed in the hope that it will be useful,
 *  but WITHOUT ANY WARRANTY; without even the implied warranty of
 *  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 *  GNU General Public License for more details.
 *  This copyright notice MUST APPEAR in all copies of the script!
 ***************************************************************/

use GjoSe\GjoBase\Controller\AbstractController as GjoBaseAbstractController;
use GjoSe\GjoProducts\Domain\Repository\ProductGroupRepository;
use GjoSe\GjoProducts\Domain\Repository\ProductSetRepository;
use GjoSe\GjoProducts\Domain\Repository\ProductSetTypeRepository;
use GjoSe\GjoProducts\Domain\Repository\ProductSetVariantRepository;
use GjoSe\GjoExtendsFemanager\Domain\Repository\FeUserRepository;
use GjoSe\GjoProducts\Domain\Repository\AccessorykitGroupRepository;

/**
 * Class AbstractController
 * @package GjoSe\GjoProducts\Controller
 */
abstract class AbstractController extends GjoBaseAbstractController
{
    /**
     * @var ProductGroupRepository
     */
    protected $productGroupRepository;

    /**
     * @param ProductGroupRepository $productGroupRepository
     */
    public function injectProductGroupRepository(ProductGroupRepository $productGroupRepository): void
    {
        $this->productGroupRepository = $productGroupRepository;
    }

    /**
     * @var ProductSetRepository
     */
    protected $productSetRepository;

    /**
     * @param ProductSetRepository $productSetRepository
     */
    public function injectProductSetRepository(ProductSetRepository $productSetRepository): void
    {
        $this->productSetRepository = $productSetRepository;
    }

    /**
     * @var ProductSetTypeRepository
     */
    protected $productSetTypeRepository;

    /**
     * @param ProductSetTypeRepository $productSetTypeRepository
     */
    public function injectProductSetTypeRepository(ProductSetTypeRepository $productSetTypeRepository): void
    {
        $this->productSetTypeRepository = $productSetTypeRepository;
    }

    /**
     * @var ProductSetVariantRepository
     */
    protected $productSetVariantRepository;

    /**
     * @param ProductSetVariantRepository $productSetVariantRepository
     */
    public function injectProductSetVariantRepository(ProductSetVariantRepository $productSetVariantRepository): void
    {
        $this->productSetVariantRepository = $productSetVariantRepository;
    }

    /**
     * @var FeUserRepository
     */
    protected $feUserRepository;

    /**
     * @param FeUserRepository $feUserRepository
     */
    public function injectFeUserRepository(FeUserRepository $feUserRepository): void
    {
        $this->feUserRepository = $feUserRepository;
    }

    /**
     * @var AccessorykitGroupRepository
     */
    protected $accessorykitGroupRepository;

    /**
     * @param AccessorykitGroupRepository $accessorykitGroupRepository
     */
    public function injectAccessorykitGroupRepository(AccessorykitGroupRepository $accessorykitGroupRepository): void
    {
        $this->accessorykitGroupRepository = $accessorykitGroupRepository;
    }
}