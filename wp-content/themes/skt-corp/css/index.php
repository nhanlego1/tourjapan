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
 <?php 
          if(isset($_post['to_step_2']) and $_post['to_step_2']=='yes'){
       ?>
   <div class="container" style="max-width:769px;">
<script type="text/javascript">
// <![CDATA[
    var config = {error_pos: true};
    livevalidation.register([
        {id: 't3di', name: 'お名前', required: true, min: 0, max: 300},
        {id: 't4kl', name: 'ニックネーム', required: true, min: 0, max: 300},
        {id: 't2wv', name: '名前（ローマ字）', required: false, min: 0, max: 300},
        {id: 't3gq', name: '左番号', required: true, min: 3, max: 3, regexp: 'number'},
        {id: 't0sz', name: '右番号', required: true, min: 4, max: 4, regexp: 'number'},
        {id: 's5bo', name: '都道府県', required: true},
        {id: 't4ii', name: '市区町村', required: true, min: 0, max: 300},
        {id: 't0pi', name: '番地建物', required: false, min: 0, max: 300},
        {id: 's6ib', name: '年号', required: true},
        {id: 't2ne', name: '年', required: true, min: 0, max: 4, regexp: 'integer'},
        {id: 't9ip', name: '月', required: true, min: 0, max: 2, regexp: 'integer'},
        {id: 't3xl', name: '日', required: true, min: 0, max: 2, regexp: 'integer'},
        {id: 't0fl', name: '携帯番号', required: true, min: 0, max: 300, regexp: 'mbphone_d'},
        {id: 't7pj', name: '対応言語', required: true, min: 0, max: 300},
        {id: 't1og', name: 'プロフィール', required: true, min: 0, max: 3000},
        {id: 't3mp', name: 'プロフィール', required: true, min: 0, max: 3000},
        {id: 't9hg', name: 'メールアドレス', required: true, min: 0, max: 300, regexp: 'mailaddress'},
        {id: 't4jy', name: '基本ガイド稼働時間', required: true, min: 0, max: 300},
        {id: 't9ag', name: '最低ガイド時間', required: true, min: 0, max: 300},
        {id: 't8nd', name: '最低ガイド時間の時給', required: true, min: 0, max: 300},
        {id: 'c9oq', name: '朝早／夜遅稼働の可否', required: true, checks_min: 1, checks_max: 2},
        {id: 't9su', name: '朝早／夜遅の際の時給', required: false, min: 0, max: 300},
        {id: 's4lu', name: '案内可能エリア', required: true},
        {id: 's4nx', name: '都道府県', required: false},
        {id: 's9pl', name: '都道府県', required: false},
        {id: 's6rf', name: '都道府県', required: false},
        {id: 's9oi', name: '都道府県', required: false},
        {id: 'c9lr', name: '案内時の移動手段', required: true, checks_min: 1, checks_max: 6},
        {id: 't4qr', name: '現在の職業', required: false, min: 0, max: 300},
        {id: 'f6et', name: 'お勧めスポット①', required: true},
        {id: 't8kg', name: 'お勧めスポット名①', required: true, min: 0, max: 300},
        {id: 'f6rs', name: 'お勧めスポット②', required: true},
        {id: 't5ue', name: 'お勧めスポット名②', required: true, min: 0, max: 300},
        {id: 'f6hl', name: 'お勧めスポット③', required: true},
        {id: 't5wp', name: 'お勧めスポット名③', required: true, min: 0, max: 300},
        {id: 'f5ue', name: 'お勧めグルメ', required: true},
        {id: 't4gt', name: 'お勧めグルメ名①', required: true, min: 0, max: 300},
        {id: 'f5vi', name: 'お勧めグルメ②', required: true},
        {id: 't0zf', name: 'お勧めグルメ名②', required: true, min: 0, max: 300},
        {id: 'f9gp', name: 'お勧めグルメ③', required: true},
        {id: 't8ia', name: 'お勧めグルメ名③', required: true, min: 0, max: 300}
    ], config);
// ]]>
</script>

<div id="mainform">
    <h2><a href="http://serve-inc.kir.jp/">ホストになる（通訳ガイド）エントリーフォーム</a></h2>
    <p class="step"><span>1. フォームの入力</span> → <em>2. 入力内容の確認</em> → <span>3. 送信完了</span></p>
    <form action="http://serve-inc.kir.jp/esform/guide_entry.php" method="post">
        <fieldset>
            <legend>ホストになる（通訳ガイド）エントリーフォーム</legend>
            <input type="hidden" name="t3di" value="fasdf"><input type="hidden" name="t4kl" value="ニックネーム"><input type="hidden" name="t2wv" value="đasd"><input type="hidden" name="t3gq" value="312"><input type="hidden" name="t0sz" value="1323"><input type="hidden" name="s5bo" value="埼玉県"><input type="hidden" name="t4ii" value="312323"><input type="hidden" name="t0pi" value="31231232"><input type="hidden" name="s6ib" value="西暦"><input type="hidden" name="t2ne" value="1988"><input type="hidden" name="t9ip" value="2"><input type="hidden" name="t3xl" value="2"><input type="hidden" name="t0fl" value="09011112222"><input type="hidden" name="t7pj" value="sdfasdf"><input type="hidden" name="t1og" value="ádfasdf"><input type="hidden" name="t3mp" value="fasdfasdf"><input type="hidden" name="t9hg" value="info@example.com"><input type="hidden" name="t4jy" value="fasdf"><input type="hidden" name="t9ag" value="fasdfsd"><input type="hidden" name="t8nd" value="fasdfdf"><input type="hidden" name="c9oq[]" value="朝早　NG"><input type="hidden" name="c9oq[]" value="夜遅　NG"><input type="hidden" name="t9su" value="fasdfasdf"><input type="hidden" name="s4lu" value="東京都"><input type="hidden" name="s4nx" value="栃木県"><input type="hidden" name="s9pl" value="宮城県"><input type="hidden" name="s6rf" value="北海道"><input type="hidden" name="s9oi" value="北海道"><input type="hidden" name="c9lr[]" value="車（レンタカー）"><input type="hidden" name="t4qr" value="fasdfdf"><input type="hidden" name="f6et" value="Courses.txt"><input type="hidden" name="f6et_file" value="123.16.42.87_1481718810.txt"><input type="hidden" name="f6et_type" value="text/plain"><input type="hidden" name="t8kg" value="fasdf"><input type="hidden" name="f6rs" value="Courses.txt"><input type="hidden" name="f6rs_file" value="123.16.42.87_1481718810.txt"><input type="hidden" name="f6rs_type" value="text/plain"><input type="hidden" name="t5ue" value="fasdfdf"><input type="hidden" name="f6hl" value="Courses.txt"><input type="hidden" name="f6hl_file" value="123.16.42.87_1481718810.txt"><input type="hidden" name="f6hl_type" value="text/plain"><input type="hidden" name="t5wp" value="fasdfdf"><input type="hidden" name="f5ue" value="Courses.txt"><input type="hidden" name="f5ue_file" value="123.16.42.87_1481718810.txt"><input type="hidden" name="f5ue_type" value="text/plain"><input type="hidden" name="t4gt" value="fasdfdf"><input type="hidden" name="f5vi" value="Courses.txt"><input type="hidden" name="f5vi_file" value="123.16.42.87_1481718810.txt"><input type="hidden" name="f5vi_type" value="text/plain"><input type="hidden" name="t0zf" value="fasfdf"><input type="hidden" name="f9gp" value="Courses.txt"><input type="hidden" name="f9gp_file" value="123.16.42.87_1481718810.txt"><input type="hidden" name="f9gp_type" value="text/plain"><input type="hidden" name="t8ia" value="fasdfdf"><input type="hidden" name="confirm" value="done"><input type="hidden" name="id" value="2">
            <table summary="確認内容">
                <tbody><tr>
                    <th>お名前<em class="required">※</em></th>
                    <td>
                        fasdf                   </td>
                </tr>
                <tr>
                    <th>ニックネーム<em class="required">※</em></th>
                    <td>
                        ニックネーム                  </td>
                </tr>
                <tr>
                    <th>名前（ローマ字）</th>
                    <td>
                        đasd                    </td>
                </tr>
                <tr>
                    <th>住所<em class="required">※</em></th>
                    <td>
                        312-1323<br>
                        埼玉県<br>
                        312323<br>
                        31231232                    </td>
                </tr>
                <tr>
                    <th>生年月日<em class="required">※</em></th>
                    <td>
                        西暦1988年2月2日
                    </td>
                </tr>
                <tr>
                    <th>携帯番号<em class="required">※</em></th>
                    <td>
                        09011112222                 </td>
                </tr>
                <tr>
                    <th>対応言語<em class="required">※</em></th>
                    <td>
                        sdfasdf                 </td>
                </tr>
                <tr>
                    <th>プロフィール<em class="required">※</em></th>
                    <td>
                        ádfasdf<br>
                        fasdfasdf                   </td>
                </tr>
                <tr>
                    <th>メールアドレス<em class="required">※</em></th>
                    <td>
                        info@example.com                    </td>
                </tr>
                <tr>
                    <th>基本ガイド稼働時間<em class="required">※</em></th>
                    <td>
                        fasdf                   </td>
                </tr>
                <tr>
                    <th>最低ガイド時間<em class="required">※</em></th>
                    <td>
                        fasdfsd                 </td>
                </tr>
                <tr>
                    <th>最低ガイド時間の時給<em class="required">※</em></th>
                    <td>
                        fasdfdf                 </td>
                </tr>
                <tr>
                    <th>朝早／夜遅稼働の可否<em class="required">※</em></th>
                    <td>
                        朝早　NG, 夜遅　NG                    </td>
                </tr>
                <tr>
                    <th>朝早／夜遅の際の時給</th>
                    <td>
                        fasdfasdf                   </td>
                </tr>
                <tr>
                    <th>案内可能エリア<em class="required">※</em></th>
                    <td>
                        東京都<br>
                        栃木県<br>
                        宮城県<br>
                        北海道<br>
                        北海道                 </td>
                </tr>
                <tr>
                    <th>案内時の移動手段<em class="required">※</em></th>
                    <td>
                        車（レンタカー）                    </td>
                </tr>
                <tr>
                    <th>現在の職業</th>
                    <td>
                        fasdfdf                 </td>
                </tr>
                <tr>
                    <th>お勧めスポット①<em class="required">※</em></th>
                    <td>
                        Courses.txt<br>
                        fasdf<br>
                        Courses.txt<br>
                        fasdfdf<br>
                        Courses.txt<br>
                        fasdfdf                 </td>
                </tr>
                <tr>
                    <th>お勧めグルメ<em class="required">※</em></th>
                    <td>
                        Courses.txt<br>
                        fasdfdf<br>
                        Courses.txt<br>
                        fasfdf<br>
                        Courses.txt<br>
                        fasdfdf                 </td>
                </tr>
            </tbody></table>
            <p>
                <input type="reset" value="やり直す" onclick="history.back();return false;">
                <input type="submit" value="内容を送信する">
            </p>
        </fieldset>
    </form>
</div>


             <div id="copyright">
                          <address><a href="http://www.mt312.com/">ES-FORM</a></address>
                        </div>
            </div>
       <?php } else { ?>
<?php if ( 'page' == get_option( 'show_on_front' ) && ( '' != get_option( 'page_for_posts' ) ) && $wp_query->get_queried_object_id() == get_option( 'page_for_posts' ) ) : ?>

    <div class="content-area">
        <div class="container">
            <section class="site-main" id="sitemain">
                <div class="blog-post">
					<?php
                    if ( have_posts() ) :
                        // Start the Loop.
                        while ( have_posts() ) : the_post();
                            /*
                             * Include the post format-specific template for the content. If you want to
                             * use this in a child theme, then include a file called called content-___.php
                             * (where ___ is the post format) and that will be used instead.
                             */
                            get_template_part( 'content', get_post_format() );
                    
                        endwhile;
                        // Previous/next post navigation.
                        skt_corp_pagination();
                    
                    else :
                        // If no content, include the "No posts found" template.
                         get_template_part( 'no-results', 'index' );
                    
                    endif;
                    ?>
                </div><!-- blog-post -->
            </section>
            <?php get_sidebar();?>
            <div class="clear"></div>
        </div>
    </div>

<?php else: ?>

	<?php
    if( of_get_option('numsection', true) > 0 ) { 
        $numSections = esc_attr( of_get_option('numsection', true) );
        for( $s=1; $s<=$numSections; $s++ ){ 
            $title 		= ( of_get_option('sectiontitle'.$s, true) != '' ) ? esc_html( of_get_option('sectiontitle'.$s, true) ) : '';
            $class		= ( of_get_option('sectionclass'.$s, true) != '' ) ? esc_html( of_get_option('sectionclass'.$s, true) ) : '';
            $content	= ( of_get_option('sectioncontent'.$s, true) != '' ) ? of_get_option('sectioncontent'.$s, true) : ''; 
            $bgcolor	= ( of_get_option('sectionbgcolor'.$s, true) != '' ) ? of_get_option('sectionbgcolor'.$s, true) : ''; 
            ?>
           
                    <?php if( $title != '' ) { ?>
                        <h2><?php echo $title; ?></h2>
                    <?php } ?>
                    <?php skt_corp_the_content_format( $content ); ?>
                    <div class="clear"></div>
                <?php 
        }
    }
    ?>
   
<?php endif; } ?>


<?php get_footer(); ?>