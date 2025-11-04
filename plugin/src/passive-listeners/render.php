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
	'passive-listeners',
	array(
		'passive' => true,
		'once'    => false,
		'primes'  => 'Ready to calculate',
	)
);

$content = __( 'But down there it would be dark now, and not the lovely lighted aquarium she imagined it to be during the daylight hours, eddying with schools of tiny, delicate animals floating and dancing slowly to their own serene currents and creating the look of a living painting. That was wrong, in any case. The ocean was different from an aquarium, which was an artificial environment. The ocean was a world. And a world is not art. Dorothy thought about the living things that moved in that world: large, ruthless and hungry. Like us up here.', 'passive-listeners' );

?>

<div <?php echo wp_kses_data( get_block_wrapper_attributes() ); ?> data-wp-interactive="passive-listeners">
	<div id="scroller-containers">
		<section>
			<h3>data-wp-on</h3>
			<p class="container" data-wp-on--wheel="actions.wheelHandler">
				<?php echo esc_html( $content ); ?>
			</p>
		</section>
		<section>
			<h3>data-wp-on-async</h3>
			<p class="container" data-wp-on-async--wheel="actions.wheelHandler">
				<?php echo esc_html( $content ); ?>
			</p>
		</section>
	</div>
	<section>
		<h3>Primes Calculated</h3>
		<p data-wp-text="state.primes"></p>
	</section>
</div>
