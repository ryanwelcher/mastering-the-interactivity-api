<?php
/**
 * @see https://github.com/WordPress/gutenberg/blob/trunk/docs/reference-guides/block-api/block-metadata.md#render
 */

?>
<section
<?php echo wp_kses_data( get_block_wrapper_attributes() ); ?>
	data-wp-interactive="router-button"
>
	<a href="http://localhost:8888/router-examples/" data-wp-on--click="actions.openRouterOverlay">Show overlay message</a>
</section>
