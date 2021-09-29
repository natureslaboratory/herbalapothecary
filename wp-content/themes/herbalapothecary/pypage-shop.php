<?php

/**
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package herbalapothecary
 */

get_header();
?>
<main id="primary" class="site-main site-main--shop">
    <?php
    $dummyCategories = [
        [
            "title" => "Western Herbs",
            "image" => "/wp-content/uploads/2021/09/western_herbs.jpeg",
            "link" => "/product-category/western-herbs"
        ],
        [
            "title" => "Chinese Herbs",
            "image" => "/wp-content/uploads/2021/09/chinese_herbs.jpg",
            "link" => "/product-category/chinese-herbs"
        ],
        [
            "title" => "Ayurvedic Herbs",
            "image" => "/wp-content/uploads/2021/09/ayurvedic_herbs.jpeg",
            "link" => "/product-category/ayurvedic-herbs"
        ],
        [
            "title" => "BeeVital Apiceuticals",
            "image" => "/wp-content/uploads/2021/09/propolis_capsules.jpg",
            "link" => "/product-category/beevital_apiceuticals"
        ],
        [
            "title" => "Sweet Cecily's Skincare",
            "image" => "/wp-content/uploads/2021/09/sweet_cecilys-1.jpg",
            "link" => "/product-category/sweet_cecilys_skincare"
        ],
        [
            "title" => "Packaging",
            "image" => "/wp-content/uploads/2021/09/packaging.jpg",
            "link" => "/product-category/packaging"
        ],
        [
            "title" => "Capsules",
            "image" => "/wp-content/uploads/2021/09/capsules.jpg",
            "link" => "/product-category/capsules"
        ],
        [
            "title" => "Detox",
            "image" => "/wp-content/uploads/2021/09/detox.jpg",
            "link" => "/product-category/detox"
        ]
    ];

    $dummyItems = [
        [
            "name" => "Artemisia vulgaris / Mugwort Herb",
            "price" => "£4.68",
            "image" => "/wp-content/uploads/2021/09/detox.jpg"
        ],
        [
            "name" => "Cynara scolymus / Artichoke",
            "price" => "£4.68",
            "image" => "/wp-content/uploads/2021/09/detox.jpg"
        ],
        [
            "name" => "Artemisia vulgaris / Mugwort Herb",
            "price" => "£4.68",
            "image" => "/wp-content/uploads/2021/09/detox.jpg"
        ]
    ];

    $dummyAllItems = [
        [
            "name" => "Artemisia vulgaris / Mugwort Herb",
            "price" => "£4.68",
            "image" => "/wp-content/uploads/2021/09/detox.jpg"
        ],
        [
            "name" => "Cynara scolymus / Artichoke",
            "price" => "£4.68",
            "image" => "/wp-content/uploads/2021/09/detox.jpg"
        ],
        [
            "name" => "Artemisia vulgaris / Mugwort Herb",
            "price" => "£4.68",
            "image" => "/wp-content/uploads/2021/09/detox.jpg"
        ],
        [
            "name" => "Artemisia vulgaris / Mugwort Herb",
            "price" => "£4.68",
            "image" => "/wp-content/uploads/2021/09/detox.jpg"
        ],
        [
            "name" => "Cynara scolymus / Artichoke",
            "price" => "£4.68",
            "image" => "/wp-content/uploads/2021/09/detox.jpg"
        ],
        [
            "name" => "Artemisia vulgaris / Mugwort Herb",
            "price" => "£4.68",
            "image" => "/wp-content/uploads/2021/09/detox.jpg"
        ],
        [
            "name" => "Artemisia vulgaris / Mugwort Herb",
            "price" => "£4.68",
            "image" => "/wp-content/uploads/2021/09/detox.jpg"
        ],
        [
            "name" => "Cynara scolymus / Artichoke",
            "price" => "£4.68",
            "image" => "/wp-content/uploads/2021/09/detox.jpg"
        ],
        [
            "name" => "Artemisia vulgaris / Mugwort Herb",
            "price" => "£4.68",
            "image" => "/wp-content/uploads/2021/09/detox.jpg"
        ]
    ];

    function printItems($items)
    {
        foreach ($items as $item) { ?>
            <div class="c-product">
                <div class="c-product__inner">
                    <div class="c-product__image-wrapper">
                        <img class="c-product__image" src="<?= $item["image"] ?>">
                        <div class="c-product__image-overlay">Overlay</div>
                    </div>
                    <p class="c-product__name"><?= $item["name"] ?></p>
                    <p class="c-product__price"><?= $item["price"] ?></p>
                </div>
                <a tabindex="0" href="/" class="c-button">Select Options</a>
            </div>
    <?php }
    }

    ?>
    <div class="c-shop l-restrict">
        <?php get_template_part("template-parts/product-categories", "categories"); ?>
        <div class="c-shop__grid">
            <?php get_template_part("template-parts/shop-sidebar", "sidebar", [
                "product_categories" => $product_categories
            ]) ?>
            <div class="c-shop__main">
                <div class="c-products c-products--shop">
                    <h2>Recommended Items</h2>
                    <div class="c-products__grid">
                        <?php printItems($dummyItems) ?>
                    </div>
                </div>
                <div class="c-products c-products--shop">
                    <h2>Best Seller Items</h2>
                    <div class="c-products__grid">
                        <?php printItems($dummyItems) ?>
                    </div>
                </div>
                <?php get_template_part("template-parts/products", "shop", ); ?>
            </div>
        </div>
    </div>


</main><!-- #main -->

<?php
get_footer();
