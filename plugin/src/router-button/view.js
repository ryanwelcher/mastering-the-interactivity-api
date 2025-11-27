/**
 * External Dependencies
 */
import Prism from 'prismjs';

/**
 * WordPress Dependencies
 */
import { store, withSyncEvent } from '@wordpress/interactivity';

store( 'router-button', {
	state: {},
	actions: {
		openRouterOverlay: withSyncEvent( function* ( e ) {
			e.preventDefault();

			// // We import the package dynamically to reduce the initial JS bundle size.
			// // Async actions are defined as generators so the import() must be called with `yield`.
			const { actions } = yield import(
				'@wordpress/interactivity-router'
			);

			yield actions.navigate( e.target.href );
		} ),
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
