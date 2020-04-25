import { CountUp } from './vendor/countUp.min.js';

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

function WP_CUPJS_initCounters() {
    const counters = document.querySelectorAll( '.counter' );

    for ( let i = 0; i < counters.length; i++ ) {
        let counterEl = counters[i];
        let endVal    = WP_CU_JS.endInsideShortcode ? counterEl.innerHTML : counterEl.dataset.end;

        counterEl.setAttribute( 'id', `counter-${ i }` );

        let options = {
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

        let countUp = new CountUp( counterEl, parseInt( endVal ), options );
        countUp.start();
    }
}

document.addEventListener( 'DOMContentLoaded', WP_CUPJS_initCounters );
