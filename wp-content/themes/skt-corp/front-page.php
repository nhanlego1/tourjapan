<?php
/**
 * The template for displaying home page.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site will use a
 * different template.
 *
 * @package SKT Corp
 */

get_header();

?>
<section id="aboutUs">
    <div class="container">
        <div class="row">

            <!-- Start about us area -->
            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 tab_left">
                <div class="aboutus_area wow fadeInLeft animated"
                     style="visibility: visible; animation-name: fadeInLeft;">
                    <h2 class="titile">JAPAN TRAVEL GUIDE.navi！？</h2>
                    <p class="bg_red">ジャパントラベルガイド.naviは、日本を訪れる訪日外国人（ゲスト）とあなたの”ふるさと”や”街”を案内する通訳ガイド（ホスト）のマッチング・ポータルサイトです。
                        <b>「地元の人しか知らないおいしいラーメン屋さんに連れてって！」
                            「1日予定が空いたので、ぶらりと街を案内して欲しい！」
                            「田舎に行って、人とのふれあいを感じられる体験や交流がしたい！」
                            「ガイドブックには載っていない、日本の穴場スポットを紹介して！」 </b>
                        などなど、そんな外国人の皆様のためのサイトです。ホストは友人感覚で日本の旅のお手伝いをいたします。
                        また、旅行代理店や各地方自治体と提携し”日本らしい！日本でしか体験することのできない♪”体験ツアーや各種アクティビティの紹介も行います。
                        その他、せっかく日本に来てみたものの「宿泊先がない！！」なんていう外国人の皆様に対し、宿泊先（ゲストハウス）のご紹介もしています。現在、日本では宿泊先が不足しています。特に”東京・大阪・名古屋”などの首都圏での宿泊先不足は深刻です。ジャパントラベルガイド.naviはホテルや旅館に代わる宿泊先の情報も提供いたします。
                        魅力あふれる日本の旅を是非お楽しみ下さい！！</p>

                </div>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 tab_right">
                <div class="newsfeed_area wow fadeInRight animated"
                     style="visibility: visible; animation-name: fadeInRight;">
                    <ul id="myTab2" class="nav nav-tabs feed_tabs">
                        <li class="active"><a href="#notice" data-toggle="tab">Blog</a></li>
                        <li class=""><a href="#news" data-toggle="tab">News</a></li>
                        <li class=""><a href="#events" data-toggle="tab">Events</a></li>
                    </ul>
                    <div class="tab-content bg_red_tab">

                        <!-- Start notice tab content -->
                        <div id="notice" class="tab-pane fade fade active in">
                            <ul class="news_tab">
                                <?php
                                $args = array(
                                    'category_name' => 'achive',
                                    'post_status' => 'publish',
                                    'orderby' => 'date',
                                    'order' => 'DESC',
                                    'posts_per_page' => 3,
                                );


                                $wp_query = new WP_Query();
                                $wp_query->query($args);
                                while ($wp_query->have_posts()):
                                    $wp_query->the_post();
                                    ?>
                                    <li>
                                        <div class="media">
                                            <div class="media-left"><a class="news_img"
                                                                       href="<?php the_permalink(); ?>"><?php the_post_thumbnail('thumbnail', array('class' => 'media-object')); ?></a>
                                            </div>
                                            <div class="media-body">

                                                <a tabindex="0"
                                                   href="<?php the_permalink(); ?>"><b><?php the_title(); ?></b></a>
                                                <p class="food_des"><?php the_excerpt(); ?></p>

                                            </div>
                                        </div>
                                    </li>

                                    <?php
                                endwhile; // end of the loop.
                                wp_reset_postdata();
                                ?>
                            </ul>
                            <a class="see_all" href="<?php echo esc_url(home_url('/')); ?>/category/achive/">See All</a>
                        </div>
                        <!-- Start news tab content -->
                        <div id="news" class="tab-pane fade">
                            <ul class="news_tab">
                                <?php

                                $args = array(
                                    'category_name' => 'news',
                                    'post_status' => 'publish',
                                    'orderby' => 'date',
                                    'order' => 'DESC',
                                    'posts_per_page' => 3,
                                );


                                $wp_query = new WP_Query();
                                $wp_query->query($args);
                                while ($wp_query->have_posts()):
                                    $wp_query->the_post();
                                    ?>
                                    <li>
                                        <div class="media">
                                            <div class="media-left"><a class="news_img"
                                                                       href="<?php the_permalink(); ?>"><?php the_post_thumbnail('thumbnail', array('class' => 'media-object')); ?></a>
                                            </div>
                                            <div class="media-body">
                                                <a tabindex="0"
                                                   href="<?php the_permalink(); ?>"><b><?php the_title(); ?></b></a>
                                                <p class="food_des"><?php the_excerpt(); ?></p>
                                                <!-- <span class="feed_date">27.02.15</span> -->
                                            </div>
                                        </div>
                                    </li>

                                    <?php
                                endwhile; // end of the loop.

                                ?>
                            </ul>
                            <a class="see_all" href="<?php echo esc_url(home_url('/')); ?>/category/news/">See All</a>

                        </div>
                        <!-- Start events tab content -->
                        <div id="events" class="tab-pane">
                            <ul class="events_tab">
                                <?php
                                $args = array(
                                    'category_name' => 'events',
                                    'post_status' => 'publish',
                                    'orderby' => 'date',
                                    'order' => 'DESC',
                                    'posts_per_page' => 3,
                                );


                                $wp_query = new WP_Query();
                                $wp_query->query($args);
                                while ($wp_query->have_posts()):
                                    $wp_query->the_post();
                                    ?>
                                    <li>
                                        <div class="media">
                                            <div class="media-left"><a class="news_img"
                                                                       href="<?php the_permalink(); ?>"><?php the_post_thumbnail('thumbnail', array('class' => 'media-object')); ?></a>
                                            </div>
                                            <div class="media-body">
                                                <a tabindex="0"
                                                   href="<?php the_permalink(); ?>"><b><?php the_title(); ?></b></a>
                                                <p class="food_des"><?php the_excerpt(); ?></p>
                                                <!-- <span class="feed_date">27.02.15</span> --></div>
                                        </div>
                                    </li>

                                    <?php
                                endwhile; // end of the loop.
                                ?>
                            </ul>
                            <a class="see_all" href="<?php echo esc_url(home_url('/')); ?>/category/events/">See All</a>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<div class="container-fluid">
    <div class="container">
        <div class="row our-service">
            <p class="service">サービス <br/><span class="lines"></span></p>

        </div>
        <div class="row margin-top-45">
            <div class="col-xs-12 col-sm-6 col-md-3 service-wrap">
                <div class="text-center"><img src="service-1.png"/></div>
                <p class="service-title">通訳ガイド</p>
                <p class="service-detail">
                    ジャパントラベルガイド.naviには日本全国から通訳のできるガイド（ホスト）が登録しています。まるで友人のように、気軽に自分の住む街や田舎を案内いたします。ガイド（ホスト）はプロではありませんが友達感覚で、気軽に！楽しく！訪日外国人の皆さんを案内いたします。素敵なホストを探して魅力あふれる日本の旅を楽しんで下さい。</p>

            </div>
            <div class="col-xs-12 col-sm-6 col-md-3 service-wrap">
                <div class="text-center"><img src="service-2.png"/></div>
                <p class="service-title">現地ツアー情報</p>
                <p class="service-detail">
                    Tジャパントラベルガイド.naviでは、観光ツアーやパッケージツアーでは決して体験できない日本ならではの体験ツアーや、ガイドブックには載っていない穴場スポット情報を配信しています。また、お客様のご要望に合わせた完全オーダーメイドの案内も可能です♪。</p>

            </div>
            <div class="col-xs-12 col-sm-6 col-md-3 service-wrap">
                <div class="text-center"><img src="service-3.png"/></div>
                <p class="service-title">宿泊先情報</p>
                <p class="service-detail">ガイド（ホスト）の自宅や別荘でのホームステイや日本の田舎暮らし体験ができる宿泊情報の他、air
                    bnb（エアービーアンドビー）のような空室、空き家情報も提供しています、東京や大阪の首都圏に滞在する際、ホテルや旅館がすでにいっぱいで宿泊先がみつからい！なんてときはジャパントラベルガイド.naviを覗いてみて下さい。</p>

            </div>
            <div class="col-xs-12 col-sm-6 col-md-3 service-wrap">
                <div class="text-center"><img src="service-4.png"/></div>
                <p class="service-title">グルメ情報</p>
                <p class="service-detail">
                    ユネスコの無形文化遺産に選ばれた”日本食＝和食”は寿司や天ぷら、らーめんだけではありません。和食には、まだまだ”安くて！美味しい！グルメがいっぱいあります。ジャパントラベルガイド.naviでは、訪日外国人向けのグルメサイト「タベルコト」と提携し、日本の安くて！美味しい！和食情報を提供してます♪</p>

            </div>
        </div>
    </div>
    <div class="row progress">
        <div class="col-xs-12 col-sm-6 col-md-3">
            <div class="c100 p30 circle-progress">
                    <span><?php
                        $count = 0;
                        $args = array(
                            'category_name' => 'hostlist',
                            'orderby' => 'date',
                            'order' => 'DESC',
                            'posts_per_page' => 8,
                        );


                        $wp_query = new WP_Query();
                        $wp_query->query($args);
                        while ($wp_query->have_posts()) {
                            $wp_query->the_post();
                            $count++;
                        }
                        print $count;; ?>人</span>
                <div class="slice">
                    <div class="bar"></div>
                    <div class="fill"></div>
                </div>
            </div>
            <p class="progress-name"> ガイド（ホスト）登録数 </p>
        </div>
        <div class="col-xs-12 col-sm-6 col-md-3">
            <div class="c100 p40 circle-progress">
                    <span><?php
                        $count = 0;
                        $args = array(
                            'category_name' => 'tourlist',
                            'orderby' => 'date',
                            'order' => 'DESC',
                            'posts_per_page' => 8,
                        );


                        $wp_query = new WP_Query();
                        $wp_query->query($args);
                        while ($wp_query->have_posts()) {
                            $wp_query->the_post();
                            $count++;
                        }
                        print $count;
                        ?>件</span>
                <div class="slice">
                    <div class="bar"></div>
                    <div class="fill"></div>
                </div>
            </div>
            <p class="progress-name"> ツアー情報数 </p>
        </div>
        <div class="col-xs-12 col-sm-6 col-md-3">
            <div class="c100 p50 circle-progress">
                <span>coming...</span>
                <div class="slice">
                    <div class="bar"></div>
                    <div class="fill"></div>
                </div>
            </div>
            <p class="progress-name"> 宿泊情報数</p>
        </div>
        <div class="col-xs-12 col-sm-6 col-md-3">
            <div class="c100 p60 circle-progress">
                <span>coming...</span>
                <div class="slice">
                    <div class="bar"></div>
                    <div class="fill"></div>
                </div>
            </div>
            <p class="progress-name"> グルメ情報数 </p>
        </div>
    </div>

    <div class="host row">
        <div class="our-service">
            <p class="service">メンバー(ホスト)のご紹介<span class="lines"></span></p>

        </div>
        <div class="container list-host">
            <div id="carousel-example-generic1" class="carousel slide" data-ride="carousel">
                <div class="carousel-inner">
                    <?php
                    $count = 0;
                    $args = array(
                        'category_name' => 'hostlist',
                        'orderby' => 'date',
                        'order' => 'DESC',
                        'posts_per_page' => 8,
                    );


                    $wp_query = new WP_Query();
                    $wp_query->query($args);
                    while ($wp_query->have_posts()) {
                        $wp_query->the_post();
                        $count++; ?>
                        <?php if ($count == 1): ?>
                            <div class="item active">
                            <div class="row">
                        <?php endif ?>
                        <?php if ($count >= 1 && $count < 5): ?>
                            <div class="col-xs-12 col-sm-6 col-md-3">
                                <div class="host-avatar"><a href="<?php echo get_permalink($post->ID); ?>"><img
                                            class="host-img"
                                            src="<?php the_post_thumbnail_url() ?>"/></a><span><strong><?php the_title(); ?> </strong></span>
                                </div>

                                <?php the_content(); ?>
                            </div>
                        <?php endif ?>
                        <?php if ($count == 5): ?>
                            </div>
                            </div>
                            <div class="item">
                            <div class="row">
                        <?php endif ?>
                        <?php if ($count >= 5 && $count <= 8): ?>
                            <div class="col-xs-12 col-sm-6 col-md-3">
                                <div class="host-avatar"><a href="<?php echo get_permalink($post->ID); ?>"><img
                                            class="host-img"
                                            src="<?php the_post_thumbnail_url() ?>"/></a><span><strong><?php the_title(); ?> </strong></span>
                                </div>

                                <?php the_content(); ?>
                            </div>
                        <?php endif ?>
                        <?php if ($count == 8): ?>
                            </div>
                            </div>
                        <?php endif ?>


                    <?php } ?>
                </div>
            </div>
            <a class="left carousel-control" href="#carousel-example-generic1" data-slide="prev"><span class="sr-only">Previous</span><img
                    class="left-arr hidden-xs hidden-sm" src="left-arr.png"/> </a>
            <a class="right carousel-control" href="#carousel-example-generic1" data-slide="next"> <span
                    class="sr-only">Next</span> <img class="right-arr hidden-xs hidden-sm" src="right-arr.png"/></a>

        </div>
    </div>

    <div class="host row newTour">
        <div class="our-service">
            <p class="service">NEWツアー/アクティビティーのご紹介<span class="lines"></span></p>
            <p></p></div>
        <div class="container list-host">
            <div id="newTour" class="carousel slide" data-ride="carousel">
                <div class="carousel-inner">
                    <?php
                    $count = 0;
                    $args = array(
                        'category_name' => 'tourlist',
                        'orderby' => 'date',
                        'order' => 'DESC',
                        'posts_per_page' => 6,
                    );


                    $wp_query = new WP_Query();
                    $wp_query->query($args);
                    while ($wp_query->have_posts()) {
                        $wp_query->the_post();
                        $count++; ?>
                        <?php if ($count == 1): ?>
                            <div class="item active">
                            <div class="row">
                        <?php endif ?>
                        <?php if ($count >= 1 && $count < 4): ?>
                            <div class="col-xs-12 col-sm-6 col-md-4">
                                <div class="host-avatar"><a href="<?php echo get_permalink($post->ID); ?>"><img
                                            class="host-img" src="<?php the_post_thumbnail_url() ?>"/></a>
                                </div>
                                <p class="host-name"><?php the_title(); ?></p>
                                <?php the_content(); ?>
                            </div>
                        <?php endif ?>
                        <?php if ($count == 4): ?>
                            </div>
                            </div>
                            <div class="item">
                            <div class="row">
                        <?php endif ?>
                        <?php if ($count >= 4 && $count <= 6): ?>
                            <div class="col-xs-12 col-sm-6 col-md-4">
                                <div class="host-avatar"><a href="<?php echo get_permalink($post->ID); ?>"><img
                                            class="host-img" src="<?php the_post_thumbnail_url() ?>"/></a>
                                </div>
                                <p class="host-name"><?php the_title(); ?></p>
                                <?php the_content(); ?>
                            </div>
                        <?php endif ?>
                        <?php if ($count == 6): ?>
                            </div>
                            </div>
                        <?php endif ?>


                    <?php } ?>


                    <p></p></div>
                <p></p></div>
            <p></p></div>
        <p><a class="left carousel-control" href="#newTour" data-slide="prev"><span class="sr-only">Previous</span><img
                    class="left-arr hidden-xs hidden-sm" src="left-arr.png"> </a><br>
            <a class="right carousel-control" href="#newTour" data-slide="next"> <span class="sr-only">Next</span> <img
                    class="right-arr hidden-xs hidden-sm" src="right-arr.png"></a></p></div>
