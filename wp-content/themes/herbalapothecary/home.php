<?php

/**
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package herbalapothecary
 */

get_header();
?>
<main id="primary" class="site-main">
    <div class="c-home">
        <div class="c-carousel__placeholder"></div>
        <div class="c-promises">
            <div class="c-promises__promise">
                <div class="c-promises__logo--placeholder"></div>
                <div>
                    <h4>Reliable</h4>
                    <p>Products You Can Trust</p>
                </div>
            </div>
            <div class="c-promises__promise">
                <div class="c-promises__logo--placeholder"></div>
                <div>
                    <h4>Home Delivery</h4>
                    <p>Straight To Your Door</p>
                </div>
            </div>
            <div class="c-promises__promise">
                <div class="c-promises__logo--placeholder"></div>
                <div>
                    <h4>Secure Payment</h4>
                    <p>100% Secure via Card or PayPal</p>
                </div>
            </div>
            <div class="c-promises__promise">
                <div class="c-promises__logo--placeholder"></div>
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
            <div class="c-socials__facebook"></div>
            <div class="c-socials__twitter"></div>
            <div class="c-socials__youtube"></div>
            <div class="c-socials__instagram"></div>
        </div>
        <div class="c-products">
            <div class="c-products__header">
                <h3>Browse Popular Products</h3>
                <div class="c-products__categories">
                    <a>Western Herbs</a>
                    <a>Chinese Herbs</a>
                    <a>Ayurvedic Herbs</a>
                    <a>Propolis</a>
                    <a>View All</a>
                </div>
            </div>
            <div class="c-products__grid">

                <?php 
                    $products = [
                        [
                            "name" => "ICF 2 Capsules",
                            "price" => "£6.30",
                            "image" => ""
                        ],
                        [
                            "name" => "Propolis Tablets",
                            "price" => "£8.23",
                            "image" => "/wp-content/uploads/2021/09/propolis_tablets.jpg"
                        ],
                        [
                            "name" => "Propolis Toothpaste",
                            "price" => "£4.13",
                            "image" => "/wp-content/uploads/2021/09/proplis_toothpaste.jpg"
                        ],
                        [
                            "name" => "Propolis Mouthwash",
                            "price" => "£4.13",
                            "image" => "/wp-content/uploads/2021/09/propolis_mouthwash.jpg"
                        ],
                        [
                            "name" => "Propolis Capsules",
                            "price" => "£8.06",
                            "image" => "/wp-content/uploads/2021/09/propolis_capsules.jpg"
                        ],
                        [
                            "name" => "Propolis B-Gel",
                            "price" => "£4.13",
                            "image" => "/wp-content/uploads/2021/09/b_gel.jpg"
                        ],
                        [
                            "name" => "Propolis & Lemongrass Soap",
                            "price" => "£4.96",
                            "image" => "/wp-content/uploads/2021/09/propolis_soap.jpg"
                        ],
                        [
                            "name" => "Propolis Tincture",
                            "price" => "£6.66",
                            "image" => "/wp-content/uploads/2021/09/propolis_tincture.jpg"
                        ],
                        [
                            "name" => "Vegetable Glycerin Liquid",
                            "price" => "£3.29",
                            "image" => ""
                        ],
                        [
                            "name" => "Paraben Free Base Cream",
                            "price" => "£7.25",
                            "image" => ""
                        ]
                    ];
                ?>
                <?php foreach ($products as $product) { ?>
                    <div class="c-product">
                        <div class="c-product__inner">
                            <div class="c-product__image-wrapper">
                                <img class="c-product__image" src="<?= $product["image"] ? $product["image"] : "/wp-content/uploads/2021/09/ha_logo_no_text_-_resized.jpg.webp" ?>">
                                <div class="c-product__image-overlay">Overlay</div>
                            </div>
                            <p class="c-product__name"><?= $product["name"] ?></p>
                            <p class="c-product__price"><?= $product["price"] ?></p>
                        </div>
                        <a href="/" class="c-button">Select Options</a>
                    </div>
                <?php } ?>
            </div>
        </div> <!-- End .c-products -->

                <?php 
        $args = array(
        'post_type' 	=> array( 'product' ),
        'meta_key'  	=> 'total_sales',
        'orderby'   	=> 'meta_value_num',
        'order' 		=> 'desc',
        'posts_per_page'		=> 5
        );

        $popular_products = new WP_Query( $args );

        if ( $popular_products->have_posts() ) :
        while ( $popular_products->have_posts() ) : $popular_products->the_post();
            the_title();
            echo '<br/>';
        endwhile;
        endif;

        wp_reset_postdata();
        ?>
        <div class="c-brands">
            <h3 class="c-brands__title">Shop By Brand</h3>
            <div class="c-brands__grid">
                <?php 
                    $brands = [
                        [
                            "name" => "BeeVital",
                            "link" => "/",
                            "logo" => "/wp-content/uploads/2021/09/BeeVital.jpg"
                        ],
                        [
                            "name" => "Sweet Cecily's",
                            "link" => "/",
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
