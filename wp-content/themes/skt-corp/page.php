<?php
/**
 * The template for displaying all pages.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site will use a
 * different template.
 *
 * @package SKT Corp
 */

get_header();
global $post;
$post_slug = $post->post_name;
?>


    <div class="header1"
         style="height:328px;background:url(<?php echo esc_url(home_url('/')); ?>img/bg-2.jpg);background-size: cover;">
        <div class="title-top">
            <h2><?php if ($post_slug == 'question'): ?>Q & A<?php else: ?><?php echo $post_slug; ?><?php endif; ?>
            </h2>
        </div>
    </div>
    <div style="width:100%;background: url(../bg-container.jpg);">
        <div class='container' style="">
            <div class='row'>
                <div class="col-md-7 col-xs-12 left-content">
                    <p></p>
                    <?php while (have_posts()) : the_post(); ?>
                        <?php get_template_part('content', 'page'); ?>
                        <?php
                        $bodybgurl = esc_url(get_post_meta(get_the_ID(), 'bodybgurl', true));
                        if ($bodybgurl != '') { ?>
                            <style type="text/css">body {
                                    background: url(<?php echo $bodybgurl; ?>) no-repeat center top;
                                    background-attachment: fixed;
                                    background-size: cover;
                                }</style>
                        <?php } ?>
                    <?php endwhile; // end of the loop. ?>
                    <!-- blog-post -->

                </div>
                <?php get_sidebar(); ?>
            </div>
        </div>
    </div>


<?php get_footer(); ?>