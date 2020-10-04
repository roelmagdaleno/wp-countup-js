import {
    RawHTML
} from '@wordpress/element';

import { generateCounterHTML } from "./utils";

const save = ( { attributes } ) => {
    const counterEl = generateCounterHTML( attributes, attributes.id );

    return (
        <RawHTML>{ counterEl.outerHTML }</RawHTML>
    );
};

export default save;
