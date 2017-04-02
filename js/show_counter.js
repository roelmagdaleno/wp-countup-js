jQuery( document ).ready( function( $ ){
	var eventFired     = false;
	var options        = {};
	var counterObjects = {};

	function wpcjs_get_counter() {
		//Loop to class counter which contains all data provided into the shortcode.
		$.each( $( '.counter' ), function( index, value ) {
			$( this ).attr( 'id', 'counter-' + index ); //Add an id to each counter.

			// If you want to put the end counter number dynamically,
			// get it from an AJAX request or something, change the number
			// inside of the counter id, in case of "Use the end number inside the shortcode?"
			// option is checked and use the following shortcode structure
			// [countup start="20"]55[/countup]:
			//
			// $('#counter-1').html('100');
			//
			// or, you could use:
			// $('#counter-1').data('count', 20);
			//
			// In case of, "Use the end number inside the shortcode?" is unchecked and use
			// the following shortcode structure: [countup start="0" end="55"].
			//
			// Be sure that the previous code run before the next code.
			var count     = wp_cup_settings.end_inside_shortcode ? $( this ).html() : $( this ).data( 'count' );
			var start     = $( this ).data( 'start' );
			var decimals  = $( this ).data( 'decimals' );
			var duration  = $( this ).data( 'duration' );
			var onScroll  = $( this ).data( 'scroll' );
			var easing    = $( this ).data( 'easing' );
			var grouping  = $( this ).data( 'grouping' );
			var separator = $( this ).data( 'separator' );
			var decimal   = $( this ).data( 'decimal' );
			var prefix    = $( this ).data( 'prefix' );
			var suffix    = $( this ).data( 'suffix' );

			//Options Variables
			var options_in_shortcode = {
				useEasing:   easing,
				useGrouping: grouping,
				separator:   separator,
				decimal:     decimal,
				prefix:      prefix,
				suffix:      suffix
			};

			//Loop to options_in_shortcode, this means if one option value inside of shortcode is empty, the default value is pull from the options page.
			$.each( options_in_shortcode, function( key, value ){
				if( value == " " ){
					options[ key ] = wp_cup_settings.settings[ key ];
				} else {
					options[ key ] = value;
				}
			});

			//Get counter id.
			var counterId = $( this ).attr( 'id' );

			//Object Instance.
			var numAnim = new CountUp( counterId, start, count, decimals, duration, options );

			//Get the counter id position.
			objectPositionTop = $( '#' + counterId ).offset().top - window.innerHeight;

			if( onScroll === false && eventFired === false ){
				numAnim.start();
			} else {
				counterObjects[ 'counterObj' + index ] = {
					'counterId'         : '#' + counterId,
					'objectPositionTop' : objectPositionTop,
					'numAnimObject'     : numAnim
				};
			}
		});
	}

	// Logic got it from: http://stackoverflow.com/a/488073/2644250
	function wpcjs_check_visibility() {
		var docViewTop    = $( window ).scrollTop();
		var docViewBottom = docViewTop + $( window ).height();

		for ( var i in counterObjects ) {
    			var elemTop = $( counterObjects[i].counterId ).offset().top;
    			var elemBottom = elemTop + $( counterObjects[i].counterId ).height();

    			if ( ( elemBottom <= docViewBottom ) && ( elemTop >= docViewTop ) ) {
				counterObjects[i].numAnimObject.start();
			}
		}
    }

	wpcjs_get_counter();
	wpcjs_check_visibility();
	$( window ).on( 'scroll', wpcjs_check_visibility );
});
