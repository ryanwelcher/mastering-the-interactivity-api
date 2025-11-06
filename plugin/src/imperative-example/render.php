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

?>
<section <?php echo wp_kses_data( get_block_wrapper_attributes() ); ?>>
	<button
		id="show-hide-btn"
		aria-expanded="false"
		aria-controls="status-paragraph"
	>show
	</button>
	<button id="activate-btn" disabled>activate</button>
	<p id="status-paragraph" class="inactive" hidden>this is inactive</p>
</section>
