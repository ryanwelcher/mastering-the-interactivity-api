/**
 * External Dependencies
 */
import Prism from 'prismjs';

/**
 * WordPress Dependencies
 */
import { store, getConfig, getElement } from '@wordpress/interactivity';

const { state } = store( 'mastering-iapi', {
	state: {
		get noSnippet() {
			return state.activeSnippet === '';
		},

		get isPHPSnippet() {
			return state.lang === 'php';
		},
		get isJSSnippet() {
			return state.lang === 'js';
		},
	},
	actions: {
		updateCodeSnippet: () => {
			const el = getElement();
			const snippet = el?.attributes?.[ 'data-snippet' ];
			const lang = el?.attributes?.[ 'data-lang' ];
			const snippets = getConfig( 'mastering-iapi-code-snippets' );

			const code = snippets[ snippet ][ lang ] || '';

			const html = Prism.highlight(
				code.trim(),
				lang === 'jsx' ? Prism.languages.jsx : Prism.languages.php,
				lang === 'jsx' ? 'jsx' : 'php'
			);
			state.codeTagRef.innerHTML = html;
			state.lang = lang;
			state.activeSnippet = code;
			Prism.highlightAll();
			// clean up if the button hasn't reset.
			state.copyButtonText = 'Copy';
		},

		copyCode: async () => {
			try {
				await navigator.clipboard.writeText( state.activeSnippet );
				state.copyButtonText = 'Copied!';

				// Reset button text after 2 seconds
				setTimeout( () => {
					state.copyButtonText = 'Copy';
				}, 2000 );
			} catch ( err ) {
				console.error( 'Failed to copy code:', err );
				state.copyButtonText = 'Error';
				setTimeout( () => {
					state.copyButtonText = 'Copy';
				}, 2000 );
			}
		},
	},
	callbacks: {
		init: () => {
			Prism.manual = true;
			Prism.highlightAll();
		},
		initCodeBlock: () => {
			const { ref } = getElement();
			state.codeTagRef = ref;
		},
	},
} );