</div>


<div class="row testimonial">
    <div class="our-service margin-top-25">
        <p class="service">ツアーガイド募集<br/><span class="lines"></span></p>

    </div>
    <div class="container">

        <?php
        $count = 0;
        $args = array(
            'category_name' => 'testimonial',
            'orderby' => 'date',
            'order' => 'DESC',
            'posts_per_page' => 4,
        );


        $wp_query = new WP_Query();
        $wp_query->query($args);
        while ($wp_query->have_posts()) {
            $wp_query->the_post();
            $count++; ?>
            <?php if ($count == 1): ?>

                <div class="row">
            <?php endif ?>
            <?php if ($count >= 1 && $count <= 2): ?>
                <div class="col-xs-12 col-md-6">
                    <div class="row">
                        <div class="col-xs-3"><img class="img-responsive"
                                                   src="<?php echo wp_get_attachment_url(get_post_thumbnail_id(get_the_ID())) ?>"/>
                        </div>
                        <div class="col-xs-9">
                            <p class="testimonial-name"><?php the_title(); ?></p>
                            <p class="testimonial-job"><?php echo get_post_meta(get_the_ID(), 'job', TRUE); ?></p>

                            <div class="hr"></div>
                            <div class="row">
                                <div class="col-xs-2"><img class="img-responsive" src="quote.png"/></div>
                                <div class="col-xs-10 testimonial-content">
                                    <?php the_content(); ?>
                                    <p class="ps text-right">掲載日：<?php echo get_the_date('d/m/Y'); ?></p>
                                    <p class="sign text-right"><a href="<?php echo get_permalink(get_the_ID()); ?> "
                                                                  style="color: #a60101;">募集詳細</a></p>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endif ?>
            <?php if ($count == 2): ?>
                </div>
                <div class="row">
            <?php endif ?>
            <?php if ($count >= 3 && $count <= 4): ?>
                <div class="col-xs-12 col-md-6">
                    <div class="row">
                        <div class="col-xs-3"><img class="img-responsive"
                                                   src="<?php echo wp_get_attachment_url(get_post_thumbnail_id(get_the_ID())) ?>"/>
                        </div>
                        <div class="col-xs-9">
                            <p class="testimonial-name"><?php the_title(); ?></p>
                            <p class="testimonial-job"><?php echo get_post_meta(get_the_ID(), 'job', TRUE); ?></p>

                            <div class="hr"></div>
                            <div class="row">
                                <div class="col-xs-2"><img class="img-responsive" src="quote.png"/></div>
                                <div class="col-xs-10 testimonial-content">
                                    <?php the_content(); ?>
                                    <p class="ps text-right">掲載日：<?php echo get_the_date('d/m/Y'); ?></p>
                                    <p class="sign text-right"><a href="<?php echo get_permalink(get_the_ID()); ?> "
                                                                  style="color: #a60101;">募集詳細</a></p>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endif ?>
            <?php if ($count == 4): ?>
                </div>
            <?php endif ?>


        <?php } ?>
    </div>
</div>
</div>
<?php get_footer(); ?>

