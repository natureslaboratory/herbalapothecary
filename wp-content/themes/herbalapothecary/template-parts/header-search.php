<form class="c-search <?= array_key_exists("cat", $args) ? "" : "c-search--navigation" ?>">
    <?php if (array_key_exists("cat", $args)) { ?>
        <select class="c-search__dropdown search-category" id="search-category">
            <?php
            $current_selected = "";
            if (array_key_exists("product_cat", $_GET)) {
                $current_selected = trim($_GET["product_cat"]);
                echo $current_selected . " - " . strlen($current_selected);
            }
            ?>
            <option value="" selected="<?= $current_selected ? "" : "selected" ?>">All</option>
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
            foreach ($product_categories as $key => $cat) { ?>
                <option value="<?= $cat->slug ?>" <?= $cat->slug == $current_selected ? "selected" : "" ?>><?= $cat->name ?></option>
            <?php }


            ?>
        </select>
    <?php } ?>
    <input id="search-text" class="c-search__box search-text" type="text" placeholder="I'm shopping for...">
    <button type="submit" id="search-submit" class="c-button search-submit">Search</button>
</form>