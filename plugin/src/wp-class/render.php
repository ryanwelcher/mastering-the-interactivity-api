<?php
/**
 * @see https://github.com/WordPress/gutenberg/blob/trunk/docs/reference-guides/block-api/block-metadata.md#render
 */

wp_interactivity_state(
	'wp-class',
	array(
		'showHelp' => false,
	)
);

$php = <<<'SNIPPET'
<section
<?php echo wp_kses_data( get_block_wrapper_attributes() ); ?>
	data-wp-interactive="wp-class"
>
	<li
		data-wp-context='{ "isSelected": false }'
		data-wp-on--click="actions.toggleSelection"
		data-wp-class--selected="context.isSelected"
	>
		Option 1
	</li>
	<li
		data-wp-context='{ "isSelected": false }'
		data-wp-on--click="actions.toggleSelection"
		data-wp-class--selected="context.isSelected"
	>
		Option 2
	</li>
</section>
SNIPPET;

$js = <<<'SNIPPET'
const { state } = store( 'wp-class', {
	state: {},
	actions: {
		toggleSelection: () => {
			const context = getContext();
			context.isSelected = ! context.isSelected;
		},
	},
	callbacks: {},
} );
SNIPPET;

?>
<section
<?php echo wp_kses_data( get_block_wrapper_attributes() ); ?>
	data-wp-interactive="wp-class"
	data-wp-router-region="directive-example"
>
	<h2>wp-class</h2>
	<ul>
		<li
			data-wp-context='{ "isSelected": false }'
			data-wp-on--click="actions.toggleSelection"
			data-wp-class--selected="context.isSelected"
		>
			Option 1
		</li>
		<li
			data-wp-context='{ "isSelected": false }'
			data-wp-on--click="actions.toggleSelection"
			data-wp-class--selected="context.isSelected"
		>
			Option 2
		</li>
	</ul>
	<hr />
	<div class="explainer-area">
		<button
			class="help-button"
			data-wp-on--click="actions.toggleHelp"
			aria-label="<?php esc_attr_e( 'Toggle code blocks' ); ?>"
			data-tracker-name="<?php echo esc_html( $tracker_name ); ?>"
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
