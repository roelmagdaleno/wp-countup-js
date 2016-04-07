jQuery(document).ready(function($){
  var options = {};

  //Loop to class counter which contains all data provided into the shortcode.
  $.each($('.counter'), function(){
    var start     = $(this).data('start');
    var count     = $(this).data('count');
    var decimals  = $(this).data('decimals');
    var duration  = $(this).data('duration');
    var easing    = $(this).data('easing');
    var grouping  = $(this).data('grouping');
    var separator = $(this).data('separator');
    var decimal   = $(this).data('decimal');
    var prefix    = $(this).data('prefix');
    var suffix    = $(this).data('suffix');

    //Options Variables
    var options_in_shortcode = {
      useEasing:    easing,
      useGrouping:  grouping,
      separator:    separator,
      decimal:      decimal,
      prefix:       prefix,
      suffix:       suffix
    };

    //Loop to options_in_shortcode, this means if one option value inside of shortcode is empty, the default value is pull from the options page.
    $.each(options_in_shortcode, function(key, value){
      if(value == " "){
        options[key] = setting[key];
      } else {
        options[key] = value;
      }
    });

    var numAnim = new CountUp(this, start, count, decimals, duration, options);

    numAnim.start();
  });

});