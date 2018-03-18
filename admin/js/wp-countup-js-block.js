// Blocks.
var el                = wp.element.createElement;
var registerBlockType = wp.blocks.registerBlockType;
var InspectorControls = wp.blocks.InspectorControls;
var RichText          = wp.blocks.RichText;
var BlockControls     = wp.blocks.BlockControls;
var AlignmentToolbar  = wp.blocks.AlignmentToolbar;

// Components.
var TextControl   = wp.components.TextControl;
var ToggleControl = wp.components.ToggleControl;
var PanelBody     = wp.components.PanelBody;
var PanelColor    = wp.components.PanelColor;
var ColorPalette  = wp.blocks.ColorPalette;

registerBlockType( 'wp-countup-js/counter-block', {
	title:       'Count Up',

	description: 'You can create a lot of animated numerical counters and display it into your site.',

	category:    'layout',

	icon:        'universal-access-alt',

	keywords:    [ 'counter', 'number', 'up' ],

	attributes:  {
		counterNumber: {
			type: 'number',
		},
		scroll: {
			type: 'boolean',
			default: true
		},
		easing: {
			type: 'boolean',
			default: true
		},
		grouping: {
			type: 'boolean',
			default: true
		},
		decimals: {
			type: 'number',
			default: '0'
		},
		duration: {
			type: 'number',
			default: '1000'
		},
		separator: {
			type: 'string',
			default: ','
		},
		decimal: {
			type: 'string',
			default: '.'
		},
		alignment: {
			type: 'string',
			default: 'center',
		},
	},

	edit: function( props ) {
		var content = props.attributes.content;
		var focus   = props.focus;

		function onChangeAlignment( newAlignment ) {
			props.setAttributes( { alignment: newAlignment } );
		}

		function onChangeScroll( newScroll ) {
			props.setAttributes( { scroll: newScroll } );
		}

		function onChangeEasing( newEasing ) {
			props.setAttributes( { easing: newEasing } );
		}

		function onChangeGrouping( newGrouping ) {
			props.setAttributes( { grouping: newGrouping } );
		}

		function onChangeDecimals( newDecimals ) {
			props.setAttributes( { decimals: newDecimals } );
		}

		function onChangeDuration( newDuration ) {
			props.setAttributes( { duration: newDuration } );
		}

		function onChangeSeparator( newSeparator ) {
			props.setAttributes( { separator: newSeparator } );
		}

		function onChangeDecimal( newDecimal ) {
			props.setAttributes( { decimal: newDecimal } );
		}

		function onChangeNumber( newEndNumber ) {
			props.setAttributes( { endNumber: newEndNumber } );
		}

		var scrollData    = {
			label:    'Start at View',
			checked:  props.attributes.scroll,
			onChange: onChangeScroll
		};
		var easingData    = {
			label:    'Easing',
			checked:  props.attributes.easing,
			onChange: onChangeEasing
		};
		var groupingData  = {
			label:    'Grouping',
			checked:  props.attributes.grouping,
			onChange: onChangeGrouping
		};
		var decimalsData  = {
			label:    'Decimals',
			value:    props.attributes.decimals,
			onChange: onChangeDecimals
		};
		var durationData  = {
			label:    'Duration',
			value:    props.attributes.duration,
			help:     'In seconds.',
			onChange: onChangeDuration
		};
		var separatorData = {
			label: 'Separator',
			help: 'The counter separator.',
			value: props.attributes.separator,
			onChange: onChangeSeparator
		};
		var decimalData   = {
			label: 'Decimal',
			help: 'The counter decimal.',
			value: props.attributes.decimal,
			onChange: onChangeDecimal
		};

		return [
			!! focus && el(
				BlockControls,
				{ key: 'controls' },
				el(
					AlignmentToolbar, {
						value: props.attributes.alignment,
						onChange: onChangeAlignment,
					}
				)
			),

			!! focus && el(
				InspectorControls,
				{ key: 'inspector' },
				el(
					PanelBody, {
						title: 'Counter Settings',
						isOpened: true,
						children: [
							WP_CUP_JS_createToggleControl( scrollData ),
							WP_CUP_JS_createToggleControl( easingData ),
							WP_CUP_JS_createToggleControl( groupingData ),
							WP_CUP_JS_createTextControl( decimalsData, 'number' ),
							WP_CUP_JS_createTextControl( durationData, 'number' ),
							WP_CUP_JS_createTextControl( separatorData, 'text' ),
							WP_CUP_JS_createTextControl( decimalData, 'text' )
						]
					}
				),
			),

			el( 'div', { style: { textAlign: props.attributes.alignment } },
				el( RichText, {
					tagName: 'span',
					className: 'wp-cup-js-top-prefix',
					placeholder: 'Top Prefix',
					onChange: onChangeNumber
				} ),

				el( 'div', { className: 'wp-cup-js-center-block' },
					el( RichText, {
						tagName: 'span',
						className: 'wp-cup-js-left-prefix',
						placeholder: 'Left Prefix',
						onChange: onChangeNumber
					} ),

					el( RichText, {
						tagName: 'span',
						className: 'wp-cup-js-counter-number',
						placeholder: 'End Number',
						onChange: onChangeNumber
					} ),

					el( RichText, {
						tagName: 'span',
						className: 'wp-cup-js-right-suffix',
						placeholder: 'Right Suffix',
						onChange: onChangeNumber
					} ),
			 	),

				el( RichText, {
					tagName: 'span',
					className: 'wp-cup-js-bottom-suffix',
					placeholder: 'Bottom Suffix',
					onChange: onChangeNumber
				} ),
		 	),

		];
	},

	save: function() {
		return el( 'p', {}, 'My saved paragraph.' );
	},
} );

function WP_CUP_JS_createToggleControl( controlData ) {
	return el(
		ToggleControl,
		{
			label:    controlData.label,
			checked:  controlData.checked,
			onChange: controlData.onChange
		}
	);
}

function WP_CUP_JS_createTextControl( controlData, inputType ) {
	return el(
		TextControl,
		{
			type:     inputType,
			label:    controlData.label,
			help:     controlData.help,
			value:    controlData.value,
			onChange: controlData.onChange
		}
	);
}
