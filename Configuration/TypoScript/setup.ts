plugin.tx_tp3ratings_tp3feratings {
  view{
    templateRootPaths.0 = EXT:tp3ratings/Resources/Private/Templates/
    templateRootPaths.1 = {$plugin.tx_tp3ratings_tp3feratings.view.templateRootPath}
    partialRootPaths.0 = EXT:tp3ratings/Resources/Private/Partials/
    partialRootPaths.1 = {$plugin.tx_tp3ratings_tp3feratings.view.partialRootPath}
    layoutRootPaths.0 = EXT:tp3ratings/Resources/Private/Layouts/
    layoutRootPaths.1 = {$plugin.tx_tp3ratings_tp3feratings.view.layoutRootPath}
  }
  persistence{
   #// storagePid = {$plugin.tx_tp3ratings_tp3feratings.persistence.storagePid}
    #recursive = 1
  }
  features{
    #skipDefaultArguments = 1
  }
  settings{
  	minValue = {$plugin.tx_tp3ratings_tp3feratings.minValue}
	maxValue = {$plugin.tx_tp3ratings_tp3feratings.maxValue}
	ratingImageWidth = {$plugin.tx_tp3ratings_tp3feratings.ratingImageWidth}
	mode = {$plugin.tx_tp3ratings_tp3feratings.mode}
	disableIpCheck = {$plugin.tx_tp3ratings_tp3feratings.disableIpCheck}
  }
  mvc{
    callDefaultActionIfActionCantBeResolved = 1
  }
}
page.includeCSS.tp3ratings = EXT:tp3ratings/Resources/Public/Css/styles.css
page.includeJSFooterlibs.tp3ratings = EXT:tp3ratings/Resources/Public/Javascript/tp3ratings.js

plugin.tx_tp3ratings._CSS_DEFAULT_STYLE (
    textarea.f3-form-error {
        background-color:#FF9F9F;
        border: 1px #FF0000 solid;
    }

    input.f3-form-error {
        background-color:#FF9F9F;
        border: 1px #FF0000 solid;
    }

    .tx-tp3ratings table {
        border-collapse:separate;
        border-spacing:10px;
    }

    .tx-tp3ratings table th {
        font-weight:bold;
    }

    .tx-tp3ratings table td {
        vertical-align:top;
    }

    .typo3-messages .message-error {
        color:red;
    }

    .typo3-messages .message-ok {
        color:green;
    }
)

tx_tp3ratings_ajaxPage = PAGE
tx_tp3ratings_ajaxPage {
    typeNum = {$plugin.tx_tp3ratings.settings.ajaxPageType}
    config {
        disableAllHeaderCode = 1
        xhtml_cleaning = 0
        admPanel = 0
        debug = 1
        additionalHeaders = Content-type: text/plain
        no_cache = 1
    }

    10 = USER
    10 {
        userFunc = TYPO3\CMS\Extbase\Core\Bootstrap->run
        extensionName = Tp3ratings
        pluginName = Tp3feratings
        vendorName = Tp3
        controller = Ratingsdata
        switchableControllerActions {
            Ratingsdata {
                1 = list
                2 = rating
            }
        }
       //#for 8
        file = EXT:tp3ratings/Resources/Private/Templates/Ratingsdata/Rating.json
        partialRootPath = EXT:tp3ratings/Resources/Private/Partials/
        layoutRootPath = EXT:tp3ratings/Resources/Private/Templates/Ratingsdata/Layouts/

        view < plugin.tx_tp3ratings.view
        persistence < plugin.tx_tp3ratings.persistence
        settings < plugin.tx_tp3ratings.settings
    }
}