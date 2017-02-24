
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

$post_detail_id = $_GET['post-detail'];
?>

<div class="header1" style="height:300px;background:url(../img/banner_host_dt.png);background-size: cover;">
<div class="title-top"> 
    <h2>ゲストの利用方法
</h2>
  </div>
</div>
<div style="width:100%;background:#f6f6f6;">
<div class='container' style="">
<div class='row'>
<div class="col-lg-7 col-md-7 col-sm-7">
            <div class="courseArchive_content">              
             <div class="singlecourse_ferimg_area">
               <div class="singlecourse_ferimg">
                 <img src="<?php echo wp_get_attachment_url( get_post_thumbnail_id($post_detail_id) )?>" alt="img">
               </div>  
                <div class="singlecourse_bottom">
                  <h1><b><?=get_the_title($post_detail_id)?></b></h1>
                  <span class="singlecourse_author">
                 <img alt="img" src="<?php echo wp_get_attachment_url( get_post_thumbnail_id($post_detail_id) )?>">東京・埼玉・神奈川</span><span class="singlecourse_price">￥<?php echo get_post_meta(get_the_ID(), 'price', TRUE); ?>／時間</span>
                </div>
             </div>
             <div class="single_course_content">
               <h2>プロフィール</h2>
               <p>東京ソラマチ@はショッピングやグルメのほか、水族館やプラネタリウムなどのエンターテインメントも楽しめる商業施設。30・31階のレストラン街「ソラマチダイニング スカイツリービュー」には、地上150mからの絶景を眺めながら食事ができるステキなレストランがたくさんありますよ。「天空ラウンジ TOP of TREE」もその１つ。間近に迫る東京スカイツリー@は大迫力。晴れた日には東京タワーや富士山も見えます。「天空ラウンジ TOP of TREE」ほか「ソラマチダイニング スカイツリービュー」のレストランでは、上から下まで、東京スカイツリーの全景が見られるのが大きな魅力です。                  そういった人々や言語を通して、文化の違いを大きく感じることも多々あり、日々発見と新鮮な驚きを得ています。この１年でアジア、東南アジア、ヨーロッパ、北中米地域の言語の仕事をすることができましたが、いずれアフリカ、中東などの仕事も行ってみたいです。プライベートでは、入社前にメキシコを訪れてきました。
                  席はすべて窓側を向いていて、どこに座っても東京スカイツリーが見えます。そんな「天空ラウンジ TOP of TREE」の人気メニューは東京スカイツリーをイメージした「アミューズタワー（2,800円）」。3段トレイの上に、シェフ特製の華やかなアミューズ（オードブル）が並んでいます。季節の食材をふんだんに使った手の込んだお料理の数々は、アミューズといえどもメイン料理にも匹敵するくらいの満足感が味わえますよ。トレイは東京スカイツリーと同じようにライトアップされる仕組みで、夜はとってもロマンティック。窓の向こうに見える東京スカイツリーとのコラボレーションも最高。大事な記念日やデートはもちろん、女子会にもぴったりです！<br>
                  <br></p>
               <table class="table table-striped course_table">
                <thead>
                  <tr>
                <th colspan="3"><h2><span class="fa fa-quote-left"></span>　私の案内するお勧めグルメ！！</h2></th>
              </tr>
                </thead>
                <tbody>
                  <tr>          
                    <td><img src="../img/ramen.jpg"></td>
                    <td><img src="../img/soba.jpg"></td>
                    <td><img src="../img/curry.jpg"></td>
                  </tr>
                  <tr>          
                    <td>○○○屋の○○ラーメン</td>
                    <td>○○○屋の天ぷらそば</td>
                    <td>○○○屋のスープカレー</td>
                  </tr>
                  <tr>
                    <td>スープカレー 心 湘南台西口店<br>14種類の野菜ともち豚 ¥1,280</td>          
                    <td>スープカレー 心 湘南台西口店<br>14種類の野菜ともち豚 ¥1,280</td>                    
                    <td>スープカレー 心 湘南台西口店<br>
                14種類の野菜ともち豚 ¥1,280</td>
                  </tr>
              <tr>
                <td width="230">自家製の極細麺は、冬の方が遥かに切れ味を感じて美味しい、水や空気の温度と合っているのではないでしょうか。
