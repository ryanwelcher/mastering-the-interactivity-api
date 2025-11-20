<?php
/**
 * @see https://github.com/WordPress/gutenberg/blob/trunk/docs/reference-guides/block-api/block-metadata.md#render
 */

wp_interactivity_state(
	'wp-style',
	array(
		'showHelp' => false,
	)
);

$php = <<<'SNIPPET'
<section
	<?php echo wp_kses_data( get_block_wrapper_attributes() ); ?>
	data-wp-interactive="wp-style"
>
	<div data-wp-context='{ "color": "var(--wp--preset--color--contrast)" }'>
		<button data-wp-on--click="actions.toggleContextColor" class="iapi-button">
			Toggle Color Text
		</button>
		<p data-wp-style--color="context.color">Hello World!</p>
	</div>
</section
SNIPPET;

$js = <<<'SNIPPET'
const { state } = store( 'wp-style', {
	state: {},
	actions: {
		toggleContextColor: () => {
			const context = getContext();
			context.color =
				context.color === 'var(--wp--preset--color--contrast)'
					? 'var(--wp--preset--color--accent)'
					: 'var(--wp--preset--color--contrast)';
		},
	},
	callbacks: {},
} );
SNIPPET;

?>
<section
	<?php echo wp_kses_data( get_block_wrapper_attributes() ); ?>
	data-wp-interactive="wp-style"
	data-wp-init="callbacks.initBlock"
	data-wp-context='{"trackerName":"wp-style example"}'
>
	<div data-wp-context='{ "color": "var(--wp--preset--color--contrast)" }'>
		<button data-wp-on--click="actions.toggleContextColor" class="iapi-button">
			Toggle Color Text
		</button>
		<p data-wp-style--color="context.color">Hello World!</p>
	</div>
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
