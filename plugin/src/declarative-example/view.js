import { store } from '@wordpress/interactivity';

const { state } = store( 'myInteractivePlugin', {
	state: {
		isVisible: false,
		isActive: false,
		get visibilityText() {
			return state.isVisible ? 'hide' : 'show';
		},
		get activationText() {
			return state.isActive ? 'deactivate' : 'activate';
		},
		get paragraphText() {
			return state.isActive ? 'this is active' : 'this is inactive';
		},
	},
	actions: {
		toggleVisibility() {
			state.isVisible = ! state.isVisible;
			if ( ! state.isVisible ) state.isActive = false;
		},
		toggleActivation() {
			state.isActive = ! state.isActive;
		},
	},
} );
