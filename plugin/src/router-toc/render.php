<?php
/**
 * @see https://github.com/WordPress/gutenberg/blob/trunk/docs/reference-guides/block-api/block-metadata.md#render
 */

// A WP Query example that retrieves posts with the category 'directives'.
$query = new WP_Query(
	array(
		'category_name'  => 'directives',
		'posts_per_page' => 5,
	)
);
$posts = array(
	array(
		'id'    => 0,
		'title' => __( 'Select a post', 'mastering-iapi' ),
		'url'   => 'http://localhost:8888/directive-examples/',
	),
);

if ( $query->have_posts() ) {
	foreach ( $query->posts as $post ) {
		$posts[] = array(
			'id'    => $post->ID,
			'title' => $post->post_title,
			'url'   => get_the_permalink( $post->ID ),
		);
	}
}

wp_interactivity_state(
	'router-toc',
	array(
		'showHelp' => false,
		'posts'    => $posts,
	)
);

?>
<section
<?php echo wp_kses_data( get_block_wrapper_attributes() ); ?>
	data-wp-interactive="router-toc"
>
	<h3><?php esc_html_e( 'Table of Contents', 'mastering-iapi' ); ?></h3>
	<ul>
		<template data-wp-each="state.posts">
			<li data-wp-key="context.item.id">
				<a
					data-wp-bind--href="context.item.url"
					data-wp-text="context.item.title"
					data-wp-on--click="actions.navigate"
					>
				</a>
			</li>
		</template>
	</ul>
</section>
