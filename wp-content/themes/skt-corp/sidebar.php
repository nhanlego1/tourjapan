<?php
/**
 * The Sidebar containing the main widget areas.
 *
 * @package SKT Corp
 */
?>
<div id="sidebar" class="col-md-4 right-content">
    <div class="right-content-child">
        <p class="title-head"><strong>おすすめツアー >> </strong></p>
        <?php
        $count = 0;
        $args = array(
            'category_name' => 'tourlist',
            'orderby' => 'date',
            'order' => 'DESC',
            'posts_per_page' => 3,
        );


        $wp_query = new WP_Query();
        $wp_query->query($args);
        while ($wp_query->have_posts()) {
            $wp_query->the_post();
            $count++; ?>
            <?php if ($count > 1): ?>
                <div class="hr"></div>
            <?php endif; ?>
            <div class="right-tour row">
                <div class="col-xs-4">
                    <img class="img-responsive" src="<?php the_post_thumbnail_url() ?>"/>
                    <p class="time"><em><?php print get_the_date('d.m.Y') ?></em></p>
                </div>
                <div class="col-xs-8">
                    <p>
                        <strong>
                            <a href="<?php echo get_permalink($post->ID); ?>"><?php the_title(); ?></a>
                        </strong>
                    </p>
                </div>
            </div>


        <?php } ?>
    </div>

    <div class="right-content-child margin-top-30">
        <p class="title-head"><strong>リンク >> </strong></p>
        <div>
            <a href="http://www.taberukoto.net/"> <img class="img-responsive"
                                                       src="<?php echo esc_url(home_url('/')); ?>right-list-img-4.jpg"/></a>
        </div>
        <p class="txt-right">
            訪日外国人向けグルメサイト「タベルコト」
        </p>
        <div class="margin-top-40">
            <a href="http://tabippo.net/"> <img class="img-responsive"
                                                src="<?php echo esc_url(home_url('/')); ?>right-list-img-5.jpg"/></a>
            <p class="txt-right">
                世界一周団体「TABIPPO」
            </p>
        </div>
        <div class="margin-top-40">
            <a href="http://mcha.jp/"> <img class="img-responsive"
                                            src="<?php echo esc_url(home_url('/')); ?>right-list-img-6.jpg"/></a>
            <p class="txt-right">
                訪日外国人観光客向けWebマガジン「MATCHA」
            </p>
        </div>
        <div class="margin-top-40">
            <a href="http://www.ayumu.ch/index.html"> <img class="img-responsive"
                                                           src="<?php echo esc_url(home_url('/')); ?>right-list-img-7.jpg"/></a>
            <p class="txt-right">
                自由人「高橋　歩」
            </p>
        </div>
        <div class="margin-top-40">
            <a href="http://www.minpakugyou.com/"> <img class="img-responsive"
                                                        src="<?php echo esc_url(home_url('/')); ?>right-list-img-8.jpg"/></a>
            <p class="txt-right">
                一般社団法人日本民泊業協会
            </p>
        </div>
    </div>


    <?php if (!dynamic_sidebar('sidebar-1')) : ?>
        <!--<aside id="archives" class="widget">
            <h3 class="widget-title"><?php _e('Archives', 'skt-corp'); ?></h3>
            <ul>
                <?php wp_get_archives(array('type' => 'monthly')); ?>
            </ul>
        </aside>
        <aside id="meta" class="widget">
            <h3 class="widget-title"><?php _e('Meta', 'skt-corp'); ?></h3>
            <ul>
                <?php wp_register(); ?>
                <li><?php wp_loginout(); ?></li>
                <?php wp_meta(); ?>
            </ul>
        </aside>  -->
    <?php endif; // end sidebar widget area ?>

</div><!-- sidebar -->
</div>
</div>
</div>