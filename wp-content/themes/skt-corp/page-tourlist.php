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

$f1=$_GET['tour'];
$f2=$_GET['theme-category'];
$f3=$_GET['language'];
?>


	<div class="header1" style="height: 328px; background: url('../img/bannerpage4.jpg'); background-size: cover;">
  <div class="title-top"> 
    <h2>体験ツアー＆アクティビティー検索</h2>
  </div>
</div>
<div class="container">
<div class="row main-content">
<div class="col-md-7 col-xs-12 left-content">

<p>「ツアー／アクティビティーを探しましょう！」</p>
<div class="hr-green-1"></div>
<p class="p-tour">目的に合わせて条件検索が可能です。</p>

<div class="wrapper-step">
<div class="row">



		 <?php

		 $terms1 = get_terms([
		    'taxonomy' => 'hokkaido-okinawa',
		    'hide_empty' => false,
		]); 
		$terms2 = get_terms([
		    'taxonomy' => 'theme-category',
		    'hide_empty' => false,
		]); 
		$term3 = get_terms([
		    'taxonomy' => 'language',
		    'hide_empty' => false,
		]); 
         ?>
		 <div class="row search-tour" style="margin-right: 0px;margin-left: 0px;">
		 <form action="" method="get" class="searchandfilter">
			<div class="col-xs-12 col-md-3">
			<select class="filter-sl" name="tour" style="width: 90%;">
			<?php foreach ($terms1 as $key => $term):?>
	        	<option value="<?=$term->slug?>" <?php if($term->slug==$f1) echo 'selected="selected"'; ?>><?=$term->name?></option>
	        <?php endforeach;?>
			<option value="all" <?php if($f1=='all') echo 'selected="selected"'; ?>>すべて</option>
			</select><i class="fa fa-angle-right"></i>
			</div>
			<div class="col-xs-12 col-md-4">
			<select name="theme-category" class="filter-sl" style="width: 90%;">
			<option <?php if(!isset($f2) || $f2=='0') echo 'selected="selected"'; ?> value="0">テーマ& カテゴリー</option>
			<?php foreach ($terms2 as $key => $term):?>
	        	<option value="<?=$term->slug?>" <?php if($term->slug==$f2) echo 'selected="selected"'; ?>><?=$term->name?></option>
	        <?php endforeach;?>
	        <option value="all" <?php if($f2=='all') echo 'selected="selected"'; ?>>すべて</option>
			</select><i class="fa fa-angle-right"></i></div>
			<div class="col-xs-12 col-md-3"><select name="language" class="filter-sl" style="width: 90%;">
			<option <?php if(!isset($f3) || $f3=='0') echo 'selected="selected"'; ?> value="0"><i class="fa fa-square" aria-hidden="true"></i> 通訳言語</option>
			<?php foreach ($term3 as $key => $term):?>
	        	<option value="<?=$term->slug?>" <?php if($term->slug==$f3) echo 'selected="selected"'; ?>><?=$term->name?></option>
	        <?php endforeach;?>
	        <option value="all" <?php if($f3=='all') echo 'selected="selected"'; ?>>すべて</option>
			</select></div>
			<div class="col-xs-12 col-md-2"><input type="submit" value="Search"></div>
		</form></div>
	</div>
</div>
<!--section 1-->
<div class="hr-green-2"></div>
<div class="row article">
<div class="col-xs-12 col-xs-8 article-title"><ol class="breadcrumb">
                        <?php if(isset($f1)): ?>
                          <li><a href="#"><?php if($f1 =='0') echo 'All'; elseif($f1 =='all') echo 'All'; else echo getLabelTour($f1, 'hokkaido-okinawa'); ?></a> <i class="fa fa-angle-double-right" aria-hidden="true"></i></li>
                            <?php endif;?>
                             <?php if(isset($f2)): ?>
                          <li><a href="#"><?php if($f2 =='0') echo 'All';  elseif($f2 =='all') echo 'All'; else echo getLabelTour($f2, 'theme-category');?></a> <i class="fa fa-angle-double-right" aria-hidden="true"></i></li>
                            <?php endif;?>
                                  <?php if(isset($f3)): ?>
                          <li class="active"><?php if($f3 =='0') echo 'All';  elseif($f3 =='all') echo 'All'; else echo getLabelTour($f3, 'language');?></li>
                          <?php endif;?>
