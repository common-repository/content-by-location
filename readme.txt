=== Plugin Name ===
Contributors: yehudah
Donate link: http://wpcoder.co.il/donate.html
Author URL: http://wpcoder.co.il
Tags: content,country,location,ip,shortcode
Requires at least: 3.1
Tested up to: 3.3.1
Stable tag: 1.0.3

With this plugin you can filter post or page content by the country (web api) of the user surfing the site, all of that using simple shortcode

== Description ==

<h5>This plugin in his early stages (but stil stable), 
please let me know if you having any bug. </h5>

to show content by country just use the shortcode like this:
<pre>
[cbl country="country code"] 
your content 
[/cbl]
</pre>

the country code can found here:
<a href="http://en.wikipedia.org/wiki/ISO_3166-1_alpha-2">SO_3166-1_alpha-2</a>

the api's (web services) you can choose from (under settings):
<ul>
<li>smart-ip.net</li>
<li>hostip.info</li>
<li>maxmind.com</li>
</ul>

please notice: the maxmind database is local and from time to time check out this page
for new updates:<a href="http://www.maxmind.com/app/geolitecountry">geolitecountry</a>.
the geoip.dat need to be extrect to plugin path :content-by-location/geoip.

for any qustion you can contact me here: http://wpcoder.co.il/contact-me.html
= Thanks! =

I would like to thank my wife for sleeping alone while i wrote this plugin (thanks shiri :-)

== Changelog ==
= 1.0.3 =
* bug - content dissaper (or unknow location message) even when not using shortcodes,
        Thanks to zavoq - Fixed

= 1.0.2 =
* bug - in case using lowercase country code in shortcode - Fixed

= 1.0.1 =
* stupid remark i forgot

= 1.0 =
* Initial release

== Installation ==

1. Download the plugin, unzip it and upload it to `/wp-content/plugins/` directory.
2. Activate the plugin through the 'Plugins' menu in WordPress.
3. Go to Settings &raquo; Content By Location 
4. Adjust the settings as you wish

 == Frequently Asked Questions ==

Q. what's the diffrence between the services your plugin provide ?
A. basicly ? none. i'm just giving more option for future cases, like : service closed, one is more acurate then the other.

== Screenshots ==

1. screenshot-1.png

== Upgrade Notice ==
none at the moment.
