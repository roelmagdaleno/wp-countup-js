import {
    Panel,
    PanelBody,
    PanelRow,
    TextControl,
    ToggleControl,
    Button,
    Toolbar,
    ToolbarButton,
    FontSizePicker
} from '@wordpress/components';

import {
    formatBold,
    formatItalic
} from '@wordpress/icons';

import {
    Fragment
} from '@wordpress/element';

import {
    InspectorControls,
    BlockControls,
    AlignmentToolbar
} from '@wordpress/block-editor';

import {
    generateCounterHTML,
    fontSizes
} from './utils';

const edit = ( { attributes, setAttributes, clientId } ) => {
    const {
        start, end, decimals,
        duration, delay, grouping,
        easing, separator, decimal,
        prefix, suffix, scroll,
        reset, align, bold, italic,
        fontSize
    } = attributes;

    const divStyle = {
        textAlign: align,
        fontWeight: bold,
        fontStyle: italic,
        fontSize: fontSize
    };

    function playCounter() {
        const counterEl = generateCounterHTML( attributes, clientId );
        window.WP_CU_JS.startCounter( counterEl );
    }

    function onChangeBold() {
        setAttributes( { bold: 'inherit' === bold ? 'bold' : 'inherit' } );
    }

    function onChangeItalic() {
        setAttributes( { italic: 'inherit' === italic ? 'italic' : 'inherit' } );
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
                                    onChange = { ( start ) => setAttributes( { start: parseInt( start ) } ) }
                                />
                            </PanelRow>

                            <PanelRow>
                                <TextControl
                                    label = 'End'
                                    value = { end }
                                    help = 'The value you want to arrive at.'
                                    type = 'number'
                                    onChange = { ( end ) => setAttributes( { end: parseInt( end ) } ) }
                                />
                            </PanelRow>

                            <PanelRow>
                                <TextControl
                                    label = 'Duration'
                                    value = { duration }
                                    help = 'Animation duration in seconds.'
                                    type = 'number'
                                    onChange = { ( duration ) => setAttributes( { duration: parseInt( duration ) } ) }
                                />
                            </PanelRow>

                            <PanelRow>
                                <TextControl
                                    label = 'Delay'
                                    value = { delay }
                                    help = 'Start counter after delay in milliseconds.'
                                    type = 'number'
                                    onChange = { ( delay ) => setAttributes( { delay: parseInt( delay ) } ) }
                                />
                            </PanelRow>
                        </PanelBody>
                    </Panel>

                    <Panel>
                        <PanelBody title = "Options" initialOpen = { false }>
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
                                    onChange = { ( decimals ) => setAttributes( { decimals: parseInt( decimals ) } ) }
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

                            <PanelRow>
                                <ToggleControl
                                    label = 'Group Digits'
                                    help = 'E.j: 1,000 (enabled) or 1000 (disabled).'
                                    checked = { grouping }
                                    onChange = { ( grouping ) => setAttributes( { grouping } ) }
                                />
                            </PanelRow>

                            <PanelRow>
                                <ToggleControl
                                    label = 'Ease Animation'
                                    checked = { easing }
                                    onChange = { ( easing ) => setAttributes( { easing } ) }
                                />
                            </PanelRow>

                            <PanelRow>
                                <ToggleControl
                                    label = 'Start on View'
                                    help = 'Start the counter on view.'
                                    checked = { scroll }
                                    onChange = { ( scroll ) => setAttributes( { scroll } ) }
                                />
                            </PanelRow>

                            <PanelRow>
                                <ToggleControl
                                    label = 'Reset after View'
                                    help = 'Reset the counter after view.'
                                    checked = { reset }
                                    onChange = { ( reset ) => setAttributes( { reset } ) }
                                />
                            </PanelRow>
                        </PanelBody>
                    </Panel>

                    <Panel>
                        <PanelBody title = "Styles" initialOpen = { false }>
                            <PanelRow>
                                <FontSizePicker
                                    fontSizes = { fontSizes }
                                    value = { fontSize }
                                    withSlider = { true }
                                    onChange = { ( fontSize ) => setAttributes( { fontSize } ) }
                                />
                            </PanelRow>
                        </PanelBody>
                    </Panel>
                </InspectorControls>

                <BlockControls>
                    <AlignmentToolbar
                        value = { align }
                        onChange = { ( align ) => setAttributes( { align } ) }
                    />

                    <Toolbar>
                        <ToolbarButton
                            icon = { formatBold }
                            label = 'Bold'
                            onClick = { () => onChangeBold() }
                            isPressed = { 'inherit' !== bold }
                        />

                        <ToolbarButton
                            icon = { formatItalic }
                            label = 'Italic'
                            onClick = { () => onChangeItalic() }
                            isPressed = { 'inherit' !== italic }
                        />
                    </Toolbar>
                </BlockControls>

                <div className="counter"
                     data-end = { end }
                     style = { divStyle }
                >
                    { start }
                </div>
            </Fragment>
        </>
    );
};

export default edit;
