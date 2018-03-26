.. ==================================================
.. FOR YOUR INFORMATION
.. --------------------------------------------------
.. -*- coding: utf-8 -*- with BOM.

.. include:: ../Includes.txt


.. _configuration:

Configuration Reference
=======================

Configure dependent variabels:


        # cat=plugin.tx_tp3ratings_tp3feratings/setup; type=int+; label=Storage page id;UID of the page where rating records will be stored
        plugin.tx_tp3ratings_tp3feratings.storagePid =
        # cat=plugin.tx_tp3ratings_tp3feratings/setup; type=int; label=Minimum rating value;Warning: this value must not be changed after ratings start working or results will be incorrect!
        plugin.tx_tp3ratings_tp3feratings.minValue = 1
        # cat=plugin.tx_tp3ratings_tp3feratings/setup; type=int; label=Minimum rating value;Warning: this value must not be changed after ratings start working or results will be incorrect! You may also need to change CSS styles to display ratings properly
        plugin.tx_tp3ratings_tp3feratings.maxValue = 5
        # cat=plugin.tx_tp3ratings_tp3feratings/setup; type=int+; label=Rating voted color
        plugin.tx_tp3ratings_tp3feratings.votedColor = {$plugin.bootstrap_package.settings.less.brand-primary}
        # cat=plugin.tx_tp3ratings_tp3feratings/setup; type=int+; label=Rating if not set falls back to linkcolor
        plugin.tx_tp3ratings_tp3feratings.Color = #fff;
        # cat=plugin.tx_tp3ratings_tp3feratings/setup; type=int+; label=Rating Icons (select you icon galery)
        plugin.tx_tp3ratings_tp3feratings.IconType = glyphicon
        # cat=plugin.tx_tp3ratings_tp3feratings/setup; type=int+; label=Rating icon Obect star, ok and more depends on icontype
        plugin.tx_tp3ratings_tp3feratings.IconObject = star
        # cat=plugin.tx_tp3ratings_tp3feratings/setup; type=int+; label=font size
        plugin.tx_tp3ratings_tp3feratings.FontSize = 12pt
        # cat=plugin.tx_tp3ratings_tp3feratings/setup; type=options[Auto=auto,Force static=static]; label=Display mode
        plugin.tx_tp3ratings_tp3feratings.mode = auto
        # cat=plugin.tx_tp3ratings_tp3feratings/setup; type=boolean; label=Disable IP checks;If checked, disables IP checks. This will let users to vote many times on the same item. Useful for debugging.
        plugin.tx_tp3ratings_tp3feratings.disableIpCheck = 1
        # cat=plugin.tx_tp3ratings_tp3feratings/setup; type=boolean; label=disable Review will disable die review request after rating.
        plugin.tx_tp3ratings_tp3feratings.disableReview = 0
        # cat=plugin.tx_tp3ratings_tp3feratings/file; type=string; label=Template file
        plugin.tx_tp3ratings_tp3feratings.templateFile = EXT:ratings/res/ratingsMicrodata.html
        # cat=plugin.tx_tp3ratings_tp3feratings/file; type=string; label=Additional CSS file
        plugin.tx_tp3ratings_tp3feratings.additionalCSS =
        # cat=plugin.tx_tp3ratings_tp3feratings/file; type=int; label=Additional CSS Flag
        plugin.tx_tp3ratings_tp3feratings.showAdditionalCSS = 0
        # cat=plugin.tx_tp3ratings_tp3feratings/file; type=string; label=the name of the page object
        plugin.tx_tp3ratings_tp3feratings.pageObjectName = page





=======================
Extension Configuration
=======================

Use the Constants Editor to adjust the tp3ratings to your needs.
The System will save the ratings in the rated page. The review is saved to the siteroot. So several installs work without additional config.


.. _configuration-faq:

FAQ
---

Possible subsection: FAQ

next steps are
- Make reviews editable by feuser (mapped on Email usserid)
- Rating vor content elements (not only pages)
