/**
 * WordPress Dependencies
 */

import { store } from '@wordpress/interactivity';

const { state } = store( 'wp-text', {
	state: {},
	actions: {
		updateText: ( evt ) => {
			state.text = evt.target.value;
		},
	},
	callbacks: {},
} );
