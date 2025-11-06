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

// Adds the global state.
wp_interactivity_state(
	'declarative',
	array(
		'content' => esc_html__( 'This paragraph was added declaratively using the Interactivity API.', 'declarative' ),
	)
);
?>
<section <?php echo wp_kses_data( get_block_wrapper_attributes() ); ?> data-wp-interactive="myInteractivePlugin">
	<button
		data-wp-on--click="actions.toggleVisibility"
		data-wp-bind--aria-expanded="state.isVisible"
		data-wp-text="state.visibilityText"
		aria-controls="status-paragraph"
	>
		show
	</button>
	<button
		data-wp-on--click="actions.toggleActivation"
		data-wp-bind--disabled="!state.isVisible"
		data-wp-text="state.activationText"
	>
		activate
	</button>
	<p
		id="status-paragraph"
		data-wp-bind--hidden="!state.isVisible"
		data-wp-class--active="state.isActive"
		data-wp-class--inactive="!state.isActive"
		data-wp-text="state.paragraphText"
	>
		this is inactive
	</p>
</section>
