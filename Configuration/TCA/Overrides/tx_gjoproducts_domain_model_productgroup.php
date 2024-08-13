<?php
declare(strict_types=1);

use GjoSe\GjoSitePackage\Utility\CroppingUtility;

call_user_func(function (): void {

    $table = 'tx_gjoproducts_domain_model_productgroup';

    $column = 'image';
    CroppingUtility::setCropVariants($table, $column);

    $column = 'teaser_image';
    CroppingUtility::setCropVariants($table, $column);

});
