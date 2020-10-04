export const fontSizes = [
    {
        name: 'Small',
        slug: 'small',
        size: 18,
    },
    {
        name: 'Regular',
        slug: 'regular',
        size: 21,
    },
    {
        name: 'Large',
        slug: 'large',
        size: 26.25
    },
    {
        name: 'Larger',
        slug: 'larger',
        size: 32
    }
];

function constructCounter( attributes ) {
    let counterEl = document.createElement( 'div' );

    counterEl = setCounterDataset( attributes, counterEl )
    counterEl = setCounterStyles( attributes, counterEl );

    counterEl.innerHTML = attributes.start;
    counterEl.classList.add( 'counter' );

    return counterEl;
}

function setCounterDataset( attributes, counterEl ) {
    const settings = [
        'start', 'duration', 'delay',
        'decimal', 'decimals', 'separator',
        'suffix', 'prefix', 'grouping', 'easing',
        'scroll', 'reset', 'end'
    ];

    for ( let i = 0; i < settings.length; i++ ) {
        let setting = settings[ i ];
        counterEl.dataset[ setting ] = attributes[ setting ];
    }

    return counterEl;
}

function setCounterStyles( attributes, counterEl ) {
    counterEl.style.textAlign = attributes.align;
    counterEl.style.fontSize  = `${ attributes.fontSize }px`;

    if ( 'inherit' !== attributes.bold ) {
        counterEl.style.fontWeight = attributes.bold;
    }

    if ( 'inherit' !== attributes.italic ) {
         counterEl.style.fontStyle = attributes.italic;
    }

    if ( '' !== attributes.colorPicker ) {
        counterEl.style.color = attributes.colorPicker;
    }

    if ( '' !== attributes.bgColor ) {
        counterEl.style.backgroundColor = attributes.bgColor;
    }

    return counterEl;
}

export function generateCounterHTML( attributes, clientId ) {
    const container = document.getElementById( `block-${ clientId }` );

    if ( ! container ) {
        return constructCounter( attributes );
    }

    let counterEl = container.querySelector( '.counter' );

    if ( ! counterEl ) {
        return false;
    }

    counterEl = setCounterDataset( attributes, counterEl )
    counterEl = setCounterStyles( attributes, counterEl );

    delete counterEl.dataset.observed;
    counterEl.innerHTML = attributes.start;

    return counterEl;
}
