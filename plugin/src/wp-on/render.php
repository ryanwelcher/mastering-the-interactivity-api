<?php
/**
 * @see https://github.com/WordPress/gutenberg/blob/trunk/docs/reference-guides/block-api/block-metadata.md#render
 */

wp_interactivity_state(
	'wp-on',
	array(
		'showHelp'  => false,
		'lastClick' => __( 'Last Clicked: Never' ),
	)
);

$php = <<<'SNIPPET'
wp_interactivity_state(
	'wp-on',
	array(
		'lastClick' => __( 'Last Clicked: Never' ),
	)
);
?>
<section
	<?php echo wp_kses_data( get_block_wrapper_attributes() ); ?>
	data-wp-interactive="wp-on"
>
	<button data-wp-on--click="actions.logTime" class="iapi-button">Click Me!</button>
	<p data-wp-text="state.lastClick"></p>
</section>
SNIPPET;

$js = <<<'SNIPPET'
const { state } = store( 'wp-on', {
	state: {},
	actions: {
		logTime: ( event ) => {
			state.lastClick = `Last Clicked: ${ new Date().toLocaleTimeString() }`;
		},
	},
	callbacks: {},
} );
SNIPPET;

?>
<section
<?php echo wp_kses_data( get_block_wrapper_attributes() ); ?>
	data-wp-interactive="wp-on"
	data-wp-router-region="directive-example"
>
	<h2>wp-on</h2>
	<button data-wp-on--click="actions.logTime" class="iapi-button">Click Me!</button>
	<p data-wp-text="state.lastClick"></p>
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
