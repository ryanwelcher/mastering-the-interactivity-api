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
		'text'     => __( 'Using the wp-text to set the text.' ),
		'showHelp' => false,
	)
);


$php = <<<'SNIPPET'
<?php
wp_interactivity_state(
	'wp-text',
	array(
		'text' => __( 'Using the wp-text to set the text.' ),
	)
);

?>
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
SNIPPET;

$js = <<<'SNIPPET'
const { state } = store( 'wp-text', {
	state: {},
	actions: {
		updateText: ( evt ) => {
			state.text = evt.target.value;
		},
	},
} );
SNIPPET;
?>
<section
	<?php echo wp_kses_data( get_block_wrapper_attributes() ); ?>
	data-wp-interactive="wp-text"
	data-wp-router-region="directive-example"
>
	<h2>wp-text</h2>
	<p data-wp-text="state.text"></p>
	<label for="wp-text-example-input">
		<?php esc_html_e( 'Update Text:' ); ?>
	</label>
	<input
		id="wp-text-example-input"
		data-wp-on--input="actions.updateText"
		placeholder="<?php esc_html_e( 'Enter text...' ); ?>"
	/>
	<hr />
	<div class="explainer-area">
		<button
			class="help-button"
			data-wp-on--click="actions.toggleHelp"
			aria-label="<?php esc_attr_e( 'Toggle code blocks' ); ?>"
		>
			<span class="help-icon">?</span>
			<span class="help-label"><?php esc_html_e( 'Toggle code' ); ?></span>
		</button>
	</div>
	<div>
		<p data-wp-class--is-visible="state.showHelp" data-wp-bind--hidden="!state.showHelp" class="file-header">render.php</p>
		<div
			class="help-text"
			data-wp-class--is-visible="state.showHelp"
			data-wp-bind--hidden="!state.showHelp"
			data-wp-init="callbacks.initCodeBlock"
		>
			<pre class="language-php"><code><?php echo esc_html( $php ); ?></code></pre>
		</div>
	</div>
	<div>
		<p data-wp-class--is-visible="state.showHelp" data-wp-bind--hidden="!state.showHelp" class="file-header">view.js</p>
		<div
			class="help-text"
			data-wp-class--is-visible="state.showHelp"
			data-wp-bind--hidden="!state.showHelp"
			data-wp-init="callbacks.initCodeBlock"
		>
			<pre class="language-jsx"><code><?php echo esc_html( $js ); ?></code></pre>
		</div>
	</div>
</section>
