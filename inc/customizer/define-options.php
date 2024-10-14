<?php
/**
 * Customizer - Define Options Setting
 *
 * @package Welcart
 * @subpackage Welcart mode
 * @since 1.0.0
 */

/**
 * Get Options
 *
 * @param string $key Get Options.
 * @return mixed
 */
function mode_get_options( $key = '' ) {

	if ( empty( $key ) ) {
		return null;
	}

	$options = get_option( 'mode_type_options' );

	if ( ! is_admin() ) {

		/* a. Title Tagline */

		if ( ! isset( $options['display_description'] ) ) {
			$options['display_description'] = false;
		}

		/* b. Nav Menus */

		if ( ! isset( $options['submenu_type_method'] ) ) {
			$options['submenu_type_method'] = 'mega-menu';
		}
		if ( ! isset( $options['menu_display_method'] ) ) {
			$options['menu_display_method'] = 'default-menu';
		}

		/* c. Theme Option */

		if ( defined( 'WCEX_WIDGET_CART' ) ) {
			if ( ! isset( $options['widget_cart_header'] ) ) {
				$options['widget_cart_header'] = false;
			}
		}

		/*__ front page _______________________*/

		if ( ! isset( $options['display_features'] ) ) {
			$options['display_features'] = false;
		}
		if ( ! isset( $options['features_list_column'] ) ) {
			$options['features_list_column'] = 2;
		}
		if ( ! isset( $options['features_slide'] ) ) {
			$options['features_slide'] = false;
		}
		if ( ! isset( $options['features_num'] ) ) {
			$options['features_num'] = 5;
		}
		if ( ! isset( $options['features_cont'] ) ) {
			$options['features_cont'] = array( 'thumbnail', 'term', 'date', 'title', 'excerpt' );
		}

		if ( ! isset( $options['display_coordinate'] ) ) {
			$options['display_coordinate'] = false;
		}
		if ( ! isset( $options['coordinate_num'] ) ) {
			$options['coordinate_num'] = 10;
		}
		if ( ! isset( $options['coordinate_layout'] ) ) {
			$options['coordinate_layout'] = 'layout-slide';
		}
		if ( ! isset( $options['coordinate_column'] ) ) {
			$options['coordinate_column'] = 5;
		}

		if ( ! isset( $options['display_brand'] ) ) {
			$options['display_brand'] = false;
		}
		if ( ! isset( $options['brand_num'] ) ) {
			$options['brand_num'] = 10;
		}
		if ( ! isset( $options['brand_column'] ) ) {
			$options['brand_column'] = 5;
		}
		if ( ! isset( $options['logo_border'] ) ) {
			$options['logo_border'] = false;
		}

		if ( ! isset( $options['display_posts'] ) ) {
			$options['display_posts'] = false;
		}
		if ( ! isset( $options['posts_layout'] ) ) {
			$options['posts_layout'] = 'module-list';
		}
		if ( ! isset( $options['posts_list_column'] ) ) {
			$options['posts_list_column'] = 2;
		}
		if ( ! isset( $options['posts_category'] ) ) {
			$options['posts_category'] = mode_get_category_default();
		}
		if ( ! isset( $options['posts_num'] ) ) {
			$options['posts_num'] = 3;
		}
		if ( ! isset( $options['posts_cont'] ) ) {
			$options['posts_cont'] = array( 'thumbnail', 'date', 'title', 'excerpt' );
		}

		/*__ sidebar _______________________*/

		if ( ! isset( $options['sidebar_layout'] ) ) {
			$options['sidebar_layout'] = 'position-left';
		}
		if ( ! isset( $options['display_sidebar'] ) ) {
			$options['display_sidebar'] = '';
		}
		if ( ! isset( $options['switch_auto_play'] ) ) {
			$options['switch_auto_play'] = 'value1';
		}
		if ( ! isset( $options['ch_slide_speed'] ) ) {
			$options['ch_slide_speed'] = '3000';
		}
		if ( ! isset( $options['ch_animation_speed'] ) ) {
			$options['ch_animation_speed'] = '300';
		}

		/*__ item list _______________________*/

		if ( ! isset( $options['display_sub_categories'] ) ) {
			$options['display_sub_categories'] = false;
		}
		if ( ! isset( $options['item_list_column'] ) ) {
			$options['item_list_column'] = 5;
		}
		if ( ! isset( $options['display_produt_tag'] ) ) {
			$options['display_produt_tag'] = true;
		}
		if ( ! isset( $options['subimage_hover'] ) ) {
			$options['subimage_hover'] = true;
		}
		if ( ! isset( $options['image_square'] ) ) {
			$options['image_square'] = false;
		}

		/*__ item single _______________________*/

		if ( ! isset( $options['content_position'] ) ) {
			$options['content_position'] = 'initial';
		}
		if ( ! isset( $options['item_page_title'] ) ) {
			$options['item_page_title'] = false;
		}
		if ( ! isset( $options['cart_button'] ) ) {
			$options['cart_button'] = __( 'Add to Shopping Cart', 'usces' );
		}
		if ( ! isset( $options['soldout_text'] ) ) {
			$options['soldout_text'] = __( 'At present we cannot deal with this product', 'welcart_mode' );
		}
		if ( ! isset( $options['display_inquiry'] ) ) {
			$options['display_inquiry'] = false;
		}
		if ( ! isset( $options['inquiry_position'] ) ) {
			$options['inquiry_position'] = 'initial';
		}
		if ( ! isset( $options['inquiry_link'] ) ) {
			$options['inquiry_link'] = 0;
		}
		if ( ! isset( $options['inquiry_text'] ) ) {
			$options['inquiry_text'] = __( 'Inquiries about this product', 'welcart_mode' );
		}
		if ( ! isset( $options['display_item_single'] ) ) {
			$options['display_item_single'] = array( 'itemcode', 'status', 'review', 'brand' );
		}

		/*__ cart Page _______________________*/

		if ( ! isset( $options['continue_shopping_button'] ) ) {
			$options['continue_shopping_button'] = false;
		}
		if ( ! isset( $options['continue_shopping_url'] ) ) {
			$options['continue_shopping_url'] = '';
		}
		if ( ! isset( $options['archives_cont'] ) ) {
			$options['archives_cont'] = array( 'thumbnail', 'date', 'title', 'excerpt' );
		}

		/*__ single(post) _______________________*/

		if ( ! isset( $options['display_post_thumbnail'] ) ) {
			$options['display_post_thumbnail'] = 'display';
		}

		/*__ arhives(post) _______________________*/

		if ( ! isset( $options['arhives_list_column'] ) ) {
			$options['arhives_list_column'] = 2;
		}
		if ( ! isset( $options['arhives_cont'] ) ) {
			$options['arhives_cont'] = array( 'thumbnail', 'date', 'title', 'excerpt' );
		}

		/*__ arhives(features) _______________________*/

		if ( ! isset( $options['features_index_layout'] ) ) {
			$options['features_index_layout'] = 'default-layout';
		}
		if ( ! isset( $options['archive_features_num'] ) ) {
			$options['archive_features_num'] = 3;
		}
		if ( ! isset( $options['archive_features_cont'] ) ) {
			$options['archive_features_cont'] = array( 'thumbnail', 'term', 'date', 'title', 'excerpt' );
		}

		/*__ coordinate _______________________*/

		if ( ! isset( $options['display_coordinate_title'] ) ) {
			$options['display_coordinate_title'] = 'show';
		}
		if ( ! isset( $options['display_model_info'] ) ) {
			$options['display_model_info'] = 'show';
		}
		if ( ! isset( $options['coordinates_headline'] ) ) {
			$options['coordinates_headline'] = __( 'Coordinate', 'welcart_mode' );
		}
		if ( ! isset( $options['coordinates_headline_eng'] ) ) {
			$options['coordinates_headline_eng'] = 'COORDINATE';
		}
		if ( ! isset( $options['coordinate_list_cont'] ) ) {
			$options['coordinate_list_cont'] = array( 'date', 'title' );
		}
		if ( ! isset( $options['display_model_items'] ) ) {
			$options['display_model_items'] = array( 'thumbnail', 'name', 'sex', 'height' );
		}
		if ( ! isset( $options['display_coordinate_subtitle'] ) ) {
			$options['display_coordinate_subtitle'] = __( 'Styling Item', 'welcart_mode' );
		}

		if ( ! isset( $options['display_post_model_info'] ) ) {
			$options['display_post_model_info'] = 'show';
		}
		if ( ! isset( $options['display_post_model_items'] ) ) {
			$options['display_post_model_items'] = array( 'thumbnail', 'name', 'sex', 'height' );
		}
		if ( ! isset( $options['display_model_coordinates'] ) ) {
			$options['display_model_coordinates'] = 'show';
		}
		if ( ! isset( $options['display_coordinate_tags'] ) ) {
			$options['display_coordinate_tags'] = 'show';
		}

		/*__ sns _______________________*/

		if ( ! isset( $options['facebook_id'] ) ) {
			$options['facebook_id'] = '';
		}
		if ( ! isset( $options['facebook_button'] ) ) {
			$options['facebook_button'] = false;
		}

		if ( ! isset( $options['twitter_id'] ) ) {
			$options['twitter_id'] = '';
		}
		if ( ! isset( $options['twitter_button'] ) ) {
			$options['twitter_button'] = false;
		}

		if ( ! isset( $options['instagram_id'] ) ) {
			$options['instagram_id'] = '';
		}
		if ( ! isset( $options['instagram_button'] ) ) {
			$options['instagram_button'] = false;
		}

		if ( ! isset( $options['youtube_id'] ) ) {
			$options['youtube_id'] = '';
		}
		if ( ! isset( $options['youtube_button'] ) ) {
			$options['youtube_button'] = false;
		}

		if ( ! isset( $options['line_id'] ) ) {
			$options['line_id'] = '';
		}
		if ( ! isset( $options['line_button'] ) ) {
			$options['line_button'] = false;
		}
	}

	if ( ! isset( $options['item_cont'] ) ) {
		$options['item_cont'] = array( 'item-img', 'item-name', 'item-soldout', 'item-tag' );
	}

	if ( empty( $options[ $key ] ) ) {
		return null;
	}

	return $options[ $key ];

}

/**
 * Options
 *
 * @param string $key Options.
 * @return void
 */
function mode_options( $key = '' ) {

	echo esc_html( mode_get_options( $key ) );

}
