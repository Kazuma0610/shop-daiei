<?php
/**
 * Welcart - Short Code
 *
 * @package Welcart
 * @subpackage Welcart mode
 * @since 1.0.0
 */

/**
 * WidgetCart Get Cart Row
 * [get-products num="4" cat="itemreco"]
 *
 * @param int    $atts Atts.
 * @param string $content Content.
 * @return ogject
 */
function getCatItems( $atts, $content = null ) {
	extract(
		shortcode_atts(
			array(
				'num'    => '',
				'column' => '4',
				'cat'    => 'item',
				'id'     => '',
			),
			$atts
		)
	);

	global $usces;

	$args = array(
		'post_type'     => 'post',
		'post_status'   => 'publish',
		'orderby'       => array(
			'menu_order' => 'ASC',
			'date'       => 'DESC',
		),
		'category_name' => $cat,
	);
	if ( ! empty( $num ) ) {
		$args['posts_per_page'] = $num;
	}
	if ( ! empty( $id ) ) {
		$ids              = array();
		$ids              = explode( ',', $id );
		$args['post__in'] = $ids;
	}
	$column = $atts['column'];
	if ( empty( $column ) ) {
		$column = 4;
	}
	$shortcode_query = new WP_Query( $args );
	$retHtml         = '';
	if ( $shortcode_query->have_posts() ) {
		$retHtml     .= '<div class="shortcode-products">';
			$retHtml .= '<div class="column-grid column-grid' . $column . '">';
		while ( $shortcode_query->have_posts() ) {
			$shortcode_query->the_post();
			usces_the_item();
			$retHtml             .= '<div class="list">';
				$retHtml         .= '<a href="' . get_permalink( get_the_ID() ) . '">' . "\n";
					$retHtml     .= '<div class="img square">' . "\n";
						$retHtml .= usces_the_itemImage( 0, 300, 300, '', 'return' ) . "\n";
			if ( mode_get_produt_tag() ) {
				$retHtml .= mode_get_produt_tag();
			}
					$retHtml     .= '</div>' . "\n";
					$retHtml     .= '<div class="info">' . "\n";
						$retHtml .= '<h2>' . usces_the_itemName( 'return' ) . '</h2>' . "\n";
						$retHtml .= '<div class="price">' . usces_the_firstPriceCr( 'return' ) . usces_guid_tax( 'return' ) . '</div>' . "\n";
						$retHtml .= usces_crform_the_itemPriceCr_taxincluded( true, '', '', '', true, false, true, 'return' );
					$retHtml     .= '</div>' . "\n";
				$retHtml         .= '</a>' . "\n";
				$retHtml         .= '</div>';
		}
			wp_reset_postdata();
			$retHtml .= '</div>';
		$retHtml     .= '</div>';
	}
	return $retHtml;
}
add_shortcode( 'get-products', 'getCatItems' );
