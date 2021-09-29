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
                <li><a href="<?= $url ?>?orderby=latin">Sort by Latin Name</a></li>
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
            case "latin":
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

    
    
    $queryArgs = [
        'post_type' => ["product"],
        'meta_key' => $metakey,
        'orderby' => $orderby,
        'order' => $order,
        'posts_per_page' => 12,
        'paged' => get_query_var("paged")
    ];
    
    if (array_key_exists("category", $args)) { 
        // $categoryDetails = get_term_by("slug", $args["category"]);
        // $catID = $categoryDetails->term_id;
        $queryArgs["product_cat"] = $args["category"];
    }

    $popular_products = new WP_Query($queryArgs);

    

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
            'total'        => $popular_products->max_num_pages,
            'format'       => '?paged=%#%',
            'show_all'     => false,
            'type'         => 'plain',
            'end_size'     => 3,
            'mid_size'     => 1,
            'prev_next'    => true,
            'prev_text'    => sprintf('<i class="fas fa-chevron-left" ></i> %1$s', __('Previous Page', 'text-domain')),
            'next_text'    => sprintf('%1$s <i class="fas fa-chevron-right"></i>', __('Next Page', 'text-domain')),
            'add_args'     => false,
            'add_fragment' => '',
        ));
        ?>
    </div>
    <?php
    wp_reset_postdata();
    ?>
</div>