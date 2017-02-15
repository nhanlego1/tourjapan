<?php get_header(); ?>
<p style="height:0;margin: 0;">
<script type="text/javascript" src="../js/prototype.js"></script>
  <script type="text/javascript" src="../js/livevalidation.js"></script>
  <script type="text/javascript" src="../js/common.js"></script></p>
<div class="header1" style="height:300px;background:url(../img/bannerpage3.jpg);background-size: cover;"></div>
<div class='row'>
  <div class="col-md-12 col-xs-12">
<div class="tab-content">
    <div class="tab-pane active" id="tab1">
       <!-- container -->
       <?php if(!isset($_post['to_step_2'])) {?>
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
                            //{id: 'f6et', name: 'お勧めスポット①', required: true},
                            //{id: 't8kg', name: 'お勧めスポット名①', required: true, min: 0, max: 300},
                           // {id: 'f6rs', name: 'お勧めスポット②', required: true},
                            //{id: 't5ue', name: 'お勧めスポット名②', required: true, min: 0, max: 300},
                            //{id: 'f6hl', name: 'お勧めスポット③', required: true},
                           // {id: 't5wp', name: 'お勧めスポット名③', required: true, min: 0, max: 300},
                           // {id: 'f5ue', name: 'お勧めグルメ', required: true},
                           // {id: 't4gt', name: 'お勧めグルメ名①', required: true, min: 0, max: 300},
                            //{id: 'f5vi', name: 'お勧めグルメ②', required: true},
                            //{id: 't0zf', name: 'お勧めグルメ名②', required: true, min: 0, max: 300},
                            //{id: 'f9gp', name: 'お勧めグルメ③', required: true},
                           // {id: 't8ia', name: 'お勧めグルメ名③', required: true, min: 0, max: 300}
                          ], config);
                        // ]]>
                        </script>
                       <!--  mainform -->
                        <div id="mainform">
                          <h2><a href="http://serve-inc.kir.jp/">ホストになる（通訳ガイド）エントリーフォーム</a></h2>
                          <p class="step"><em>1. フォームの入力</em> → <span>2. 入力内容の確認</span> → <span>3. 送信完了</span></p>
                          <form action="http://tourjapan.lakita.vn/host_entry/" method="post" enctype="multipart/form-data" accept-charset="utf-8">
							<input type="hidden" name="to_step_2" value="yes">
                            <fieldset>
                              <legend>ホストになる（通訳ガイド）エントリーフォーム</legend>
                              <table>
                                <tbody><tr>
                                  <th>お名前<em class="required">※</em></th>
                                  <td>
                                    <input type="text" id="t3di" name="t3di" size="60" value="" maxlength="300">
                                  </td>
                                </tr>
                                <tr>
                                  <th>ニックネーム<em class="required">※</em></th>
                                  <td>
                                    <input type="text" id="t4kl" name="t4kl" size="60" value="" maxlength="300">
                                  </td>
                                </tr>
                                <tr>
                                  <th>名前（ローマ字）</th>
                                  <td>
                                    <input type="text" id="t2wv" name="t2wv" size="60" value="" maxlength="300">
                                  </td>
                                </tr>
                                <tr>
                                  <th>住所<em class="required">※</em></th>
                                  <td>
                                    <span class="lside">郵便番号</span><input type="text" id="t3gq" name="t3gq" size="4" value="" maxlength="3"><span class="rside">-</span><input type="text" id="t0sz" name="t0sz" size="7" value="" maxlength="4"><br>
                                    <span class="lside">都道府県</span><select id="s5bo" name="s5bo" size="1">
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
                                    <span class="lside">市区町村</span><input type="text" id="t4ii" name="t4ii" size="60" value="" maxlength="300"><br>
                                    <span class="lside">番地建物</span> <input type="text" id="t0pi" name="t0pi" size="60" value="" maxlength="300">
                                  </td>
                                </tr>
                                <tr>
                                  <th>生年月日<em class="required">※</em></th>
                                  <td><span class="aside">※サイトには○○才～○○才と5才単位で表示されます。</span><br>
                                    <select id="s6ib" name="s6ib" size="1">
                                      <option value="西暦">西暦</option>
                                      <option value="平成">平成</option>
                                      <option value="昭和">昭和</option>
                                      <option value="大正">大正</option>
                                      <option value="明治">明治</option>
                                    </select> <input type="text" id="t2ne" name="t2ne" size="5" value="" maxlength="4"><span class="rside">年</span><input type="text" id="t9ip" name="t9ip" size="5" value="" maxlength="2"><span class="rside">月</span><input type="text" id="t3xl" name="t3xl" size="5" value="" maxlength="2"><span class="rside">日</span>
                                  </td>
                                </tr>
                                <tr>
                                  <th>携帯番号<em class="required">※</em></th>
                                  <td>
                                    <span class="aside">※サイトには表示されません。</span><br>
                                    <input type="text" id="t0fl" name="t0fl" size="60" value="" maxlength="300"><br>
                                    <span class="bside">例： 09011112222 (ハイフン不要)</span>
                                  </td>
                                </tr>
                                <tr>
                                  <th>対応言語<em class="required">※</em></th>
                                  <td>
                                    <span class="aside">例）○○語、○○語　※複数記入可能、カンマ区切り</span><br>
                                    <input type="text" id="t7pj" name="t7pj" size="60" value="" maxlength="300">
                                  </td>
                                </tr>
                                <tr>
                                  <th>プロフィール<em class="required">※</em></th>
                                  <td>
                                    <span class="aside">プロフィール（日本語で記入下さい。）</span><br>
                                    <textarea id="t1og" name="t1og" cols="80" rows="15"></textarea><br>
                                    <span class="aside">プロフィール（通訳可能な言語で記入下さい。）</span><br>
                                    <textarea id="t3mp" name="t3mp" cols="80" rows="15"></textarea>
                                  </td>
                                </tr>
                                <tr>
                                  <th>メールアドレス<em class="required">※</em></th>
                                  <td>
                                    <input type="text" id="t9hg" name="t9hg" size="60" value="" maxlength="300"><br>
                                    <span class="bside">例： info@example.com</span>
                                  </td>
                                </tr>
                                <tr>
                                  <th>基本ガイド稼働時間<em class="required">※</em></th>
                                  <td>
                                    <span class="aside">例）9：00～18：00、10：00～17：00</span><br>
                                    <input type="text" id="t4jy" name="t4jy" size="60" value="" maxlength="300">
                                  </td>
                                </tr>
                                <tr>
                                  <th>最低ガイド時間<em class="required">※</em></th>
                                  <td>
                                    <span class="aside">例）6時間以上～、等</span><br>
                                    <input type="text" id="t9ag" name="t9ag" size="60" value="" maxlength="300">
                                  </td>
                                </tr>
                                <tr>
                                  <th>最低ガイド時間の時給<em class="required">※</em></th>
                                  <td>
                                    <input type="text" id="t8nd" name="t8nd" size="60" value="" maxlength="300">
                                  </td>
                                </tr>
                                <tr>
                                  <th>朝早／夜遅稼働の可否<em class="required">※</em></th>
                                  <td>
                                    <span id="c9oq" class="checkbox">
                                      <label for="c9oq0"><input type="checkbox" id="c9oq0" name="c9oq[]" value="朝早　OK">朝早　OK</label><label for="c9oq1"><input type="checkbox" id="c9oq1" name="c9oq[]" value="朝早　NG">朝早　NG</label>
                                      <label for="c9oq2"><input type="checkbox" id="c9oq2" name="c9oq[]" value="夜遅　OK">夜遅　OK</label><label for="c9oq3"><input type="checkbox" id="c9oq3" name="c9oq[]" value="夜遅　NG">夜遅　NG</label>
                                    </span>
                                  </td>
                                </tr>
                                <tr>
                                  <th>朝早／夜遅の際の時給</th>
                                  <td>
                                    <input type="text" id="t9su" name="t9su" size="60" value="" maxlength="300">
                                  </td>
                                </tr>
                                <tr>
                                  <th>案内可能エリア<em class="required">※</em></th>
                                  <td>
                                    <select id="s4lu" name="s4lu" size="1">
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
                                    <select id="s4nx" name="s4nx" size="1">
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
                                    <select id="s9pl" name="s9pl" size="1">
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
                                    <select id="s6rf" name="s6rf" size="1">
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
                                    <select id="s9oi" name="s9oi" size="1">
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
                                    </select>
                                  </td>
                                </tr>
                                <tr>
                                  <th>案内時の移動手段<em class="required">※</em></th>
                                  <td>
                                    
                                    <span id="c9lr" class="checkbox">
                                      <label for="c9lr0"><input type="checkbox" id="c9lr0" name="c9lr[]" value="自家用車">自家用車</label>
                                      <label for="c9lr1"><input type="checkbox" id="c9lr1" name="c9lr[]" value="車（レンタカー）">車（レンタカー）</label>
                                      <label for="c9lr2"><input type="checkbox" id="c9lr2" name="c9lr[]" value="電車">電車</label>
                                      <label for="c9lr3"><input type="checkbox" id="c9lr3" name="c9lr[]" value="バス">バス</label>
                                      <label for="c9lr4"><input type="checkbox" id="c9lr4" name="c9lr[]" value="徒歩">徒歩</label>
                                      <label for="c9lr5"><input type="checkbox" id="c9lr5" name="c9lr[]" value="その他">その他</label>
                                    </span>
                                  </td>
                                </tr>
                                <tr>
                                  <th>現在の職業</th>
                                  <td>
                                    
                                    <input type="text" id="t4qr" name="t4qr" size="60" value="" maxlength="300">
                                  </td>
                                </tr>
                              </tbody></table>
                              <p>
                                <input type="reset" value="やり直す"><input type="submit" value="確認画面へ">
                              </p>
                            </fieldset>
                          </form>
                          <p class="back">
                            <a href="#" onclick="history.back();return false;">←前へ戻る</a>
                            <a href="#">↑ページの先頭へ</a>
                          </p>
                        </div>
 	  <!-- end mainform -->
                        <div id="copyright">
                          <address><a href="http://www.mt312.com/">ES-FORM</a></address>
                        </div>

                        </div>
      <!-- end container -->
      <?php } 
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
						fasdf					</td>
				</tr>
				<tr>
					<th>ニックネーム<em class="required">※</em></th>
					<td>
						ニックネーム					</td>
				</tr>
				<tr>
					<th>名前（ローマ字）</th>
					<td>
						đasd					</td>
				</tr>
				<tr>
					<th>住所<em class="required">※</em></th>
					<td>
						312-1323<br>
						埼玉県<br>
						312323<br>
						31231232					</td>
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
						09011112222					</td>
				</tr>
				<tr>
					<th>対応言語<em class="required">※</em></th>
					<td>
						sdfasdf					</td>
				</tr>
				<tr>
					<th>プロフィール<em class="required">※</em></th>
					<td>
						ádfasdf<br>
						fasdfasdf					</td>
				</tr>
				<tr>
					<th>メールアドレス<em class="required">※</em></th>
					<td>
						info@example.com					</td>
				</tr>
				<tr>
					<th>基本ガイド稼働時間<em class="required">※</em></th>
					<td>
						fasdf					</td>
				</tr>
				<tr>
					<th>最低ガイド時間<em class="required">※</em></th>
					<td>
						fasdfsd					</td>
				</tr>
				<tr>
					<th>最低ガイド時間の時給<em class="required">※</em></th>
					<td>
						fasdfdf					</td>
				</tr>
				<tr>
					<th>朝早／夜遅稼働の可否<em class="required">※</em></th>
					<td>
						朝早　NG, 夜遅　NG					</td>
				</tr>
				<tr>
					<th>朝早／夜遅の際の時給</th>
					<td>
						fasdfasdf					</td>
				</tr>
				<tr>
					<th>案内可能エリア<em class="required">※</em></th>
					<td>
						東京都<br>
						栃木県<br>
						宮城県<br>
						北海道<br>
						北海道					</td>
				</tr>
				<tr>
					<th>案内時の移動手段<em class="required">※</em></th>
					<td>
						車（レンタカー）					</td>
				</tr>
				<tr>
					<th>現在の職業</th>
					<td>
						fasdfdf					</td>
				</tr>
				<tr>
					<th>お勧めスポット①<em class="required">※</em></th>
					<td>
						Courses.txt<br>
						fasdf<br>
						Courses.txt<br>
						fasdfdf<br>
						Courses.txt<br>
						fasdfdf					</td>
				</tr>
				<tr>
					<th>お勧めグルメ<em class="required">※</em></th>
					<td>
						Courses.txt<br>
						fasdfdf<br>
						Courses.txt<br>
						fasfdf<br>
						Courses.txt<br>
						fasdfdf					</td>
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
       <?php } ?>
    </div>
   
</div>
            </div>
 </div>
<?php get_footer(); ?>