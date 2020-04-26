import {
    Panel,
    PanelBody,
    PanelRow,
    TextControl,
    ToggleControl,
    Button
} from '@wordpress/components';

import {
    Fragment
} from '@wordpress/element';

import {
    InspectorControls
} from '@wordpress/block-editor';

const edit = ( { attributes, setAttributes, clientId } ) => {
    const {
        start,
        end,
        decimals,
        duration,
        delay,
        grouping,
        easing,
        separator,
        decimal,
        prefix,
        suffix,
        scroll,
        reset
    } = attributes;

    function playCounter() {
        const container = document.getElementById( `block-${ clientId }` );

        if ( ! container ) {
            return;
        }

        const counterEl = container.querySelector( '.counter' );

        if ( ! counterEl ) {
            return;
        }

        counterEl.dataset.start     = start;
        counterEl.dataset.duration  = duration;
        counterEl.dataset.delay     = delay;
        counterEl.dataset.decimal   = decimal;
        counterEl.dataset.decimals  = decimals;
        counterEl.dataset.separator = separator;
        counterEl.dataset.suffix    = suffix;
        counterEl.dataset.prefix    = prefix;
        counterEl.dataset.grouping  = grouping;
        counterEl.dataset.easing    = easing;
        counterEl.dataset.scroll    = scroll;
        counterEl.dataset.reset     = reset;
        counterEl.dataset.end       = end;

        window.WP_CU_JS.startCounter( counterEl );
    }

    return (
        <>
            <Fragment>
                <InspectorControls>
                    <Panel className = 'wp-cujs-block__play-counter__panel'>
                        <PanelBody>
                            <PanelRow>
                                <Button
                                    isPrimary
                                    label = 'Play Counter'
                                    className = 'wp-cujs-block__play-counter__button'
                                    onClick = { () => playCounter() }
                                >Play Counter</Button>
                            </PanelRow>
                        </PanelBody>
                    </Panel>

                    <Panel>
                        <PanelBody title = "Counter" initialOpen = { true }>
                            <PanelRow>
                                <TextControl
                                    label = 'Start'
                                    value = { start }
                                    help = 'Number to start at.'
                                    type = 'number'
                                    onChange = { ( start ) => setAttributes( { start } ) }
                                />
                            </PanelRow>

                            <PanelRow>
                                <TextControl
                                    label = 'End'
                                    value = { end }
                                    help = 'The value you want to arrive at.'
                                    type = 'number'
                                    onChange = { ( end ) => setAttributes( { end } ) }
                                />
                            </PanelRow>

                            <PanelRow>
                                <TextControl
                                    label = 'Duration'
                                    value = { duration }
                                    help = 'Animation duration in seconds.'
                                    type = 'number'
                                    onChange = { ( duration ) => setAttributes( { duration } ) }
                                />
                            </PanelRow>

                            <PanelRow>
                                <TextControl
                                    label = 'Delay'
                                    value = { delay }
                                    help = 'Start counter after delay in milliseconds.'
                                    type = 'number'
                                    onChange = { ( delay ) => setAttributes( { delay } ) }
                                />
                            </PanelRow>
                        </PanelBody>
                    </Panel>

                    <Panel>
                        <PanelBody title = "Settings" initialOpen = { false }>
                            <PanelRow>
                                <TextControl
                                    label = 'Decimal'
                                    value = { decimal }
                                    onChange = { ( decimal ) => setAttributes( { decimal } ) }
                                />
                            </PanelRow>

                            <PanelRow>
                                <TextControl
                                    label = 'Decimals'
                                    value = { decimals }
                                    help = 'Number of decimal places.'
                                    type = 'number'
                                    onChange = { ( decimals ) => setAttributes( { decimals } ) }
                                />
                            </PanelRow>

                            <PanelRow>
                                <TextControl
                                    label = 'Separator'
                                    value = { separator }
                                    help = 'Grouping separator.'
                                    onChange = { ( separator ) => setAttributes( { separator } ) }
                                />
                            </PanelRow>

                            <PanelRow>
                                <TextControl
                                    label = 'Prefix'
                                    value = { prefix }
                                    help = 'Text prepended to the result.'
                                    onChange = { ( prefix ) => setAttributes( { prefix } ) }
                                />
                            </PanelRow>

                            <PanelRow>
                                <TextControl
                                    label = 'Suffix'
                                    value = { suffix }
                                    help = 'Text appended to the result.'
                                    onChange = { ( suffix ) => setAttributes( { suffix } ) }
                                />
                            </PanelRow>
                        </PanelBody>
                    </Panel>

                    <Panel>
                        <PanelBody title = "Extras" initialOpen = { false }>
                            <PanelRow>
                                <ToggleControl
                                    label = 'Group Digits'
                                    help = 'E.j: 1,000 (enabled) or 1000 (disabled).'
                                    checked = { grouping }
                                    onChange = { ( value ) => setAttributes( { grouping: value } ) }
                                />
                            </PanelRow>

                            <PanelRow>
                                <ToggleControl
                                    label = 'Ease Animation'
                                    checked = { easing }
                                    onChange = { ( value ) => setAttributes( { easing: value } ) }
                                />
                            </PanelRow>

                            <PanelRow>
                                <ToggleControl
                                    label = 'Start on View'
                                    help = 'Start the counter on view.'
                                    checked = { scroll }
                                    onChange = { ( value ) => setAttributes( { scroll: value } ) }
                                />
                            </PanelRow>

                            <PanelRow>
                                <ToggleControl
                                    label = 'Reset after View'
                                    help = 'Reset the counter after view.'
                                    checked = { reset }
                                    onChange = { ( value ) => setAttributes( { reset: value } ) }
                                />
                            </PanelRow>
                        </PanelBody>
                    </Panel>
                </InspectorControls>

                <div className="counter" data-end = { end }>
                    { end }
                </div>
            </Fragment>
        </>
    );
};

export default edit;
