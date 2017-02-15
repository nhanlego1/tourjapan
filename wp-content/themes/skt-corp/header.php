<?php
/**
 * The Header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="content">
 *
 * @package SKT Corp
 */
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="profile" href="http://gmpg.org/xfn/11">
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
<link href="<?php echo esc_url(home_url('/'));?>bootstrap-3.3.6/dist/css/bootstrap.min.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="<?php echo esc_url(home_url('/'));?>js/jquery.min.js"></script>
<script src="<?php echo esc_url(home_url('/'));?>bootstrap-3.3.6/dist/js/bootstrap.js" type="text/javascript"></script>
<script src="<?php echo esc_url(home_url('/'));?>js/jquery.jpostal.js" type="text/javascript"></script>
    <script src="http://serve-inc.kir.jp/js/wow.min.js"></script>  
    <!-- Bootstrap js -->
    <!-- slick slider -->
    <script src="http://serve-inc.kir.jp/js/slick.min.js"></script>
    <!-- superslides slider -->
    <script src="http://serve-inc.kir.jp/js/jquery.easing.1.3.js"></script>
    <script src="http://serve-inc.kir.jp/js/jquery.animate-enhanced.min.js"></script>
    <script src="http://serve-inc.kir.jp/js/jquery.superslides.min.js" type="text/javascript" charset="utf-8"></script>   
    <!-- for circle counter -->
    <script src='https://cdn.rawgit.com/pguso/jquery-plugin-circliful/master/js/jquery.circliful.min.js'></script> 

<script src="http://serve-inc.kir.jp/js/jquery.tosrus.min.all.js" type="text/javascript"></script>
<script src="http://serve-inc.kir.jp/js/custom.js" type="text/javascript"></script>
<link href="http://serve-inc.kir.jp/css/jquery.tosrus.all.css" rel="stylesheet" type="text/css">
<link href="<?php echo esc_url(home_url('/'));?>css/font-awesome.min.css" rel="stylesheet" type="text/css">
<link href="<?php echo esc_url(home_url('/'));?>css/style.css" rel="stylesheet" type="text/css">
<link href="<?php echo esc_url(home_url('/'));?>css/circle.css" rel="stylesheet" type="text/css">
<link href="<?php echo esc_url(home_url('/'));?>css/import.css" rel="stylesheet" type="text/css">
<link href="<?php echo esc_url(home_url('/'));?>css/progress-wizard.min.css" rel="stylesheet" type="text/css">
<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>

    <div class="wrapper_main <?php if ( of_get_option('layout', true) != 'box' ) { echo 'layout_wide'; } else { echo 'layout_box';}?>" >

        <header class="header">
        	<div class="container">
                <div id="logo"><a href="<?php echo esc_url(home_url('/'));?>">
                        <?php if( of_get_option('logo', true) != '' ) { ?>
                        	<?php if( of_get_option('logo',true) == 1) { ?>
                            	<h1><?php bloginfo( 'name' ); ?></h1>
                            <?php } else { ?>
                            <img src="<?php echo esc_url( of_get_option('logo', true) ); ?>" />
                        <?php } } else { ?>
                            <h1><?php bloginfo( 'name' ); ?></h1>
                        <?php } ?>
                    </a>
                    <h3 class="tagline"><?php bloginfo('description'); ?></h3>
                </div>
                <div class="header_right">

                    <!-- <div class="search_form">
                        <?php get_search_form(); ?> 
                    </div>
                    <div class="clear"></div> -->
                    <div class="mobile_nav"><a href="#"><?php _e('','skt-corp'); ?></a></div>
                    <nav id="nav" class="navbar-fixed-top">
                        <?php wp_nav_menu( array('theme_location'  => 'primary', 'container' => '', 'container_class' => '', 'items_wrap' => '<ul>%3$s</ul>' ) ); ?>
                    </nav>
                    <div class="language">
                        <a href="http://tourjp.exo-maker.com"><img src="<?php echo esc_url(home_url('/'));?>ja-lgflag.gif"></a>
                         <a href="http://touren.exo-maker.com"><img src="<?php echo esc_url(home_url('/'));?>english.png"></a>
                    </div>
                </div>
	            <div class="clear"></div>
            </div>
        </header>
		<?php //if ( (of_get_option('innerpageslider', true) != 'hide') || is_home() || is_front_page() ) {
            if (  is_home() || is_front_page() ) {
            ?>
        <section id="home_slider">
        	<?php
				if( of_get_option('slide1',true) == 1) { ?>
                	<div class="slider-wrapper theme-default">
                    	<div id="slider" class="nivoSlider">
                        	<img src="<?php echo get_template_directory_uri(); ?>/images/slides/slide2.jpg" />
                    	</div>
                        <div class="nivo-caption" style="display:block">
                            <div class="slide_info">
                            		<h1><?php _e('Go to Appearance >> Theme Options >> Restore Defaults','skt-corp'); ?></h1>
                                    <p><?php _e('Go to Appearance >> Theme Options >> Restore Defaults','skt-corp'); ?></p>
                            </div>
                        </div>
                    </div>
            <?php
				} else { 
			$slAr = array();
			$m = 0;
			for ($i=1; $i<6; $i++) {
				if ( of_get_option('slide'.$i, true) != "" ) {
					$imgSrc 	= of_get_option('slide'.$i, true);
					$imgTitle	= of_get_option('slidetitle'.$i, true);
					$imgDesc	= of_get_option('slidedesc'.$i, true);
					$imgLink	= of_get_option('slideurl'.$i, true);
					if ( strlen($imgSrc) > 3 ) {
						$slAr[$m]['image_src'] = of_get_option('slide'.$i, true);
						$slAr[$m]['image_title'] = of_get_option('slidetitle'.$i, true);
						$slAr[$m]['image_desc'] = of_get_option('slidedesc'.$i, true);
						$slAr[$m]['image_link'] = of_get_option('slideurl'.$i, true);
						$m++;
					}
				}
			}
			$slideno = array();
			if( $slAr > 0 ){
				$n = 0;?>
                <div class="slider-wrapper theme-default"><div id="slider" class="nivoSlider">
                <?php 
                foreach( $slAr as $sv ){
                    $n++; ?><img src="<?php echo $sv['image_src']; ?>" alt="<?php echo $sv['image_title'];?>" title="<?php if ( ($sv['image_title']!='') && ($sv['image_desc']!='') ) { echo '#slidecaption'.$n ; } ?>" /><?php
                    $slideno[] = $n;
                }
                ?>
                </div><?php
                foreach( $slideno as $sln ){ ?>
                    <div id="slidecaption<?php echo $sln; ?>" class="nivo-html-caption">
                    <div class="slide_info">
                        <?php if( of_get_option('slidetitle'.$sln, true) != '' ){ ?>
                            <h1><?php echo of_get_option('slidetitle'.$sln, true); ?></h1>
                        <?php } ?>
                        <?php if( of_get_option('slidedesc'.$sln, true) != '' ){ ?>
                            <p><?php echo of_get_option('slidedesc'.$sln, true); ?></p>
                        <?php } ?>
                    </div><?php                            
                    if( of_get_option('slideurl'.$sln, true) != '' ){ ?>
                        <div class="slide_more"><a href="<?php echo esc_url(of_get_option('slideurl'.$sln, true)); ?>"><?php _e('View More','skt-corp'); ?></a></div><?php 
                    } ?>
                    </div><?php 
                } ?>
                </div>
                <div class="clear"></div><?php 
			} }
            ?>
        </section>
        <?php } ?>