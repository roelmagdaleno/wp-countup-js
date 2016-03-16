=== Plugin Name ===
Contributors: Roel Magdaleno
Tags: wordpress, plugin, counter, countup, countupjs, animated
Requires at least: 3.5
Tested up to: 4.4.2
Stable tag: "trunk"
License: GPLv2
License URI: http://www.gnu.org/licenses/gpl-2.0.html

You can create a lot of animated numerical counters and display it into your site.

== Description ==

This plugin it's based on Inorganik CountUp.js: https://inorganik.github.io/countUp.js/ and Countup JS Wordpress Plugin (this plugin just permit you create one countup shortcode).

With this plugin and using a shortcode, you can create a lot of animated numerical counter and display it into your site.

== Installation ==

1. Install the plugin via Wordpress Plugin Installer.
2. Activate the plugin through the 'Plugins' screen in WordPress.
3. Go to "Settings"->"CountUP.js" menu to configure options of the plugin.

== Usage and Options ==

Use this plugin, is very easy, you can use it quickly after install it. To do that, you need to use this shortcode:

[countup start="your-value" end="your-value" decimals="your-value" duration="your-value"]

The shortcode accepts four arguments, as you can see previously:

[countup
  start="your-value" //This use a number to begin the counter.
  end="your-value" //This use a number to end the counter at.
  decimals="your-value" //This use a number to put decimals to your counter.
  duration="your-value" //This use a number (seconds) as duration of the counter.
]

Example: [countup start="0" end="55" decimals="0" duration="5"]

Now you know how to use this plugin, but you can edit some options if you required (Go to "Settings"->"CountUP.js").

- Easing: Easing the counter.
- Grouping: Groups the content into sections (eg. 1,000 vs 1000).
- Separator: You can use a separator (default is comma).
- Decimal: Symbol to use for decimal spot (default is dot).
- Prefix: Character(s) at beginning of string.
- Suffix: Character(s) at end of string.

== Screenshots ==

1. Screenshot-1: Output counters on the site.
2. Screenshot-2: Shortcode example.
3. Screenshot-3: Plugin options page.

== Changelog ==

= 1.0 =
* Release

== Upgrade Notice ==
