<?php 

$currentPage = get_home_url() . $_SERVER["REQUEST_URI"];

?>

<div class="c-news__categories">
    <?php 
        $categories = get_categories();
        $link = get_permalink(get_option('page_for_posts'));
        $linkClass = $currentPage == $link ? "active" : "";
        ?> <a href="<?php echo get_permalink(get_option('page_for_posts')); ?>" class="<?= $linkClass ?>">All</a>  <?php
        foreach ($categories as $cat) {
            $link = get_term_link($cat);
            $linkClass = $currentPage == $link ? "active" : "";    
        ?>
            <a href="<?= $link ?>" class="<?= $linkClass ?>"><?= $cat->name ?></a>
        <?php }
    ?>
</div>