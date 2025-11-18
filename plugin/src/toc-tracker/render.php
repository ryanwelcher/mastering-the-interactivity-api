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
	'toc-tracker',
	array(
		'items'       => array(),
		'viewedItems' => array(),
	)
);
?>
<section
	<?php echo wp_kses_data( get_block_wrapper_attributes() ); ?>
	data-wp-interactive="toc-tracker"
	data-wp-watch="callbacks.trackViewed"
>
	<h3><?php esc_html_e( 'Table of Contents', 'mastering-iapi') ;?></h3>
	<ul >
		<template data-wp-each="state.items">
			<li data-wp-text="context.item" data-wp-class--viewed="state.isViewed"></li>
		</template>
	</ul>
</section>
