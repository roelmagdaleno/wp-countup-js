import { registerBlockType } from '@wordpress/blocks';
import edit from './edit';

registerBlockType( 'roelmagdaleno/wp-countup-js', {
    title: 'CountUp',
    description: 'Create animated incremental numerical counters and display it into your site.',
    category: 'common',
    icon: 'editor-ol',
    keywords: [ 'counter', 'countup', 'animate' ],
    attributes: {
        start: {
            type: 'number',
            default: 0
        },
        end: {
            type: 'number',
            default: 1992
        },
        decimals: {
            type: 'number',
            default: 0
        },
        duration: {
            type: 'number',
            default: 2
        },
        delay: {
            type: 'number',
            default: 0
        },
        grouping: {
            type: 'boolean',
            default: !! WP_CU_JS.pluginSettings.useGrouping
        },
        easing: {
            type: 'boolean',
            default: !! WP_CU_JS.pluginSettings.useEasing
        },
        scroll: {
            type: 'boolean'
        },
        reset: {
            type: 'boolean',
            default: !! WP_CU_JS.resetCounterWhenViewAgain
        },
        separator: {
            type: 'string',
            default: WP_CU_JS.pluginSettings.separator
        },
        decimal: {
            type: 'string',
            default: WP_CU_JS.pluginSettings.decimal
        },
        prefix: {
            type: 'string',
            default: WP_CU_JS.pluginSettings.prefix
        },
        suffix: {
            type: 'string',
            default: WP_CU_JS.pluginSettings.suffix
        }
    },
    edit,
    save: () => {
    }
} );
