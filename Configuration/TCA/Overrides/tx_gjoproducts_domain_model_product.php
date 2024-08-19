<?php

declare(strict_types=1);

use GjoSe\GjoSitePackage\Utility\CroppingUtility;

(function (): void {

    $table = 'tx_gjoproducts_domain_model_product';
    $column = 'image';

    CroppingUtility::setCropVariants($table, $column);

})();