　スープとの相性に全く問題がなく、いい感じで持ち上げてくれます。</td>
                <td width="230">本格出雲蕎麦と、地元の新鮮食材を使用したセット・定食をご堪能ください。</td>
                <td width="230">15種類の野菜と果実のおいしさにこだわりました！ たっぷりのソテー・ド・オニオンと、 すりおろした野菜や果実を加え、小麦粉を使用せずに野菜の自然なとろみとおいしさで 仕上げたカレーです。</td>
              </tr>
            </tbody>
              </table>
               <table class="table table-striped course_table">
                <thead>
                  <tr>
                <th colspan="3"><h2><span class="fa fa-quote-left"></span>　私の案内するお勧めスポット！！</h2></th>
              </tr>
                </thead>
                <tbody>
                  <tr>          
                    <td><img src="../img/akarenga.jpg"></td>
                    <td><img src="../img/rainbow.jpg"></td>
                    <td><img src="../img/factory.jpg"></td>
                  </tr>
                  <tr>
                <td width="230">横浜赤レンガ倉庫</td>
                <td width="230">レインボーブリッジ</td>
                <td width="230">○○○屋のスープカレー</td>
              </tr>
                  <tr>
                <td width="230">神奈川県横浜市中区新港1-1</td>
                <td>━</td>                    
                    <td>━</td>
                  </tr>
            </tbody>
              </table>
                <table class="table table-striped course_table">
                <thead>
                  <tr>          
                    <th>名前</th>
                <th colspan="2">森純一郎</th>
              </tr>
                </thead>
                <tbody>
                  <tr>          
                    <td>ニックネーム</td>
                    <td>JUN</td>
              </tr>
                  <tr>          
                    <td>案内エリア</td>
                    <td>東京、横浜、埼玉</td>
              </tr>
                  <tr>
                    <td>対応言語</td>          
                    <td>英語、スペイン語</td>
              </tr>
                  <tr>
                    <td>最低時間</td>          
                    <td>8時間</td>
              </tr>
                  <tr>
                    <td>移動手段</td>          
                    <td>車（自己所有）、バス、電車</td>
              </tr>
                  <tr>          
                    <td>車の提供可能</td>
                    <td>OK</td>
              </tr>
                  <tr>          
                    <td>基本時間</td>
                    <td>9：00～18：00</td>
              </tr>
                  <tr>          
                    <td>朝早／夜遅</td>
                    <td>朝早OK：3,500／時間　夜遅OK：3,500</td>
              </tr>
                  <tr>
                    <td>専門</td>          
                    <td>英語、スペイン語</td>
              </tr>
                  <tr>
                    <td>年齢</td>          
                    <td>30歳～34歳</td>
              </tr>
                  <tr>
                    <td>現在の仕事</td>          
                    <td>飲み師</td>
              </tr>
                </tbody>
              </table>
             </div>
             <!-- start related course -->
<div class="pay"><a href="../host_entry/">Pay with PAYPAL</a></div>
             <div class="related_post">
              <h2>ユーザーレビュー</h2>
          　　　　　　　　　　 　　　　　　　　　　 　　　　　　　　　　 　　　　　　　　　　 　　　　　　　　　　 　　　　　　　　　　
          <table class="table table-striped course_table">
                <thead>
                  <tr>          
                    <th colspan="7">| 過去の評価</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>          
                    <td>◎</td>
                    <td>○</td>
                    <td>━</td>
                <td>△</td>
                <td>×</td>
                <td>休</td>
                    <td>欠</td>
                  </tr>
                  <tr>          
                    <td>5</td>
                    <td>0</td>
                    <td>3</td>
                <td>1</td>
                <td>2</td>
                <td>1</td>
                    <td>1</td>
                  </tr>
                  <tr>          
                    <td colspan="7"><b>★☆ユーザー投稿レビュー☆★</b><br><br> <?php
                        // If comments are open or we have at least one comment, load up the comment template
                        if ( comments_open() || '0' != get_comments_number() )
                            comments_template();
                        ?></td>
                  </tr>
                </tbody>
              </table>             
                <div class="row">
                </div>
              </div>
              <!-- End related course -->
            </div>
          </div>
          
     <?php get_sidebar();?>
          <?php get_footer(); ?>