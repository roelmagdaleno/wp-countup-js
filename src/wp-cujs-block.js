import { registerBlockType } from '@wordpress/blocks';
import edit from './edit';
import save from './save';
import attributes from './attributes';
import transforms from "./transforms";

registerBlockType( 'roelmagdaleno/wp-countup-js', {
    title: 'CountUp',
    description: 'Display multiple animated counters into your WordPress site.',
    category: 'common',
    icon: 'editor-ol',
    keywords: [ 'counter', 'countup', 'animate' ],
    attributes,
    transforms,
    edit,
    save
} );
