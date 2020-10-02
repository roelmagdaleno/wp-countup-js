import {
    RawHTML
} from '@wordpress/element';

import { generateCounterHTML } from "./utils";

const save = ( { attributes } ) => {
    const counterEl = generateCounterHTML( attributes.id, attributes );

    return counterEl && (
        <RawHTML>
            { counterEl.outerHTML }
        </RawHTML>
    );
};

export default save;
