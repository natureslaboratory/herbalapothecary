<?php
/**
 * Template part for displaying products in product lists
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package herbalapothecary
 */

?>

<?php 
    $product = wc_get_product(get_the_ID());
    if ($product) { ?>
        <div id="post-<?php the_ID() ?>" <?php post_class("c-product") ?>>
            <div class="c-product__inner">
                <div class="c-product__image-wrapper">
                    <?= $product->get_image("woocommerce_thumbnail", ["class" => "c-product__image"]) ?>
                    <div class="c-product__image-overlay">Overlay</div>
                </div>
                <p class="c-product__name"><?php the_title() ?></p>
                <p class="c-product__price"><?= wc_price($product->get_price()) ?></p>
            </div>
            <a href="<?= $product->get_permalink() ?>" class="c-button">Select Options</a>
        </div>
    <?php }
?>

