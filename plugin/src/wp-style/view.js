/**
 * External Dependencies
 */
import Prism from 'prismjs';

/**
 * WordPress Dependencies
 */
import { store, getElement, getContext } from '@wordpress/interactivity';

const { state } = store( 'wp-style', {
	state: {},
	actions: {
		toggleContextColor: () => {
			console.log( 'Toggling context color' );
			const context = getContext();
			context.color =
				context.color === 'var(--wp--preset--color--contrast)'
					? 'var(--wp--preset--color--accent)'
					: 'var(--wp--preset--color--contrast)';
		},
		toggleHelp: () => {
			state.showHelp = ! state.showHelp;
			// Handle marking as viewed in the toc-tracker store
			const { trackerName } = getContext();
			const tracker = store( 'toc-tracker' );
			if ( state.showHelp ) {
				tracker.actions.markAsViewed( trackerName );
			}
		},
	},
	callbacks: {
		initCodeBlock: () => {
			const { ref } = getElement();
			const codeBlock = ref.querySelector( 'code' );
			if ( codeBlock ) {
				Prism.highlightElement( codeBlock );
			}
		},

		initBlock: () => {
			const { trackerName } = getContext();
			const tracker = store( 'toc-tracker' );
			tracker.callbacks.initItem( trackerName );
		},
	},
} );
