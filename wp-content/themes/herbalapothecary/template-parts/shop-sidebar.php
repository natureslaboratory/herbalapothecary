<?php

$product_categories = [];
if (array_key_exists("product_categories", $args)) {
    $product_categories = $args["product_categories"];
} else {
    $orderby = 'name';
    $order = 'asc';
    $hide_empty = false;
    $cat_args = array(
        'orderby'    => $orderby,
        'order'      => $order,
        'hide_empty' => $hide_empty,
    );

    $product_categories = get_terms('product_cat', $cat_args);
}



?>

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