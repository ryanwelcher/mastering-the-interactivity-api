/**
 * External Dependencies
 */
import Prism from 'prismjs';

/**
 * WordPress Dependencies
 */
import { store, getElement, getContext } from '@wordpress/interactivity';

store( 'overlay', {
	state: {},
	actions: {
		closeOverlay: () => {
			const overlay = document.querySelector(
				'.router-attach-to-overlay'
			);
			if ( overlay ) {
				overlay.style.display = 'none';
			}
		},
	},
	callbacks: {},
} );
