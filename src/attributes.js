const attributes = {
	align: { type: 'string', default: 'center' },
	bgColor: { type: 'string', default: '' },
	bold: { type: 'string', default: 'inherit' },
	colorPicker: { type: 'string', default: '' },
	decimal: { type: 'string', default: WP_CU_JS.pluginSettings.decimal },
	decimals: { type: 'number', default: 0 },
	delay: { type: 'number', default: 0 },
	duration: { type: 'number', default: 2 },
	easing: { type: 'boolean', default: ! ! WP_CU_JS.pluginSettings.useEasing },
	end: { type: 'number', default: 0 },
	fontSize: { type: 'number', default: 21 },
	grouping: { type: 'boolean', default: ! ! WP_CU_JS.pluginSettings.useGrouping },
	italic: { type: 'string', default: 'inherit' },
	prefix: { type: 'string', default: WP_CU_JS.pluginSettings.prefix },
	reset: { type: 'boolean', default: ! ! WP_CU_JS.resetCounterWhenViewAgain },
	scroll: { type: 'boolean', default: false },
	separator: { type: 'string', default: WP_CU_JS.pluginSettings.separator },
	start: { type: 'number', default: 0 },
	suffix: { type: 'string', default: WP_CU_JS.pluginSettings.suffix }
};

export default attributes;
