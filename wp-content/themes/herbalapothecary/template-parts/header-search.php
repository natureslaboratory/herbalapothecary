<form class="c-search <?= array_key_exists("cat", $args) ? "" : "c-search--navigation" ?>">
    <?php if (array_key_exists("cat", $args)) { ?>
<!--
        <select class="c-search__dropdown search-category">
            <option value="" selected="selected">All</option>
            <option value="ayurvedic-herbs">Ayurvedic Herbs</option>
            <option value="beevital-apiceuticals">BeeVital Apiceuticals</option>
            <option value="herbal-capsules">Capsules</option>
            <option value="carrier-oils-waters">Carrier Oils &amp; Waters</option>
            <option value="chinese-herbs">Chinese Herbs</option>
            <option value="creams-base-products">Creams &amp; Base Products</option>
            <option value="detox">Detox</option>
            <option value="essential-oils">Essential Oils</option>
            <option value="gums-waxes">Gums &amp; Waxes</option>
            <option value="packaging">Packaging</option>
            <option value="herbal-products">Products A-Z</option>
            <option value="sale">Sale</option>
            <option value="sweet-cecilys-skincare">Sweet Cecily's Skincare</option>
            <option value="uncategorised">Uncategorised</option>
            <option value="western-herbs">Western Herbs</option>
        </select>
-->
    <?php } ?>
    <input class="c-search__box search-text" type="text" placeholder="I'm shopping for...">
    <button type="submit" class="c-button search-submit">Search</button>
</form>