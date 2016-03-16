jQuery(function(){
  var options = {
    useEasing: setting.easing,
    useGrouping: setting.grouping,
    separator: setting.separator,
    decimal: setting.decimal,
    prefix: setting.prefix,
    suffix: setting.suffix
  };

  //new CountUp('#id', start, end, decimals, duration, options);
  $.each($('.counter'), function(){
    var start    = $(this).data('start');
    var count    = $(this).data('count');
    var decimals = $(this).data('decimals');
    var duration = $(this).data('duration');

    var numAnim = new CountUp(this, start, count, decimals, duration, options);

    numAnim.start();
  });
});