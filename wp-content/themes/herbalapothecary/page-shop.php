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
	<main id="primary" class="site-main site-main--no-side-padding">
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
                    "image" => "http://localhost:4003/wp-content/uploads/2021/09/sweet_cecilys-1.jpg",
                    "link" => "/product-category/sweet_cecilys_skincare"
                ],
                [
                    "title" => "Packaging",
                    "image" => "http://localhost:4003/wp-content/uploads/2021/09/packaging.jpg",
                    "link" => "/product-category/packaging"
                ],
                [
                    "title" => "Capsules",
                    "image" => "http://localhost:4003/wp-content/uploads/2021/09/capsules.jpg",
                    "link" => "/product-category/capsules"
                ],
                [
                    "title" => "Detox",
                    "image" => "http://localhost:4003/wp-content/uploads/2021/09/detox.jpg",
                    "link" => "/product-category/detox"
                ]
            ];
        ?>
        <div class="c-shop">
            <div class="c-categories">
                <?php foreach ($dummyCategories as $cat) { ?>
                    <div class="c-category">
                        <a href="<?= $cat["link"] ?>"><img src="<?= $cat["image"] ?>" alt="<?= $cat["title"] ?>"></a>
                        <a href="<?= $cat["link"] ?>"><h3><?= $cat["title"] ?></h3></a>
                    </div>
                <?php } ?>
            </div>
        </div>
		

	</main><!-- #main -->

<?php
get_footer();
