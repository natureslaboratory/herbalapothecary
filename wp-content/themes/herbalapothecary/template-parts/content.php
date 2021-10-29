<?php

/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package herbalapothecary
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class("c-post"); ?>>
	<header class="entry-header c-post__header">
		<?php
		if (is_singular()) :
			the_title('<h1 class="entry-title ' . is_cart() ? "c-cart__title" : "" . '">', '</h1>');
		else :
			the_title('<h1 class="entry-title"><a href="' . esc_url(get_permalink()) . '" rel="bookmark">', '</a></h1>');
		endif;
		

		if ('post' === get_post_type()) :
		?>
			<div class="entry-meta c-post__details">
				<strong><?php the_date() ?></strong> by
				<a href="<?php $authorID = get_the_author_meta("ID");
							echo get_author_posts_url($authorID); ?>"><?php the_author() ?></a> in
				<?php $categories = get_the_category();
				if ($categories) {
					for ($i = 0; $i < count($categories); $i++) {
						$cat = $categories[$i];

						echo "<a href=" . get_term_link($cat) . ">" . $cat->name . "</a>";

						if (!($i == count($categories) - 1)) {
							echo ", ";
						}
					}
				}
				?>
			</div><!-- .entry-meta -->
		<?php endif; ?>
	</header><!-- .entry-header -->

	<?php herbalapothecary_post_thumbnail(); ?>

	<div class="entry-content c-post__content">
		<?php
		the_content(
			sprintf(
				wp_kses(
					/* translators: %s: Name of current post. Only visible to screen readers */
					__('Continue reading<span class="screen-reader-text"> "%s"</span>', 'herbalapothecary'),
					array(
						'span' => array(
							'class' => array(),
						),
					)
				),
				wp_kses_post(get_the_title())
			)
		);

		wp_link_pages(
			array(
				'before' => '<div class="page-links">' . esc_html__('Pages:', 'herbalapothecary'),
				'after'  => '</div>',
			)
		);
		?>
	</div><!-- .entry-content -->

	<footer class="entry-footer">
		<?php herbalapothecary_entry_footer(); ?>
	</footer><!-- .entry-footer -->
</article><!-- #post-<?php the_ID(); ?> -->