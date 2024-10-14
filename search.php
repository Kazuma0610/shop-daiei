<?php
/**
 * Search Template
 *
 * @package Welcart
 * @subpackage Welcart mode
 * @since 1.0.0
 */

get_header();
?>

	<header class="page-header">
		<h1 class="page-title">
            <?php
              if (isset($_GET['s']) && empty($_GET['s'])) {
              echo '条件にマッチする商品：'.$wp_query->found_posts .'件'; // 検索キーワードと該当件数を表示
              }
            ?>
        </h1>
		<div class="main-search-pc">

        <?php
          $args = array(
	        'post_type'   => 'page',
	        'name'        => 'filter-search-2',
	        'post_status' => array( 'publish', 'private' ),
          );
          $posts_array = get_posts( $args );
            if ( $posts_array && is_array( $posts_array ) ) {
	          $content = $posts_array[0]->post_content;
	          echo apply_filters( 'the_content', $content );
            }
        ?>

        </div>
	</header><!-- .page-header -->

	<?php if ( have_posts() ) : ?> 

		<div class="search-li type-grid">

			<?php
			$column = mode_get_options( 'item_list_column' );
			echo '<div class="product-group column-grid column-grid' . esc_attr( $column ) . '">';
			while ( have_posts() ) {
				the_post();
				get_template_part( 'template-parts/loop/product' );
			}
			echo '</div>';
			?>

		</div><!-- .search-li -->

		<div class="pagination_wrapper">
			<?php
			$args = array(
				'type'      => 'list',
				'prev_text' => __( ' &laquo; ' ),
				'next_text' => __( ' &raquo; ' ),
			);
			echo wp_kses_post( paginate_links( $args ) );
			?>
		</div><!-- .pagination_wrapper -->

	<?php else : ?>

		<p><?php echo esc_html__( 'No posts found.', 'usces' ); ?></p>

	<?php endif; ?>

<?php
get_footer();
