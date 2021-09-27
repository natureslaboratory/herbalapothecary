<?php

/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package herbalapothecary
 */

?>

<div class="c-news-link">
    <?php the_post_thumbnail("large", ["class" => "c-news-link__image"]) ?>
    <div class="c-news-link__details">
        <?php $categories = get_the_category();
        if ($categories) {
            echo "<p class='c-news-link__categories'>";
            for ($i=0; $i < count($categories); $i++) { 
                $cat = $categories[$i];
                
                echo "<a href=" . get_term_link($cat) . ">" . $cat->name . "</a>";

                if (!($i == count($categories) - 1)) {
                    echo ", ";
                }
            }
            echo "</p>";
        }
        ?>
        <a href="<?php the_permalink() ?>">
            <h3 class="c-news-link__title"><?php the_title() ?></h3>
        </a>
        <?php the_excerpt() ?>
        <p class="c-news-link__info"><?php the_date() ?> by <a href="<?php $authorID = get_the_author_meta("ID"); echo get_author_posts_url($authorID); ?>"><?php the_author() ?></a></p>
    </div>
</div>