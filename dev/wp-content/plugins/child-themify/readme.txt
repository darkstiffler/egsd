=== Child Themify ===
Contributors: JohnPBloch
Tags: themes, child, theme
Requires at least: 3.4.2
Tested up to: 3.5
Stable tag: 1.0.1
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

Create child themes at the click of a button.

== Description ==

Create child themes from any non-child theme at the click of a button.

This plugin is multisite compatible; if used on a multisite network, controls for creating child themes will be in the network admin instead of the regular site admin.

== Installation ==

1. Upload the `child-themify` directory and its contents to the `/wp-content/plugins/` directory (or your custom location if you manually changed the location).
1. Activate the plugin through the 'Plugins' menu in WordPress
1. You can now create a child theme of any non-child theme you have installed by going to the themes page and clicking "Create a child theme" from the actions links of the theme of your choice.

== Frequently Asked Questions ==

None yet.

== Screenshots ==

1. Network administration area
2. Single site administration area

== Changelog ==

= 1.0.1 =
* Add a semicolon to the end of the @import line in the stylesheet. Props to Luis Alejandre (wpthemedetector.com) for finding and solving.

= 1.0 =
* Initial Release

== Upgrade Notice ==

= 1.0.1 =
This version fixes a bug that will prevent some users' css from taking effect in new child themes.
