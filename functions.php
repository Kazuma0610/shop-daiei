<?php
/**
 * The Functions Template for our theme
 *
 * @package Welcart
 * @subpackage Mode Child
 * @since 1.0.0
 */



add_action( 'wp_enqueue_scripts', 'theme_enqueue_styles', 10 );
function theme_enqueue_styles() {

	$template_dir = get_template_directory_uri();

	wp_enqueue_style( 'parent-style', $template_dir . '/style.css', array( 'reset-style' ) );
	wp_enqueue_style( 'theme_cart_css', $template_dir . '/usces_cart.css',  array( 'reset-style' ) );

	// WCEX Plugin
	if ( defined( 'WCEX_MSA_VERSION' ) ) {
		wp_enqueue_style( 'parent-msa', $template_dir . '/wcex_multi_shipping.css', array( 'msa_style' ), WCEX_MSA_VERSION, false  );	
	}
	if ( defined( 'WCEX_SKU_SELECT' ) ) {
		wp_enqueue_style( 'parent-sku_select', $template_dir . '/wcex_sku_select.css', array(), '1.0');
	}
	if ( defined( 'WCEX_AUTO_DELIVERY' ) ) {
		wp_enqueue_style( 'parent-auto_delivery', $template_dir . '/auto_delivery.css', array(), '1.0');
	}
	if ( defined( 'WCEX_DLSELLER' ) ) {
		wp_enqueue_style( 'parent-auto_delivery', $template_dir . '/dlseller.css', array(), '1.0');
	}
	if( defined( 'WCEX_ORDER_LIST_WIDGET' ) ) {
		wp_enqueue_style( 'parent-olwidget', $template_dir . '/wcex_olwidget.css', array(), '1.0');	
	}

}

//JSの読み込み//
function my_scripts() {
    wp_enqueue_script( 'script-move', get_template_directory_uri() . '/assets/js/move.js', array( 'jquery' ), '1.0.0', true );
    wp_enqueue_script( 'script-header', get_template_directory_uri() . '/assets/js/header.js', array( 'jquery' ), '1.0.0', true );
  }
add_action( 'wp_enqueue_scripts', 'my_scripts' );


//検索対象を『タイトルのみ』にする

function __search_by_title_only( $search, &$wp_query )
{
global $wpdb;
if ( empty( $search ) )
return $search; // skip processing - no search term in query
$q = $wp_query->query_vars;
$n = ! empty( $q['exact'] ) ? '' : '%';
$search =
$searchand = '';
foreach ( (array) $q['search_terms'] as $term ) {
$term = esc_sql( like_escape( $term ) );
$search .= "{$searchand}($wpdb->posts.post_title LIKE '{$n}{$term}{$n}')";
$searchand = ' AND ';
}
if ( ! empty( $search ) ) {
$search = " AND ({$search}) ";
if ( ! is_user_logged_in() )
$search .= " AND ($wpdb->posts.post_password = '') ";
}
return $search;
}
add_filter( 'posts_search', '__search_by_title_only', 500, 2 );

//検索対象を『タイトルのみ』にする-終了


//googleカウントを無効化。（VK並び順ー人気順用）//
/* クロールカウントの無効化 */ 
function is_bot() {
  $ua = $_SERVER['HTTP_USER_AGENT'];
  $bot = array(
    'googlebot',
    'msnbot',
    'yahoo',
  );
  foreach( $bot as $bot ) {
    if (stripos( $ua, $bot ) !== false){
      return true;
    }
  }
  return false;
}

/*サイドバーのウィジェット登録*/
if (function_exists('register_sidebar')) {
  register_sidebar(array(
    'name' => 'サイドバーレフト',
    'id' => 'sidebar-left',
    'description' => 'サイドバーウィジェットトップ左用',
    'before_widget' => '<div>',
    'after_widget' => '</div>',
    'before_title' => '<h3 class="side-title">',
    'after_title' => '</h3>'
 ));
}

