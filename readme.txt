# WP CountUP JS #
* Contributors: rokumetal
* Donate Link: https://paypal.me/roelmagdaleno
* Tags: WP CountUP JS, CountUP, CountUP JS, counters, animated
* Tested up to: 4.9.4
* Requires at least: 3.0
* Requires PHP: 5.0
* Stable tag: 4.0.2
* License: GPLv2 or later
* License URI: https://www.gnu.org/licenses/gpl-2.0.html

You can create a lot of animated numerical counters and display it into your site.

## Description ##

This plugin is based on [Inorganik CountUp.js](https://inorganik.github.io/countUp.js/) and [Countup JS WordPress plugin](https://wordpress.org/plugins/countup-js/) (this plugin just permit you create one counter per page).

You can use this plugin with shortcodes and create a lot of animated numerical counter and display it into your site.

## Installation ##

1. Install the plugin via Wordpress Plugin Installer.
2. Activate the plugin through the 'Plugins' screen in WordPress.
3. Go to "Settings"->"CountUP.js" menu to configure options of the plugin.

## Usage & Options ##

Is very easy to use this plugin, you can use the shortcode after install it, but there are two ways to use the plugin:

The first way:

`[countup start="your-value" end="your-value" decimals="your-value" duration="your-value"]`

The second way. To use this format you need to check the **Use the end number inside the shortcode?** setting in the plugin option page:

`[countup start="the-start-number" decimals="your-value" duration="your-value"]the-end-number[/countup]`

The shortcode accepts the next arguments:

- start - The number that the counter use to start.
- end - The number that the counter use to end.
- decimals - Puts the desired decimals into your counter.
- duration - The counter duration represented by a number (seconds).
- scroll - If true, start the counter when the user visualize it.
- suffix - A text that will work as the counter suffix.
- prefix - A text that will work as the counter prefix.

## Example ##

You can use the shortcode in two ways:

If you are using the first way:

`[countup start="0" end="55" decimals="2" duration="5" prefix="my_prefix" scroll="false"]`

If you are using the second way (remember to check the **Use the end number inside the shortcode?**):

`[countup start="0" decimals="2" duration="5"]55[/countup]`

Copy and paste any example in one of your posts and test.

## Settings Page ##

You know how to use the plugin now, but you can still edit some options inside of the plugin settings page (Go to **Settings->CountUP.js**).

Inside of the settings page, you can find the next settings:

- Easing: Easing the counter.
- Grouping: Groups the content into sections (eg. 1,000 vs 1000).
- Separator: You can use a separator (default is comma).
- Decimal: Symbol to use for decimal spot (default is dot).
- Prefix: Character(s) at beginning of string.
- Suffix: Character(s) at end of string.

## Screenshots ##

1. Screenshot-1: Output counters on the site.
2. Screenshot-2: Shortcode example.
3. Screenshot-3: Plugin options page.
4. Screenshot-4: CountUp.js Options inside shortcode.
5. Screenshot-5: Output counters on the site with individual prefix and suffix.

## Changelog ##

= 1.0 =
* Release

= 1.1 =
* jQuery issue was solved.

= 2.0 =
* Now you can add the options from CountUP.js Options Page inside of the shortcode.

= 2.1 =
* All counters starts their animations before to reach the target counter.
* Now, when you scroll to the target counter, the counter will start its animation.

= 2.2 =
* Now you can add an option if you wanna start the counter when the page is loaded or when scroll it.

= 2.3 =
* Bug fixed where counter at the top starts counters at bottom.
* Now, every counter works independently.

= 3.0 =
* Bug fixed where some counters didn't start after scroll into it.
* You can use two ways to use the shortcode.

= 3.1 =
* Bug fixed where the plugin was initializing at the same time that other plugins, breaking them.

= 4.0 =
* The whole plugin is using OOP style.
* The core plugin was updated to 1.9.3 version.

= 4.0.1 =
* Bug fixed where uBlock browser extension was blocking the "showCounter.js" file.
* "showCounter.js" file renamed to "wp-countup-show-counter.js" due to the previous bug.

= 4.0.2 =
* Now you can execute a shortcode (that returns a number) inside the counter shortcode.
