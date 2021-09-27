<div class="c-author">
    <?php $authorID = get_the_author_meta("ID"); echo get_avatar($authorID) ?>
    <h4><?php the_author() ?></h4>
</div>