# WP CountUP JS #
* Tags: WP CountUP JS, CountUP, CountUP JS, counters, animated
* Tested up to: 4.9.1
* Requires at least: 3.0
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

## Usage and Options ##

Use this plugin, is very easy, you can use it quickly after install it. To do that, you need to use this shortcode:

[countup start="your-value" end="your-value" decimals="your-value" duration="your-value"]

The shortcode accepts those arguments, as you can see previously:

[countup
  start="your-value" //This use a number to begin the counter.
  end="your-value" //This use a number to end the counter at.
  decimals="your-value" //This use a number to put decimals to your counter.
  duration="your-value" //This use a number (seconds) as duration of the counter.
  scroll="your-value" //Load counter when the page is loaded. Default Value: True.
]

## Example ##

[countup start="0" end="55" decimals="0" duration="5" prefix="my_prefix" scroll="false"]

Inside Shortcode Arguments:

[countup
  start="your-value" //This use a number to begin the counter.
  decimals="your-value" //This use a number to put decimals to your counter.
  duration="your-value" //This use a number (seconds) as duration of the counter.
  scroll="your-value" //Load counter when the page is loaded. Default Value: True.
]your-end-number[/countup]

Example Inside Shortcode:
[countup start="0" decimals="0" duration="5"]55[/countup]

Now you know how to use this plugin, but you can edit some options if you required (Go to "Settings"->"CountUP.js").

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
* Now you can add the options from CountUP.js Options Page inside of the shortcode. Please check Usage and Options for more information.

= 2.1 =
* All counters started their animation before to reach the target counter. Now, when you scrolled to the target counter, the counter will start their animation.

= 2.2 =
* Now you can add an option if you wanna start the counter when the page is loaded or when scroll it.

= 2.3 =
* Bug fixed where counter at the top starts counters at bottom. Now, every counter works independently.

= 3.0 =
* Bug fixed where some counters didn't start after scroll into it. And it was implemented two ways to use the shortcode.

= 3.1 =
* Bug fixed where the plugin was initializing at the same time of the other plugins, breaking them.

## Upgrade Notice ##
