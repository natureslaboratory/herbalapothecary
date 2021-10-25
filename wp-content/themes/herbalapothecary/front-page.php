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
        <a href="/calculator" class="c-calculator-banner" style="background-image: url(/wp-content/uploads/2021/10/AdobeStock_354372002-scaled.jpeg.webp)">
            <h2>Try our <br><strong>Herbal Product Calculator</strong></h2>
            <div>
                <p><strong>Get a price for your own formulation</strong></p>
                <p>Choose from a liquid, capsule, powder, or cut herb blend</p>
                <p>Submit your details and we'll call you back - simple!</p>
            </div>
        </a>
        <?php

        function renderCards($cardList, $customClass = "")
        { ?>
            <div class="c-cards <?= $customClass ?>">
                <?php foreach ($cardList as $c) { ?>
                    <div class="c-card">
                        <div class="c-card__image-container">
                            <img src="<?= $c["image"] ?>">
                        </div>
                        <h3><?= $c["title"] ?></h3>
                        <?= $c["description"] ?>
                        <a class="c-button" href="<?= $c["button-link"] ?>"><?= $c["button_label"] ?></a>
                    </div>
                <?php } ?>
            </div>
        <?php }
        $certCards = [
            [
                "title" => "Herb Mark",
                "description" => "<p>Herbal Apothecary are part of the BHMA's
                                            Herb Mark Scheme. This scheme is
                                            designed to ensure the quality and safety of
                                            herbal products by requiring manufacturers
                                            of herbal products to adopt a common
                                            Quality Management System. Herbal
                                            Apothecary are one of a small selection of
                                            herbal remedy manufacturers who currently
                                            meet this standard.</p>",
                "button_label" => "More about Quality",
                "button_link" => "/",
                "image" => "/assets/herbmark.svg"
            ],
            [
                "title" => "Organic Certification",
                "description" =>
                "<p>
                            Herbal Apothecary are a producer of organic
                            products and as such have been awarded
                            organic certification. Our range of organic
                            tinctures and herbs sit alongside our nonorganic
                            products.
                        </p>
                        <p>
                            We believe organic products are better for
                            growers, better for the environment and
                            ultimately better for consumers.
                        </p>
                        ",
                "button_label" => "Why Organic is Better",
                "button_link" => "/",
                "image" => "/assets/organic.svg"
            ],
            [
                "title" => "ISO 9001:2015",
                "description" =>
                "<p>
                            At Herbal Apothecary we continually assess
                            our business systems and processes as
                            part of our ISO 9001 QMS. As a result, our
                            business undergoes a process of continual
                            improvement.
                        </p>
                        <p>
                            Our systems are designed to help us
                            identify potential problems before they arise,
                            ensuring the quality of our products.
                        </p>
                        ",
                "button_label" => "Manufacturing Innovation",
                "button_link" => "/",
                "image" => "/assets/ISO.svg"
            ],
            [
                "title" => "Living Wage Employer",
                "description" =>
                "<p>
                            We pay all our staff the Living Wage. This is
                            a higher rate than the standard minimum
                            wage and reflects the actual cost of living.
                            As well as this, Herbal Apothecary provide
                            paid compassionate leave, holiday
                            allowances which increase each year and a
                            paid volunteering day to give our staff the
                            opportunity to support community initiatives
                            of their choice.
                        </p>
                        ",
                "button_label" => "About our Company",
                "button_link" => "/",
                "image" => "/assets/livingwage.svg"
            ]
        ];


        renderCards($certCards);
        ?>

        <div class="c-newsletter">
            <div>
                <h3>Sign Up for our Mailing List</h3>
                <form class="c-newsletter__signup" action="https://buttondown.email/api/emails/embed-subscribe/herbalapothecary" method="post" target="popupwindow" onsubmit="window.open('https:\//buttondown.email/herbalapothecary', 'popupwindow')" class="embeddable-buttondown-form">
                    <label for="bd-email" style="font-weight:700">Enter your email</label>
                    <input type="email" name="email" id="bd-email" />
                    <input type="hidden" value="1" name="embed" />
                    <input type="submit" value="Sign Up!" class="c-button" />
                </form>
            </div>
            <div class="c-socials__wrapper">
                <h3>Follow Us on Social Media</h3>
                <div class="c-socials">
                    <a target="_blank" href="https://www.facebook.com/herbalapothecaryuk/"><i class="fab fa-facebook-square"></i></a>
                    <a target="_blank" href="https://twitter.com/herbalapoth?lang=en"><i class="fab fa-twitter-square"></i></a>
                    <a target="_blank" href="https://www.youtube.com/channel/UCAm5dGGrJEPctkyFP7LclDA"><i class="fab fa-youtube-square"></i></a>
                    <a target="_blank" href="https://www.instagram.com/herbalapothecaryuk/"><i class="fab fa-instagram-square"></i></a>
                </div>
            </div>
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
        <?php

        $featureCards = [
            [
                "title" => "Evidence",
                "description" => "
                <p>
                At Herbal Apothecary we seek to produce natural medicines of the highest quality. We
                manufacture under ISO9001:2015 and Organic certification and according to HACCP
                and GMP principles. We are supported in our work by highly qualified scientific
                personnel.
                </p>",
                "button_label" => "More about Evidence",
                "button_link" => "/",
                "image" => "/assets/evidence.jpg"
            ],
            [
                "title" => "Access",
                "description" =>
                "<p>
                    We believe that natural medicine will have a huge part to play in the healthcare of the
                    21st Century. We are committed to ensuring the long term viability and availability of
                    herbal medicine, to ensure as many people as possible can benefit from the potentially
                    life changing treatments this tradition has to offer.
                </p>
                ",
                "button_label" => "More about Access",
                "button_link" => "/",
                "image" => "/assets/access.jpg"
            ],
            [
                "title" => "Sustainability",
                "description" =>
                "<p>
                    We believe that truly sustainable businesses must consider all aspects of their operating
                    processes and strive to create long lasting benefits for customers, employees, the
                    community and the wider environment.
                </p>
                ",
                "button_label" => "More about Sustainability",
                "button_link" => "/",
                "image" => "/assets/sustainability.jpg"
            ],
            [
                "title" => "Quality",
                "description" =>
                "<p>
                    With more than 30 years of experience, our Technical Team continues its commitment to
                    ensuring our product safety and quality systems are to the highest standards.
                    Experienced chemists, pharmacists, and herbal experts work on the analysis of the
                    goods in our modern in-house laboratory.
                </p>
                ",
                "button_label" => "More about Access",
                "button_link" => "/",
                "image" => "/assets/quality.jpg"
            ]
        ];

        renderCards($featureCards, "c-cards--wide");



        ?>

    </div>


</main><!-- #main -->

<?php
get_footer();
