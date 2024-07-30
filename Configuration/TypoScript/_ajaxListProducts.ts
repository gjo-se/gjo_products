ajaxListProducts = PAGE
ajaxListProducts {
    typeNum = 902
    10 = USER
    10 {
        userFunc = TYPO3\CMS\Extbase\Core\Bootstrap->run
        extensionName = GjoProducts
        pluginName = Product
        vendorName = GjoSe
        switchableControllerActions {
            Product {
                1 = ajaxListProducts
            }
        }
        view =< plugin.tx_gjoproducts.view
        persistence =< plugin.tx_gjoproducts.persistence
        settings =< plugin.tx_gjoproducts.settings
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

plugin.tx_gjoproducts {
    settings {
        ajaxListProducts {
            offset = 0
            limit = 6
        }
    }
}
