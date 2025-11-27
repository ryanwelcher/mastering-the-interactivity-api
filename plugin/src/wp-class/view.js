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
	},
} );
