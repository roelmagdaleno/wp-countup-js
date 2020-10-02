export function generateCounterHTML( clientId, attributes ) {
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
        reset,
        align
    } = attributes;

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
    counterEl.style.textAlign   = align;

    return counterEl;
}
