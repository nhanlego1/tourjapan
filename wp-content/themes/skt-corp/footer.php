
<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after
 *
 * @package SKT Corp
 */
?>
	<div class="clear"></div>
</div>

           <footer id="footer">
    <div class="footer_top">
<div class="container">
<div class="row">
  <div class="col-ld-3  col-md-3 col-sm-3">
    <div class="single_footer_widget">
      <h3>About Us</h3>
      <p>ジャパン・トラベルガイド.naviは「日本を訪れる外国人（ゲスト）」と「自分の住む街や故郷を紹介する通訳ガイド（ホスト）」のマッチング・ポータルサイトです。
ホストはプロではありませんが、日本の”おもてなし”の心を大切に自分の住む”街や故郷”をご案内いたします。
是非、素敵なホストを見つけて、魅力あふれる日本の旅をお楽しみ下さい♪</p>
    </div>
  </div>
  <div class="col-ld-3  col-md-3 col-sm-3">
    <div class="single_footer_widget">
      <h3>Community</h3>
      <ul class="footer_widget_nav">
        <li><a href="torihiki">特定商取引法に基ずく表示</a></li>
        <li><a href="privacy">個人情報の取り扱いについて</a></li>
        <li><a href="menseki">免責事項</a></li>
        <li><a href="kiyaku">利用規約</a></li>
      </ul>
    </div>
  </div>
  <div class="col-ld-3  col-md-3 col-sm-3">
    <div class="single_footer_widget">
      <h3>Others</h3>
      <ul class="footer_widget_nav">
        <li><a href="campany">会社概要</a> 
        </li><li><a href="contact">お問合せ</a>  
      </li></ul>
    </div>
  </div>
  <div class="col-ld-3  col-md-3 col-sm-3">
    <div class="single_footer_widget">
      <h3>Adress</h3>
            <p>〒167-0034 東京都杉並区桃井1-5-1</p>
           <p>TEL : 03-000-0000</p>
           <p>FAX : 03-000-0000</p>
           <p>E-mail : contact@wpfdegree.com</p>
    </div>
  </div>
</div>
</div>
</div>
</footer>
	<!-- <div class="container">
        <aside class="widget">
        	<?php dynamic_sidebar('footer-1'); ?>
        </aside>
        <aside class="widget">
        	<?php dynamic_sidebar('footer-2'); ?>
        </aside>
        <aside class="widget last">
        	<?php dynamic_sidebar('footer-3'); ?>
        </aside>
        <div class="clear"></div>
    </div> -->


<!-- <div id="copyright">
	<div class="container">
    	<div class="left">
        	<?php if( of_get_option('footertext', true) == 1) { ?>
            	<?php _e('Go to Appearance >> Theme Options >> Restore Defaults','skt-corp'); ?>
            <?php } else { ?>
				<?php echo of_get_option('footertext', true); ?>
            <?php } ?>
        </div>
    	<div class="right">
        	<?php if( of_get_option('footerlinks', true) == 1) { ?>
            	<?php _e('Go to Appearance >> Theme Options >> Restore Defaults','skt-corp'); ?>
            <?php } else { ?>
				<?php echo of_get_option('footerlinks', true); ?>
            <?php } ?>
        </div>
        <div class="clear"></div>
    </div>
</div> -->

<?php wp_footer(); ?>

</body>
</html>