<?php
/**
 * Template Name: COA
 *
 * The template file for displaying full width.
 *
 * @package Martfury
 */

get_header(); ?>

<main class="site-main site-main--shop">
    <div class="l-restrict l-restrict--narrow">
        <?php
        if ( have_posts() ) :
            while ( have_posts() ) : the_post();
                echo "<div class='c-coa'>";
                the_title("<h2>", "</h2>");
                the_content();
                echo '<div class="row">
                        <div class="col-md-12 col-md-12 col-md-12 text-center">
                            <form id="form">
                                <label style="font-weight:700">Batch Number</label><br /><br />
                                <input type="text" id="batch" style="text-align:center;" value="'; echo $_GET['batch']; echo '" /><br /><br />
                                <input type="submit" value="Search COA Database" id="submit" class="wpcf7-form-control wpcf7-submit" />
                            </form>
                        </div>
                    </div>
                    <span id="spec" style="width:100%;float:left;text-align:center;background:#f1f1f1;margin-top:30px;"></span>
                    <script>
                        jQuery("#form").submit(function(event){
                            event.preventDefault();
                            jQuery("#spec").html("");
                            var batch = jQuery("#batch").val();
                            jQuery.post("https://natureslaboratory.co.uk/herbal-apothecary/coa-exists/?batch="+batch, function( data ) {
                            if(data==1){
                                jQuery("#spec").html("<p style=\'margin-bottom:0px;text-align:center;\'><strong><a style=\'padding:10px;float:left;display:block;text-align:center;width:100%;\' href=\'https://natureslaboratory.co.uk/herbal-apothecary/get-coa/?batch="+batch+"\'>Click Here to download the Nature\'s Laboratory COA file (PDF)</a></strong></p>");
                            }else{
                                jQuery("#spec").html("<p style=\'margin-bottom:0px;padding:10px;\'><strong>Sorry, no COA available online for this batch - please call us on 01947 602346 to request one</strong></p>");
                            }
                            });
                        });
                    </script>';
                echo "</div>";
            endwhile;
        endif;
        ?>
    </div>
</main>
<?php get_footer(); ?>

