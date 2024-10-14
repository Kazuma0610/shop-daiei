<?php
/**
 * Footer Template
 *
 * @package Welcart
 * @subpackage Welcart mode
 * @since 1.0.0
 */

?>

					</div><!-- #content -->

					<?php
					$is_secondary = welcart_mode_secondary();
					if ( $is_secondary ) {
						get_sidebar();
					}
					?>
					<?php if(is_front_page()): ?>

                        <?php get_sidebar('right'); ?>

                    <?php endif; ?>
					
				</div>

			</main>

			<div id="toTop" class="wrap fixed"><a href="#masthead"><span class="welicon-chevron-top"></span></a></div>

			<footer id="site-footer" role="contentinfo" class="footer-group">

				<div class="in">
				    
				    <div class="f-row">
						<div class="f-navi">
						    <div class="f_navi_box_aboutus">
							  <p class="f_nav_box_ttl">ABOUT US</p>
							    <ul>
								  <li>
									<a href="https://daieirecord.jp/access/">店舗情報</a>
								  </li>
								  <li>
									<a href="https://daieirecord.jp/%e5%80%8b%e4%ba%ba%e6%83%85%e5%a0%b1%e3%81%ae%e5%8f%96%e3%82%8a%e6%89%b1%e3%81%84%e3%81%ab%e3%81%a4%e3%81%84%e3%81%a6/">個人情報の取り扱いについて</a>
								  </li>
								  <li>
									<a href="https://daieirecord.jp/%e7%89%b9%e5%ae%9a%e5%95%86%e5%8f%96%e5%bc%95%e6%b3%95%e3%81%ab%e9%96%a2%e3%81%99%e3%82%8b%e8%a1%a8%e7%a4%ba/">特定商取引法に関する表示</a>
								  </li>
							    </ul>
						   </div>
					       <div class="f_navi_box_delivery">
							   <p class="f_nav_box_ttl">DELIVERY</p>
							   <ul>
								  <li>
								    <a href="https://daieirecord.jp/%e8%b3%bc%e5%85%a5%e6%96%b9%e6%b3%95/">購入方法</a>
								  </li>
								  <li>
								    <a href="https://daieirecord.jp/%e9%80%81%e6%96%99%e3%81%ab%e3%81%a4%e3%81%84%e3%81%a6/">送料について</a>
								  </li>
								  <li>
								    <a href="https://daieirecord.jp/%e9%80%81%e6%96%99%e3%81%ab%e3%81%a4%e3%81%84%e3%81%a6/#area-2">返品について</a>
					              </li>
							    </ul>
						   </div>
						   <div class="f_navi_box_support">
							<p class="f_nav_box_ttl">SUPPORT</p>
							   <ul>
								  <li>
									<a href="https://daieirecord.jp/q-a/">Q&A</a>
								  </li>
								  <li>
									<a href="https://daieirecord.jp/contact/">お問い合わせ</a>
								  </li>
								  <li>
									<a href="https://daieirecord.jp/sitemap/">サイトマップ</a>
								  </li>
							   </ul>
						   </div>
					    </div> 
						<div class="f-sns">
							<div class="f-sns-box">
								<p class="f-sns-box-ttl">FOLLOW US</p>
								<?php if ( mode_get_options( 'facebook_button' ) || mode_get_options( 'twitter_button' ) || mode_get_options( 'instagram_button' ) || mode_get_options( 'youtube_button' ) || mode_get_options( 'line_button' ) ) : ?>
					            <ul class="shop-sns">
					            <?php if ( mode_get_options( 'facebook_button' ) ) : ?>
						            <li class="facebook"><a href="https://www.facebook.com/<?php mode_options( 'facebook_id' ); ?>" target="_blank" rel="nofollow"><span class="welicon-facebook"></span></a></li>
					            <?php endif; ?>
					            <?php if ( mode_get_options( 'twitter_button' ) ) : ?>
						            <li class="twitter"><a href="https://twitter.com/<?php mode_options( 'twitter_id' ); ?>" target="_blank" rel="nofollow"><span class="welicon-twitter"></span></a></li>
					            <?php endif; ?>
					            <?php if ( mode_get_options( 'instagram_button' ) ) : ?>
						            <li class="instagram"><a href="https://www.instagram.com/<?php mode_options( 'instagram_id' ); ?>" target="_blank" rel="nofollow"><span class="welicon-instagram"></span></a></li>
					            <?php endif; ?>
					            <?php if ( mode_get_options( 'youtube_button' ) ) : ?>
						            <li class="youtube"><a href="https://www.youtube.com/channel/<?php mode_options( 'youtube_id' ); ?>" target="_blank" rel="nofollow"><span class="welicon-youtube"></span></a></li>
					            <?php endif; ?>
					            <?php if ( mode_get_options( 'line_button' ) ) : ?>
						            <li class="line"><a href="<?php mode_options( 'line_id' ); ?>" target="_blank" rel="nofollow"><span class="welicon-line"></span></a></li>
					            <?php endif; ?>
					            </ul><!-- .shop-sns -->
				                <?php endif; ?>
							</div>
							<div class="cragit-wrap">
							  <div class="cragit-box">
								<ul class="cragit-ul">
									<li><img src="https://daieirecord.jp/wp-content/uploads/2023/02/visa.png" alt="" loading="lazy"></li>
									<li><img src="https://daieirecord.jp/wp-content/uploads/2023/02/jcb.jpg" alt="" loading="lazy"></li>
									<li><img src="https://daieirecord.jp/wp-content/uploads/2023/02/mc_symbol_opt_73_3x.png" alt="" loading="lazy"></li>
									<li><img src="https://daieirecord.jp/wp-content/uploads/2023/02/AMEXlogo.jpg" alt="" loading="lazy"></li>
									<li><img src="https://daieirecord.jp/wp-content/uploads/2023/02/dinersclub.jpg" alt="" loading="lazy"></li>
									<li><img src="https://daieirecord.jp/wp-content/uploads/2023/02/discover.jpg" alt="" loading="lazy"></li>
								</ul>
							  </div>
						    </div>
					    </div>
					</div>

					<!--<nav id="footer-navigation" class="footer-navigation">
						<?php
							$page_cart   = get_page_by_path( 'usces-cart' );
							$page_member = get_page_by_path( 'usces-member' );
							wp_nav_menu(
								array(
									'theme_location' => 'footer-menu',
									'depth'          => 1,
									'menu_class'     => 'footer-menu',
								)
							);
							?>
					</nav><!--.sub-navigation -->

				</div><!-- .in -->

				<?php welcart_mode_copyright(); ?>
				<div class="copyright">Copyright © Ochiai. All Rights Reserved.</div>

			</footer><!-- #site-footer -->

			<div class="drawe-bg-sp"></div>
			<div class="drawe-bg-pc"></div>

		</div><!-- #site -->

		<?php wp_footer(); ?>
		<script>
			const swiper = new Swiper('.mySwiper', {
            loop: true,                       
            slidesPerView: 1,
            centeredSlides : true,
            spaceBetween: 10,               //追記
            autoplay: {                         
              delay: 7000,  
			  disableOnInteraction: false, // ユーザーが操作しても自動再生を止めない
              waitForTransition: false, // アニメーションの間も自動再生を止めない（最初のスライドの表示時間を揃えたいときに）
            },                   
            breakpoints: {
            1030: {
                slidesPerView: 1,
                },
            },
            centeredSlides : true,
            spaceBetween: 5,               //追記
            autoplay: {                         
              delay: 7000,  
			  disableOnInteraction: false, // ユーザーが操作しても自動再生を止めない
              waitForTransition: false, // アニメーションの間も自動再生を止めない（最初のスライドの表示時間を揃えたいときに）
            },                   
            pagination: {                       
              el: '.swiper-pagination',
			  clickable: true, // クリックによるスライド切り替えを有効にする
            },
            navigation: {                      
              nextEl: ".swiper-button-next",
              prevEl: ".swiper-button-prev",
            },
          });

		  const swiper2 = new Swiper('.mySwiper-topic', {
            loop: true,                       
            slidesPerView: 2,
            centeredSlides : true,
            spaceBetween: 5,               //追記
            autoplay: {                         
              delay: 7000,  
			  disableOnInteraction: false, // ユーザーが操作しても自動再生を止めない
              waitForTransition: false, // アニメーションの間も自動再生を止めない（最初のスライドの表示時間を揃えたいときに）
            },                   
            pagination: {                       
              el: '.swiper-pagination',
			  clickable: true, // クリックによるスライド切り替えを有効にする
            },
            navigation: {                      
              nextEl: ".swiper-button-next",
              prevEl: ".swiper-button-prev",
            },
          });
        </script><!--スライダー-->
	</body>
</html>
