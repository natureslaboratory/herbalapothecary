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
        <?php

        $orderby = 'name';
        $order = 'asc';
        $hide_empty = false;
        $cat_args = array(
            'orderby'    => $orderby,
            'order'      => $order,
            'hide_empty' => $hide_empty,
        );

        $product_categories = get_terms('product_cat', $cat_args);

        if (!empty($product_categories)) { ?>
            <div class="c-categories">
                <?php foreach ($product_categories as $category) { ?>
                    <?php if ($category->name == "Uncategorized" || $category->name == "Uncategorised") {
                        continue;
                    } ?>
                    <div class="c-category">
                        <a class="c-category__image-wrapper" href="<?= get_term_link($category) ?>"><?php woocommerce_subcategory_thumbnail($category) ?></a>
                        <a href="<?= get_term_link($category) ?>">
                            <h3><?= $category->name ?></h3>
                        </a>
                    </div>
                <?php } ?>
            </div>
        <?php } ?>
        <div class="c-shop__grid">
            <div class="c-shop__sidebar">
                <div class="c-shop__sidebar-element c-shop__sidebar-categories">
                    <h4>CATEGORIES</h4>
                    <ul>
                        <?php foreach ($product_categories as $cat) { ?>
                            <?php if ($cat->name == "Uncategorized" || $cat->name == "Uncategorised") {
                                continue;
                            } ?>
                            <li>
                                <a href="<?= get_term_link($cat) ?>"><?= $cat->name ?></a>
                            </li>
                        <?php } ?>
                    </ul>
                </div>
                <form>
                    <div class="c-shop__sidebar-element">
                        <div class="c-shop__sidebar-element-section">
                            <h4>BY BRANDS</h4>
                            <input type="text" id="search">
                            <div class="c-checkbox">
                                <input type="checkbox" id="beevital" name="beevital">
                                <label for="beevital">BeeVital</label>
                            </div>
                            <div class="c-checkbox">
                                <input type="checkbox" id="beevital" name="beevital">
                                <label for="beevital">Sweet Cecily's</label>
                            </div>
                        </div>
                        <div class="c-shop__sidebar-element-section">
                            <h4>BY PRICE</h4>
                            <div class="c-price-slider">
                                <input type="range" id="price" min="0" max="450">
                                <label for="price">Price: £0 - £450</label>
                            </div>
                            <button type="submit" class="c-button">Filter</button>
                        </div>
                        <div class="c-shop__sidebar-element-section">
                            <h4>PRODUCT TAGS</h4>
                            <?php

                            $product_tags = get_terms("product_tag", [
                                "orderby" => "name",
                                "order" => "asc",
                                "hide_empty" => false
                            ]);
                            ?>
                            <ul>
                                <?php foreach ($product_tags as $tag) { ?>
                                    <li>
                                        <a href="<?= get_term_link($tag) ?>"><?= $tag->name ?></a>
                                    </li>
                                <?php } ?>
                            </ul>
                        </div>
                    </div>
                </form>
            </div>
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
                <div class="c-products c-products--shop">
                    <div class="c-products__banner">
                        <p><strong>457</strong> Products found</p>
                        <div class="c-products__filter">
                            <ul id="sort" class="c-product-filter">
                                <?php 
                                    $url = explode("?", $_SERVER["REQUEST_URI"])[0]; 
                                    if (strpos($url, "/page/")) {
                                        $url = explode("/page/", $url)[0];
                                    }
                                ?>
                                <?php echo woocommerce_catalog_ordering() ?>
                                <li><a href="<?= $url ?>">Sort by Common Name</a></li>
                                <li><a href="<?= $url ?>?orderby=latin_name">Sort by Latin Name</a></li>
                                <li><a href="<?= $url ?>?orderby=price">Sort by price: low to high</a></li>
                                <li><a href="<?= $url ?>?orderby=price-desc">Sort by price: high to low</a></li>
                            </ul>
                            <p>View</p>
                            <div class="c-products__filter-placeholder"></div>
                            <div class="c-products__filter-placeholder"></div>
                        </div>
                    </div>
                    <?php
                    $metakey = "common_name";
                    $orderby = "meta_value";
                    $order = "asc";

                    if (array_key_exists("orderby", $_GET)) {
                        switch ($_GET["orderby"]) {
                            case "latin_name":
                                $metakey = "latin_name";
                                break;
                            case "price":
                                $metakey = "_price";
                                $orderby = "meta_value_num";
                                break;
                            case "price-desc":
                                $metakey = "_price";
                                $orderby = "meta_value_num";
                                $order = "desc";
                                break;
                            default:
                                $metakey = "common_name";
                                $orderby = "meta_value";
                        }
                    }


                    $args = [
                        'post_type' => ["product"],
                        'meta_key' => $metakey,
                        'orderby' => $orderby,
                        'order' => $order,
                        'posts_per_page' => 12,
                        'paged' => get_query_var("paged")
                    ];

                    $popular_products = new WP_Query($args);

                    // print_r($popular_products->posts);

                    ?>

                    <div class="c-products__grid">
                        <?php
                        if ($popular_products->have_posts()) :
                            while ($popular_products->have_posts()) :
                                $popular_products->the_post();
                                // the_field("common_name");
                                $common_name = get_field("user_level");
                                // print_r($fields);
                                get_template_part('template-parts/product-thumbnail');
                            endwhile;
                        endif;
                        ?>
                    </div>

                    <div class="c-pagination">
                        <?php
                        echo paginate_links(array(
                            'base'         => str_replace(999999999, '%#%', esc_url(get_pagenum_link(999999999))),
                            'total'        => $popular_products->max_num_pages,
                            'format'       => '?page=%#%',
                            'show_all'     => false,
                            'type'         => 'plain',
                            'end_size'     => 2,
                            'mid_size'     => 1,
                            'prev_next'    => true,
                            'prev_text'    => sprintf('<i></i> %1$s', __('<', 'text-domain')),
                            'next_text'    => sprintf('%1$s <i></i>', __('>', 'text-domain')),
                            'add_args'     => false,
                            'add_fragment' => '',
                        ));
                        ?>
                    </div>

                    <?php
                    wp_reset_postdata();
                    ?>
                </div>
            </div>
        </div>
    </div>


</main><!-- #main -->

<?php
get_footer();
