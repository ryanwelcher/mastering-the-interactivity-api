<?php

/**
 * Theme functions file, which is autoloaded by WordPress. This file is used to
 * load any other necessary PHP files and bootstrap the theme.
 *
 * @author    Your Name <yourname@some-email-service-or-another.com>
 * @copyright Copyright (c) 2024, Your Name
 * @license   https://www.gnu.org/licenses/gpl-3.0.html GPL-3.0-or-later
 * @link      https://github.com/justintadlock/tt4-dark-mode
 */

/**
 * Adds a CSS custom property to :root that controls the color-scheme
 * preference for the entire document. This allows the browser to adjust
 * default colors and form controls based on the user's preference.
 */
add_action(
	'wp_head',
	function () {
		?>
		<style>
			:root {
				color-scheme: light dark;
			}
		</style>
		<?php
	}
);
