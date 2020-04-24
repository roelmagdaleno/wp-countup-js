function WP_CUJS_editBlock( props ) {
    const el = wp.element.createElement;
    return el( 'input', {
        type: 'number',
        className: 'wp-cujs-counter',
        value: props.attributes.startNumber
    } );
}

( function( blocks, editor, element ) {
    const el = element.createElement;
    var AlignmentToolbar = editor.AlignmentToolbar;
    var BlockControls = editor.BlockControls;

    blocks.registerBlockType( 'wp-countup-js/counter', {
        title: 'CountUp',
        icon: 'universal-access-alt',
        category: 'layout',
        attributes: {
            content: {
                type: 'string',
                source: 'html',
                selector: 'p'
            },
            counterStart: {
                type: 'string',
                selector: '.wp-cujs-counter'
            }
        },
        edit: function( props ) {
            var updateFieldValue = function( val ) {
                props.setAttributes( { content: val } );
            }

            return wp.element.createElement(
                wp.components.TextControl,
                {
                    label: 'My Text Field',
                    type: 'number',
                    value: props.attributes.content,
                    onChange: updateFieldValue,
                }
            );
        },

        save: function( props ) {
            return el( 'p', {}, props.attributes.content );
        },
        // edit: function ( props ) {
        //     function onChangeAlignment( newAlignment ) {
        //         props.setAttributes( { alignment: newAlignment === undefined ? 'none' : newAlignment } );
        //     }
        //
        //     return el( wp.components.TextControl, {
        //         type: 'number',
        //         className: 'wp-cujs-counter',
        //         value: props.attributes.counterStart
        //     } );
        // },
        // save: function( props ) {
        //     //
        // }
    } );
}(
    window.wp.blocks,
    window.wp.blockEditor,
    window.wp.element
) );