</ol></div>
<!--
<div class="col-xs-12 col-sm-4 text-right"><span class="btn-1"> 築地市場ま</span><span class="btn-2"> 見学と握</span></div>
-->

</div>
<div class="article-star"><span class="red"> <strong> 5.0 </strong></span><span class="blue"> (泉がいい値群馬) </span></div>
<div class="row">
<div class="col-xs-12 col-sm-8 article-desc">築地市場まるごと見学と握り寿</div>
<!--
<div class="col-xs-12 col-sm-4 text-right"><span class="btn-3"> 築地市</span><span class="btn-3"> 築地市</span></div>
-->

</div>
<div class="margin-top-23"><strong> 築地市場まるごと見学 </strong>
<span class="font-size-12">築地市場まるごと見学と握り寿司体験ツアー築地市場まるごと見学と握り寿司体験ツアー</span></div>



<?php SearchTour();?>


<div class="hr-gray"></div>
<p class="blue text-underline"><strong> 築地市場まるごと見学(5学) </strong></p>
<!--section 2-->
<div class="hr-green-2"></div>
<div class="row article">
<div class="col-xs-12 col-xs-8 article-title"><strong> 築地市場まるごと見学と握り寿 </strong></div>
<div class="col-xs-12 col-sm-4 text-right"><span class="btn-1"> 築地市場ま</span><span class="btn-2"> 見学と握</span></div>
</div>
<div class="article-star"><span class="red"> <strong> 5.0 </strong></span><span class="blue"> (泉がいい値群馬) </span></div>
<div class="row">
<div class="col-xs-12 col-sm-8 article-desc">築地市場まるごと見学と握り寿</div>
<div class="col-xs-12 col-sm-4 text-right"><span class="btn-3"> 築地市</span><span class="btn-3"> 築地市</span></div>
</div>
<div class="margin-top-23"><strong> 築地市場まるごと見学 </strong>
<span class="font-size-12">築地市場まるごと見学と握り寿司体験ツアー築地市場まるごと見学と握り寿司体験ツアー</span></div>

 <?php $args = array( 
                        'category_name' => 'tourlist', 
                        'orderby'=>'date',
                        'order'=>'DESC', 
                        'posts_per_page' => 4, 
                      );
                      $wp_query = new WP_Query();
                      $wp_query->query( $args );?>
                     <?php while ($wp_query->have_posts()) : $wp_query->the_post()?>
                     	<div class="hr-gray"></div>
                         <div class="row">
                            <div class="col-xs-12 col-sm-4 col-md-3">
                                <?php echo get_the_post_thumbnail($post->ID, 'thumbnail' );?>
                            </div>
                            <div class="col-xs-12 col-sm-8 col-md-9">
                                <p class="blue text-underline"> <?php the_title(); ?></p>
                                <p class="gray"> <?php the_content(); ?></p>
                                <div class="row">
                                    <div class="col-xs-6 red">
                                        <strong><i class="fa fa-usd" aria-hidden="true"></i>  <?php echo get_post_meta(get_the_ID(), 'price', TRUE); ?></strong>
                                    </div>
                                    <div class="col-xs-6 text-right">
                                       <a href="<?php echo get_permalink( get_the_ID() ); ?>"><button class="btn my-btn"> <span class="glyphicon glyphicon-search" aria-hidden="true"></span> ツアー詳細 </button></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                    <?php endwhile; ?>




<div class="hr-gray"></div>
<p class="blue text-underline"><strong> 築地市場まるごと見学(5学) </strong></p>

</div>
       
<?php get_sidebar();?>

<?php get_footer(); ?>