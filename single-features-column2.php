<?php
/**
 * Template Name: 2カラムテンプレート
 * Template Post Type: features
 * Single Template for Features
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

			get_template_part( 'template-parts/content', 'features' );
		}
	} else {

		echo '<p class="no-post">' . esc_html__( 'Sorry, no posts matched your criteria.', 'usces' ) . '</p>';

	}

	?>

	<nav class="navigation single-post-navigation" role="navigation">
		<ul class="nav-links">
			<li class="nav-previous"><?php previous_post_link( '%link', '%title' ); ?></li>
			<li class="nav-next"><?php next_post_link( '%link', '%title' ); ?></li>
		</ul>
	</nav>

<!-- 最近閲覧した記事 -->
<aside class="latest_post_wrap">
    <div class="latest_post">最近閲覧した記事</div>
    <?php readpost_typecheack(4); ?>
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
    'post_type' => 'features',
    'posts_per_page' => '4', //表示させたい記事数
    'post__not_in' =>array( $post->ID ), //現在の記事は含めない
    'category__in' => $category, //先ほど取得したカテゴリー内の記事
    'orderby' => 'rand' //ランダムで取得
);
$related_query = new WP_Query( $args );?>
<aside class="related_post">
    <h3>関連記事</h3>
    <ul class="related_post_container">
        <?php while ( $related_query->have_posts() ) : $related_query->the_post(); ?>
        <li>
            <a href="<?php the_permalink(); ?>">
                <!-- アイキャッチ表示 -->
                <div class="related_thumb"><?php the_post_thumbnail(); ?></div>
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
    'post_type' => 'coordinates',
    'posts_per_page' => '4', //表示させたい記事数
    'post__not_in' =>array( $post->ID ), //現在の記事は含めない
    'category__in' => $category, //先ほど取得したカテゴリー内の記事
    'orderby' => 'rand' //ランダムで取得
);
$related_query = new WP_Query( $args );?>
<aside class="related_post">
    <h3>ピックアップ記事</h3>
    <ul class="related_post_container">
        <?php while ( $related_query->have_posts() ) : $related_query->the_post(); ?>
        <li>
            <a href="<?php the_permalink(); ?>">
                <!-- アイキャッチ表示 -->
                <div class="related_thumb_coordi"><?php the_post_thumbnail(); ?></div>
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
