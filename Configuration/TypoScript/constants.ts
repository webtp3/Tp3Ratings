
plugin.tx_tp3ratings_tp3feratings {
  view {
    # cat=plugin.tx_tp3ratings_tp3feratings/file; type=string; label=Path to template root (FE)
    templateRootPath = EXT:tp3ratings/Resources/Private/Templates/
    # cat=plugin.tx_tp3ratings_tp3feratings/file; type=string; label=Path to template partials (FE)
    partialRootPath = EXT:tp3ratings/Resources/Private/Partials/
    # cat=plugin.tx_tp3ratings_tp3feratings/file; type=string; label=Path to template layouts (FE)
    layoutRootPath = EXT:tp3ratings/Resources/Private/Layouts/
  }
  persistence {
    # cat=plugin.tx_tp3ratings_tp3feratings//a; type=string; label=Default storage PID
    //storagePid =
  }
}

# cat=plugin.tx_tp3ratings_tp3feratings/setup; type=int+; label=Storage page id;UID of the page where rating records will be stored
plugin.tx_tp3ratings_tp3feratings.storagePid =
# cat=plugin.tx_tp3ratings_tp3feratings/setup; type=int; label=Minimum rating value;Warning: this value must not be changed after ratings start working or results will be incorrect!
plugin.tx_tp3ratings_tp3feratings.minValue = 1
# cat=plugin.tx_tp3ratings_tp3feratings/setup; type=int; label=Minimum rating value;Warning: this value must not be changed after ratings start working or results will be incorrect! You may also need to change CSS styles to display ratings properly
plugin.tx_tp3ratings_tp3feratings.maxValue = 5
# cat=plugin.tx_tp3ratings_tp3feratings/setup; type=int+; label=Rating image width
plugin.tx_tp3ratings_tp3feratings.ratingImageWidth = 11
# cat=plugin.tx_tp3ratings_tp3feratings/setup; type=options[Auto=auto,Force static=static]; label=Display mode
plugin.tx_tp3ratings_tp3feratings.mode = auto
# cat=plugin.tx_tp3ratings_tp3feratings/setup; type=boolean; label=Disable IP checks;If checked, disables IP checks. This will let users to vote many times on the same item. Useful for debugging.
plugin.tx_tp3ratings_tp3feratings.disableIpCheck = 1
# cat=plugin.tx_tp3ratings_tp3feratings/file; type=string; label=Template file
plugin.tx_tp3ratings_tp3feratings.templateFile = EXT:ratings/res/ratingsMicrodata.html
# cat=plugin.tx_tp3ratings_tp3feratings/file; type=string; label=Additional CSS file
plugin.tx_tp3ratings_tp3feratings.additionalCSS =
# cat=plugin.tx_tp3ratings_tp3feratings/file; type=int; label=Additional CSS Flag
plugin.tx_tp3ratings_tp3feratings.showAdditionalCSS = 0
# cat=plugin.tx_tp3ratings_tp3feratings/file; type=string; label=the name of the page object
plugin.tx_tp3ratings_tp3feratings.pageObjectName = page

