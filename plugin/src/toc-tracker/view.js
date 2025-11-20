import { store, getContext, getElement } from '@wordpress/interactivity';

const { state } = store( 'toc-tracker', {
	state: {
		get isViewed() {
			const ctx = getContext();
			return state.viewedItems.includes( ctx.item.name );
		},
	},
	actions: {
		markAsViewed( name ) {
			if ( name && ! state.viewedItems.includes( name ) ) {
				state.viewedItems.push( name );
			}
		},
	},
	callbacks: {
		initItem: ( name ) => {
			if ( name ) {
				state.items.push( {
					name,
					anchor: `#${ name.replace( /\s/g, '-' ) }`,
				} );
			}
		},
	},
} );
