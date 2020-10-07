const transforms = {
    from: [
        {
            type: 'shortcode',
            tag: 'countup',
            attributes: {
                decimals: {
                    type: 'number',
                    shortcode: ( attributes ) => parseInt( attributes.named.decimals )
                },
                delay: {
                    type: 'number',
                    shortcode: ( attributes ) => {
                        const delay = parseInt( attributes.named.delay );
                        return isNaN( delay ) ? 0 : delay;
                    }
                },
                duration: {
                    type: 'number',
                    shortcode: ( attributes ) => {
                        const duration = parseInt( attributes.named.duration );
                        return isNaN( duration ) ? 2 : duration;
                    }
                },
                easing: {
                    type: 'boolean',
                    shortcode: ( attributes ) => attributes.named.easing === 'true'
                },
                end: {
                    type: 'number',
                    shortcode: ( attributes ) => parseFloat( attributes.named.end )
                },
                grouping: {
                    type: 'boolean',
                    shortcode: ( attributes ) => attributes.named.grouping === 'true'
                },
                prefix: {
                    type: 'string',
                    shortcode: ( attributes ) => attributes.named.prefix
                },
                reset: {
                    type: 'boolean',
                    shortcode: ( attributes ) => attributes.named.reset === 'true'
                },
                scroll: {
                    type: 'boolean',
                    shortcode: ( attributes ) => attributes.named.scroll === 'true'
                },
                separator: {
                    type: 'string',
                    shortcode: ( attributes ) => attributes.named.separator
                },
                start: {
                    type: 'number',
                    shortcode: ( attributes ) => parseFloat( attributes.named.start )
                },
                suffix: {
                    type: 'string',
                    shortcode: ( attributes ) => parseInt( attributes.named.suffix )
                }
            }
        }
    ]
};

export default transforms;
