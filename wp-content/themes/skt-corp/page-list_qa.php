<?php
get_header(); 
?>
  <div class="header1" style="height:328px;background:url(../img/bg-2.jpg);background-size: cover;">
	<div class="title-top"> 
    <h2>Q & A
</h2>
  </div>
</div>
<div>
<div class='container' style="">
<div class='row'>
<div class="col-md-7 col-xs-12 left-content">
                  <p></p>
                   <h3>List Questions</h3>
                    <?php echo do_shortcode('[dwqa-list-questions]');?>       
</div>
 <?php get_sidebar();?>
</div>
</div>
</div>

 <?php get_sidebar();?>

<?php get_footer(); ?> 
  
     