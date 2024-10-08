(function() {
	'use strict';
	window.aosNevothemes = {
            initRefresh: function () {
                AOS.refresh();
            },
            initAOS: function() {
                  AOS.init( {    
                        offset: parseInt( aoswp_params.offset ),
                        duration: parseInt( aoswp_params.duration ),
                        easing: aoswp_params.easing,
                        delay: parseInt( aoswp_params.delay ),
                        once: aoswp_params.once,
                  } );
            },
            init: function() {
			window.aosNevothemes.initAOS();
		}
	}
	if ( 'loading' === document.readyState ) {
		// The DOM has not yet been loaded.
		document.addEventListener( 'DOMContentLoaded', window.aosNevothemes.init );
	} else {
		// The DOM has already been loaded.
		window.aosNevothemes.init();
	}
})();