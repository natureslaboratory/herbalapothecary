<?php

$orderby = 'name';
$order = 'asc';
$hide_empty = false;
$cat_args = array(
    'orderby'    => $orderby,
    'order'      => $order,
    'hide_empty' => $hide_empty,
    "parent" => 0
);

$product_categories = get_terms('product_cat', $cat_args);

if (!empty($product_categories)) { ?>
    <div class="c-categories">
        <?php foreach ($product_categories as $category) { ?>
            <?php if ($category->name == "Uncategorized" || $category->name == "Uncategorised" || $category->name == "Products A-Z" || $category->name == "Sale") {
                continue;
            } ?>
            <div class="c-category">
                <a class="c-category__image-wrapper" href="<?= get_term_link($category) ?>"><?php woocommerce_subcategory_thumbnail($category) ?></a>
                <a class="c-category__title" href="<?= get_term_link($category) ?>">
                    <h3><?= $category->name ?></h3>
                </a>
            </div>
        <?php } ?>
    </div>
<?php } else { echo "empty"; } ?>