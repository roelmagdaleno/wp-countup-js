import { registerBlockType } from '@wordpress/blocks';
import edit from './edit';
import attributes from './attributes';

registerBlockType( 'roelmagdaleno/wp-countup-js', {
    title: 'CountUp',
    description: 'Create animated incremental numerical counters and display it into your site.',
    category: 'common',
    icon: 'editor-ol',
    keywords: [ 'counter', 'countup', 'animate' ],
    attributes,
    edit,
    save: () => {
    }
} );
