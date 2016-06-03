<?php
  /*
  Plugin Name: WP CountUP JS
  Plugin URI: https://inorganik.github.io/countUp.js/
  Description: You can create a lot of animated numerical counters and display it into your site.
  Version: 2.1
  Author: Roel Magdaleno
  Author URI: https://twitter.com/roelmagdaleno
  License: GPLv2
  */

  /*-----------------------------------
  * Adding Menu to Settings Menu
  *----------------------------------*/
  add_action( 'admin_menu', 'countup_options_to_settings_menu' );

  function countup_options_to_settings_menu(){
    add_options_page( 'CountUp.js Options', 'CountUP.js', 'manage_options', 'countup-js', 'countup_theme' );
  }

  /*-----------------------------------
  * Theme Display
  *----------------------------------*/
  function countup_theme(){
    ?>
      <div class="wrap">
        <form method="post" action="options.php">
          <?php settings_fields( 'countupjs-option-page' ); ?>
          <?php do_settings_sections( 'countupjs-option-page' ); ?>
          <?php submit_button(); ?>
        </form>
      </div>
    <?php
  }

  /*-----------------------------------
  * CountUp.js Activated & Deactivated
  *----------------------------------*/
  //Activated
  function countup_activated(){
    if( !get_option( 'countupjs-option-page' ) ){
      $default_settings = array(
        'use_easing' => 'true',
        'use_grouping' => 'true',
        'use_separator' => ',',
        'use_decimal' => '.',
        'use_prefix' => '',
        'use_sufix' => ''
      );

      add_option('countupjs-option-page', $default_settings);
    }
  }

  //Uninstalled
  function countup_uninstall(){
    delete_option('countupjs-option-page');
  }

  //Register Hooks
  register_activation_hook(__FILE__, 'countup_activated');
  register_uninstall_hook(__FILE__, 'countup_uninstall');

  /*-----------------------------------
  * Setting Registration
  *----------------------------------*/
  function countupjs_initialize_theme_options(){
    add_settings_section(
      'countupjs_settings_section',
      'CountUp.js Options',
      'countupjs_options_callback',
      'countupjs-option-page'
    );

    //Checkbox
    add_settings_field(
      'use_easing',
      'Use Easing?',
      'countupjs_easing_callback',
      'countupjs-option-page',
      'countupjs_settings_section',
      array(
        'Activate this setting to activate the easing.'
      )
    );

    //Checkbox
    add_settings_field(
      'use_grouping',
      'Use Grouping?',
      'countupjs_grouping_callback',
      'countupjs-option-page',
      'countupjs_settings_section',
      array(
        'Activate this setting to activate the grouping.'
      )
    );

    //Textfield
    add_settings_field(
      'use_separator',
      'Separator',
      'countupjs_separator_callback',
      'countupjs-option-page',
      'countupjs_settings_section',
      array(
        "If you put a comma, returns: 1,300"
      )
    );

    //Textfield
    add_settings_field(
      'use_decimal',
      'Decimal',
      'countupjs_decimal_callback',
      'countupjs-option-page',
      'countupjs_settings_section',
      array(
        "If you put a dot, returns: 1,300.00"
      )
    );

    //Textfield
    add_settings_field(
      'use_prefix',
      'Prefix',
      'countupjs_prefix_callback',
      'countupjs-option-page',
      'countupjs_settings_section',
      array(
        "If you use a prefix, returns: prefix1200"
      )
    );

    //Textfield
    add_settings_field(
      'use_sufix',
      'Sufix',
      'countupjs_sufix_callback',
      'countupjs-option-page',
      'countupjs_settings_section',
      array(
        "If you use a suffix, returns: 1200suffix"
      )
    );

    //Register the fields with WordPress
    register_setting(
      'countupjs-option-page',
      'countupjs-option-page'
    );
  }
  add_action('admin_init', 'countupjs_initialize_theme_options');

  /*-----------------------------------
  * Section Callbacks
  *----------------------------------*/
  function countupjs_options_callback(){
    echo '<p>This options are completely optional, so feel free to activate or deactivate the easing and grouping, and fill the textfields.</p>';
  }

  /*-----------------------------------
  * Field Callbacks
  *----------------------------------*/
  function countupjs_easing_callback($args){
    $options = get_option('countupjs-option-page');

    if( !isset($options['use_easing']) ){
      $use_easing = "false";
    } else {
      $use_easing = $options['use_easing'];
    }

    $html = '<input type="checkbox" id="use_easing" name="countupjs-option-page[use_easing]" value="true" ' . checked('true', $use_easing, false) . '/>';

    $html .= '<label for="use_easing"> '  . $args[0] . '</label>';

    echo $html;
  }

  function countupjs_grouping_callback($args){
    $options = get_option('countupjs-option-page');

    if( !isset($options['use_grouping']) ){
      $use_grouping = "false";
    } else {
      $use_grouping = $options['use_grouping'];
    }

    $html = '<input type="checkbox" id="use_grouping" name="countupjs-option-page[use_grouping]" value="true" ' . checked('true', $use_grouping, false) . '/>';

    $html .= '<label for="use_grouping"> '  . $args[0] . '</label>';

    echo $html;
  }

  function countupjs_separator_callback($args){
    $options = get_option('countupjs-option-page');

    $html = "<input type='text' id='use_separator' name='countupjs-option-page[use_separator]' value='$options[use_separator]'>";

    $html .= '<label for="use_separator"> '  . $args[0] . '</label>';

    echo $html;
  }

  function countupjs_decimal_callback($args){
    $options = get_option('countupjs-option-page');

    $html = "<input type='text' id='use_decimal' name='countupjs-option-page[use_decimal]' value='$options[use_decimal]'>";

    $html .= '<label for="use_decimal"> '  . $args[0] . '</label>';

    echo $html;
  }

  function countupjs_prefix_callback($args){
    $options = get_option('countupjs-option-page');

    $html = "<input type='text' id='use_prefix' name='countupjs-option-page[use_prefix]' value='$options[use_prefix]'>";

    $html .= '<label for="use_prefix"> '  . $args[0] . '</label>';

    echo $html;
  }

  function countupjs_sufix_callback($args){
    $options = get_option('countupjs-option-page');

    $html = "<input type='text' id='use_sufix' name='countupjs-option-page[use_sufix]' value='$options[use_sufix]'>";

    $html .= '<label for="use_sufix"> '  . $args[0] . '</label>';

    echo $html;
  }

  /*-----------------------------------
  * CountUp.js Plugin
  *----------------------------------*/
  function register_countupjs(){
    wp_enqueue_script('jquery');

    wp_register_script('countupjs', plugins_url('js/countUp.js', __FILE__), array("jquery"));

    wp_enqueue_script('countupjs');

    wp_register_script('countupjs_initializer', plugins_url('js/show_counter.js', __FILE__), array("jquery"));
  }

  add_action('wp_enqueue_scripts', 'register_countupjs');

  /*-----------------------------------
  * Shortcode [countup arg1="" arg2="" ...]
  *----------------------------------*/
  add_shortcode( "countup", "shows_count_up" );
  function shows_count_up($atts){
    //Get options saved from CountUp.js Options
    $options = (array) get_option('countupjs-option-page');

    $a = shortcode_atts(array(
      'start' => '0',
      'end' => '1000',
      'decimals' => '0',
      'duration' => '2',
      'easing' => ' ',
      'grouping' => ' ',
      'separator' => ' ',
      'decimal' => ' ',
      'prefix' => ' ',
      'suffix' => ' '
    ), $atts );

    $settings = array(
      "useEasing" => $options['use_easing'],
      "useGrouping" => $options['use_grouping'],
      "separator" => $options['use_separator'],
      "decimal" => $options['use_decimal'],
      "prefix" => $options['use_prefix'],
      "suffix" => $options['use_sufix']
    );

    //Pass shortcode settings to show_counter.js
    wp_localize_script('countupjs_initializer', 'setting', $settings);
    wp_enqueue_script('countupjs_initializer');

    //This div contains the end of the counter, it is represented by a data-count.
    $output = "<div class='counter' data-start='$a[start]' data-count='$a[end]' data-decimals='$a[decimals]' data-duration='$a[duration]' data-easing='$a[easing]' data-grouping='$a[grouping]' data-separator='$a[separator]' data-decimal='$a[decimal]' data-prefix='$a[prefix]' data-suffix='$a[suffix]'></div>";

    //Return Output.
    return $output;
  }
?>