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
		},
	},
	callbacks: {
		initBlock: () => {
			const { trackerName } = getContext();
			const tracker = store( 'toc-tracker' );
			if ( tracker ) {
				tracker?.callbacks.initItem( trackerName );
			}
		},
	},
} );
