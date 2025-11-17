<?php
/**
 * PHP file to use when rendering the block type on the server to show on the front end.
 *
 * The following variables are exposed to the file:
 *     $attributes (array): The block attributes.
 *     $content (string): The block default content.
 *     $block (WP_Block): The block instance.
 *
 * @see https://github.com/WordPress/gutenberg/blob/trunk/docs/reference-guides/block-api/block-metadata.md#render
 */

wp_interactivity_state(
	'wp-text',
	array(
		'text' => __( 'This is the server side rendered text.' ),
	)
);

?>
<section
	<?php echo wp_kses_data( get_block_wrapper_attributes() ); ?>
	data-wp-interactive="wp-text"
	data-wp-init="toc-tracker::callbacks.initItem"
>
	<h2>Example of wp-text</h2>
	<p data-wp-text="state.text"></p>
	<label for="wp-text-example-input">
		<?php esc_html_e( 'Update Text:' ); ?>
	</label>
	<input
		id="wp-text-example-input"
		data-wp-on--input="actions.updateText"
		placeholder="<?php esc_html_e( 'Enter text...' ); ?>"
	/>
	<div>
		<hr />
		<button
			data-wp-on--click="mastering-iapi::actions.updateCodeSnippet"
			data-snippet="wp-text"
			data-lang="php"
			class="show-code-button"
		>Show render.php</button>
		<button
			data-wp-on--click="mastering-iapi::actions.updateCodeSnippet"
			data-snippet="wp-text"
			data-lang="jsx"
			class="show-code-button"
		>Show view.js</button>
	</div>
</section>
