<?php
/**
 * @see https://github.com/WordPress/gutenberg/blob/trunk/docs/reference-guides/block-api/block-metadata.md#render
 */

wp_interactivity_state(
	'wp-bind',
	array(
		'showHelp' => false,
	)
);

$php = <<<'SNIPPET'
<section
<?php echo wp_kses_data( get_block_wrapper_attributes() ); ?>
	data-wp-interactive="wp-bind"
>
	<li data-wp-context='{ "isMenuOpen": false }'>
		<button
			data-wp-on--click="actions.toggleMenu"
			data-wp-bind--aria-expanded="context.isMenuOpen"
			data-wp-text="state.menuStatus"
		>
		</button>
		<div data-wp-bind--hidden="!context.isMenuOpen">
			<ul>
				<li><a href="#">Item 1</a></li>
				<li><a href="#">Item 2</a></li>
				<li><a href="#">Item 3</a></li>
			</ul>
		</div>
	</li>
</section>
SNIPPET;

$js = <<<'SNIPPET'
const { state } = store( 'wp-bind', {
	state: {
		get menuStatus() {
			const context = getContext();
			return context.isMenuOpen ? 'Menu is open' : 'Menu is closed';
		},
	},
	actions: {
		toggleMenu: () => {
			const context = getContext();
			context.isMenuOpen = ! context.isMenuOpen;
		},
	},
	callbacks: {},
} );
SNIPPET;

?>
<section
<?php echo wp_kses_data( get_block_wrapper_attributes() ); ?>
	data-wp-interactive="wp-bind"
	data-wp-router-region="directive-example"
>
	<h2>wp-bind</h2>
	<li data-wp-context='{ "isMenuOpen": false }'>
		<button
			data-wp-on--click="actions.toggleMenu"
			data-wp-bind--aria-expanded="context.isMenuOpen"
			data-wp-text="state.menuStatus"
			class="iapi-button"
		>
		</button>
		<div data-wp-bind--hidden="!context.isMenuOpen">
			<ul>
				<li><a href="#">Item 1</a></li>
				<li><a href="#">Item 2</a></li>
				<li><a href="#">Item 3</a></li>
			</ul>
		</div>
	</li>
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
