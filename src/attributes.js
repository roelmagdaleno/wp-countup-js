const attributes = {
    id:        { type: 'string' },
    start:     { type: 'number', default: 0 },
    end:       { type: 'number', default: 0 },
    decimals:  { type: 'number', default: 0 },
    duration:  { type: 'number', default: 2 },
    delay:     { type: 'number', default: 0 },
    grouping:  { type: 'boolean', default: !! WP_CU_JS.pluginSettings.useGrouping },
    easing:    { type: 'boolean', default: !! WP_CU_JS.pluginSettings.useEasing },
    scroll:    { type: 'boolean', default: false },
    reset:     { type: 'boolean', default: !! WP_CU_JS.resetCounterWhenViewAgain },
    separator: { type: 'string', default: WP_CU_JS.pluginSettings.separator },
    decimal:   { type: 'string', default: WP_CU_JS.pluginSettings.decimal },
    prefix:    { type: 'string', default: WP_CU_JS.pluginSettings.prefix },
    suffix:    { type: 'string', default: WP_CU_JS.pluginSettings.suffix },
    align:     { type: 'string', default: 'center' },
    bold:      { type: 'string', default: 'inherit' },
    italic:    { type: 'string', default: 'inherit' }
};

export default attributes;
