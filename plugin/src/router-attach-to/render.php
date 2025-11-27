<?php
/**
 * @see https://github.com/WordPress/gutenberg/blob/trunk/docs/reference-guides/block-api/block-metadata.md#render
 */

?>
<section
<?php echo wp_kses_data( get_block_wrapper_attributes() ); ?>
	data-wp-interactive="overlay"
	data-wp-router-region='{"id":"overlay", "attachTo":"body"}'
>
	<div class="router-attach-to-overlay">
		<div class="router-attach-to-backdrop"></div>
		<div class="router-attach-to-content">
			<button
				class="router-attach-to-close"
				data-wp-on--click="router-button::actions.closeOverlay"
				aria-label="Close overlay"
			>
				×
			</button>
			Overlay content attached to &lt;body&gt; using the <code>data-wp-router-region</code>s <code>attachTo</code> option.
		</div>
	</div>
</section>
