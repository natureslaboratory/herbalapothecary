<?php

/**
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package herbalapothecary
 */

get_header();
?>
<main id="primary" class="site-main site-main--home">
    <div class="c-home">
        <div class="c-carousel">
            <div class="c-carousel__overlay">
                <div class="c-carousel__content">
                    <p class="c-carousel__small-heading">UK Supplier of Herbal Products</p>
                    <h2 class="c-carousel__heading">Herbal Apothecary</h2>
                    <p class="c-carousel__description">
                        We supply one of the largest ranges of herbal products in the UK
                    </p>
                    <a href="/about-us/"><button class="c-button">Find Out More</button></a>
                </div>
            </div>
        </div>
        <div class="c-promises">
            <div class="c-promises__promise">
                <i class="fas fa-capsules"></i>
                <div>
                    <h4>Reliable</h4>
                    <p>Products You Can Trust</p>
                </div>
            </div>
            <div class="c-promises__promise">
                <i class="fas fa-truck"></i>
                <div>
                    <h4>Home Delivery</h4>
                    <p>Straight To Your Door</p>
                </div>
            </div>
            <div class="c-promises__promise">
                <i class="far fa-credit-card"></i>
                <div>
                    <h4>Secure Payment</h4>
                    <p>100% Secure via Card or PayPal</p>
                </div>
            </div>
            <div class="c-promises__promise">
                <i class="far fa-comments"></i>
                <div>
                    <h4>Support</h4>
                    <p>Get In Touch With Our Team</p>
                </div>
            </div>
        </div>
        <div class="c-specials">
            <a class="c-specials__option" style="background-image: url(/wp-content/uploads/2021/09/Oral_Health_Range_2-scaled.jpg.webp)">
                <h3>BeeVital Propolis</h3>
                <h4>Discover our range of propolis products</h4>
                <p>Including tinctures. liquids, tablets and oral health products</p>
                <button class="c-button">Shop Now</button>
            </a>
            <a class="c-specials__option" style="background-image: url(/wp-content/uploads/2021/09/herb-2.jpg.webp)">
                <h3>Explore Our Range of Herbs</h3>
                <h4>Including Western, Chinese, and Ayurvedic</h4>
                <p>Cut, whole, powdered, tinctures and fluid extracts</p>
                <button class="c-button">Shop Now</button>
            </a>
        </div>
        <div class="c-socials">
            <a target="_blank" href="https://www.facebook.com/herbalapothecaryuk/"><i class="fab fa-facebook-square"></i></a>
            <a target="_blank" href="https://twitter.com/herbalapoth?lang=en"><i class="fab fa-twitter-square"></i></a>
            <a target="_blank" href="https://www.youtube.com/channel/UCAm5dGGrJEPctkyFP7LclDA"><i class="fab fa-youtube-square"></i></a>
            <a target="_blank" href="https://www.instagram.com/herbalapothecaryuk/"><i class="fab fa-instagram-square"></i></a>
        </div>
        <div class="c-products">
            <div class="c-products__header">
                <h3>Browse Popular Products</h3>
                <div class="c-products__categories">
                    <?php 
                        $orderby = 'count';
                        $order = 'desc';
                        $hide_empty = false;
                        $cat_args = array(
                            'orderby'    => $orderby,
                            'order'      => $order,
                            'hide_empty' => $hide_empty,
                            'number' => 4
                        );

                        $cats = get_terms('product_cat', $cat_args);

                        foreach ($cats as $key => $cat) { ?>
                            <a href="/product-category/<?= $cat->slug ?>"><?= $cat->name ?></a>
                        <?php }
                    
                    
                    ?>
                    <!-- <a>Western Herbs</a>
                    <a>Chinese Herbs</a>
                    <a>Ayurvedic Herbs</a>
                    <a>Propolis</a> -->
                    <a href="/shop">View All</a>
                </div>
            </div>
            <div class="c-products__grid">
            <?php 
            $args = [
                'post_type' => ["product"],
                'meta_key' => 'total_sales',
                'orderby' => 'meta_value_num',
                'order' => 'desc',
                'posts_per_page' => 12
            ];

            $popular_products = new WP_Query($args);

            if ($popular_products->have_posts()) :
                while ($popular_products->have_posts()) : 
                    $popular_products->the_post();
                    get_template_part('template-parts/product-thumbnail');
                endwhile;
            endif;

            wp_reset_postdata();
            ?>
            </div>
        </div>
        <div class="c-brands">
            <h3 class="c-brands__title">Shop By Brand</h3>
            <div class="c-brands__grid">
                <?php 
                    $brands = [
                        [
                            "name" => "BeeVital",
                            "link" => "https://dev.herbalapothecaryuk.com/product-category/beevital-apiceuticals/",
                            "logo" => "/wp-content/uploads/2021/09/BeeVital.jpg"
                        ],
                        [
                            "name" => "Sweet Cecily's",
                            "link" => "https://dev.herbalapothecaryuk.com/product-category/sweet-cecilys-skincare/",
                            "logo" => "/wp-content/uploads/2021/09/sweet_cecilys.jpg"
                        ]
                    ]
                ?>
                <?php foreach ($brands as $brand) { ?>
                    <div class="c-brand">
                        <a href="<?= $brand["link"] ?>">
                            <img src="<?= $brand["logo"] ?>" alt="<?= $brand["name"] ?>">
                        </a>
                    </div>
                <?php } ?>
            </div>
        </div>
        <div class="c-intro">
            <h2>Herbal Apothecary Ethos</h2>
            <p>Herbal Apothecary has always maintained a strong emphasis on our three core values.</p>
            <p>
                Firstly, we want our products must be supported by strong scientific evidence. 
                To that end, we have strong links with external research bodies. 
                We also have a growing in-house research team. They are responsible for testing 
                as well as formulating new products.
            </p>
            <p>
                Secondly, our business is sustainable. This is not just about environmental 
                sustainability. We know how important it is to develop strong and sustainable 
                relationships. Sustainability is also impacts our financial decisions. These three 
                combined ensure the long-term sustainability of our company.
            </p>
            <p>
                Thirdly, Herbal Apothecary is committed to ensurring access to herbal practitioners 
                and products. We produce products which allow practitioners to deliver the services 
                their patients need. We want to ensure herbal medicine is available to all.
            </p>
            <div class="c-intro__columns">
                <div class="c-intro__columns-left">
                    <h2>Evidence</h2>
                    <p>
                        Reuniting Science and Nature through rigorous targeted research. 
                        <a href="/">Find out more</a>.
                    </p>
                    <h2>Sustainability</h2>
                    <p>
                        Creating ecologically sustainable products and processes. 
                        <a href="/">Find out more</a>.
                    </p>
                    <h2>Access</h2>
                    <p>
                        Creating connections between practitioners and consumers, through 
                        products and services.
                        <a href="/">Find out more</a>.
                    </p>
                </div>
                <div class="c-intro__columns-right">
                    <h2>Contract Manufacturing of Herbal Products</h2>
                    <p>
                        We offer the <strong>complete manufacture of natural products</strong>. Methods 
                        developed for our own specialist products are now available to you.
                    </p>
                    <p>
                        With custom manufacturing we can develop <strong>high quality products</strong> that meet your 
                        unique specifications.
                    </p>
                    <p>
                        For more details about custom orders, please contact our sales team.
                    </p>
                </div>
            </div>
        </div>
        <div class="c-newsletter">
            <div>
                <h2>Sign up to our Newsletter</h2>
                <p>for the latest product and research news from Herbal Apothecary</p>
                <form class="c-newsletter__signup">
                    <label for="email">Enter your email</label>
                    <input type="email" id="email">
                    <button type="submit" class="c-button">Subscribe</button>
                </form>
            </div>
            <img src="/wp-content/uploads/2021/09/ha_logo_no_text_-_resized.jpg.webp" alt="Herbal Apothecary">
        </div>
    </div>


</main><!-- #main -->

<?php
get_footer();
