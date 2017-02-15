<?php 
if (isset($_GET['amount']) and $_GET['amount']!=''){
    $data_get = array('status' => 'yes',
        'money_amount'=>intval($_GET['amount']));
     global  $wpdb;
    $wpdb->update( 'house_reg', $data_get,  array( 'id' => intval($_GET['order_id'] ) ));
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
        'name_house' => $_POST['t0zz'],
        'ngu_am' => $_POST['t7pa'],
        'price_one_night' => $_POST['t8sb'],
         'zone1' => $_POST['t5kf'],
        'zone2' => $_POST['t3hz'],
        'zone3' => $_POST['s0sx'],
        'zone4' => $_POST['t4bf'],
        'zone5' => $_POST['t1yt'],
        'phone_number' => $_POST['t4my'],
         'mail_address' => $_POST['t0qm'],
         'phone_number2' => $_POST['t4cf'],
        'property_type' => $_POST['c6ux'],
        'bet_type' => $_POST['c7jj'],
        'guests_allowed' => $_POST['c2aw'],
        'bathroom' => $_POST['c2cp'],
        'bet_number' => $_POST['c1in'],
        'amenity' => $_POST['c9qd'],
        'facility' => $_POST['c7vj'],
        'other' => $_POST['c7bz'],
        'minimum_nights' => $_POST['t0mc'],
        'check_in' => $_POST['t8vp'],
        'check_out' => $_POST['t9ju'],
        'cleaning_fee' => $_POST['c1jz'],
        'separate_cleaning_fee' => $_POST['t4ai'],
        'file_zone1' => $_POST['file_f9og'],
        'file_zone2' => $_POST['file_f9oe'],
        'file_zone3' => $_POST['file_f5iq'],
        'file_zone4' => $_POST['file_f8ss'],
        'file_zone5' => $_POST['file_f4vl'],
         'file_zone6' => $_POST['file_f7fh'],
        'file_zone7' => $_POST['file_f1iw'],
        'file_zone8' => $_POST['file_f2va'],
        'file_zone9' => $_POST['file_f3jx'],
         'file_zone10' => $_POST['file_f6oc'],
        'file_zone11' => $_POST['file_f1uw'],
        'file_zone12' => $_POST['file_f6ta'],
        'file_zone13' => $_POST['file_f2ab'],
         'file_zone14' => $_POST['file_f7cv'],
        'file_zone15' => $_POST['file_f0tv'],
         'homepage_url' => $_POST['t6rs']
      
      
        );
       global  $wpdb;
       $wpdb->insert( 'house_reg', $data_post);
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
        $("#return").val('http://tourjapan.lakita.vn/thankyou_house?order_id='+ order_id+ '&amount='+amount)
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
 	  $c6ux='';
        foreach ($_POST['c6ux'] as $key=>$value) {
            if($value!='') $c6ux.=$value.",";
        }
         $c7jj='';
        foreach ($_POST['c7jj'] as $key=>$value) {
            if($value!='') $c7jj.=$value.",";
        }
         $c2aw='';
        foreach ($_POST['c2aw'] as $key=>$value) {
            if($value!='') $c2aw.=$value.",";
        }
         $c2cp='';
        foreach ($_POST['c2cp'] as $key=>$value) {
            if($value!='') $c2cp.=$value.",";
        }
         $c1in='';
        foreach ($_POST['c1in'] as $key=>$value) {
            if($value!='') $c1in.=$value.",";
        }
         $c9qd='';
        foreach ($_POST['c9qd'] as $key=>$value) {
            if($value!='') $c9qd.=$value.",";
        }
         $c7vj='';
        foreach ($_POST['c7vj'] as $key=>$value) {
            if($value!='') $c7vj.=$value.",";
        }
          $c7bz='';
        foreach ($_POST['c7bz'] as $key=>$value) {
            if($value!='') $c7bz.=$value.",";
        }
         $c1jz='';
        foreach ($_POST['c1jz'] as $key=>$value) {
            if($value!='') $c1jz.=$value.",";
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
    <form action="http://tourjapan.lakita.vn/hause_entry/" method="post">
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
            <input type="hidden" name="t0zz" value="<?php echo $_POST['t0zz']; ?>">
            <input type="hidden" name="t7pa" value="<?php echo $_POST['t7pa']; ?>">
            <input type="hidden" name="t8sb" value="<?php echo $_POST['t8sb'] ;?>">
            <input type="hidden" name="t5kf" value="<?php echo $_POST['t5kf'] ;?>">
            <input type="hidden" name="t3hz" value="<?php echo $_POST['t3hz'] ;?>">
            <input type="hidden" name="s0sx" value="<?php echo $_POST['s0sx']; ?>">
            <input type="hidden" name="t4bf" value="<?php echo $_POST['t4bf']; ?>">
            <input type="hidden" name="t1yt" value="<?php echo $_POST['t1yt']; ?>">
            <input type="hidden" name="t4my" value="<?php echo $_POST['t4my']; ?>">
            <input type="hidden" name="t0qm" value="<?php echo $_POST['t0qm']; ?>">
            <input type="hidden" name="t4cf" value="<?php echo $_POST['t4cf']; ?>">
            <input type="hidden" name="c6ux" value="<?php echo $c6ux; ?>">
            <input type="hidden" name="c7jj" value="<?php echo $c7jj; ?>">
            <input type="hidden" name="c2aw" value="<?php echo $c2aw; ?>">
            <input type="hidden" name="c2cp" value="<?php echo $c2cp; ?>">
             <input type="hidden" name="c1in" value="<?php echo $c1in; ?>">
             <input type="hidden" name="c9qd" value="<?php echo $c9qd; ?>">
             <input type="hidden" name="c7vj" value="<?php echo $c7vj; ?>">
             <input type="hidden" name="c7bz" value="<?php echo $c7bz; ?>">
            <input type="hidden" name="t0mc" value="<?php echo $_POST['t0mc']; ?>">
            <input type="hidden" name="t8vp" value="<?php echo $_POST['t8vp']; ?>">
            <input type="hidden" name="t9ju" value="<?php echo $_POST['t9ju']; ?>">
            <input type="hidden" name="c1jz" value="<?php echo $c1jz; ?>">
            <input type="hidden" name="t4ai" value="<?php echo $_POST['t4ai']; ?>">

            <input type="hidden" name="file_f9og" value="<?php echo $_FILES['f9og']['name']; ?>">
          <input type="hidden" name="file_f9oe" value="<?php echo $_FILES['f9oe']['name']; ?>">
           <input type="hidden" name="file_f5iq" value="<?php echo $_FILES['f5iq']['name']; ?>">
           <input type="hidden" name="file_f8ss" value="<?php echo $_FILES['f8ss']['name']; ?>">
           <input type="hidden" name="file_f4vl" value="<?php echo $_FILES['f4vl']['name']; ?>">
            <input type="hidden" name="file_f7fh" value="<?php echo $_FILES['f7fh']['name']; ?>">
          <input type="hidden" name="file_f1iw" value="<?php echo $_FILES['f1iw']['name']; ?>">
           <input type="hidden" name="file_f2va" value="<?php echo $_FILES['f2va']['name']; ?>">
           <input type="hidden" name="file_f3jx" value="<?php echo $_FILES['f3jx']['name']; ?>">
           <input type="hidden" name="file_f6oc" value="<?php echo $_FILES['f6oc']['name']; ?>">
            <input type="hidden" name="file_f1uw" value="<?php echo $_FILES['f1uw']['name']; ?>">
          <input type="hidden" name="file_f6ta" value="<?php echo $_FILES['f6ta']['name']; ?>">
           <input type="hidden" name="file_f2ab" value="<?php echo $_FILES['f2ab']['name']; ?>">
           <input type="hidden" name="file_f7cv" value="<?php echo $_FILES['f7cv']['name']; ?>">
           <input type="hidden" name="file_f0tv" value="<?php echo $_FILES['f0tv']['name']; ?>">


            <input type="hidden" name="t6rs" value="<?php echo $_POST['t6rs']; ?>">
          
           
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
                    <th>お名前<em class="required">※</em></th>
                    <td>
                       <?php echo $_POST['t0zz']; ?>  </td>
                </tr>
                <tr>
                    <th>フリガナ<em class="required">※</em></th>
                    <td>
                     <?php echo $_POST['t7pa']; ?>  </td>
                </tr>
                <tr>
                    <th>料金（1泊あたり）<em class="required">※</em></th>
                    <td>
                     <?php echo $_POST['t8sb']; ?>   </td>
                </tr>
                <tr>
                    <th>物件住所<em class="required">※</em></th>
                    <td>
                       <?php echo $_POST['t5kf']; ?>-<?php echo $_POST['t3hz']; ?><br>
                        <?php echo $_POST['s0sx']; ?><br>
                        <?php echo $_POST['t4bf']; ?><br>
                        <?php echo $_POST['t1yt']; ?>                </td>
                </tr>
                <tr>
                    <th>電話番号<em class="required">※</em></th>
                    <td>
                       <?php echo $_POST['t4my']; ?>         </td>
                </tr>
                <tr>
                    <th>メールアドレス<em class="required">※</em></th>
                    <td>
                     <?php echo $_POST['t0qm']; ?>                   </td>
                </tr>
                <tr>
                    <th>携帯番号<em class="required">※</em></th>
                    <td>
                       <?php echo $_POST['t4cf']; ?>    </td>
                </tr>
                <tr>
                    <th>物件タイプ<em class="required">※</em></th>
                    <td>
                     <?php echo $c6ux; ?>             </td>
                </tr>
                <tr>
                    <th>ベットタイプ<em class="required">※</em></th>
                    <td>
                      <?php echo $c7jj; ?>  </td>
                </tr>
                <tr>
                    <th>宿泊可能人数<em class="required">※</em></th>
                    <td>
                     <?php echo $c2aw; ?>  </td>
                </tr>
                <tr>
                    <th>バスルーム<em class="required">※</em></th>
                    <td>
                     <?php echo $c2cp; ?>     </td>
                </tr>
                <tr>
                    <th>ベット数<em class="required">※</em></th>
                    <td>
                     <?php echo $c1in; ?>   </td>
                </tr>
                <tr>
                    <th>アメニティ<em class="required">※</em></th>
                    <td>
                       <?php echo $c9qd; ?>    </td>
                </tr>
                <tr>
                    <th>設備<em class="required">※</em></th>
                    <td>
                      <?php echo $c7vj; ?>               </td>
                </tr>
                <tr>
                    <th>その他<em class="required">※</em></th>
                    <td>
                       <?php echo $c7bz; ?>               </td>
                </tr>
                <tr>
                    <th>最低泊数<em class="required">※</em></th>
                    <td>
                     <?php echo $_POST['t0mc']; ?>            </td>
                </tr>
                <tr>
                    <th>チェックイン<em class="required">※</em></th>
                    <td>
                       <?php echo $_POST['t8vp']; ?>         </td>
                </tr>
                <tr>
                    <th>チェックアウト<em class="required">※</em></th>
                    <td>
                   <?php echo $_POST['t9ju']; ?>              </td>
                </tr>
                <tr>
                    <th>清掃代<em class="required">※</em></th>
                    <td>
                     <?php echo $c1jz; ?>   </td>
                </tr>
                <tr>
                    <th>清掃代が別途の場合の料金</th>
                    <td>
                    <?php echo $_POST['t4ai']; ?>              </td>
                </tr>
                <tr>
                    <th>写真</th>
                    <td>
                      <?php echo $_FILES['f9og']['name']; ?><br>
                      <?php echo $_FILES['f9oe']['name']; ?><br>
                      <?php echo $_FILES['f5iq']['name']; ?><br>
                     <?php echo $_FILES['f8ss']['name']; ?><br>
                     <?php echo $_FILES['f4vl']['name']; ?><br>
                     <?php echo $_FILES['f7fh']['name']; ?><br>
                      <?php echo $_FILES['f1iw']['name']; ?><br>
                      <?php echo $_FILES['f2va']['name']; ?><br>
                     <?php echo $_FILES['f3jx']['name']; ?><br>
                     <?php echo $_FILES['f6oc']['name']; ?><br>
                     <?php echo $_FILES['f1uw']['name']; ?><br>
                      <?php echo $_FILES['f6ta']['name']; ?><br>
                     <?php echo $_FILES['f2ab']['name']; ?><br>
                   <?php echo $_FILES['f7cv']['name']; ?><br>
                 <?php echo $_FILES['f0tv']['name']; ?>        </td>
                </tr>
                <tr>
                    <th>ホームページURL</th>
                    <td>
                       <?php echo $_POST['t6rs']; ?>              </td>
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