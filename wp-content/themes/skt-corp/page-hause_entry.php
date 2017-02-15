<?php get_header();?>
<div class="header1" style="height:300px;background:url(../img/bannerpage3.jpg);background-size: cover;">
  <div class="title-top"> 
      <h2>ツアーエントリーフォーム</h2>
  </div>
</div>
<div class="col-md-12 col-xs-12 " id="step">
    <div class='container'>
      <div class='row'> 
        <div class="col-md-8  col-md-offset-2 col-xs-12  row step">
            <ul class="progress-indicator">
                <li class="completed">
                    <span class="bubble"><span class="num-step">1</span></span>
                    <span class="title-step">Form of input</span> 
                </li>
                <li class="completed">
                    <span class="bubble"><span class="num-step">2</span></span>
                    <span class="title-step">Confirmation of input content</span> 
                </li>
                <li class="completed">
                    <span class="bubble"><span class="num-step">3</span></span>
                    <span class="title-step">Transmission completion</span> 
                </li>
                <li class="completed">
                    <span class="bubble bubble-last"><span class="num-step num-step-last">4</span></span>
                    <span class="title-step">Completion</span> 
                </li>
            </ul>
            
         </div>
      </div>
    </div>
</div>
<div class='row'>
  <div class="col-md-12 col-xs-12">
<div class="tab-content">
    <div class="tab-pane active" id="tab1" style="background: url(../bg-container.jpg);">
       <!-- container -->
      
                  <div class="container" style="/*max-width:769px;*/" id="wrap-host">
                      
                       <!--  mainform -->
                        <div id="mainform">
                          <p></p>
                          <br />
                          <h2 class="text-center"><a href="http://extourjapan.lakita.vn/">ツアーエントリーフォーム</a></h2>
                          <!-- <p class="step"><em>1. Enter form</em> → <span>2. Confirmation of input contents</span> → <span>3. send completely</span></p> -->
                          <div class="inner-host">
                            <?php
                              $arg_host = array(
                                  'category_name' => 'hostguide',
                                  'post_status' => 'publish',
                                  'post_per_page'=> 1,
                              );

                              $query_host = new WP_Query($arg_host);

                              while( $query_host->have_posts() ) : $query_host->the_post();
                            ?>
                            <div class="row">
                             <div class="col-md-8 col-md-offset-2 col-xs-12 title-info">
                                 <?php the_title();?>
                             </div>
                             <div class="col-md-8 col-md-offset-2 col-xs-12 info-host">
                                 <div><?php the_content();?></div>
                             </div>
                             </div>
                             <?php
                                endwhile;
                                wp_reset_postdata();
                              ?>
                            </div>
                          </div>
                              
<?php 
if (isset($_GET['amount']) and $_GET['amount']!=''){
    $data_get = array('status' => 'yes',
        'money_amount'=>intval($_GET['amount']));
     global  $wpdb;
    $wpdb->update( 'house_reg', $data_get,  array( 'id' => intval($_GET['order_id'] ) ));
}
    if(isset($_POST['to_step_3']) and $_POST['to_step_3']=='yes') :?> <?php
    	
       $data_post = array(
       	'name_guest' => $_POST['t3di_guest'],
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
       
       $status = $wpdb->insert( 'house_reg', $data_post);       
       
       $lastInsertId = $wpdb->insert_id; 

       ?>
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
                                   <?php echo $_POST['t0zz']; ?>       
                </td>
        </tr>
         <tr>
                <th>メールアドレス</th>
                <td>
                                  <?php echo   $_POST['t0qm']; ?>
                </td>
        </tr>
        <tr>
                <th>携帯番号</th>
                <td>
                                  <?php echo $_POST['t4my']; ?>
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
        $("#return").val('<?php echo esc_url(home_url('/'));?>thankyou_house?order_id='+ order_id+ '&amount='+amount)
      });
  </script>
    <!-- <input type="hidden" name="option_select0" value="Monthly Membership">
    <input type="hidden" name="option_amount0" value="10.00">
    <input type="hidden" name="option_select1" value="Life Membership">
    <input type="hidden" name="option_amount1" value="100.00">
    <input type="hidden" name="option_index" value="0">-->
    <input type="hidden" name="return" id="return" value="">
    <input type="hidden" name="rm" value="2">
    <input type="hidden" name="cancel_return" value="<?php echo esc_url(home_url('/'));?>tryagain">
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
<?php endif;
 ?>
