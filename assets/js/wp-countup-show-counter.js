import { CountUp } from './vendor/countUp.min.js';

const WP_CUPJS_OBSERVER = new IntersectionObserver( WP_CUPJS_startCounterOnScroll, {
    rootMargin: '100px 0px 100px 0px',
    threshold: 0.7
} );

let WP_CUPJS_TIMERS = {};

window.WP_CU_JS.startCounter = ( counterEl ) => WP_CUPJS_startCounter( counterEl );

/**
 * Start the counters that are intersecting using the scroll
 * functionality.
 *
 * Also will reset those counter that have the reset attribute.
 *
 * @since 4.1.0
 *
 * @param {array}                  entries   The current observed elements.
 * @param {IntersectionObserver}   observer  The current observer object.
 */
function WP_CUPJS_startCounterOnScroll( entries, observer ) {
    for ( let i = 0; i < entries.length; i++ ) {
        const entry        = entries[i];
        const counterEl    = entry.target;
        const dataset      = counterEl.dataset;
        const observed     = dataset.hasOwnProperty( 'observed' );
        const onScroll     = dataset.hasOwnProperty( 'scroll' ) && 'true' === dataset.scroll;
        const resetCounter = WP_CUPJS_shouldResetCounter( dataset );

        if ( ! entry.isIntersecting ) {
            WP_CUPJS_maybeResetCounter( onScroll, resetCounter, observed, counterEl );
            continue;
        }

        // If counter starts on scroll and need reset.
        if ( onScroll && resetCounter && observed ) {
            WP_CUPJS_resetCounter( counterEl );
            continue;
        }

        // If counter starts on scroll but doesn't need reset.
        if ( onScroll && ! resetCounter && observed ) {
            WP_CUPJS_OBSERVER.unobserve( counterEl );
            continue;
        }

        // If counter doesn't have scroll action but need to reset.
        if ( ! onScroll && resetCounter && ! observed ) {
            counterEl.dataset.scroll   = 'true';
            counterEl.dataset.observed = 'true';
            continue;
        }

        WP_CUPJS_startCounter( counterEl );
    }
}

/**
 * Decide if the counter should be reset.
 *
 * If the reset attribute doesn't exists then use the default setting
 * from the options page.
 *
 * @since  4.1.0
 *
 * @param  {object}   dataset   The counter dataset that includes the attributes.
 * @return {boolean}            Whether should reset the counter or not.
 */
function WP_CUPJS_shouldResetCounter( dataset ) {
    return ! dataset.hasOwnProperty( 'reset' ) ? !! WP_CU_JS.resetCounterWhenViewAgain : 'true' === dataset.reset;
}

/**
 * Get the counter prefix with some HTML content
 * so the user can style it.
 *
 * @since  4.1.0
 *
 * @param  {string}   counterId   The counter ID.
 * @param  {string}   prefix      The counter prefix.
 * @return {string}               The counter prefix with some HTML.
 */
function WP_CUPJS_getPrefix( counterId, prefix ) {
    if ( '' === prefix ) {
        return prefix;
    }

    return `<span class="wp_cup_prefix" id="prefix-${ counterId }">${ prefix }</span>`;
}

/**
 * Get the counter suffix with some HTML content
 * so the user can style it.
 *
 * @since  4.1.0
 *
 * @param  {string}   counterId   The counter ID.
 * @param  {string}   suffix      The counter suffix.
 * @return {string}               The counter suffix with some HTML.
 */
function WP_CUPJS_getSuffix( counterId, suffix ) {
    if ( '' === suffix ) {
        return suffix;
    }

    return `<span class="wp_cup_suffix" id="suffix-${ counterId }">${ suffix }</span>`;
}

/**
 * Check if current counter should reset or not.
 *
 * @since 4.2.0
 *
 * @param {boolean}      onScroll       Whether counter should start on view.
 * @param {boolean}      resetCounter   Whether to reset counter or not.
 * @param {boolean}      observed       Whether counter is being observed.
 * @param {HTMLElement}  counterEl      The counter element.
 */
function WP_CUPJS_maybeResetCounter( onScroll, resetCounter, observed, counterEl ) {
    if ( onScroll && resetCounter && observed ) {
        WP_CUPJS_resetCounter( counterEl );
    }
}

/**
 * Reset the counter.
 *
 * Also remove the observed dataset attribute so the counter
 * can run again.
 *
 * @since 4.1.0
 *
 * @param {HTMLElement}   counterEl    The counter element.
 */
function WP_CUPJS_resetCounter( counterEl ) {
    const countUp = new CountUp( counterEl );
    countUp.reset();

    if ( WP_CUPJS_TIMERS.hasOwnProperty( counterEl.id ) ) {
        clearTimeout( WP_CUPJS_TIMERS[ counterEl.id ] );
    }

    delete counterEl.dataset.observed;
}

