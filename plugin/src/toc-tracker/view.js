import { store, getContext, getElement } from '@wordpress/interactivity';

const { state } = store( 'toc-tracker', {
	state: {
		get isViewed() {
			const ref = getElement();
			const ctx = getContext();

			// const item = ref.querySelector( 'h2' ).innerText;
			// console.log( ref, ctx );
			return state.viewedItems.includes( ctx.item );
		},
	},
	actions: {
		markAsViewed() {
			const context = getContext();
			const state = store( 'toc-tracker' ).state;
			if ( ! state.viewedItems.includes( context.itemId ) ) {
				state.viewedItems = [ ...state.viewedItems, context.itemId ];
			}
		},
	},
	callbacks: {
		initItem: () => {
			const { ref } = getElement();
			const item = ref.querySelector( 'h2' ).innerText;
			state.items.push( item );
		},
		trackViewed() {
			const listItems = document.querySelectorAll( 'h2' );

			const observer = new IntersectionObserver(
				( entries ) => {
					entries.forEach( ( entry ) => {
						if ( entry.isIntersecting ) {
							const itemText = entry.target.innerText;
							if ( state.items.includes( itemText ) ) {
								if (
									! state.viewedItems.includes( itemText )
								) {
									state.viewedItems.push( itemText );
								}
							}
						}
					} );
				},
				{
					threshold: 1, // Item is considered viewed when 50% visible
				}
			);

			listItems.forEach( ( item ) => observer.observe( item ) );
		},
	},
} );
