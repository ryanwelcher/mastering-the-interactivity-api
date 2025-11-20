<?php
/**
 * Plugin Name:       Mastering The Interactivity API
 * Description:       Example block scaffolded with Create Block tool.
 * Version:           1.0.0
 * Requires at least: 6.7
 * Requires PHP:      7.4
 * Author:            Ryan Welcher
 * License:           GPL-2.0-or-later
 * License URI:       https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain:       mastering-api
 *
 * @package MasteringIapi
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}
/**
 * Registers the block using a `blocks-manifest.php` file, which improves the performance of block type registration.
 * Behind the scenes, it also registers all assets so they can be enqueued
 * through the block editor in the corresponding context.
 *
 * @see https://make.wordpress.org/core/2025/03/13/more-efficient-block-type-registration-in-6-8/
 * @see https://make.wordpress.org/core/2024/10/17/new-block-type-registration-apis-to-improve-performance-in-wordpress-6-7/
 */
function mastering_iapi_mastering_the_interactivity_api_block_init() {
	/**
	 * Registers the block(s) metadata from the `blocks-manifest.php` and registers the block type(s)
	 * based on the registered block metadata.
	 * Added in WordPress 6.8 to simplify the block metadata registration process added in WordPress 6.7.
	 *
	 * @see https://make.wordpress.org/core/2025/03/13/more-efficient-block-type-registration-in-6-8/
	 */
	if ( function_exists( 'wp_register_block_types_from_metadata_collection' ) ) {
		wp_register_block_types_from_metadata_collection( __DIR__ . '/build', __DIR__ . '/build/blocks-manifest.php' );
		return;
	}

	/**
	 * Registers the block(s) metadata from the `blocks-manifest.php` file.
	 * Added to WordPress 6.7 to improve the performance of block type registration.
	 *
	 * @see https://make.wordpress.org/core/2024/10/17/new-block-type-registration-apis-to-improve-performance-in-wordpress-6-7/
	 */
	if ( function_exists( 'wp_register_block_metadata_collection' ) ) {
		wp_register_block_metadata_collection( __DIR__ . '/build', __DIR__ . '/build/blocks-manifest.php' );
	}
	/**
	 * Registers the block type(s) in the `blocks-manifest.php` file.
	 *
	 * @see https://developer.wordpress.org/reference/functions/register_block_type/
	 */
	$manifest_data = require __DIR__ . '/build/blocks-manifest.php';
	foreach ( array_keys( $manifest_data ) as $block_type ) {
		register_block_type( __DIR__ . "/build/{$block_type}" );
	}
}
add_action( 'init', 'mastering_iapi_mastering_the_interactivity_api_block_init' );


add_action(
	'init',
	function () {

		$php      = <<<'HEREDOC'
			<section
			<?php echo wp_kses_data( get_block_wrapper_attributes() ); ?>
			data-wp-interactive="wp-text"
		>
			<p data-wp-text="state.text"></p>
			<label for="wp-text-example-input">
				<?php esc_html_e( 'Update Text:' ); ?>
			</label>
			<input
				id="wp-text-example-input"
				data-wp-on--input="actions.updateText"
				placeholder="<?php esc_html_e( 'Enter text...' ); ?>"
			/>
		</section>
		HEREDOC;
		$snippets = array(
			'wp-text' => array(
				'php' => $php,
				'jsx' => <<<'SNIPPET'
				import { store } from '@wordpress/interactivity';

			const { state } = store( 'wp-text', {
				state: {},
				actions: {
					updateText: ( evt ) => {
						state.text = evt.target.value;
					},
				},
				callbacks: {},
			} );
			SNIPPET,
			),
			'wp-bind' => array(
				'php' => <<<'SNIPPET'
								<section
				<?php echo wp_kses_data( get_block_wrapper_attributes() ); ?>
				data-wp-interactive="wp-bind"
				>
					<li data-wp-context='{ "isMenuOpen": false }'>
						<button
							data-wp-on--click="actions.toggleMenu"
							data-wp-bind--aria-expanded="context.isMenuOpen"
							data-wp-text="state.menuStatus"
						>
						</button>
						<div data-wp-bind--hidden="!context.isMenuOpen">
							<ul>
								<li><a href="#">Item 1</a></li>
								<li><a href="#">Item 2</a></li>
								<li><a href="#">Item 3</a></li>
							</ul>
						</div>
					</li>
					<div>
						<hr />
						<button
							data-wp-on--click="mastering-iapi::actions.updateCodeSnippet"
							data-snippet="wp-bind"
							data-lang="php"
							class="show-code-button"
						>Show render.php</button>
						<button
							data-wp-on--click="mastering-iapi::actions.updateCodeSnippet"
							data-snippet="wp-bind"
							data-lang="jsx"
							class="show-code-button"
						>Show view.js</button>
					</div>
				</section>
				SNIPPET,
				'jsx' => <<<'SNIPPET'
				import { store, getContext } from '@wordpress/interactivity';

			store( 'wp-bind', {
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
				},
				callbacks: {},
			} );
			SNIPPET,
			),
		);
		wp_interactivity_config(
			'mastering-iapi-code-snippets',
			$snippets
		);
	}
);


// Enqueue filename from a plugin
add_action(
	'wp_enqueue_scripts',
	function () {
		wp_enqueue_style(
			'prism',
			plugin_dir_url( __FILE__ ) . '/assets/prism.css',
			array(),
		);
	}
);

add_filter(
	'block_categories_all',
	function ( $categories ) {
		array_unshift(
			$categories,
			array(
				'slug'  => 'mastering-iapi-blocks',
				'title' => __( 'Mastering the Interactivity API', 'block-developer-cookbook' ),
			)
		);
		return $categories;
	},
	10
);
