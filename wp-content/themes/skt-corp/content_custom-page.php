<?php 
if (isset($_GET['amount']) and $_GET['amount']!=''){
    $data_get = array('status' => 'yes',
        'money_amount'=>intval($_GET['amount']));
     global  $wpdb;
    $wpdb->update( 'tour_reg', $data_get,  array( 'id' => intval($_GET['order_id'] ) ));
}
    if(isset($_POST['to_step_3']) and $_POST['to_step_3']=='yes')
    {
       
       $data_post = array('name_guest' => $_POST['t3di_guest'],
        'phone_guest' => $_POST['t0fl_guest'],
        'email_guest' => $_POST['t9hg_guest'],
        'code1_guest' => $_POST['t3gq_guest'],
        'code2_guest' => $_POST['t0sz_guest'],
        'quan_guest' => $_POST['s5bo_guest'],
        'tinh_guest' => $_POST['t4ii_guest'],
        'add_guest' => $_POST['t0pi_guest'],
        'name_tour' => $_POST['t5nm'],
        'topic_tour' => $_POST['c5kv'],
        'outline_tour' => $_POST['t0ym'],
        'schedule_tour' => $_POST['t1lr'],
        'start_tour' => $_POST['t0gb'],
        'age_taget' => $_POST['t6en'],
        'price_tour' => $_POST['t8sb'],
        'include_tour' => $_POST['t3ic'],
        'time_need' => $_POST['t2xk'],
        'language_tour' => $_POST['t6ki'],
        'food' => $_POST['t5gn'],
        'pickup' => $_POST['t0fd'],
        'holidays' => $_POST['t0mi'],
        'minimum_performers' => $_POST['t5lx'],
        'notes' => $_POST['t7ex'],
        'remarks' => $_POST['t4ti'],
        'inquiries' => $_POST['t0zz'],
        'person_charge'=>$_POST['t8ro'],
        'zone1' => $_POST['t5kf'],
        'zone2' => $_POST['t3hz'],
        'zone3' => $_POST['s0sx'],
        'zone4' => $_POST['t4bf'],
        'zone5' => $_POST['t1yt'],
        'phone_number' => $_POST['t4my'],
        'mail_address' => $_POST['t0qm'],
        'phone_number2' => $_POST['t4cf'],
        'file_zone1' => $_POST['file_f9og'],
        'file_zone2' => $_POST['file_f9oe'],
        'file_zone3' => $_POST['file_f5iq'],
        'file_zone4' => $_POST['file_f6ta'],
        'file_zone5' => $_POST['file_f7cv']
        );
       global  $wpdb;
       $wpdb->insert( 'tour_reg', $data_post);
       $lastInsertId = $wpdb->insert_id; 
       ?>
         <div class="header1" style="height:300px;background:url(../img/bannerpage3.jpg);background-size: cover;"></div>
         <div class="container">
            <div class="row main-content">
                <div class="col-md-6 col-xs-12 col-md-offset-3 left-content">
    <form action="https://www.sandbox.paypal.com/cgi-bin/webscr" method="post" target="_top">
    <input type="hidden" name="cmd" value="_xclick">
    <input type="hidden" name="business" value="congnn@bkindex.com">
    <input type="hidden" name="lc" value="US">
    <input type="hidden" name="item_name" value="By Tour">
    <input type="hidden" name="button_subtype" value="services">
    <input type="hidden" name="no_note" value="0">
    <input type="hidden" name="currency_code" value="USD">
    <input type="hidden" name="bn" value="PP-BuyNowBF:btn_buynowCC_LG.gif:NonHostedGuest">
    <table>
        <tr>
            <td colspan="2" style="text-align:center;">
                <input type="hidden" name="on0"  value="Package">情報
            </td>
        </tr>
        <tr>
                <th>お名前</th>
                <td>
                                   <?php echo $_POST['t3di_guest']; ?>       
                </td>
        </tr>
         <tr>
                <th>メールアドレス</th>
                <td>
                                  <?php echo $_POST['t9hg_guest']; ?>
                </td>
        </tr>
        <tr>
                <th>携帯番号</th>
                <td>
                                  <?php echo $_POST['t0fl_guest']; ?>
                </td>
        </tr>
        <tr>
                <th>お金</th>
                <td>
                                <input type="text" name="amount" id="amount"  value="">$
                </td>
        </tr>
      
    </table>
  <script type="text/javascript">
      $('#amount').change(function(){
        var order_id=$("#order_id").val();
        var amount=$(this).val();
        $("#return").val('http://tourjapan.lakita.vn/thankyou_tour?order_id='+ order_id+ '&amount='+amount)
      });
  </script>
    <!-- <input type="hidden" name="option_select0" value="Monthly Membership">
    <input type="hidden" name="option_amount0" value="10.00">
    <input type="hidden" name="option_select1" value="Life Membership">
    <input type="hidden" name="option_amount1" value="100.00">
    <input type="hidden" name="option_index" value="0">-->
    <input type="hidden" name="return" id="return" value="">
    <input type="hidden" name="rm" value="2">
    <input type="hidden" name="cancel_return" value="http://tourjapan.lakita.vn/tryagain">
    <input type="hidden" name="page_style" value="TestLocal">
    <input type="hidden" name="order_id" id="order_id" value="<?php echo  $lastInsertId; ?>">
    <div style="width: 100%;
    height: 150px;
    text-align: center;
    margin-top: 15px;">
    <input type="image" src="../img/paypal.png" border="0" name="submit" alt="PayPal - The safer, easier way to pay online!" value="支払う" style="
    width: 120px;
    border: none;
">
    <img alt="" border="0" src="https://www.paypalobjects.com/en_US/i/scr/pixel.gif" width="1" height="1">
    </div>
</form>
</div></div></div>
       <?php
    }
  else{
 ?>
<?php  
 if (isset($_POST['to_step_2']) and $_POST['to_step_2']=='yes'){
      $c5kv='';
        foreach ($_POST['c5kv'] as $key=>$value) {
            if($value!='') $c5kv.=$value." ";
        }
       ?>
       <div class="header1" style="height:300px;background:url(../img/bannerpage3.jpg);background-size: cover;"></div>
            <div class='row'>
              <div class="col-md-12 col-xs-12">
            <div class="tab-content">
                <div class="tab-pane active" id="tab1">
               <div class="container" style="max-width:769px;">
            <div id="mainform">
    <h2><a href="http://tourjapan.lakita.vn">ホストになる（通訳ガイド）エントリーフォーム</a></h2>
    <p class="step"><span>1. フォームの入力</span> → <em>2. 入力内容の確認</em> → <span>3. 送信完了</span></p>
    <form action="http://tourjapan.lakita.vn/tour_entry/" method="post">
        <fieldset>
            <legend> ゲストになる エントリーフォーム</legend>
            <input type="hidden" name="to_step_3" value="yes">
            <input type="hidden" name="t3di_guest" value="<?php echo $_POST['t3di_guest']; ?>">
            <input type="hidden" name="t0fl_guest" value="<?php echo $_POST['t0fl_guest']; ?>">
            <input type="hidden" name="t9hg_guest" value="<?php echo $_POST['t9hg_guest']; ?>">
            <input type="hidden" name="t3gq_guest" value="<?php echo $_POST['t3gq_guest']; ?>">
            <input type="hidden" name="t0sz_guest" value="<?php echo $_POST['t0sz_guest']; ?>">
            <input type="hidden" name="s5bo_guest" value="<?php echo $_POST['s5bo_guest']; ?>">
            <input type="hidden" name="t4ii_guest" value="<?php echo $_POST['t4ii_guest']; ?>">
            <input type="hidden" name="t0pi_guest" value="<?php echo $_POST['t0pi_guest']; ?>">
            <input type="hidden" name="t5nm" value="<?php echo $_POST['t5nm']; ?>">
            <input type="hidden" name="c5kv" value="<?php echo $c5kv ;?>">
            <input type="hidden" name="t0ym" value="<?php echo $_POST['t0ym']; ?>">
            <input type="hidden" name="t1lr" value="<?php echo $_POST['t1lr'] ;?>">
            <input type="hidden" name="t0gb" value="<?php echo $_POST['t0gb'] ;?>">
            <input type="hidden" name="t6en" value="<?php echo $_POST['t6en'] ;?>">
            <input type="hidden" name="t8sb" value="<?php echo $_POST['t8sb']; ?>">
            <input type="hidden" name="t3ic" value="<?php echo $_POST['t3ic']; ?>">
            <input type="hidden" name="t2xk" value="<?php echo $_POST['t2xk']; ?>">
            <input type="hidden" name="t6ki" value="<?php echo $_POST['t6ki']; ?>">
            <input type="hidden" name="t5gn" value="<?php echo $_POST['t5gn']; ?>">
            <input type="hidden" name="t0fd" value="<?php echo $_POST['t0fd']; ?>">
            <input type="hidden" name="t0mi" value="<?php echo $_POST['t0mi']; ?>">
            <input type="hidden" name="t5lx" value="<?php echo $_POST['t5lx']; ?>">
            <input type="hidden" name="t7ex" value="<?php echo $_POST['t7ex']; ?>">
            <input type="hidden" name="t4ti" value="<?php echo $_POST['t4ti']; ?>">
            <input type="hidden" name="t0zz" value="<?php echo $_POST['t0zz']; ?>">
            <input type="hidden" name="t8ro" value="<?php echo $_POST['t8ro']; ?>">
            <input type="hidden" name="t5kf" value="<?php echo $_POST['t5kf']; ?>">
            <input type="hidden" name="t3hz" value="<?php echo $_POST['t3hz']; ?>">
            <input type="hidden" name="s0sx" value="<?php echo $_POST['s0sx']; ?>">
            <input type="hidden" name="t4bf" value="<?php echo $_POST['t4bf']; ?>">
            <input type="hidden" name="t1yt" value="<?php echo $_POST['t1yt']; ?>">
            <input type="hidden" name="t4my" value="<?php echo $_POST['t4my']; ?>">
            <input type="hidden" name="t0qm" value="<?php echo $_POST['t0qm']; ?>">
            <input type="hidden" name="t4cf" value="<?php echo $_POST['t4cf']; ?>">
          
          
         <input type="hidden" name="file_f9og" value="<?php echo $_FILES['f9og']['name']; ?>">
          <input type="hidden" name="file_f9oe" value="<?php echo $_FILES['f9oe']['name']; ?>">
           <input type="hidden" name="file_f5iq" value="<?php echo $_FILES['f5iq']['name']; ?>">
           <input type="hidden" name="file_f6ta" value="<?php echo $_FILES['f6ta']['name']; ?>">
           <input type="hidden" name="file_f7cv" value="<?php echo $_FILES['f7cv']['name']; ?>">
          
           
           <table>
                <tbody>
                <tr>
                <th>お名前<em class="required">※</em></th>
                <td>
                     <?php echo $_POST['t3di_guest']; ?>              
                </td>
                </tr>
                <tr>
                <th>携帯番号<em class="required">※</em></th>
                <td>x
                                  <?php echo $_POST['t0fl_guest']; ?>                 
                                                  </td>
                </tr>
                <tr>
                <th>メールアドレス<em class="required">※</em></th>
                <td><?php echo $_POST['t9hg_guest']; ?>
                </td>
                </tr>
                <tr>
                <th>住所<em class="required">※</em></th>
                <td>
                <span>郵便番号:</span><?php echo $_POST['t3gq_guest']; ?>-<?php echo $_POST['t0sz_guest']; ?>
                 </br><span>都道府県:</span><?php echo $_POST['s5bo_guest']; ?>
                 </br><span class="lside">市区町村</span><?php echo $_POST['t4ii_guest']; ?>
                  </br><span class="lside">番地建物</span><?php echo $_POST['t0pi_guest']; ?>
                  </td>
                </tr>
                </tbody>
                </table>
            <br>  
             <legend>ツアーエントリー...</legend>  
           <table summary="確認内容">
                <tbody><tr>
                    <th>ツアータイトル<em class="required">※</em></th>
                    <td>
                        <?php echo $_POST['t5nm'] ;?></td>          
                </tr>
                <tr>
                    <th>ツアーテーマ<em class="required">※</em></th>
                    <td>
                        <?php echo $c5kv ;?></td>           
                </tr>
                <tr>
                    <th>ツアー概要・ＰＲ<em class="required">※</em></th>
                    <td>
                        <?php echo $_POST['t0ym'] ;?></td>
                </tr>
                <tr>
                    <th>ツアースケジュールイメージ<em class="required">※</em></th>
                    <td>
                        <?php echo $_POST['t1lr'] ;?></td>
                </tr>
                <tr>
                    <th>出発地<em class="required">※</em></th>
                    <td>
                        <?php echo $_POST['t0gb'] ;?></td>
                </tr>
                <tr>
                    <th>対象年齢<em class="required">※</em></th>
                    <td>
                        <?php echo $_POST['t6en'] ;?></td>
                </tr>
                <tr>
                    <th>ツアー料金<em class="required">※</em></th>
                    <td>
                        <?php echo $_POST['t8sb'] ;?></td>
                </tr>
                <tr>
                    <th>料金に含まれるもの<em class="required">※</em></th>
                    <td>
                    <?php echo $_POST['t3ic'] ;?></td>
                </tr>
                <tr>
                    <th>所要時間<em class="required">※</em></th>
                    <td>
                        <?php echo $_POST['t2xk'] ;?></td>
                </tr>
                <tr>
                    <th>対応言語<em class="required">※</em></th>
                    <td>
                        <?php echo $_POST['t6ki'] ;?></td>
                </tr>
                <tr>
                    <th>食事の有無<em class="required">※</em></th>
                    <td>
                        <?php echo $_POST['t5gn'] ;?></td>
                </tr>
                <tr>
                    <th>送迎の有無<em class="required">※</em></th>
                    <td>
                        <?php echo $_POST['t0fd'] ;?></td>
                </tr>
                <tr>
                    <th>開催曜日<em class="required">※</em></th>
                    <td>
                        <?php echo $_POST['t0mi'] ;?></td>
                </tr>
                <tr>
                    <th>最少遂行人数<em class="required">※</em></th>
                    <td>
                        <?php echo $_POST['t5lx'] ;?></td>
                </tr>
                <tr>
                    <th>注意事項<em class="required">※</em></th>
                    <td>
                        <?php echo $_POST['t7ex'] ;?></td>
                </tr>
                <tr>
                    <th>備考<em class="required">※</em></th>
                    <td>
                        <?php echo $_POST['t4ti'] ;?></td>
                </tr>
                <tr>
                    <th>お問い合わせ先＜会社名・団体名＞<em class="required">※</em></th>
                    <td>
                        <?php echo $_POST['t0zz'] ;?></td>
                </tr>
                <tr>
                    <th>ご担当者名<em class="required">※</em></th>
                    <td>
                        <?php echo $_POST['t8ro'] ;?></td>
                </tr>
                <tr>
                    <th>住所<em class="required">※</em></th>
                    <td>
                        <?php echo $_POST['t5kf'] ;?>-<?php echo $_POST['t3hz'] ;?><br>
                        <?php echo $_POST['s0sx'] ;?><br>
                        <?php echo $_POST['t4bf'] ;?><br>
                        <?php echo $_POST['t1yt'] ;?></td>
                </tr>
                <tr>
                    <th>電話番号<em class="required">※</em></th>
                    <td>
                        <?php echo $_POST['t4my'] ;?></td>
                </tr>
                <tr>
                    <th>メールアドレス<em class="required">※</em></th>
                    <td>
                        <?php echo $_POST['t0qm'] ;?></td>
                </tr>
                <tr>
                    <th>携帯番号<em class="required">※</em></th>
                    <td>
                        <?php echo $_POST['t4cf'] ;?></td>
                </tr>
                <tr>
                    <th>イメージ写真</th>
                    <td>
                        <?php echo $_FILES['f9og']['name']; ?><br>
                        <?php echo $_FILES['f9oe']['name']; ?><br>
                        <?php echo $_FILES['f5iq']['name']; ?><br>
                        <?php echo $_FILES['f6ta']['name']; ?><br>
                        <?php echo $_FILES['f7cv']['name']; ?></td>
                </tr>
            </tbody></table>
            <p class="submit_bt_wrap">
                <input type="reset" value="やり直す" onclick="history.back();return false;">
                <input type="submit" value="内容を送信する">
            </p>
        </fieldset>
    </form>
</div>


         
            </div>  </div>
   
</div>
            </div>
 </div>

       <?php } else { ?>

        <?php the_content(); ?>
        <?php
            wp_link_pages( array(
                'before' => '<div class="page-links">' . __( 'Pages:', 'skt-corp' ),
                'after'  => '</div>',
            ) );
       }
    }
        ?>

    <?php //edit_post_link( __( 'Edit', 'skt-corp' ), '<footer class="entry-meta"><span class="edit-link">', '</span></footer>' ); ?>