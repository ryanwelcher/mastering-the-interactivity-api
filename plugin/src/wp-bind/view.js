import { store, getContext } from '@wordpress/interactivity';
const { state } = store( 'wp-bind', {
	state: {
		get menuStatus() {
			const context = getContext();
			return context.isMenuOpen ? 'Menu is open' : 'Menu is closed';
		},
	},
	actions: {
		toggleMenu: () => {
			const context = getContext();
			context.isMenuOpen = ! context.isMenuOpen;
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
		initBlock: () => {
			const { trackerName } = getContext();
			const tracker = store( 'toc-tracker' );
			tracker.callbacks.initItem( trackerName );
		},
	},
} );
