/**
 * Imperative Example Block View Script.
 */
import wpDomReady from '@wordpress/dom-ready';
import { __ } from '@wordpress/i18n';

// When the DOM is ready, execute the following code
wpDomReady( () => {
	const showHideBtn = document.getElementById( 'show-hide-btn' );
	const activateBtn = document.getElementById( 'activate-btn' );
	const statusParagraph = document.getElementById( 'status-paragraph' );

	showHideBtn.addEventListener( 'click', () => {
		if ( statusParagraph.hasAttribute( 'hidden' ) ) {
			statusParagraph.removeAttribute( 'hidden' );
			showHideBtn.textContent = 'hide';
			showHideBtn.setAttribute( 'aria-expanded', 'true' );
			activateBtn.removeAttribute( 'disabled' );
		} else {
			if ( statusParagraph.classList.contains( 'active' ) ) {
				statusParagraph.textContent = 'this is inactive';
				statusParagraph.classList.remove( 'active' );
				activateBtn.textContent = 'activate';
			}
			statusParagraph.setAttribute( 'hidden', true );
			showHideBtn.textContent = 'show';
			showHideBtn.setAttribute( 'aria-expanded', 'false' );
			activateBtn.setAttribute( 'disabled', true );
		}
	} );

	activateBtn.addEventListener( 'click', () => {
		if ( activateBtn.textContent === 'activate' ) {
			statusParagraph.textContent = 'this is active';
			statusParagraph.classList.remove( 'inactive' );
			statusParagraph.classList.add( 'active' );
			activateBtn.textContent = 'deactivate';
		} else {
			statusParagraph.textContent = 'this is inactive';
			statusParagraph.classList.remove( 'active' );
			statusParagraph.classList.add( 'inactive' );
			activateBtn.textContent = 'activate';
		}
	} );
} );
