<?php
/**
 * Template part for displaying products in product lists
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package herbalapothecary
 */

?>

<div id="post-<?php the_ID() ?>" <?php post_class("c-product") ?>>
    <div class="c-product__inner">
        <div class="c-product__image-wrapper">
            <?php 
                $image = wp_get_attachment_image_src(get_post_thumbnail_id($loop->post->ID), 'single-post-thumbnail');
            ?>
            <img class="c-product__image" src="<?= $image[0] ? $image[0] : "/wp-content/uploads/2021/09/ha_logo_no_text_-_resized.jpg.webp" ?>">
            <div class="c-product__image-overlay">Overlay</div>
        </div>
        <p class="c-product__name"><?php the_title() ?></p>
        <p class="c-product__price"><?= "£0.00" ?></p>
    </div>
    <a href="/" class="c-button">Select Options</a>
</div>