/**
 * Decide if the counter needs to be observed.
 *
 * If the counter doesn't have the scroll attribute or is already observed
 * then won't observe it again.
 *
 * Otherwise observe it and return true.
 *
 * @since  4.1.0
 *
 * @param  {HTMLElement}   counterEl    The counter element.
 * @return {boolean}                    Whether the counter is being observed or not.
 */
function WP_CUPJS_runObserver( counterEl ) {
    const dataset  = counterEl.dataset;
    const onScroll = dataset.hasOwnProperty( 'scroll' ) && 'true' === dataset.scroll;
    const observed = dataset.hasOwnProperty( 'observed' );

    if ( ! onScroll || observed ) {
        return false;
    }

    WP_CUPJS_OBSERVER.observe( counterEl );
    return true;
}

/**
 * Start the counter.
 *
 * If the counter has a delay then use a timeout to run after pass the delay.
 *
 * @since 4.1.0
 *
 * @param {HTMLElement}   counterEl    The counter element.
 * @param {boolean}       isObserved   Whether the counter is being observed or not.
 */
function WP_CUPJS_startCounter( counterEl, isObserved = true ) {
    let endVal  = counterEl.dataset.end;
    let countUp = new CountUp( counterEl, parseFloat( endVal ), WP_CUPJS_getOptions( counterEl ) );
    const delay = parseInt( counterEl.dataset.delay );

    if ( isObserved ) {
        counterEl.dataset.observed = 'true';
    }

    if ( 0 === delay || isNaN( delay ) ) {
        countUp.start();
        return;
    }

    WP_CUPJS_TIMERS[ counterEl.id ] = setTimeout( () => countUp.start(), delay );
}

/**
 * Get the counter options to be used in CountUp instance.
 *
 * @since  4.1.0
 *
 * @param  {HTMLElement}   counterEl   The counter element.
 * @return {object}                    The counter options for CountUp instance.
 */
function WP_CUPJS_getOptions( counterEl ) {
    const settings = WP_CU_JS.pluginSettings;
    const dataset  = counterEl.dataset;
    let options    = {
        useEasing:   settings.useEasing,
        useGrouping: settings.useGrouping,
        separator:   settings.separator,
        decimal:     settings.decimal,
        prefix:      settings.prefix,
        suffix:      settings.suffix
    };

    if ( dataset.hasOwnProperty( 'start' ) ) {
        options.startVal = parseFloat( dataset.start );
    }

    if ( dataset.hasOwnProperty( 'decimals' ) ) {
        options.decimalPlaces = dataset.decimals;
    }

    if ( dataset.hasOwnProperty( 'duration' ) ) {
        options.duration = isNaN( dataset.duration ) ? 2 : dataset.duration;
    }

    if ( dataset.hasOwnProperty( 'grouping' ) ) {
        options.useGrouping = 'false' !== dataset.grouping;
    }

    if ( dataset.hasOwnProperty( 'easing' ) ) {
        options.useEasing = 'false' !== dataset.easing;
    }

    if ( dataset.hasOwnProperty( 'separator' ) ) {
        options.separator = dataset.separator;
    }

    if ( dataset.hasOwnProperty( 'decimal' ) ) {
        options.decimal = dataset.decimal;
    }

    if ( dataset.hasOwnProperty( 'prefix' ) ) {
        options.prefix = dataset.prefix;
    }

    if ( dataset.hasOwnProperty( 'suffix' ) ) {
        options.suffix = dataset.suffix;
    }

    options.prefix = WP_CUPJS_getPrefix( counterEl.id, options.prefix );
    options.suffix = WP_CUPJS_getSuffix( counterEl.id, options.suffix );

    return options;
}

/**
 * Prepare the counter to be executed.
 *
 * First we need to decide if the counter runs on scroll, if that's true
 * then register the counter into the observer and won't execute the counter.
 *
 * Otherwise run the counter that doesn't need the scroll event.
 *
 * If the counter has the "reset" attribute then we need to "observe" it.
 *
 * @since 4.1.0
 *
 * @param {HTMLElement}   counterEl   The counter element.
 */
function WP_CUPJS_prepareCounter( counterEl ) {
    if ( WP_CUPJS_runObserver( counterEl ) ) {
        return;
    }

    const resetCounter = WP_CUPJS_shouldResetCounter( counterEl.dataset );

    if ( resetCounter ) {
        WP_CUPJS_OBSERVER.observe( counterEl );
    }

    const isObserved = false;
    WP_CUPJS_startCounter( counterEl, isObserved );
}

/**
 * Get all counters in the page and prepare them to execute.
 * Also set the ids for every counter so the user can customize using the ids.
 *
 * @since 4.1.0
 */
function WP_CUPJS_initCounters() {
    const counters = document.querySelectorAll( '.counter' );

    for ( let i = 0; i < counters.length; i++ ) {
        let counterEl = counters[i];

        counterEl.setAttribute( 'id', `counter-${ i }` );
        WP_CUPJS_prepareCounter( counterEl );
    }
}

// Initialize the JS functionality.
document.addEventListener( 'DOMContentLoaded', WP_CUPJS_initCounters );
