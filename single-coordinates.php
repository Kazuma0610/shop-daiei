<?php
/**
 * The Coordinates Single template file
 *
 * @package Welcart
 * @subpackage Welcart mode
 * @since 1.0.0
 */

get_header();
?>

	<?php

	if ( have_posts() ) {

		while ( have_posts() ) {
			the_post();

			get_template_part( 'template-parts/content', 'coordinates' );
		}
	} else {

		echo '<p class="no-post">' . esc_html__( 'Sorry, no posts matched your criteria.', 'usces' ) . '</p>';

	}

	?>

	<nav class="navigation single-coord-navigation" role="navigation">

		<?php
		$display_model_info = mode_get_options( 'display_post_model_info' );
		$model_items_cont   = mode_get_options( 'display_post_model_items' );
		if ( ! is_array( $model_items_cont ) ) {
			$model_items_cont = array();
		}
		$nextpost = get_adjacent_post( false, '', false );
		if ( $nextpost ) :
			?>
			<div class="nextpost nav_block">
				<a href="<?php echo esc_url( get_permalink( $nextpost->ID ) ); ?>">
					<?php
					$terms = get_the_terms( $nextpost->ID, 'model' );
					if ( $terms && 'show' === $display_model_info ) {
						foreach ( $terms as $term ) {
							$term_id       = $term->term_id;
							$model_img_url = get_term_meta( $term_id, 'model-img-url', true );
							$model_img_id  = get_term_meta( $term_id, 'model-img-id', true );
							$model_name    = get_term_meta( $term_id, 'model_name', true );
							$model_type    = get_term_meta( $term_id, 'model_type', true );
							$model_height  = get_term_meta( $term_id, 'model_height', true );
							if ( ! empty( $model_img_id ) && in_array( 'thumbnail', $model_items_cont, true ) && has_post_thumbnail( $nextpost->ID ) ) {
								echo '<div class="thumbnail">' . get_the_post_thumbnail( $nextpost->ID, 'thumbnail' ) . '</div>';
							} else {
								echo '<div class="thumbnail"><img src="' . esc_url( get_template_directory_uri() ) . '/assets/images/model_icon.svg" alt="noimage"></div>';
							}
							echo '<div class="text">';
							if ( in_array( 'name', $model_items_cont, true ) ) {
								echo '<span class="name">' . esc_html( $term->name ) . '</span>';
							}
							echo '<div class="in">';
							if ( in_array( 'sex', $model_items_cont, true ) ) {
								echo '<span class="type">' . esc_html( $model_type ) . '</span>';
							}
							if ( in_array( 'height', $model_items_cont, true ) ) {
								echo '<span class="height">( ' . esc_html( $model_height ) . 'cm )</span>';
							}
							echo '<span class="post_title">' . esc_attr( $nextpost->post_title ) . '</span>';
							echo '</div></div>';
							break;
						}
					} else {
						if ( has_post_thumbnail( $nextpost->ID ) ) {
								echo '<div class="thumbnail">' . get_the_post_thumbnail( $nextpost->ID, 'thumbnail' ) . '</div>';
						} else {
							echo '<div class="thumbnail"><img src="' . esc_url( get_template_directory_uri() ) . '/assets/images/model_icon.svg" alt="noimage"></div>';
						}
						echo '<div class="text"<span class="post_title">' . esc_html( $nextpost->post_title ) . '</span></div>';
					}
					?>
				</a>
			</div>
			<?php
		endif;
		$prevpost = get_adjacent_post( false, '', true ); if ( $prevpost ) :
			?>
			<div class="prevpost nav_block">
				<a href="<?php echo esc_url( get_permalink( $prevpost->ID ) ); ?>">
					<?php
					$terms = get_the_terms( $prevpost->ID, 'model' );
					if ( $terms && 'show' === $display_model_info ) {
						foreach ( $terms as $term ) {
							$term_id       = $term->term_id;
							$model_img_url = get_term_meta( $term_id, 'model-img-url', true );
							$model_img_id  = get_term_meta( $term_id, 'model-img-id', true );
							$model_name    = get_term_meta( $term_id, 'model_name', true );
							$model_type    = get_term_meta( $term_id, 'model_type', true );
							$model_height  = get_term_meta( $term_id, 'model_height', true );
							if ( ! empty( $model_img_id ) && in_array( 'thumbnail', $model_items_cont, true ) && has_post_thumbnail( $prevpost->ID ) ) {
								echo '<div class="thumbnail">' . get_the_post_thumbnail( $prevpost->ID, 'thumbnail' ) . '</div>';
							} else {
								echo '<div class="thumbnail"><img src="' . esc_url( get_template_directory_uri() ) . '/assets/images/model_icon.svg" alt="noimage"></div>';
							}
							echo '<div class="text">';
							if ( in_array( 'name', $model_items_cont, true ) ) {
								echo '<span class="name">' . esc_html( $term->name ) . '</span>';
							}
							echo '<div class="in">';
							if ( in_array( 'sex', $model_items_cont, true ) ) {
								echo '<span class="type">' . esc_html( $model_type ) . '</span>';
							}
							if ( in_array( 'height', $model_items_cont, true ) ) {
								echo '<span class="height">( ' . esc_html( $model_height ) . 'cm )</span>';
							}
							echo '<span class="post_title">' . esc_attr( $prevpost->post_title ) . '</span>';
							echo '</div></div>';
							break;
						}
					} else {
						if ( has_post_thumbnail( $prevpost->ID ) ) {
								echo '<div class="thumbnail">' . get_the_post_thumbnail( $prevpost->ID, 'thumbnail' ) . '</div>';
						} else {
							echo '<div class="thumbnail"><img src="' . esc_url( get_template_directory_uri() ) . '/assets/images/model_icon.svg" alt="noimage"></div>';
						}
						echo '<div class="text"<span class="post_title">' . esc_attr( $prevpost->post_title ) . '</span></div>';
					}
					?>
				</a>
			</div>
			<?php
		endif;
		?>

	</nav>
	<!-- 関連記事 -->
    <?php if(has_category() ) {
    $catlist =get_the_category();
    $category = array();
    foreach($catlist as $cat){
        $category[] = $cat->term_id;
    }}
    ?>
    <?php $args = array(
    'post_type' => 'coordinates',
    'posts_per_page' => '4', //表示させたい記事数
    'post__not_in' =>array( $post->ID ), //現在の記事は含めない
    'category__in' => $category, //先ほど取得したカテゴリー内の記事
    'orderby' => 'rand' //ランダムで取得
    );
    $related_query = new WP_Query( $args );?>
    <aside class="related_post_coodi">
    <h3>関連記事</h3>
    <ul class="related_post_container">
        <?php while ( $related_query->have_posts() ) : $related_query->the_post(); ?>
        <li>
            <a href="<?php the_permalink(); ?>">
                <!-- アイキャッチ表示 -->
                <div class="related_thumb_coordi_two"><?php the_post_thumbnail('medium'); ?></div>
                <!-- タイトル表示 -->
                <p class="related_title"><?php the_title(); ?></p>
                <!--日付表示-->
                <div class="date_time"><?php echo get_the_date( $format, $post ); ?></div>
            </a>
        </li>
        <?php endwhile; ?>
        <?php wp_reset_postdata(); //最後に記事のリセット?>
    </ul>
    </aside>
    <!-- トピック記事 -->
    <?php if(has_category() ) {
    $catlist =get_the_category();
    $category = array();
    foreach($catlist as $cat){
        $category[] = $cat->term_id;
    }}
    ?>
    <?php $args = array(
    'post_type' => 'features',
    'posts_per_page' => '4', //表示させたい記事数
    'post__not_in' =>array( $post->ID ), //現在の記事は含めない
    'category__in' => $category, //先ほど取得したカテゴリー内の記事
    'orderby' => 'rand' //ランダムで取得
    );
    $related_query = new WP_Query( $args );?>
    <aside class="related_post_coodi">
    <h3>特集記事</h3>
    <ul class="related_post_container">
        <?php while ( $related_query->have_posts() ) : $related_query->the_post(); ?>
        <li>
            <a href="<?php the_permalink(); ?>">
                <!-- アイキャッチ表示 -->
                <div class="related_thumb_fear_two"><?php the_post_thumbnail('medium'); ?></div>
                <!-- タイトル表示 -->
                <p class="related_title"><?php the_title(); ?></p>
                <!--日付表示-->
                <div class="date_time"><?php echo get_the_date( $format, $post ); ?></div>
            </a>
        </li>
        <?php endwhile; ?>
        <?php wp_reset_postdata(); //最後に記事のリセット?>
    </ul>
    </aside>
<?php
get_footer();
