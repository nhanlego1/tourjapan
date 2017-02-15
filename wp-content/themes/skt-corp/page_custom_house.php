<?php /* Template Name: Page_house */

get_header(); ?>
<?php while ( have_posts() ) : the_post(); ?>
                    <?php get_template_part( 'content_custom_house', 'page' ); ?>
					<?php
                    $bodybgurl = esc_url( get_post_meta( get_the_ID(), 'bodybgurl', true ) );
                    if( $bodybgurl != '' ){ ?>
                        <style type="text/css">body{background:url(<?php echo $bodybgurl; ?>) no-repeat center top; background-attachment:fixed; background-size:cover;}</style>
                    <?php } ?>
                <?php endwhile; // end of the loop. ?>
        <div class="clear"></div>
<?php get_footer(); ?>