<?php  
 if (isset($_POST['to_step_2']) and $_POST['to_step_2']=='yes'):?><?php
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
   <form action="<?php echo esc_url(home_url('/'));?>hause_entry/" method="post">
        <fieldset>
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
<?php endif;?>
 <?php if (!isset($_POST['to_step_2']) && !isset($_POST['to_step_3'])):?>                          
   <form action="<?php echo esc_url(home_url('/'));?>hause_entry/" method="post" enctype="multipart/form-data" accept-charset="utf-8">
							<input type="hidden" name="to_step_2" value="yes">
                              <fieldset>
                            <fieldset>
                              <legend>ホストになる（ゲストハウス）エントリー...</legend>
                            <table>
				<tbody><tr>
					<th>お名前<em class="required">※</em></th>
					<td>
						
						<input type="text" id="t0zz" required name="t0zz" size="60" value="" maxlength="300">
					</td>
				</tr>
				<tr>
					<th>フリガナ<em class="required">※</em></th>
					<td>
						
						<input type="text" required id="t7pa" name="t7pa" size="60" value="" maxlength="300">
					</td>
				</tr>
				<tr>
					<th>料金（1泊あたり）<em class="required">※</em></th>
					<td>
						
						<input type="text" id="t8sb" required name="t8sb" size="60" value="" maxlength="300">
					</td>
				</tr>
				<tr>
					<th>物件住所<em class="required">※</em></th>
					<td>
						<span class="lside">郵便番号</span><input type="text" required id="t5kf" name="t5kf" size="4" value="" maxlength="3"><span class="rside">-</span><input type="text" required id="t3hz" name="t3hz" size="7" value="" maxlength="4"><br>
						<span class="lside">都道府県</span><select id="s0sx" required name="s0sx" size="1">
							<option value="">----</option>
							<optgroup label="北海道">
								<option value="北海道">北海道</option>
							</optgroup>
							<optgroup label="東北">
								<option value="青森県">青森県</option>
								<option value="岩手県">岩手県</option>
								<option value="宮城県">宮城県</option>
								<option value="秋田県">秋田県</option>
								<option value="山形県">山形県</option>
								<option value="福島県">福島県</option>
							</optgroup>
							<optgroup label="関東">
								<option value="茨城県">茨城県</option>
								<option value="栃木県">栃木県</option>
								<option value="群馬県">群馬県</option>
								<option value="埼玉県">埼玉県</option>
								<option value="千葉県">千葉県</option>
								<option value="東京都">東京都</option>
								<option value="神奈川県">神奈川県</option>
								<option value="山梨県">山梨県</option>
							</optgroup>
							<optgroup label="信越">
								<option value="長野県">長野県</option>
								<option value="新潟県">新潟県</option>
							</optgroup>
							<optgroup label="北陸">
								<option value="富山県">富山県</option>
								<option value="石川県">石川県</option>
								<option value="福井県">福井県</option>
							</optgroup>
							<optgroup label="東海">
								<option value="岐阜県">岐阜県</option>
								<option value="静岡県">静岡県</option>
								<option value="愛知県">愛知県</option>
								<option value="三重県">三重県</option>
							</optgroup>
							<optgroup label="近畿">
								<option value="滋賀県">滋賀県</option>
								<option value="京都府">京都府</option>
								<option value="大阪府">大阪府</option>
								<option value="兵庫県">兵庫県</option>
								<option value="奈良県">奈良県</option>
								<option value="和歌山県">和歌山県</option>
							</optgroup>
							<optgroup label="中国">
								<option value="鳥取県">鳥取県</option>
								<option value="島根県">島根県</option>
								<option value="岡山県">岡山県</option>
								<option value="広島県">広島県</option>
								<option value="山口県">山口県</option>
							</optgroup>
							<optgroup label="四国">
								<option value="徳島県">徳島県</option>
								<option value="香川県">香川県</option>
								<option value="愛媛県">愛媛県</option>
								<option value="高知県">高知県</option>
							</optgroup>
							<optgroup label="九州">
								<option value="福岡県">福岡県</option>
								<option value="佐賀県">佐賀県</option>
								<option value="長崎県">長崎県</option>
								<option value="熊本県">熊本県</option>
								<option value="大分県">大分県</option>
								<option value="宮崎県">宮崎県</option>
								<option value="鹿児島県">鹿児島県</option>
							</optgroup>
							<optgroup label="沖縄県">
								<option value="沖縄県">沖縄県</option>
							</optgroup>
							<optgroup label="海外">
								<option value="海外">海外</option>
							</optgroup>
						</select><br>
						<span class="lside">市区町村</span><input type="text" required  id="t4bf" name="t4bf" size="60" value="" maxlength="300"><br>
						<span class="lside">番地建物</span><input type="text" required id="t1yt" name="t1yt" size="60" value="" maxlength="300">
					</td>
				</tr>
				<tr>
					<th>電話番号<em class="required">※</em></th>
					<td>
						
						<input type="text" required id="t4my" name="t4my" size="60" value="" maxlength="300"><br>
						<span class="bside">ハイフン不要</span>
					</td>
				</tr>
				<tr>
					<th>メールアドレス<em class="required">※</em></th>
					<td>
						
						<input type="text" id="t0qm" required name="t0qm" size="60" value="" maxlength="300"><br>
						<span class="bside">例： info@example.com</span>
					</td>
				</tr>
				<tr>
					<th>携帯番号<em class="required">※</em></th>
					<td>
						
						<input type="text" id="t4cf" required name="t4cf" size="60" value=""  oninput="maxLengthCheck11(this)" maxlength="11"><br>
						<span class="bside">例： 09011112222 (ハイフン不要)</span>
					</td>
				</tr>
				<tr>
					<th>物件タイプ<em class="required">※</em></th>
					<td>
						
						<span id="c6ux" class="checkbox">
							<label for="c6ux0"><input type="checkbox" id="c6ux0" name="c6ux[]" value="□まるまる貸切">□まるまる貸切</label>
							<label for="c6ux1"><input type="checkbox" id="c6ux1" name="c6ux[]" value="・戸建">・戸建</label>
							<label for="c6ux2"><input type="checkbox" id="c6ux2" name="c6ux[]" value="・マンション">・マンション</label>
							<label for="c6ux3"><input type="checkbox" id="c6ux3" name="c6ux[]" value="・アパート">・アパート</label>
							<label for="c6ux4"><input type="checkbox" id="c6ux4" name="c6ux[]" value="□シェアルーム">□シェアルーム</label>
							<label for="c6ux5"><input type="checkbox" id="c6ux5" name="c6ux[]" value="・洋室">・洋室</label>
							<label for="c6ux6"><input type="checkbox" id="c6ux6" name="c6ux[]" value="・和室">・和室</label>
							<label for="c6ux7"><input type="checkbox" id="c6ux7" name="c6ux[]" value="□個室（ホスト同居）">□個室（ホスト同居）</label>
							<label for="c6ux8"><input type="checkbox" id="c6ux8" name="c6ux[]" value="・洋室">・洋室</label>
							<label for="c6ux9"><input type="checkbox" id="c6ux9" name="c6ux[]" value="・和室">・和室</label>
							<label for="c6ux10"><input type="checkbox" id="c6ux10" name="c6ux[]" value="□個室（ホスト別居）">□個室（ホスト別居）</label>
							<label for="c6ux11"><input type="checkbox" id="c6ux11" name="c6ux[]" value="・洋室">・洋室</label>
							<label for="c6ux12"><input type="checkbox" id="c6ux12" name="c6ux[]" value="・和室">・和室</label>
						</span>
					</td>
				</tr>
				<tr>
					<th>ベットタイプ<em class="required">※</em></th>
					<td>
						
						<span id="c7jj" class="checkbox">
							<label for="c7jj0"><input type="checkbox" id="c7jj0" name="c7jj[]" value="ベット">ベット</label>
							<label for="c7jj1"><input type="checkbox" id="c7jj1" name="c7jj[]" value="和式布団">和式布団</label>
						</span>
					</td>
				</tr>
				<tr>
					<th>宿泊可能人数<em class="required">※</em></th>
					<td>
						
						<span id="c2aw" class="checkbox">
							<label for="c2aw0"><input type="checkbox" id="c2aw0" name="c2aw[]" value="1人">1人</label>
							<label for="c2aw1"><input type="checkbox" id="c2aw1" name="c2aw[]" value="2人">2人</label>
							<label for="c2aw2"><input type="checkbox" id="c2aw2" name="c2aw[]" value="3人">3人</label>
							<label for="c2aw3"><input type="checkbox" id="c2aw3" name="c2aw[]" value="4人">4人</label>
							<label for="c2aw4"><input type="checkbox" id="c2aw4" name="c2aw[]" value="5人">5人</label>
							<label for="c2aw5"><input type="checkbox" id="c2aw5" name="c2aw[]" value="6人">6人</label>
							<label for="c2aw6"><input type="checkbox" id="c2aw6" name="c2aw[]" value="7人">7人</label>
							<label for="c2aw7"><input type="checkbox" id="c2aw7" name="c2aw[]" value="8人">8人</label>
							<label for="c2aw8"><input type="checkbox" id="c2aw8" name="c2aw[]" value="9人">9人</label>
							<label for="c2aw9"><input type="checkbox" id="c2aw9" name="c2aw[]" value="10人">10人</label>
							<label for="c2aw10"><input type="checkbox" id="c2aw10" name="c2aw[]" value="10人～">10人～</label>
						</span>
					</td>
				</tr>
				<tr>
					<th>バスルーム<em class="required">※</em></th>
					<td>
						
						<span id="c2cp" class="checkbox">
							<label for="c2cp0"><input type="checkbox" id="c2cp0" name="c2cp[]" value="1">1</label>
							<label for="c2cp1"><input type="checkbox" id="c2cp1" name="c2cp[]" value="2">2</label>
							<label for="c2cp2"><input type="checkbox" id="c2cp2" name="c2cp[]" value="3">3</label>
							<label for="c2cp3"><input type="checkbox" id="c2cp3" name="c2cp[]" value="4">4</label>
							<label for="c2cp4"><input type="checkbox" id="c2cp4" name="c2cp[]" value="5">5</label>
							<label for="c2cp5"><input type="checkbox" id="c2cp5" name="c2cp[]" value="5～">5～</label>
						</span>
					</td>
				</tr>
				<tr>
					<th>ベット数<em class="required">※</em></th>
					<td>
						
						<span id="c1in" class="checkbox">
							<label for="c1in0"><input type="checkbox" id="c1in0" name="c1in[]" value="1">1</label>
							<label for="c1in1"><input type="checkbox" id="c1in1" name="c1in[]" value="2">2</label>
							<label for="c1in2"><input type="checkbox" id="c1in2" name="c1in[]" value="3">3</label>
							<label for="c1in3"><input type="checkbox" id="c1in3" name="c1in[]" value="4">4</label>
							<label for="c1in4"><input type="checkbox" id="c1in4" name="c1in[]" value="5">5</label>
							<label for="c1in5"><input type="checkbox" id="c1in5" name="c1in[]" value="6">6</label>
							<label for="c1in6"><input type="checkbox" id="c1in6" name="c1in[]" value="7">7</label>
							<label for="c1in7"><input type="checkbox" id="c1in7" name="c1in[]" value="8">8</label>
							<label for="c1in8"><input type="checkbox" id="c1in8" name="c1in[]" value="9">9</label>
							<label for="c1in9"><input type="checkbox" id="c1in9" name="c1in[]" value="10">10</label>
							<label for="c1in10"><input type="checkbox" id="c1in10" name="c1in[]" value="10～">10～</label>
						</span>
					</td>
				</tr>
				<tr>
					<th>アメニティ<em class="required">※</em></th>
					<td>
						
						<span id="c9qd" class="checkbox">
							<label for="c9qd0"><input type="checkbox" id="c9qd0" name="c9qd[]" value="フェイスタオル">フェイスタオル</label>
							<label for="c9qd1"><input type="checkbox" id="c9qd1" name="c9qd[]" value="ボディータオル">ボディータオル</label>
							<label for="c9qd2"><input type="checkbox" id="c9qd2" name="c9qd[]" value="シャンプー／ボディーソープ">シャンプー／ボディーソープ</label>
							<label for="c9qd3"><input type="checkbox" id="c9qd3" name="c9qd[]" value="食器">食器</label>
							<label for="c9qd4"><input type="checkbox" id="c9qd4" name="c9qd[]" value="朝食">朝食</label>
						</span>
					</td>
				</tr>
				<tr>
					<th>設備<em class="required">※</em></th>
					<td>
						
						<span id="c7vj" class="checkbox">
							<label for="c7vj0"><input type="checkbox" id="c7vj0" name="c7vj[]" value="テレビ">テレビ</label>
							<label for="c7vj1"><input type="checkbox" id="c7vj1" name="c7vj[]" value="インターネット">インターネット</label>
							<label for="c7vj2"><input type="checkbox" id="c7vj2" name="c7vj[]" value="WIFI">WIFI</label>
							<label for="c7vj3"><input type="checkbox" id="c7vj3" name="c7vj[]" value="エアコン">エアコン</label>
							<label for="c7vj4"><input type="checkbox" id="c7vj4" name="c7vj[]" value="暖房">暖房</label>
							<label for="c7vj5"><input type="checkbox" id="c7vj5" name="c7vj[]" value="洗濯機">洗濯機</label>
							<label for="c7vj6"><input type="checkbox" id="c7vj6" name="c7vj[]" value="乾燥機">乾燥機</label>
							<label for="c7vj7"><input type="checkbox" id="c7vj7" name="c7vj[]" value="キッチン">キッチン</label>
							<label for="c7vj8"><input type="checkbox" id="c7vj8" name="c7vj[]" value="電子レンジ">電子レンジ</label>
							<label for="c7vj9"><input type="checkbox" id="c7vj9" name="c7vj[]" value="オーブン">オーブン</label>
							<label for="c7vj10"><input type="checkbox" id="c7vj10" name="c7vj[]" value="トースター">トースター</label>
							<label for="c7vj11"><input type="checkbox" id="c7vj11" name="c7vj[]" value="無料駐車場">無料駐車場</label>
							<label for="c7vj12"><input type="checkbox" id="c7vj12" name="c7vj[]" value="プール">プール</label>
							<label for="c7vj13"><input type="checkbox" id="c7vj13" name="c7vj[]" value="ジム">ジム</label>
							<label for="c7vj14"><input type="checkbox" id="c7vj14" name="c7vj[]" value="ヘアドライヤー">ヘアドライヤー</label>
							<label for="c7vj15"><input type="checkbox" id="c7vj15" name="c7vj[]" value="アイロン">アイロン</label>
						</span>
					</td>
				</tr>
				<tr>
					<th>その他<em class="required">※</em></th>
					<td>
						
						<span id="c7bz" class="checkbox">
							<label for="c7bz0"><input type="checkbox" id="c7bz0" name="c7bz[]" value="ペット可能">ペット可能</label>
							<label for="c7bz1"><input type="checkbox" id="c7bz1" name="c7bz[]" value="ファミリー／子供可能">ファミリー／子供可能</label>
							<label for="c7bz2"><input type="checkbox" id="c7bz2" name="c7bz[]" value="喫煙可能">喫煙可能</label>
							<label for="c7bz3"><input type="checkbox" id="c7bz3" name="c7bz[]" value="車椅子">車椅子</label>
							<label for="c7bz4"><input type="checkbox" id="c7bz4" name="c7bz[]" value="24時間チェックイン可能">24時間チェックイン可能</label>
						</span>
					</td>
				</tr>
				<tr>
					<th>最低泊数<em class="required">※</em></th>
					<td>
						
						<input type="text" required id="t0mc" name="t0mc" size="60" value="" maxlength="300">
					</td>
				</tr>
				<tr>
					<th>チェックイン<em class="required">※</em></th>
					<td>
						
						<input type="text" required id="t8vp" name="t8vp" size="60" value="" maxlength="300">
					</td>
				</tr>
				<tr>
					<th>チェックアウト<em class="required">※</em></th>
					<td>
						
						<input type="text" required id="t9ju" name="t9ju" size="60" value="" maxlength="300">
					</td>
				</tr>
				<tr>
					<th>清掃代<em class="required">※</em></th>
					<td>
						
						<span id="c1jz" class="checkbox">
							<label for="c1jz0"><input type="checkbox" id="c1jz0" name="c1jz[]" value="含む">含む</label>
							<label for="c1jz1"><input type="checkbox" id="c1jz1" name="c1jz[]" value="別途">別途</label>
						</span>
					</td>
				</tr>
				<tr>
					<th>清掃代が別途の場合の料金</th>
					<td>
						
						<input type="text" id="t4ai" name="t4ai" size="60" value="" maxlength="300">
					</td>
				</tr>
				<tr>
					<th>写真</th>
					<td>
						<input type="file" id="f9og" name="f9og" size="60"><br>
						<input type="file" id="f9oe" name="f9oe" size="60"><br>
						<input type="file" id="f5iq" name="f5iq" size="60"><br>
						<input type="file" id="f8ss" name="f8ss" size="60"><br>
						<input type="file" id="f4vl" name="f4vl" size="60"><br>
						<input type="file" id="f7fh" name="f7fh" size="60"><br>
						<input type="file" id="f1iw" name="f1iw" size="60"><br>
						<input type="file" id="f2va" name="f2va" size="60"><br>
						<input type="file" id="f3jx" name="f3jx" size="60"><br>
						<input type="file" id="f6oc" name="f6oc" size="60"><br>
						<input type="file" id="f1uw" name="f1uw" size="60"><br>
						<input type="file" id="f6ta" name="f6ta" size="60"><br>
						<input type="file" id="f2ab" name="f2ab" size="60"><br>
						<input type="file" id="f7cv" name="f7cv" size="60"><br>
						<input type="file" id="f0tv" name="f0tv" size="60">
					</td>
				</tr>
				<tr>
					<th>ホームページURL</th>
					<td>
						
						<span class="aside">※すでにair bnb等に登録がある場合、ページURLを記入下さい。</span><br>
						<input type="text" id="t6rs" name="t6rs" size="60" value="" maxlength="300"><br>
						<span class="bside">例： http://www.example.com/</span>
					</td>
				</tr>
			</tbody></table>
                              <p class="submit_bt_wrap">
                                <input type="reset" value="やり直す"><input type="submit" value="確認画面へ">
                              </p>
                            </fieldset>
                          </form>
                          <?php endif;?>
                          <p class="back">
                            <a href="#" onclick="history.back();return false;">← 前へ戻る</a><br />
                            <a href="#">↑ ↑ページの先頭へ</a>
                          </p>
                        </div>
      <!-- end mainform -->
                       

                        </div>
      <!-- end container -->
     
    </div>
   
