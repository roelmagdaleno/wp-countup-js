import { CountUp } from './vendor/countUp.min.js';

const WP_CUPJS_OBSERVER = new IntersectionObserver( WP_CUPJS_startCounterOnScroll, {
    rootMargin: '100px 0px 100px 0px',
    threshold: 0.7
} );

function WP_CUPJS_startCounterOnScroll( entries, observer ) {
    for ( let i = 0; i < entries.length; i++ ) {
        const entry = entries[i];

        if ( ! entry.isIntersecting ) {
            continue;
        }

        const counterEl = entry.target;

        if ( counterEl.dataset.hasOwnProperty( 'alreadyScrolled' ) ) {
            continue;
        }

        counterEl.dataset.alreadyScrolled = 'true';

        WP_CUPJS_startCounter( counterEl );
    }
}

function WP_CUPJS_getPrefix( counterId, prefix ) {
    if ( '' === prefix ) {
        return prefix;
    }

    return `<span class="wp_cup_prefix" id="prefix-${ counterId }">${ prefix }</span>`;
}

function WP_CUPJS_getSuffix( counterId, suffix ) {
    if ( '' === suffix ) {
        return suffix;
    }

    return `<span class="wp_cup_suffix" id="suffix-${ counterId }">${ suffix }</span>`;
}

function WP_CUPJS_startCounter( counterEl ) {
    const onScroll = !! counterEl.dataset.scroll;

    if ( ! counterEl.dataset.hasOwnProperty( 'alreadyScrolled' ) && onScroll ) {
        WP_CUPJS_OBSERVER.observe( counterEl );
        return;
    }

    let endVal  = WP_CU_JS.endInsideShortcode ? counterEl.innerHTML : counterEl.dataset.end;
    let countUp = new CountUp( counterEl, parseInt( endVal ), WP_CUPJS_getOptions( counterEl ) );
    const delay = parseInt( counterEl.dataset.delay );

    if ( 0 === delay || isNaN( delay ) ) {
        countUp.start();
        return;
    }

    setTimeout( () => countUp.start(), delay );
}

function WP_CUPJS_getOptions( counterEl ) {
    return {
        startVal: counterEl.dataset.start,
        decimalPlaces: counterEl.dataset.decimals,
        duration: counterEl.dataset.duration,
        useGrouping: !! counterEl.dataset.grouping,
        useEasing: !! counterEl.dataset.easing,
        separator: counterEl.dataset.separator,
        decimal: counterEl.dataset.decimal,
        prefix: WP_CUPJS_getPrefix( counterEl.id, counterEl.dataset.prefix ),
        suffix: WP_CUPJS_getSuffix( counterEl.id, counterEl.dataset.suffix )
    };
}

function WP_CUPJS_initCounters() {
    const counters = document.querySelectorAll( '.counter' );

    for ( let i = 0; i < counters.length; i++ ) {
        let counterEl = counters[i];
        counterEl.setAttribute( 'id', `counter-${ i }` );

        WP_CUPJS_startCounter( counterEl );
    }
}

document.addEventListener( 'DOMContentLoaded', WP_CUPJS_initCounters );
