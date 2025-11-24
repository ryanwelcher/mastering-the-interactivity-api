/**
 * External Dependencies
 */
import Prism from 'prismjs';

/**
 * WordPress Dependencies
 */
import { store, getElement, getContext } from '@wordpress/interactivity';

const { state } = store( 'wp-class', {
	state: {},
	actions: {
		toggleHelp: () => {
			state.showHelp = ! state.showHelp;
			// Handle marking as viewed in the toc-tracker store
			const { trackerName } = getContext();
			const tracker = store( 'toc-tracker' );
			if ( state.showHelp ) {
				tracker.actions.markAsViewed( trackerName );
			}
		},
		toggleSelection: () => {
			console.log( 'Toggling selection' );
			const context = getContext();
			context.isSelected = ! context.isSelected;
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
