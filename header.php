<?php
/**
 * Header Template
 *
 * @package Welcart
 * @subpackage welcart_mode
 * @since 1.0.0
 */

?>
<!DOCTYPE html>

<html class="no-js" <?php language_attributes(); ?>>

	<head>
		<meta charset="<?php bloginfo( 'charset' ); ?>" />
		<meta name="viewport" content="width=device-width, user-scalable=no">
		<meta name="format-detection" content="telephone=no"/>
        <meta name="description" content="神奈川のアナログレコードオンライン販売">
		<meta property="og:image" content="<?php echo get_stylesheet_directory_uri(); ?>/images/daiei_mv_new3.png" />
		<?php wp_head(); ?><!--wp_headで出力するとレイアウトに少しバグが起きるので、CDN等は直書きしています-->
		<link href="https://fonts.googleapis.com/css2?family=Crimson+Text&amp;display=swap" rel="stylesheet">
		<link href="https://fonts.googleapis.com/css2?family=Josefin+Sans&display=swap" rel="stylesheet">
		<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css">
		<link href="https://use.fontawesome.com/releases/v6.2.0/css/all.css" rel="stylesheet">
		<script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
		<!--slick-css-->
		<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick.css"/>
        <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick-theme.css">
        <script src="js/5-1-9.js"></script>
		<script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-cookie/1.4.1/jquery.cookie.js"></script><!--cookie用-->
		<!--swiper用-->
		<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.css"/>
        <script src="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.js"></script>
		<!--カルーセルのバナーJquary-->
		<script type="text/javascript">
			jQuery(function(){
	            jQuery('.banner-content').slick({
		            autoplay: true,         //自動再生
                    autoplaySpeed: 5000,    //自動再生のスピード
                    speed: 800,             //スライドするスピード
                    dots: false,             //スライドしたのドット
                    arrows: false,           //左右の矢印
                    infinite: true,         //スライドのループ
                    pauseOnHover: true,    //ホバーしたときにスライドを一時停止しない
	            });
			});
        </script>
		<!--ヘッダーのUp・DawnのJS-->
		<script type="text/javascript">

		  //スクロール途中でヘッダーが消え、上にスクロールすると復活する設定を関数にまとめる
		  jQuery(function ScrollAnime ($) {
            var _window = $(window),
            _header = $('#site-header'),
            heroBottom,
            startPos,
            winScrollTop;

            _window.on('scroll',function(){
            winScrollTop = $(this).scrollTop();
            heroBottom = $('.home-slide-container').height();
            if (winScrollTop >= startPos) {
            if(winScrollTop >= heroBottom){
            _header.addClass('hide');
            }
            } else {
            _header.removeClass('hide');
            }
            startPos = winScrollTop;
            });

            _window.trigger('scroll');
 
          });

		</script>
		<script type="text/javascript">

		  //スクロール途中でヘッダーが消え、上にスクロールすると復活する設定を関数にまとめる
          jQuery(function ScrollAnime ($) {
            var _window = $(window),
            _header = $('#site-header'),
            heroBottom,
            startPos,
            winScrollTop;

            _window.on('scroll',function(){
            winScrollTop = $(this).scrollTop();
            heroBottom = $('.breadcrumb').height();
            if (winScrollTop >= startPos) {
            if(winScrollTop >= heroBottom){
            _header.addClass('hide');
            }
            } else {
            _header.removeClass('hide');
            }
            startPos = winScrollTop;
            });

            _window.trigger('scroll');
          });
			
		</script>
		<!--質問アコーディオンJS-->
		<script type="text/javascript">
			jQuery(function ($) {
              $('.accordion_one .ac_header').click(function(){
                $(this).next('.ac_inner').slideToggle();
                $(this).toggleClass("open");
               });
           });
		</script>
		<!-- Google tag (gtag.js) -->
        <script async src="https://www.googletagmanager.com/gtag/js?id=G-R7XFQV4PK2"></script>
        <script>
           window.dataLayer = window.dataLayer || [];
           function gtag(){dataLayer.push(arguments);}
           gtag('js', new Date());

           gtag('config', 'G-R7XFQV4PK2');
        </script>
		<!-- ページ内スクロール -->
		<script type="text/javascript">
			jQuery(function ($) {
			  $('a[href*="#"]').click(function () {
		      var elmHash = $(this).attr('href'); //ページ内リンクのHTMLタグhrefから、リンクされているエリアidの値を取得
		      var pos = $(elmHash).offset().top-80;  //idの上部の距離を取得
		      $('body,html').animate({scrollTop: pos}, 500); //取得した位置にスクロール。500の数値が大きくなるほどゆっくりスクロール
		      return false;
	          });
	        });
        </script>
		<!-- modal -->
		<script type="text/javascript">

			//ボタンを押したらモーダルが出現
            function buttonClick() {
              $(".modal").fadeIn();
              $("html").addClass("fixed"); // 背景固定させるクラス付与

			  $(".popup-close").on("click", function () {
              $("html").removeClass("fixed"); // 背景固定させるクラス付与
              $(".modal").fadeOut();
               return false;
              });
		    } 
        </script>
	</head> 

	<?php
		$lang = 'lang-' . get_bloginfo( 'language' );
	?>
	<body <?php body_class( $lang ); ?>>

	    

		<?php wp_body_open(); ?>

	    <!--ここにスプラッシュ入る予定-->
		<!--モーダル-->

		<div class="modal">
          <div class="modal_bg js-modal-close"></div>
            <div class="modalScroll">
              <div class="modal_content">

                <div class="sso_content_modal">
				  <div class="sso_content_modal">
				    <?php
                      $args = array(
		                'post_type'   => 'page',
		                'name'        => 'filter-search-1',
		                'post_status' => array( 'draft' ),
	                  );
	                  $posts_array = get_posts( $args );
	                  if ( $posts_array && is_array( $posts_array ) ) {
		              $content = $posts_array[0]->post_content;
		              echo apply_filters( 'the_content', $content );
	                  }
                    ?>
                  </div>
                </div>
                        
                <span class="popup-close" onclick="closePopUp()"></span>
              </div>
            </div>
          </div>
        </div><!--modal-->

		

		<div id="site">

		    <?php
		    if ( true === mode_get_options( 'fixed_header' ) ) {
			    $fixedHeader = 'header-group fixed_header';
		    } else {
			    $fixedHeader = 'header-group';
		    }
		    ?>
	        

			<header id="site-header" class="<?php echo esc_attr( $fixedHeader ); ?> Dawnmove" role="banner">

			    <div id="header_banner">
				    <a href="https://daieirecord.jp/category/item/rock-pops-sale/"><span class="header-img-banner"><img src="<?php echo get_stylesheet_directory_uri(); ?>/images/rock-sale-banner.png" alt="画像"/></span></a>
	            </div>

			    <?php if ( defined( 'WCEX_WIDGET_CART' ) && true === mode_get_options( 'widget_cart_header' ) ) : ?>
				    <input type="checkbox" id="widget_cart_open">
				    <div class="view-cart">
					    <div class="column1120">
						    <label class="widgetcart-close-btn" for="widget_cart_open"><span class="bar"></span><span class="bar"></span></label>
						    <div id="wgct_row"><?php echo widgetcart_get_cart_row(); ?></div>
					    </div>
				    </div><!-- .view-cart -->
			    <?php endif; ?>

				<div class="header_inner">

					<?php welcart_mode_site_description(); ?>
					<div class="site-branding">
						<?php welcart_mode_title_logo(); ?>
					</div><!-- .site-branding -->

					<!--<div class="modal_btn_wrap_sp_tablet_only">
                        <buttun class="lead-btn buttun" onclick="buttonClick()">
                            <a href="#" class="btn_modal btn btn-border-1"><i class="fa-solid fa-magnifying-glass"></i></a>
                        </buttun>
			        </div>-->

					<div class="drawer-sp">

						<input type="checkbox" class="open-check open-check-sp" id="open-check-sp">
						<label class="trigger-menu" for="open-check-sp">
							<?php get_template_part( 'template-parts/nav/menu-trigger' ); ?>
						</label>

						<div class="drawer-menu-sp">
							<div class="in">

								<?php
								$global_menu = 'global-menu';
								if ( has_nav_menu( $global_menu ) ) {
									welcart_mode_global_navigation();
								}
								?>

								<div class="drawer-menu-pc">

									<input type="checkbox" class="open-check open-check-pc" id="open-check-pc">
									<label class="trigger-menu" for="open-check-pc">
										<?php get_template_part( 'template-parts/nav/menu-trigger' ); ?>
									</label>

									<div class="in">
										<?php
										$sub_menu = 'sub-menu';
										if ( has_nav_menu( $sub_menu ) ) {

											echo '<nav id="sub-navigation" class="sub-navigation">';
											$args = array(
												'theme_location' => $sub_menu,
											);
											wp_nav_menu( $args );
											echo '</nav>';

										}
										?>
										

										<div class="shopping-navigation">
											<?php welcart_mode_header_search_form(); ?>
											<div class="membership">
											<?php if ( usces_is_login() ) : ?>
												<ul>
													<li><?php /* translators: */ printf( esc_html__( 'Hello %s', 'usces' ), esc_html( usces_the_member_name( 'return' ) ) ); ?></li>
													<li><a href="<?php echo esc_url( USCES_MEMBER_URL ); ?>"><?php esc_html_e( 'My page', 'welcart_mode' ); ?></a></li>
													<li><?php usces_loginout(); ?></li>
													<?php do_action( 'usces_theme_login_menu' ); ?>
												</ul>
											<?php else : ?>
												<ul>
													<li><?php esc_html_e( 'guest', 'usces' ); ?></li>
													<li><?php usces_loginout(); ?></li>
													<li><a href="<?php echo esc_url( USCES_NEWMEMBER_URL ); ?>"><?php esc_html_e( 'New Membership Registration', 'usces' ); ?></a></li>
												</ul>
											<?php endif; ?>
											</div>
											<div class="search-form">
											    <!--<div class="modal_btn_wrap">
                                                    <buttun class="lead-btn buttun" onclick="buttonClick()">
                                                        <a href="#" class="btn_modal btn btn-border-1"><i class="fa-solid fa-magnifying-glass"></i><span>より詳細な検索はコチラ</span></a>
                                                    </buttun>
			                                    </div>-->
												<?php get_search_form(); ?>
					                        </div>
										</div>

									</div><!-- .in -->
									<!--<div class="sns-content-wrap">
										<div class="sns-list">
										   <a href="https://www.instagram.com/daieirecord4045/" target="_blank" rel="noopener"> 
                                              <img src="https://daieirecord.jp/wp-content/uploads/2023/01/insta-banner.svg" alt="インスタバナー" loading="lazy"></a>
										</div>
										<div class="sns-list">
										   <a href="https://twitter.com/daieirecord" target="_blank" rel="noopener">
                                              <img src="https://daieirecord.jp/wp-content/uploads/2023/01/twitter-banner.svg" alt="ツイッターバナー" loading="lazy"></a>
										</div>
									</div>-->
								</div><!-- .drawer-menu-pc -->

							</div><!-- .in -->
						</div><!-- .drawer-menu-sp -->

					</div><!-- .drawer-sp -->

					<?php if ( ! ( defined( 'WCEX_WIDGET_CART' ) && true === mode_get_options( 'widget_cart_header' ) ) ) : ?>
						<div class="incart">
							<div class="in">
								<a href="<?php echo esc_url( USCES_CART_URL ); ?>">
									<span class="welicon-shopping-cart"></span>
									<span class="total-quantity"><?php usces_totalquantity_in_cart(); ?></span>
								</a>
							</div>
						</div><!-- .incart -->
					<?php else : ?>
						<div class="incart widgetcart">
							<div class="in">
							    
								<label for="widget_cart_open" class="widget_cart_button">
									<span class="welicon-shopping-cart"></span>
									<span class="total-quantity"><?php usces_totalquantity_in_cart(); ?></span>
								</label>
							</div>
						</div><!-- .widgetcart -->
						<div id="wgct_alert"></div>
					<?php endif; ?>

				</div><!-- header_inner -->

			</header><!-- #site-header -->

			<?php
			$class            = '';
			$is_secondary     = welcart_mode_secondary();
			$secondary_layout = mode_get_options( 'sidebar_layout' );
			if ( $is_secondary ) {
				$class .= 'site-column2';
			} else {
				$class .= 'site-column1';
			}
			if ( 'position-left' === $secondary_layout ) {
				$class .= ' position-left';
			} else {
				$class .= ' position-right';
			}
			?>
			<main class="<?php echo esc_attr( $class ); ?>" role="main">

				<?php
				if ( is_home() || is_front_page() ) :
					$headers       = get_uploaded_header_images();
					$headers_count = count( $headers );
					?>

					<div id="key" class="home-slide-container">
					  <?php
					  if ( $headers ) :
						if ( $headers_count > 0 ) :
							?>

							<div class="slider">
								<?php
								foreach ( $headers as $key => $value ) :
									global $wpdb;
									$parse_url = explode( parse_url( WP_CONTENT_URL, PHP_URL_PATH ), $value['url'] );
									$this_host = str_ireplace( 'www.', '', parse_url( home_url(), PHP_URL_HOST ) );
									$file_host = str_ireplace( 'www.', '', parse_url( $value['url'], PHP_URL_HOST ) );
									if ( ! isset( $parse_url[1] ) || empty( $parse_url[1] ) || ( $this_host !== $file_host ) ) {
										return;
									}
									$img_id      = $wpdb->get_col( $wpdb->prepare( "SELECT ID FROM {$wpdb->prefix}posts WHERE guid RLIKE %s;", $parse_url[1] ) );
									$img_meta    = get_post( $img_id[0] );
									$img_title   = $img_meta->post_title;
									$img_caption = $img_meta->post_excerpt;
									$img_alt     = get_post_meta( $img_id[0], '_wp_attachment_image_alt', true );
									$img_link    = get_post_meta( $img_id[0], 'link_url', true );
									?>
									<div class="list">
										<?php if ( ! empty( $img_link ) ) : ?>
											<a href="<?php echo esc_html( $img_link ); ?>">
										<?php endif; ?>
										<figure><?php echo wp_get_attachment_image( $img_id[0], 'full' ); ?></figure>
										<?php if ( $img_alt || $img_caption ) : ?>
											<div class="slide-content">
												<?php
												if ( $img_alt ) {
													echo '<div class="headline"><strong>' . esc_html( $img_alt ) . '</strong></div>';
												}
												?>
												<?php
												if ( $img_caption ) {
													echo '<p>' . wp_kses_post( $img_caption ) . '</p>';
												}
												?>
											</div>
										<?php endif; ?>
										<?php if ( ! empty( $img_link ) ) : ?>
											</a>
										<?php endif; ?>
									</div>
									<?php
								endforeach;
								?>
							</div>
							<?php
						endif;
					  else :
						?>
						<?php if ( get_header_image() ) : ?>
							<div class="default-head-img"><img src="<?php header_image(); ?>" width="<?php echo esc_attr( get_custom_header()->width ); ?>" height="<?php echo esc_attr( get_custom_header()->height ); ?>" alt="<?php bloginfo( 'name' ); ?>"></div>
						<?php endif; ?>
					  <?php endif; ?>

					  <div class="mv-contents">
                        <div class="swiperCont">
                          <div class="swiper mySwiper">
                            <div class="swiper-wrapper">
                              <div class="swiper-slide">
                                <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/daiei-mv-re.png" alt="画像"/>
                              </div>
                              <div class="swiper-slide">
                                <a href="https://daieirecord.jp/category/item/rock-pops-sale/"><img src="<?php echo get_stylesheet_directory_uri(); ?>/images/rock-main.png" alt="画像"/></a>
                              </div>
							  <div class="swiper-slide">
                                <a href="https://daieirecord.jp/category/item/jazz-feature/"><img src="<?php echo get_stylesheet_directory_uri(); ?>/images/jazz.png" alt="画像"/></a>
                              </div>
							  <div class="swiper-slide">
                                <a href="https://daieirecord.jp/category/item/soul-feature/"><img src="<?php echo get_stylesheet_directory_uri(); ?>/images/soul.png" alt="画像"/></a>
                              </div>
                              <div class="swiper-slide">
                                <a href="https://daieirecord.jp/category/item/wa-jazz-feature/"><img src="<?php echo get_stylesheet_directory_uri(); ?>/images/waja.png" alt="画像"/></a>
                              </div>
							  <div class="swiper-slide">
                                <a href="https://daieirecord.jp/category/item/reggae_sale/"><img src="<?php echo get_stylesheet_directory_uri(); ?>/images/re.png" alt="画像"/></a>
                              </div>
                            </div>
                          </div>
                          <div class="swiper-pagination"></div>
                          <div class="swiper-button-prev"></div>
                          <div class="swiper-button-next"></div>
                        </div><!--swipercont-->
                      </div><!--mv-contents-->
					  
					  
					</div>

				<?php endif; ?>
				<!--パンくずリスト-->
                <?php if(!is_front_page()): ?>

                    <div class="breadcrumb">
                        <?php
                            if(function_exists( 'yoast_breadcrumb' )){
                            yoast_breadcrumb( '<p id="breadcrumbs">', '</p>');
                        }
                        ?>
                    </div>		  
                <?php endif; ?>

				<div id="primary" class="site-content">

				    <?php if(is_front_page()): ?>

						<?php get_sidebar('left'); ?>
		  
                    <?php endif; ?>

				    

					<div id="content" role="main">
