.. ==================================================
.. FOR YOUR INFORMATION
.. --------------------------------------------------
.. -*- coding: utf-8 -*- with BOM.

.. include:: ../Includes.txt


.. _configuration:

Configuration Reference
=======================

Configure dependent variabels:

         # cat=plugin.tx_tp3social_tp3share//a; type=string; label=twitter
          twitter 	= 1
          # cat=plugin.tx_tp3social_tp3share//a; type=string; label=social
		social 	= 1
		# cat=plugin.tx_tp3social_tp3share//a; type=string; label=google
		google 		= 1
	  	# cat=plugin.tx_tp3social_tp3share//a; type=string; label=googleshare
	    googleshare = 0
		# cat=plugin.tx_tp3social_tp3share//a; type=string; label=meinvz
		meinvz 		= 0
		# cat=plugin.tx_tp3social_tp3share//a; type=string; label=youtube
		youtube 	= 1
		# cat=plugin.tx_tp3social_tp3share//a; type=string; label=xing
		xing		= 1
		# cat=plugin.tx_tp3social_tp3share//a; type=string; label=linkedin
		linkedin	= 1
		# cat=plugin.tx_tp3social_tp3share//a; type=string; label=tumblr
		tumblr		= 0
		# cat=plugin.tx_tp3social_tp3share//a; type=string; label=vkontakte
		vkontakte	= 0
		# cat=plugin.tx_tp3social_tp3share//a; type=string; label=flickr
		flickr	= 0
		# cat=plugin.tx_tp3social_tp3share//a; type=string; label=twittername
		twittername = {$twittername}
		# cat=plugin.tx_tp3social_tp3share//a; type=string; label=flickrname
		flickrname	= LINK TO FLICKR PHOTOSTREAM
		# cat=plugin.tx_tp3social_tp3share//a; type=string; label=youtubename
        youtubename = {$youtubename}
		# cat=plugin.tx_tp3social_tp3share//a; type=string; label=socialname
       ratingsname = {$socialname}
		# cat=plugin.tx_tp3social_tp3share//a; type=string; label=googlename
        googlename = {$googlename}
		# cat=plugin.tx_tp3social_tp3share//a; type=string; label=BITusername
		BITusername = thomnasruta
		# cat=plugin.tx_tp3social_tp3share//a; type=string; label=BITapi
		BITapi = R_666437839bbce9a5044fde7b4d39d2ff
		# cat=plugin.tx_tp3social_tp3share//a; type=string; label=layout
		layout = style05
		# cat=plugin.tx_tp3social_tp3share//a; type=string; label=googleid
		googleid ={$google_publisher}
		# cat=plugin.tx_tp3social_tp3share//a; type=string; label=googleid
		socialid = {$socialid}
		# cat=plugin.tx_tp3social_tp3share//a; type=string; label=shortener



=======================
Extension Configuration
=======================

Use the Constants Editor to adjust the tp3ratings to your needs.
A Api Key has to be regitered denpending on the service you use:
https://developers.social.com/apps/     (faebook)
https://developer.twitter.com/en/docs   (twitter)
https://developers.google.com/          (google)
https://developer.linkedin.com/         (linkedin)
...

The essential domains have to be set in the app for crossdomain referencing.
Then the plugin can be used fully.

.. _configuration-faq:

FAQ
---

Possible subsection: FAQ

next steps are
- fix deprecated api calls
- megrge into tp3ratings to combine alle soc. media
- load on demand - apis are loaded within a click (pagespeed)
