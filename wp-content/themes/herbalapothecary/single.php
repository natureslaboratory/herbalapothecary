<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package herbalapothecary
 */

get_header();
?>

	<main id="primary" class="site-main site-main--shop">
		<div class="l-restrict l-restrict--narrow">
			<?php
			while ( have_posts() ) :
				the_post();

				get_template_part( 'template-parts/content', get_post_type() );

				get_template_part('template-parts/author-feature', 'author');

				the_post_navigation(
					array(
						'class' => "c-post__nav",
						'prev_text' => '<p class="c-post__nav-direction">Previous</p> <p class="c-post__nav-text">%title</p>',
						'next_text' =>  '<p class="c-post__nav-direction">Next</p> <p class="c-post__nav-text">%title</p>',
					)
				);

				// If comments are open or we have at least one comment, load up the comment template.
				if ( comments_open() || get_comments_number() ) :
					comments_template();
				endif;

			endwhile; // End of the loop.
			?>
		</div>


	</main><!-- #main -->

<?php
// get_sidebar();
get_footer();
