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

$state = array(
	'copyButtonText' => 'Copy',
	'activeSnippet'  => '',
);
wp_interactivity_state( 'mastering-iapi', $state );

$config = wp_interactivity_config( 'mastering-iapi-code-snippets' );
?>
<div
	<?php echo wp_kses_data( get_block_wrapper_attributes( [ 'class' => 'code-block-wrapper' ] ) ); ?>
	data-wp-interactive="mastering-iapi"
	data-wp-init="callbacks.init"
>
	<button
		class="copy-button"
		data-wp-on--click="actions.copyCode"
		data-wp-text="state.copyButtonText"
		data-wp-bind--hidden="state.noSnippet"

	></button>
	<pre class="language-php" data-wp-bind--hidden="state.noSnippet"><code
			data-wp-init="callbacks.initCodeBlock"
			data-wp-text="state.activeSnippet"
			class="language-php"
			data-wp-bind--hidden="state.noSnippet"
			></code></pre>
</div>


<ul data-wp-context='{ "fruits": ["Apple", "Banana", "Cherry"] }'>
    ...
</ul>

<?php

$context = array( 'fruits' => array( 'Apple', 'Banana', 'Cherry' ) );
?>
<ul <?php echo wp_interactivity_data_wp_context( $context ); ?>>
  ...
</ul>
