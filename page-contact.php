<?php get_header(); ?>

<div id="primary" class="site-content">
    <div id="content" role="main">

    <?php
        // 変数の初期化
        $page_flag = 0;
		$clean = array();
		$error = array();

        // サニタイズ
        if( !empty($_POST) ) {
	      foreach( $_POST as $key => $value ) {
		  $clean[$key] = htmlspecialchars( $value, ENT_QUOTES);
	      }
        }

        if( !empty($clean['btn_confirm']) ) {

			$error = validation($clean);

	        if( empty($error) ) {
		      
				$page_flag = 1;

				// セッションの書き込み
		        session_start();
		        $_SESSION['page'] = true;

	        }


        } elseif( !empty($clean['btn_submit']) ) {

			session_start();
	        if( !empty($_SESSION['page']) && $_SESSION['page'] === true ) {

		    // セッションの削除
		    unset($_SESSION['page']);

            $page_flag = 2;

            // 変数とタイムゾーンを初期化
            $header = null;
	        $auto_reply_subject = null;
	        $auto_reply_text = null;
            $admin_reply_subject = null;
	        $admin_reply_text = null;
	        date_default_timezone_set('Asia/Tokyo');

            // ヘッダー情報を設定
	        $header = "MIME-Version: 1.0\n";
	        $header .= "From: DAIEIRECORD <mail@daieirecord.jp>\n";
	        $header .= "Reply-To: DAIEIRECORD <mail@daieirecord.jp>\n";

	        // 件名を設定
	        $auto_reply_subject = 'お問い合わせありがとうございます。';

	        // 本文を設定
	        $auto_reply_text = "この度は、お問い合わせ頂き誠にありがとうございます。下記の内容でお問い合わせを受け付けました。\n\n";
	        $auto_reply_text .= "お問い合わせ日時：" . date("Y-m-d H:i") . "\n\n";
	        $auto_reply_text .= "氏名：" . $clean['your_name'] . "\n\n";
	        $auto_reply_text .= "メールアドレス：" . $clean['email'] . "\n\n";
            $auto_reply_text .= "電話番号：" . $clean['tel'] . "\n\n";
			$auto_reply_text .= "好きな音楽ジャンルはなんですか？：" . implode(' ／ ', $_POST['brand']) . "\n\n";
			$auto_reply_text .= "お問い合わせ内容：" . nl2br($clean['contact']) . "\n\n";
	        $auto_reply_text .= "原則3営業日までにはご返信致します。暫しお待ちくださいませ。\n\n";
			$auto_reply_text .= "DAIEIRECORD \n";

	        // メール送信
	        mb_send_mail( $clean['email'], $auto_reply_subject, $auto_reply_text, $header);

            // 運営側へ送るメールの件名
	        $admin_reply_subject = "お問い合わせを受け付けました";
	
	        // 本文を設定
	        $admin_reply_text = "下記の内容でお問い合わせがありました。\n\n";
	        $admin_reply_text .= "お問い合わせ日時：" . date("Y-m-d H:i") . "\n\n";
	        $admin_reply_text .= "氏名：" . $clean['your_name'] . "\n\n";
	        $admin_reply_text .= "メールアドレス：" . $clean['email'] . "\n\n";
            $admin_reply_text .= "電話番号：" . $clean['tel'] . "\n\n";
			$admin_reply_text .= "好きな音楽ジャンルはなんですか？：" . implode(' ／ ', $_POST['brand']) . "\n\n";
			$admin_reply_text .= "お問い合わせ内容：" . nl2br($clean['contact']) . "\n\n";
			

	        // 運営側へメール送信
	        mb_send_mail( 'mail@daieirecord.jp', $admin_reply_subject, $admin_reply_text, $header);

		    } else {
			  $page_flag = 0;
		    }
        }

		function validation($data) {

			$error = array();
		
			// 氏名のバリデーション
			if( empty($data['your_name']) ) {
				$error[] = "「氏名」は必ず入力してください。";
			} elseif( 20 < mb_strlen($data['your_name']) ) {
				$error[] = "「氏名」は20文字以内で入力してください。";
			}
		  // メールアドレスのバリデーション
			if( empty($data['email']) ) {
				$error[] = "「メールアドレス」は必ず入力してください。";
		
			} elseif( !preg_match( '/^[0-9a-z_.\/?-]+@([0-9a-z-]+\.)+[0-9a-z-]+$/', $data['email']) ) {
				$error[] = "「メールアドレス」は正しい形式で入力してください。";
			}
		  // 電話番号のバリデーション
			if( empty($data['tel']) ) {
				$error[] = "「電話番号」は必ず入力してください。";
			} elseif( !preg_match( '/^[0-9.-]+$/', $data['tel']) ) {
				$error[] = "「電話番号」は正しい形式で入力してください。";
			} elseif( 10 > mb_strlen($data['tel']) ) {
				$error[] = "電話番号は10桁以上でご記入ください";
			}
		  // 好きな音楽のジャンルは？のバリデーション
			if( empty($_POST['brand']) ) {
				$error[] = "好きな音楽のジャンルをご選択ください。";
			}
		  // お問い合わせ内容のバリデーション
			if( empty($data['contact']) ) {
				$error[] = "「お問い合わせ内容」は必ず入力してください。";
			}
		  // プライバシーポリシー同意のバリデーション
			if( empty($data['agreement']) ) {
				$error[] = "プライバシーポリシーをご確認ください。";
			} elseif( (int)$data['agreement'] !== 1 ) {
				$error[] = "プライバシーポリシーをご確認ください。";
			}
		
			return $error;
		}
    ?>
        <article class="post-205 page type-page status-publish hentry" id="post-205">
            <div class="contact-form">
              
              <?php if( $page_flag === 1 ): ?>

				<p class="con-p">ご確認ページ</p>

                <form method="post" action="">
	                <div class="element_wrap">
		                <label>氏名</label>
		                <p><?php echo $clean['your_name']; ?></p>
	                </div>
	                <div class="element_wrap">
		                <label>メールアドレス</label>
		                <p><?php echo $clean['email']; ?></p>
	                </div>
                    <div class="element_wrap">
		                <label>電話番号</label>
		                <p><?php echo $clean['tel']; ?></p>
	                </div>
					<div class="element_wrap">
                        <label>好きな音楽ジャンルはなんですか？</label>
                        <p><?php echo implode(' ／ ', $_POST['brand']);?></p>
                    </div>
					<div class="element_wrap">
		                <label>お問い合わせ内容</label>
		                <p><?php echo nl2br($clean['contact']); ?></p>
	                </div>
	                <div class="element_wrap">
		                <label>プライバシーポリシーに同意する</label>
		                <p><?php if( $clean['agreement'] === "1" ){ echo '同意する'; }
		                else{ echo '同意しない'; } ?></p>
	                </div>
	                <input type="submit" name="btn_back" value="戻る">
	                <input type="submit" name="btn_submit" value="送信">
	                <input type="hidden" name="your_name" value="<?php echo $clean['your_name']; ?>">
	                <input type="hidden" name="email" value="<?php echo $clean['email']; ?>">
                    <input type="hidden" name="tel" value="<?php echo $clean['tel']; ?>">
					<!-- チェックボックスの選択された値をhiddenで持たせる -->
					<?php
                        if( !empty($_POST['brand']) ){
                          foreach($_POST['brand'] as $brand_value){
                          echo '<input type="hidden" name="brand[]" value="'.$brand_value.'">';
                        }
                        }
                      ?>
					<input type="hidden" name="contact" value="<?php echo $clean['contact']; ?>">
	                <input type="hidden" name="agreement" value="<?php echo $clean['agreement']; ?>">
                </form>
              <?php elseif( $page_flag ===2 ): ?>

                     <p class="done_text">送信が完了しました。</p>
                     <p class="done_text">自動送信メールが送られます。<br>担当者からは3営業日以内にご連絡いたします。</p>

                     <form method="post" action="">
	                     <input type="submit" name="btn_back" value="入力画面に戻る">
                     </form>

              <?php else: ?>

				<?php if( !empty($error) ): ?>
	                <ul class="error_list">
	                    <?php foreach( $error as $value ): ?>
		                    <li><?php echo $value; ?></li>
	                    <?php endforeach; ?>
	                </ul>
                <?php endif; ?>

				<h2 class="contact-title">CONTACT</h2>
			    <p class="contact-p">商品や当店に関するお問い合わせ、購入や返品等のご質問がありましたら、お気軽に上記のフォームからお問い合わせください。原則3営業日までにはご返信致します。</p>

                <form method="post" action="">
	                <div class="element_wrap">
		                <label>氏名<br><span class="required">必須</sapn></label>
		                <input type="text" name="your_name" placeholder="例：鈴木太郎" value="<?php if( !empty($clean['your_name']) ){ echo $clean['your_name']; } ?>">
	                </div>
	                <div class="element_wrap">
		                <label>メールアドレス<br><span class="required">必須</sapn></label>
		                <input type="text" name="email" placeholder="例：example@example.com" value="<?php if( !empty($clean['email']) ){ echo $clean['email']; } ?>">
	                </div>
                    <div class="element_wrap">
		                <label>電話番号<br><span class="required">必須</sapn></br><span class="required">ハイフン無しでも可</sapn></label>
		                <input type="text" name="tel" placeholder="例：○○○-○○○○-○○○○" value="<?php if( !empty($clean['tel']) ){ echo $clean['tel']; } ?>">
	                </div>
					<div class="element_wrap_cb">
                        <label>好きな音楽ジャンルはなんですか？<br><span class="required">必須</sapn></label>
                          <div class="cb-wrap">
                            <label class="selects"><input type="checkbox" name="brand[]" value="BLUES" <?php if( !empty($_POST['brand']) && in_array('BLUES', $_POST['brand']) ){ echo 'checked'; } ?>>BLUES</label>
                            <label class="selects"><input type="checkbox" name="brand[]" value="SOUL" <?php if( !empty($_POST['brand']) && in_array('SOUL', $_POST['brand']) ){ echo 'checked'; } ?>>SOUL</label>
                            <label class="selects"><input type="checkbox" name="brand[]" value="JAZZ" <?php if( !empty($_POST['brand']) && in_array('JAZZ', $_POST['brand']) ){ echo 'checked'; } ?>>JAZZ</label>
                            <label class="selects"><input type="checkbox" name="brand[]" value="AOR" <?php if( !empty($_POST['brand']) && in_array('AOR', $_POST['brand']) ){ echo 'checked'; } ?>>AOR</label>
                            <label class="selects"><input type="checkbox" name="brand[]" value="ROCK" <?php if( !empty($_POST['brand']) && in_array('ROCK', $_POST['brand']) ){ echo 'checked'; } ?>>ROCK</label>
                            <label class="selects"><input type="checkbox" name="brand[]" value="JPOP" <?php if( !empty($_POST['brand']) && in_array('JPOP', $_POST['brand']) ){ echo 'checked'; } ?>>JPOP</label>
                            <label class="selects"><input type="checkbox" name="brand[]" value="REGGAE" <?php if( !empty($_POST['brand']) && in_array('REGGAE', $_POST['brand']) ){ echo 'checked'; } ?>>REGGAE</label>
                            <label class="selects"><input type="checkbox" name="brand[]" value="HIPHOP" <?php if( !empty($_POST['brand']) && in_array('HIPHOP', $_POST['brand']) ){ echo 'checked'; } ?>>HIPHOP</label>
							<label class="selects"><input type="checkbox" name="brand[]" value="ELECTRO" <?php if( !empty($_POST['brand']) && in_array('ELECTRO', $_POST['brand']) ){ echo 'checked'; } ?>>ELECTRO</label>
							<label class="selects"><input type="checkbox" name="brand[]" value="FUSION" <?php if( !empty($_POST['brand']) && in_array('FUSION', $_POST['brand']) ){ echo 'checked'; } ?>>FUSION</label>
                          </div>
                    </div>
					<div class="element_wrap">
		              <label>お問い合わせ内容<br><span class="required">必須</sapn></label>
		              <textarea name="contact" placeholder="例：ここにお問合せ内容を記入下さい"><?php if( !empty($clean['contact']) ){ echo $clean['contact']; } ?></textarea>
	                </div>
	                <div class="element_wrap">
		              <label for="agreement"><input id="agreement" type="checkbox" name="agreement" value="1"<?php if( !empty($clean['agreement']) && $clean['agreement'] === "1" ){ echo 'checked'; } ?>><a href="https://daieirecord.jp/%e5%80%8b%e4%ba%ba%e6%83%85%e5%a0%b1%e3%81%ae%e5%8f%96%e3%82%8a%e6%89%b1%e3%81%84%e3%81%ab%e3%81%a4%e3%81%84%e3%81%a6/" target="blank" rel="noopener" >プライバシーポリシー</a>に同意する<br><span class="required">必須</sapn></label>
	                </div>
	                <input type="submit" name="btn_confirm" value="入力内容を確認する">
                </form>

              <?php endif; ?>
            </div>
            <!--<div class="contact-wrap">
                    <div class="tel-contact">
                        <a href="tel:046-267-4045">
                            <div class="tel-number">046-267-4045</div>
                        </a>
                        <div class="tel-text">午前10時～午後7時まで（日曜定休日）</div>
                    </div>
            </div>-->
            
        </article>
    </div>
</div>

<?php get_footer(); ?>