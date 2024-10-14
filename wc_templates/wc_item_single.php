<?php
/**
 * Item Single
 *
 * @package Welcart
 * @subpackage Welcart mode
 * @since 1.0.0
 */

get_header();

/* 詳細説明の場所変更機能 */
$get_subimg       = usces_get_itemSubImageNums();
$cont_position    = mode_get_options( 'content_position' );
$page_title       = mode_get_options( 'item_page_title' );
$display_inquiry  = mode_get_options( 'display_inquiry' );
$inquiry_position = mode_get_options( 'inquiry_position' );
$other_item       = mode_get_options( 'display_item_single' );

if ( ! is_array( $other_item ) ) {
	$other_item = array();
}

if ( 'lp' === $cont_position ) {
	$class = 'layout-lp';
} else {
	$class = 'layout-default';
}

?>

    <?php

	// 	ACFの「PV」カウント
	if( !is_user_logged_in() && !is_bot() ) {
		$pv = get_field('pv');
		$pv++;
		update_field('pv', $pv);
	}

	?>



	<?php
	if ( have_posts() ) :
		the_post();
		?>

		<article <?php post_class( $class ); ?> id="post-<?php the_ID(); ?>">

			<?php usces_remove_filter(); ?>
			<?php usces_the_item(); ?>
			<?php usces_have_skus(); ?>

			<?php if ( 'lp' === $cont_position ) : ?>

				<section class="item-content entry-content entry-box">
					<?php if ( $page_title ) : ?>
						<h1 class="item-page-title"><?php the_title(); ?></h1>
					<?php endif; ?>
					<?php the_content(); ?>
				</section>

			<?php endif; ?>

			<section class="is-product">

				<div class="gallery">

					<div id="itemimg" class="itemimg">
						<div class="slider slider-for">
							<div class="list">
								<?php if ( wp_is_mobile() ) : ?>
									<?php usces_the_itemImage( 0, 600, 600, $post ); ?>
								<?php else : ?>
									<a href="<?php usces_the_itemImageURL( 0 ); ?>" <?php echo apply_filters( 'usces_itemimg_anchor_rel', null ); ?>>
										<?php usces_the_itemImage( 0, 600, 600, $post ); ?>
									</a>
								<?php endif; ?>
							</div>
							<?php foreach ( $get_subimg as $subimg ) : ?>
								<div class="list">
									<?php if ( wp_is_mobile() ) : ?>
										<?php usces_the_itemImage( $subimg, 600, 600, $post ); ?>
									<?php else : ?>
										<a href="<?php usces_the_itemImageURL( $subimg ); ?>" <?php echo apply_filters( 'usces_itemimg_anchor_rel', null ); ?>>
											<?php usces_the_itemImage( $subimg, 600, 600, $post ); ?>
										</a>
									<?php endif; ?>
								</div>
							<?php endforeach; ?>
						</div>
						<?php do_action( 'usces_theme_favorite_icon' ); ?>
					</div><!-- #itemimg -->

					<?php if ( ! empty( $get_subimg ) ) : ?>
						<div id="itemimg-sub" class="slider slider-nav itemimg-sub">
							<div class="list"><?php usces_the_itemImage( 0, 300, 300, $post ); ?></div>
							<?php foreach ( $get_subimg as $subimg ) : ?>
								<div class="list"><?php usces_the_itemImage( $subimg, 300, 300, $post ); ?></div>
							<?php endforeach; ?>
						</div><!-- #itemimg-sub -->
					<?php endif; ?>

				</div><!-- .gallery -->

				<div class="add-to-cart">

					<?php mode_produt_tag(); ?>

					<?php
					if ( in_array( 'brand', $other_item, true ) ) {
						mode_brand_label( $post );
					}
					?>

					<div class="itemname">
						<h1><?php usces_the_itemName(); ?></h1>
						<?php if ( in_array( 'itemcode', $other_item, true ) ) : ?>
							<div class="itemcode"><?php usces_the_itemCode(); ?></div>
						<?php endif; ?>
					</div>

					<?php if ( ! empty( $post->post_excerpt ) ) : ?>
						<div class="excerpt">
							<p><?php echo esc_html( $post->post_excerpt ); ?></p>
						</div>
					<?php endif; ?>

					<form action="<?php echo esc_url( USCES_CART_URL ); ?>" method="post">

					<?php do { ?>
						<div class="skuform cf">

							<?php if ( '' !== usces_the_itemSkuDisp( 'return' ) ) : ?>
								<div class="skuname"><?php usces_the_itemSkuDisp(); ?></div>
							<?php endif; ?>

							<?php do_action( 'usces_theme_item_single_before_options' ); ?>

							<?php if ( usces_is_options() ) : ?>
								<dl class="item-option">
									<?php while ( usces_have_options() ) : ?>
										<dt><?php usces_the_itemOptName(); ?></dt>
										<dd><?php usces_the_itemOption( usces_getItemOptName(), '' ); ?></dd>
									<?php endwhile; ?>
								</dl>
							<?php endif; ?>

							<?php
							global $usces;
							$pictid = $usces->get_subpictid( usces_the_itemSku( 'return' ) );
							if ( $pictid ) :
								?>
								<div class="skuimg">
									<?php echo wp_get_attachment_image( $pictid, array( 300, 300 ), true ); ?>
								</div>
								<?php
							endif;
							?>


							<div class="is-cart">

								<?php welcart_mode_campaign_message(); ?>

								<?php if ( in_array( 'status', $other_item, true ) ) : ?>
									<div class="zaikostatus"><?php usces_the_itemZaikoStatus(); ?></div>
								<?php endif; ?>

								<?php if ( 'continue' === welcart_mode_get_item_chargingtype( $post->ID ) ) : ?>
									<div class="frequency"><span class="field_frequency"><?php dlseller_frequency_name( $post->ID, 'amount' ); ?></span></div>
								<?php endif; ?>

								<div class="field_price">
									<?php if ( usces_the_itemCprice( 'return' ) > 0 ) : ?>
										<span class="field_cprice"><?php usces_the_itemCpriceCr(); ?></span>
									<?php endif; ?>
									<?php usces_the_itemPriceCr(); ?><?php usces_guid_tax(); ?>
								</div>
								<?php usces_crform_the_itemPriceCr_taxincluded(); ?>

								<?php usces_the_itemGpExp(); ?>

								<?php if ( ! usces_have_zaiko() ) : ?>

									<?php if ( $display_inquiry && 'initial' === $inquiry_position ) : ?>
										<div class="contact-item initial"><a href="<?php echo esc_url( welcart_mode_get_inquiry_link_url() ); ?>"><span class="welicon-contact"></span><?php mode_options( 'inquiry_text' ); ?></a></div>
									<?php else : ?>
										<div class="itemsoldout"><?php mode_options( 'soldout_text' ); ?></div>
										<?php if ( $display_inquiry && 'always' === $inquiry_position ) : ?>
										<div class="contact-item always"><a href="<?php echo esc_url( welcart_mode_get_inquiry_link_url() ); ?>"><span class="welicon-contact"></span><?php mode_options( 'inquiry_text' ); ?></a></div>
										<?php endif; ?>
									<?php endif; ?>

								<?php else : ?>

									<div class="c-box">

										<div class="quantity"><?php esc_html_e( 'Quantity', 'usces' ); ?><?php usces_the_itemQuant(); ?><?php usces_the_itemSkuUnit(); ?></div>

										<?php if ( $display_inquiry && 'always' === $inquiry_position ) : ?>
											<div class="cart-button"><?php usces_the_itemSkuButton( mode_get_options( 'cart_button' ), 0 ); ?></div>
											<div class="contact-item always"><a href="<?php echo esc_url( welcart_mode_get_inquiry_link_url() ); ?>"><span class="welicon-contact"></span><?php mode_options( 'inquiry_text' ); ?></a></div>
										<?php else : ?>
											<div class="cart-button"><?php usces_the_itemSkuButton( mode_get_options( 'cart_button' ), 0 ); ?></div>
										<?php endif; ?>

									</div>

								<?php endif; ?>

								<div class="error_message"><?php usces_singleitem_error_message( $post->ID, usces_the_itemSku( 'return' ) ); ?></div>

							</div>

						</div><!-- .skuform -->
					<?php } while ( usces_have_skus() ); ?>

						<?php do_action( 'usces_action_single_item_inform' ); ?>
					</form>
					<?php do_action( 'usces_action_single_item_outform' ); ?>
					<!--<div class="about-stock-box">
                             <span class="box-title">店頭での在庫共有について</span>
                             <p>実店舗と在庫を共有しております為、稀に『売り違い』が生じてしまう事もございます。ご了承の程お願い致します。尚、ご注文いただきました商品が在庫切れの場合は、電話、またはメールでご連絡差し上げます。その場合はキャンセルも可能です。</p>
                    </div>-->
					<div class="s_section">
                         <div class="accordion_area gutter">
                            <div class="accordion_one">
                               <div class="ac_header">
                                   <div class="p-faq__headinner">
                                      <p class="p-faq__q-txt">店頭での在庫共有について</p>
                                   </div>
      
								   <div class="i_box"></div>
                               </div>
                                   <div class="ac_inner">
                                      <div class="p-faq__bodyinner">
                                           <p class="p-faq__a-txt">実店舗と在庫を共有しております為、稀に『売り違い』が生じてしまう事もございます。ご了承の程お願い致します。尚、ご注文いただきました商品が在庫切れの場合は、電話、またはメールでご連絡差し上げます。その場合はキャンセルも可能です。</p>
                                      </div>
                                   </div>
                            </div>
                         </div>
                    </div>
					
				</div><!-- .add-to-cart -->

				<div class="info">

					<div class="tabs-sp">
						<ul class="tabs">

							<?php if ( 'initial' === $cont_position ) : ?>
								<li class="active">
									<div class="label"><?php esc_html_e( 'Item Description', 'welcart_mode' ); ?></div>
									<div class="icon">
										<div class="in"></div>
									</div>
									<div class="entry-box select">
										<?php the_content(); /* パターンB */ ?>
									</div>
								</li>
							<?php endif; ?>

							<?php
							$item_custom = usces_get_item_custom( $post->ID, 'table', 'return' );
							if ( ! empty( $item_custom ) ) :
								?>
								<li>
									<div class="label"><?php esc_html_e( 'Other', 'welcart_mode' ); ?></div>
									<div class="icon">
										<div class="in"></div>
									</div>

									<div class="entry-box spec"><?php echo wp_kses_post( $item_custom ); ?></div>

								</li>
							<?php endif; ?>

							<?php if ( in_array( 'review', $other_item, true ) ) : ?>
								<li>
									<div class="label"><?php esc_html_e( 'Review', 'welcart_mode' ); ?><span class="review-num">（ <?php echo esc_html( get_comments_number() ); ?> ）</span></div>
									<div class="icon">
										<div class="in"></div>
									</div>
									<div class="entry-box review-list">
										<?php comments_template( '/wc_templates/wc_review-list.php' ); ?>
									</div><!-- .entry-review -->
								</li>
							<?php endif; ?>

						</ul>
					</div>

					<div class="tabs-pc">
						<ul class="tabs">

							<?php
							if ( 'initial' === $cont_position ) :
								?>
								<li class="active">
									<div class="label"><?php esc_html_e( 'Item Description', 'welcart_mode' ); ?></div>
								</li>
								<?php
								endif;
								$item_custom = usces_get_item_custom( $post->ID, 'table', 'return' );
							if ( ! empty( $item_custom ) ) :
								if ( 'initial' !== $cont_position ) {
									$class = 'active';
								} else {
									$class = 'second-menu';
								}
								?>
								<li class="<?php echo esc_attr( $class ); ?>">
									<div class="label"><?php esc_html_e( 'Other', 'welcart_mode' ); ?></div>

								</li>
								<?php
								endif;
							if ( in_array( 'review', $other_item, true ) ) :
								if ( 'initial' !== $cont_position && ! $item_custom ) {
									$class = 'active';
								} else {
									$class = 'second-menu';
								}
								?>
								<li class="<?php echo esc_attr( $class ); ?>">
									<div class="label"><?php esc_html_e( 'Review', 'welcart_mode' ); ?><span class="review-num">（ <?php echo esc_html( get_comments_number() ); ?> ）</span></div>
								</li>
								<?php
								endif;
							?>

						</ul>

						<?php
						if ( 'initial' === $cont_position ) :
							?>
							<div class="entry-box entry-content select">
								<?php the_content(); /* パターンB */ ?>
							</div>
							<?php
							endif;
						if ( ! empty( $item_custom ) ) :
							if ( 'initial' !== $cont_position ) {
								$class = ' select';
							} else {
								$class = ' second-menu';
							}
							?>
							<div class="entry-box spec<?php echo esc_attr( $class ); ?>">
								<?php echo wp_kses_post( $item_custom ); ?>
							</div>
							<?php
							endif;
						if ( in_array( 'review', $other_item, true ) ) :
							if ( 'initial' !== $cont_position && empty( $item_custom ) ) {
								$class = ' select';
							} else {
								$class = ' second-menu';
							}
							?>
							<div class="entry-box review-list<?php echo esc_attr( $class ); ?>">
								<?php comments_template( '/wc_templates/wc_review-list.php' ); ?>
							</div><!-- .entry-review -->
							<?php
							endif;
						?>

					</div>

					<?php if ( in_array( 'review', $other_item, true ) ) : ?>
						<div class="entry-review">
							<?php comments_template( '/wc_templates/wc_review.php', false ); ?>
						</div>
					<?php endif; ?>

				</div><!-- .info -->
				
			</section>

			<nav class="navigation single-post-navigation" role="navigation">
		              <ul class="nav-links">
			              <li class="nav-previous"><?php previous_post_link( '%link', '前の商品',true ); ?></li>
			              <li class="nav-next"><?php next_post_link( '%link', '次の商品',true ); ?></li>
		              </ul>
	        </nav>

			<!-- 最近閲覧した記事 -->
            <aside class="watched_page_wrap">
              <h3>最近閲覧した商品</h3>
              <?php watchedpost_typecheack(5); ?>
            </aside>

            

			<!-- 関連記事 -->
            <?php if(has_category() ) {
                    $catlist =get_the_category();
                    $category = array();
                    foreach($catlist as $cat){
                    $category[] = $cat->term_id;
                }}
            ?>
            <?php $args = array(
                   'post_type' => 'post',
                   'posts_per_page' => '5', //表示させたい記事数
                   'post__not_in' =>array( $post->ID ), //現在の記事は含めない
                   'category__in' => $category, //先ほど取得したカテゴリー内の記事
                   'orderby' => 'rand' //ランダムで取得
                );
            
			$related_query = new WP_Query( $args );?>
            <aside class="recommend-wrap">
                <h3>コチラもオススメ商品</h3>
                    <ul class="recommend-content">
                        <?php while ( $related_query->have_posts() ) : $related_query->the_post(); ?>
                            <li>
                                <a href="<?php the_permalink(); ?>">
                                    <!-- アイキャッチ表示 -->
                                    <div class="related_thumb_reco"><?php the_post_thumbnail($wp, array(200, 200)); ?></div>
                                    <!-- タイトル表示 -->
                                    <p class="related_title_reco"><?php the_title(); ?></p>
                                </a>
                            </li>
                        <?php endwhile; ?>
                        <?php wp_reset_postdata(); //最後に記事のリセット?>
                    </ul>
            </aside>

			<?php welcart_mode_coordinates_item_models_list(); ?>

			<?php usces_assistance_item( $post->ID, __( 'An article concerned', 'usces' ) ); ?>

			

		</article>
		

	<?php else : ?>

		<p class="no-post"><?php esc_html_e( 'Sorry, no posts matched your criteria.', 'usces' ); ?></p>

	<?php endif; ?>

<?php
get_footer();
