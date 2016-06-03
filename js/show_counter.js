jQuery(document).ready(function($){
  var eventFired = false;
  var options = {};

  //Loop to class counter which contains all data provided into the shortcode.
  $.each($('.counter'), function(index, value){
    $(this).attr('id', 'counter-' + index); //Add an id to each counter.

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

    //Get counter id.
    var counterId = $(this).attr('id');

    //Object Instance.
    var numAnim = new CountUp(counterId, start, count, decimals, duration, options);

    //Scroll function to execute the animation number when it scrolled to the object.
    var objectPositionTop = $('#' + counterId).offset().top - window.innerHeight;

    $(window).on('scroll', function(){
      var currentPosition = $(document).scrollTop();

      if(currentPosition > objectPositionTop && eventFired === false){
        numAnim.start();
      }
    });
  });
});