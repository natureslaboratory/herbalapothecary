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
                    <p class="c-carousel__small-heading">UK Practitioner Supplier of Herbal Medicines</p>
                    <h2 class="c-carousel__heading">Herbal Apothecary</h2>
                    <p class="c-carousel__description">
                        We supply one of the largest ranges of herbal products in the UK including tinctures, fluid extracts, capsules &amp; creams as well as whole, cut and powdered herbs.<br /><br />
                        <small>Part of Nature's Laboratory, along with <a href="https://beevitalpropolis.com">BeeVital</a> and <a href="https://sweetcecilys.com">Sweet Cecily's</a></small>
                    </p>
                    <a href="/shop/" class="c-button">Shop Now</a>
                </div>
            </div>
        </div>
        <div class="c-promises">
            <div class="c-promises__promise">
                <i class="fas fa-capsules"></i>
                <div>
                    <h2>High Quality</h2>
                    <p>Products You Can Trust</p>
                </div>
            </div>
            <div class="c-promises__promise">
                <i class="fas fa-truck"></i>
                <div>
                    <h2>Prompt Delivery</h2>
                    <p>Straight To Your Door</p>
                </div>
            </div>
            <div class="c-promises__promise">
                <i class="far fa-credit-card"></i>
                <div>
                    <h2>Secure Payment</h2>
                    <p>100% Secure via Card or PayPal</p>
                </div>
            </div>
            <div class="c-promises__promise">
                <i class="far fa-comments"></i>
                <div>
                    <h2>Helpful Support</h2>
                    <p>Get In Touch With Our Team</p>
                </div>
            </div>
        </div>
        <!-- TrustBox widget - Micro Review Count -->
		<div class="trustpilot-widget" data-locale="en-GB" data-template-id="5419b6a8b0d04a076446a9ad" data-businessunit-id="616978080bd1fb001d4d29a5" data-style-height="24px" data-style-width="100%" data-theme="light">
		  <a href="https://uk.trustpilot.com/review/herbalapothecaryuk.com" target="_blank" rel="noopener">Trustpilot</a>
		</div>
		<!-- End TrustBox widget -->
        <div class="c-specials">
            <a class="c-specials__option" href="/product-category/western-herbs/" style="background-image: url(/wp-content/themes/herbalapothecary/images/western.jpg);background-position: bottom right;background-size:contain;background-repeat:no-repeat;">
	            <div class="c-specials__container">
	                <h2>Western Herbs</h2>
	                <h3>Explore our extensive range of Western Herbs</h3>
	                <p>Including cut, whole and powdered herbs, tinctures and fluid extracts for Medical Herbalists</p>
	                <button class="c-button">Shop Now</button>
	            </div>
            </a>
            <a class="c-specials__option" href="/product-category/ayurvedic-herbs/" style="background-image: url(/wp-content/themes/herbalapothecary/images/ayuvedic.jpg);background-position: bottom right;background-size:contain;background-repeat:no-repeat;">
	            <div class="c-specials__container">
	                <h2>Ayurvedic Herbs</h2>
	                <h3>Discover our collection of Ayurvedic Herbs</h3>
	                <p>High quality dried herbs, capsules and liquids used in Ayurvedic Medicine</p>
	                <button class="c-button">Shop Now</button>
	            </div>
            </a>
        </div>
        <div class="c-specials">
            <a class="c-specials__option" href="/product-category/chinese-herbs/" style="background-image: url(/wp-content/themes/herbalapothecary/images/chinese.jpg);background-position: bottom right;background-size:contain;background-repeat:no-repeat;">
	            <div class="c-specials__container">
	                <h2>Chinese Herbs</h2>
	                <h3>A wide range of herbs for Traditional Chinese Medicine</h3>
	                <p>Herbal tinctures and extracts as well as dried herbs and capsules</p>
	                <button class="c-button">Shop Now</button>
	            </div>
            </a>
            <a class="c-specials__option" href="/product-category/herbal-capsules/" style="background-image: url(/wp-content/themes/herbalapothecary/images/capsules.jpg);background-position: bottom right;background-size:contain;background-repeat:no-repeat;">
	            <div class="c-specials__container">
	                <h2>Capsules</h2>
	                <h3>Practitioner quality herbal capsules</h3>
	                <p>Manufactured using high quality herbal powders here in the UK</p>
	                <button class="c-button">Shop Now</button>
	            </div>
            </a>
        </div>
        <div class="c-specials">
            <a class="c-specials__option" href="/product-category/beevital-apiceuticals/" style="background-image: url(/wp-content/themes/herbalapothecary/images/beevital.jpg);background-position: bottom right;background-size:contain;background-repeat:no-repeat;">
	            <div class="c-specials__container">
	                <h2>BeeVital Propolis</h2>
	                <h3>Medicines from the beehive</h3>
	                <p>Propolis liquids, capsules, tablets, oral health products &amp; more</p>
	                <button class="c-button">Shop Now</button>
	            </div>
            </a>
            <a class="c-specials__option" href="/product-category/sweet-cecilys-skincare/" style="background-image: url(/wp-content/themes/herbalapothecary/images/skincare.jpg);background-position: bottom right;background-size:contain;background-repeat:no-repeat;">
	            <div class="c-specials__container">
	                <h2>Sweet Cecily's Skincare</h2>
	                <h3>High quality hand-made skincare products</h3>
	                <p>Moisturisers, toners, face masks, lip balms and base creams</p>
	                <button class="c-button">Shop Now</button>
	            </div>
            </a>
        </div>
        
        <?php

        function renderCards($cardList, $customClass = "")
        { ?>
            <div class="c-cards <?= $customClass ?>">
                <?php foreach ($cardList as $c) { ?>
                    <div class="c-card">
                        <div class="c-card__image-container">
                            <img src="<?= $c["image"] ?>" alt="<?= $c["image_alt"] ?>" loading="lazy">
                        </div>
                        <h3><?= $c["title"] ?></h3>
                        <?= $c["description"] ?>
                        <a class="c-button" href="<?= $c["button_link"] ?>"><?= $c["button_label"] ?></a>
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
                "button_link" => "/quality",
                "image" => "/assets/herbmark.svg",
                "image_alt" => "Herbmark Logo"
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
                "button_link" => "/organic",
                "image" => "/assets/organic.svg",
                "image_alt" => "Organic Certification Logo"
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
                "button_link" => "/manufacturing",
                "image" => "/assets/ISO.svg",
                "image_alt" => "ISO Logo"
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
                "button_link" => "/about-us",
                "image" => "/assets/livingwage.svg",
                "image_alt" => "Living Wage Employer Logo"
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
                    <a aria-label="Our Facebook Page" target="_blank" rel="noreferrer" href="https://www.facebook.com/herbalapothecaryuk/"><i class="fab fa-facebook-square"></i></a>
                    <a aria-label="Our Twitter Page" target="_blank" rel="noreferrer" href="https://twitter.com/herbalapoth?lang=en"><i class="fab fa-twitter-square"></i></a>
                    <a aria-label="Our Youtube Channel" target="_blank" rel="noreferrer" href="https://www.youtube.com/channel/UCAm5dGGrJEPctkyFP7LclDA"><i class="fab fa-youtube-square"></i></a>
                    <a aria-label="Our Instagram Page" target="_blank" rel="noreferrer" href="https://www.instagram.com/herbalapothecaryuk/"><i class="fab fa-instagram-square"></i></a>
                </div>
            </div>
        </div>
        
        <a href="/herbal-access/" class="c-calculator-banner text-white text-right" style="background-image: url(/wp-content/uploads/2021/11/AdobeStock_246756561-2048x763.jpeg)">
            <h2>New! <br><strong>Herbal Access</strong></h2>
            <div>
                <p><strong>We're helping cover the cost of herbal prescriptions</strong></p>
                <p>Herbalists can claim back &pound;8 per prescription</p>
                <p>We're helping make herbal medicine accessible to all!</p>
            </div>
        </a>
        <a href="/calculator" class="c-calculator-banner" style="background-image: url(/wp-content/uploads/2021/10/AdobeStock_354372002-scaled.jpeg.webp)">
            <h2>Try our <br><strong>Herbal Product Calculator</strong></h2>
            <div>
                <p><strong>Get a price for your own formulation</strong></p>
                <p>Choose from a liquid, capsule, powder, or cut herb blend</p>
                <p>Submit your details and we'll call you back - simple!</p>
            </div>
        </a>

        <div class="c-home-categories">
            <h2>Product Categories</h2>
            <?php
            // $args = [
            //     'post_type' => ["product"],
            //     'meta_key' => 'total_sales',
            //     'orderby' => 'meta_value_num',
            //     'order' => 'desc',
            //     'posts_per_page' => 12
            // ];

            // $popular_products = new WP_Query($args);

            // if ($popular_products->have_posts()) :
            //     while ($popular_products->have_posts()) :
            //         $popular_products->the_post();
            //         get_template_part('template-parts/product-thumbnail');
            //     endwhile;
            // endif;

            // wp_reset_postdata();
            echo get_template_part("template-parts/product-categories", "categories");
            ?>
        </div>
        <?php

        $featureCards = [
            [
                "title" => "Research",
                "description" => "
                <p>
                At Herbal Apothecary we seek to produce natural medicines of the highest quality. We
                manufacture under ISO9001:2015 and Organic certification and according to HACCP
                and GMP principles. We are supported in our work by highly qualified scientific
                personnel.
                </p>",
                "button_label" => "More about Research",
                "button_link" => "/research",
                "image" => "/assets/evidence.webp",
                "image_alt" => "Scientific Equipment"
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
                "button_link" => "/access",
                "image" => "/assets/access.webp",
                "image_alt" => "Wooden gate in field"
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
                "button_link" => "/sustainability",
                "image" => "/assets/sustainability.webp",
                "image_alt" => "Plant shoot"
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
                "button_label" => "More about Quality",
                "button_link" => "/quality",
                "image" => "/assets/quality.webp",
                "image_alt" => "Scientific Equipment"
            ]
        ];

        renderCards($featureCards, "c-cards--wide");



        ?>

    </div>


</main><!-- #main -->

<?php
get_footer();
