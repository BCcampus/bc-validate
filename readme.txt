=== BC Post-Secondary Validator ===
Contributors: bdolor
Tags: authentication
Requires at least: 4.9.8
Tested up to: 4.9.8
Stable tag: 1.0.2
Requires PHP: 7.1
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

Provides a mechanism to validate whether a user's email address is part of the BC Post-Secondary System.

== Description ==

Affects the sign up page (wp-signup.php) using hooks. Requires that a new user has an email address from a post-secondary institute in British Columbia. 
Also allows a user to identify which institute they are from. 

== Installation ==

1. Upload `bc-validate` to the `/wp-content/plugins/` directory
1. Activate the plugin through the 'Plugins' menu in WordPress

== Frequently Asked Questions ==


== Changelog ==

= 1.0.2 (10/16/2018) =
* adding domains of private BC institutions
* terse attention to coding standards

= 1.0.1 =
* widespread updates

= 1.0 =
* Initial commit