</div>
            </div>
 </div>
<p style="margin:0">
<script type="text/javascript">
$(window).ready( function() {
	$("#t3gq_guest").jpostal({
		postcode : [
			"#t3gq_guest",
			"#t0sz_guest"
		],
		address : {
			"#s5bo_guest"  : "%3",
			"#t4ii_guest"  : "%4",
			"#t0pi_guest"  : "%5",
'#address1_kana'  : '%8',
			'#address2_kana'  : '%9',
			'#address3_kana'  : '%10'
		}
	});
});
</script>
<script type="text/javascript">
	$(window).ready( function() {
	$("#t5kf").jpostal({
		postcode : [
			"#t5kf",
			"#t3hz"
		],
		address : {
			"#s0sx"  : "%3",
			"#t4bf"  : "%4",
			"#t1yt"  : "%5",
'#address1_kana'  : '%8',
			'#address2_kana'  : '%9',
			'#address3_kana'  : '%10'
		}
	});
});
</script>
</p>
<style>
#form-host {
    margin-bottom: 150px;
}
.btn-form-host button {
    margin-left: 20px;
}
.btn-form-host {
    position: absolute;
    width: 100%;
    bottom: -70px;
}
.post-code .last{
 padding-right: 0;
 padding-left: 5px;
}
.post-code .first{
 padding-left: 0;
 padding-right: 5px;
}
.bubble-last{
   background: #fff!important;
}
.num-step-last{
   color:#2c944a!important;
   position: relative;
   z-index: 1;
   background: #fff;
   width: 20px;
   border-radius: 34px;
}
.title-step {
    font-size: 13px;
    color:#fff;
    text-transform: initial;
    display: block;
    padding: 5px 0 0;
}
.progress-indicator>li.completed .bubble, .progress-indicator>li.completed .bubble:after, .progress-indicator>li.completed .bubble:before{
    background:red;
}
#step  {
 background: #2c944a;
    padding: 10px 0 10px 0;
} 
.title-info {
    color: red;
    font-size: 20px;
    font-weight: bold;
    margin-bottom: 20px;
    margin-top: 0px;
}
.info-host {
    border: 5px solid #fff;
    padding: 10px;
    margin-bottom: 30px;
}
.info-host p:first-child{
   font-size: 15px;
     border-right: 5px solid #fff;
}
.info-host p{
   margin-bottom: 0!important;
}
#form-host{
    background: #e4f0f0;
    padding: 20px;
}
.btn-form-host {
    background: none;
}
.inner-host {
    text-align: center;
}
.form-horizontal .control-label {
    text-align: left!important;
    padding-top: 0;
}
.btn-cancel-host {
    color: #fff;
    background: #0d4886;
}
.btn-cancel-host:hover {
    color: rgba(255, 248, 248, 0.75);
    background: #1e67b3;
}
.btn-sumit-host{
 color: #fff;
    background: #820f0f;
}
.btn-sumit-host:hover{
 color: rgba(255, 248, 248, 0.75);
    background: #9a3535;
}
.content-form-host .border-bottom{
    border: none;
    border-bottom: 1px solid #cccccc;
    box-shadow: none;
    border-radius: 0px;
}
.content-form-host input{
    background: transparent;
}
.content-form-host .form-group{
    margin-bottom: 15px;
}
.num-step {
   color: #fff;
    margin-top: 4px;
    font-size: 12px;
    display: inline-block;
    position: relative;
    z-index: 1;
    font-weight: bold;
}
.progress-indicator {
    margin-bottom: -5px;
}
    .progress-indicator.custom-complex {
        background-color: #f1f1f1;
        padding: 10px 5px;
        border: 1px solid #ddd;
        border-radius: 10px;
    }
    .progress-indicator.custom-complex > li .bubble {
        height: 12px;
        width: 99%;
        border-radius: 2px;
        box-shadow: inset -5px 0 12px rgba(0, 0, 0, 0.2);
    }
    .progress-indicator.custom-complex > li .bubble:before,
    .progress-indicator.custom-complex > li .bubble:after {
        display: none;
    }

    /* Demo for vertical bars */

    .progress-indicator.stepped.stacked {
        width: 48%;
        display: inline-block;
    }
    .progress-indicator.stepped.stacked > li {
        height: 150px;
    }
    .progress-indicator.stepped.stacked > li .bubble {
        padding: 0.1em;
    }
    .progress-indicator.stepped.stacked > li:first-of-type .bubble {
        padding: 0.5em;
    }
    .progress-indicator.stepped.stacked > li:last-of-type .bubble {
        padding: 0em;
    }

    /* Nocenter */

    .progress-indicator.nocenter.stacked > li {
        min-height: 100px;
    }
    .progress-indicator.nocenter.stacked > li span {
        display: block;
    }

    /* Demo for Timeline vertical bars */

    #timeline-speaker-example {
        background-color: #2b4a6d;
        color: white;
        padding: 1em 2em;
        text-align: center;
        border-radius: 10px;
    }
    #timeline-speaker-example .progress-indicator {
        width: 100%;
    }
    #timeline-speaker-example .bubble {
        padding: 0;
    }
    #timeline-speaker-example .progress-indicator > li {
        color: white;
    }
    #timeline-speaker-example .time {
        position: relative;
        left: -80px;
        top: 30px;
        font-size: 130%;
        text-align: right;
        opacity: 0.6;
        font-weight: 100;
    }
    #timeline-speaker-example .current-time .time {
        font-size: 170%;
        opacity: 1;
    }
    #timeline-speaker-example .stacked-text {
        top: -37px;
        left: -50px;
    }
    #timeline-speaker-example .subdued {
        font-size: 10px;
        display: block;
    }
    #timeline-speaker-example > li:hover {
        color: #ff3d54;
    }
    #timeline-speaker-example > li:hover .bubble,
    #timeline-speaker-example > li:hover .bubble:before,
    #timeline-speaker-example > li:hover .bubble:after {
        background-color: #ff3d54;
    }
    #timeline-speaker-example .current-time .sub-info {
        font-size: 60%;
        line-height: 0.2em;
        text-transform: capitalize;
        color: #6988be;
    }
    .progress-indicator>li .bubble{
      width: 25px;
      height: 25px;
    }
    .num-step-last{
      width: 25px;
    }
    .num-step{
      font-size: 16px;
      line-height: 18px;
    }
    .progress-indicator>li .bubble:after, .progress-indicator>li .bubble:before{
      top: 11px;
    }
    .completed>br{
      display: none;
    }
    @media handheld, screen and (max-width: 400px) {
        .container {
            margin: 0;
            width: 100%;
        }
        .progress-indicator.stacked {
            display: block;
            width: 100%;
        }
        .progress-indicator.stacked > li {
            height: 80px;
        }
    }
    .add p{
      display: none;
    }
    .add .form-group{
      margin-bottom: 8px;
    }
    .add .col-sm-4,.add .col-sm-8, .add .col-sm-12{
      padding: 0;
      line-height: 24px;
    }
    .add .post-code input, .add .city input{
      height: 22px;
      border-radius: 0px;
      padding: 0px 5px 2px;
    }

    label.col-sm-12{
      line-height: 15px;
    }

    .add .city input{

    }
    .text-danger{
      color: #f22420;
    }
    .submit_bt_wrap {
        text-align: center;
        margin-top: 20px;
    }
</style>
<?php get_footer();?>