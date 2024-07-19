ajaxListProducts = PAGE
ajaxListProducts {
    typeNum = 902
    10 = USER
    10 {
        userFunc = TYPO3\CMS\Extbase\Core\Bootstrap->run
        extensionName = GjoTiger
        pluginName = Product
        vendorName = GjoSe
        switchableControllerActions {
            Product {
                1 = ajaxListProducts
            }
        }

        view =< plugin.tx_gjotiger.view
        persistence =< plugin.tx_gjotiger.persistence
        settings =< plugin.tx_gjotiger.settings
    }

    config {
        disableAllHeaderCode = 1
        additionalHeaders = Content-type:application/html
        xhtml_cleaning = 0
        debug = 0
        no_cache = 1
        admPanel = 0
    }
}

plugin.tx_gjotiger {
    settings{
        ajaxListProducts {
            offset = 0
            limit = 6
        }
    }
}