/*サイドバーのウィジェット登録２*/
if (function_exists('register_sidebar')) {
  register_sidebar(array(
    'name' => 'サイドバーライト',
    'id' => 'sidebar-right',
    'description' => 'サイドバーウィジェットトップ右用',
    'before_widget' => '<div>',
    'after_widget' => '</div>',
    'before_title' => '<h3 class="side-title">',
    'after_title' => '</h3>'
 ));
}


/*** cookieの設定 ***/
add_action( 'get_header', 'readpost');
 
function readpost() {
global $browsing_histories;
$browsing_histories = null;
$set_this_ID = null;
    if(is_single()){
if( isset($_COOKIE['postid_history']) ){
//postid_historyの部分は任意の文字列でOKです
//cookieの値を呼び出し
$browsing_histories = explode(",", $_COOKIE['postid_history']);
if($browsing_histories[0] != get_the_ID()){
if(count($browsing_histories) >= 50 ){
$set_browsing_histories = array_slice($browsing_histories , 0, 49);
}else{
$set_browsing_histories = $browsing_histories;
}
//値の先頭が現在の記事IDでなければ文字列の一番最初に追加
$set_this_ID = get_the_ID().','.implode(",", $set_browsing_histories);
setcookie( 'postid_history', $set_this_ID, time() + 60 * 60 * 24 * 365 * 1,'/');
// }else{
// 	$set_this_ID = $_COOKIE['postid_history'];
}
}else{
//cookieがなければ、現在の記事IDを保存
$set_this_ID = get_the_ID();
setcookie( 'postid_history', $set_this_ID, time() + 60 * 60 * 24 * 365 * 1,'/');
}
//詳細ページ以外なら呼び出しのみ
}else{
if( isset($_COOKIE['postid_history']) ){
$browsing_histories = explode(",", $_COOKIE['postid_history']);
}
}
$postread = explode(",", $_COOKIE['postid_history']);
$postread = array_unique($postread);
$postread = array_values($postread);
return $postread;
}

/*** 履歴閲覧記事の設定 ***/
function readpost_typecheack($postnum) {
  global $post;
  $postdate = readpost();
  $numlist = 0;
  if(!empty($postdate)):
  ?>
  <div class="post-check-wrap">
  <ul class="my-post-check"><?php
  foreach($postdate as $key =>$val):
  $posttype = get_post_type( $val );
  if($posttype==="features")://ここで記事かどうかを見る。
  if($postnum==$numlist){ break; }
  ?>
  <li>
  <a href="<?php echo get_permalink($val); ?>">
  <figure class="my-widget__img">
  <?php echo get_the_post_thumbnail($val, 'thumb-160'); ?>
  </figure>
  <div class="my-widget__text"><?php echo get_the_title($val); ?>
	</div>
  <div class="post-date dfont"><?php echo get_the_time("Y年m月d日", $val); ?></div>
  
  </a>
  <!--<?php print_r($postcustom); ?>-->
  </li>
  <?php
  $numlist++;
  endif;
  endforeach;
  ?>
  </ul>
  </div>
  <?php
  endif;
  }

/*** 履歴閲覧記事の設定 ***/
function watchedpost_typecheack($postnum) {
  global $post;
  $postdate = readpost();
  $numlist = 0;
  if(!empty($postdate)):
  ?>
  <div class="watched_page">
  <ul><?php
  foreach($postdate as $key =>$val):
  $posttype = get_post_type( $val );
  if($posttype==="post")://ここで記事かどうかを見る。
  if($postnum==$numlist){ break; }
  ?>
  <li>
  <a href="<?php echo get_permalink($val); ?>">
  <figure class="thumbnail-img">
  <?php echo get_the_post_thumbnail($val); ?>
  </figure>
  <div class="watched_info"><?php echo get_the_title($val); ?>
	</div>
  </a>
  <!--<?php print_r($postcustom); ?>-->
  </li>
  <?php
  $numlist++;
  endif;
  endforeach;
  ?>
  </ul>
  </div>
  <?php
  endif;
  }