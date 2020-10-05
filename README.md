# WP CountUP JS

Display multiple animated counters into your WordPress site.

## Gutenberg

The plugin is compatible with Gutenberg, so you can add the custom block called _**CountUp**_ to your posts and pages. [Check the wiki for more details](https://github.com/roelmagdaleno/wp-countup-js/wiki/Gutenberg-Block).

## Shortcode

It's very easy to use this plugin, you can use the shortcode after install it, but there are two ways to use the plugin:

The first way is:

```
[countup start="your-value" end="your-value" decimals="your-value" duration="your-value"]
```
The second way. To use this format you need to check the **_Use the end number inside the shortcode?_** setting in the plugin option page:

```
[countup start="the-start-number" decimals="your-value" duration="your-value"]the-end-number[/countup]
```

### Example

You can use the shortcode in two ways, as mentioned before. If you are using the first way:

```
[countup start="0" end="55" decimals="2" duration="5" prefix="my_prefix" scroll="false"]
```

If you are using the second way (remember to check the **_Use the end number inside the shortcode?_**):

```
[countup start="0" decimals="2" duration="5"]55[/countup]
```

Copy and paste any example in one of your posts and test.

## Available Attributes

The shortcode and Gutenberg block accepts the next arguments:

- decimals - Puts the desired decimals into your counter.
- delay - Set a delay in milliseconds to start the counter.
- duration - The counter duration represented by a number (seconds).
- easing - Easing the counter.
- end - A number to end (arrive) the counter.
- grouping - Groups the content into sections (eg. 1,000 vs 1000).
- prefix - A text as counter prefix.
- reset - Reset the counter after view.
- scroll - If true, start the counter when the user visualize it.
- separator - You can use a separator (default is comma).
- start - A number to start the counter.
- suffix - A text as counter suffix.

## Settings

You know how to use the plugin now, but you can still edit some options inside of the plugin settings page (Go to _**Settings->CountUP.js**_).

Inside of the settings page, you can find the next settings:

- Easing: Easing the counter.
- Grouping: Groups the content into sections (eg. 1,000 vs 1000).
- Separator: You can use a separator (default is comma).
- Decimal: Symbol to use for decimal spot (default is dot).
- Prefix: Character(s) at beginning of string.
- Suffix: Character(s) at the end of string.
