<?php
declare(strict_types=1);

use GjoSe\GjoSitePackage\Utility\CroppingUtility;

call_user_func(function (): void {

    $table = 'tx_gjoproducts_domain_model_productset';

    $column = 'image';
    CroppingUtility::setCropVariants($table, $column);

    $column = 'icon';
    CroppingUtility::setCropVariants($table, $column);

    $column = 'image_engineering_drawings';
    CroppingUtility::setCropVariants($table, $column);

});
