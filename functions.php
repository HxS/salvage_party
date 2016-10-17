<?php
add_theme_support('post-thumbnails');


// パンくずリスト
// usage: 引数なし
function breadcrumb(){
  global $post;
  $str ='';
  if(!is_home()&&!is_admin()){
    $str.= '<div id="breadcrumb" class="breadcrumb">';
    $str.= '<div itemscope ';
    $str.= 'itemtype="http://data-vocabulary.org/Breadcrumb">';
    $str.= '<a href="';
    $str.= home_url();
    $str.= '" itemprop="url"><span itemprop="title">Home</span></a> ';
    $str.= '&gt; </div>';

    if(is_category()) {
      $cat = get_queried_object();
      if($cat -> parent != 0){
        $ancestors = array_reverse(
          get_ancestors( $cat -> cat_ID, 'category' )
        );
        foreach($ancestors as $ancestor){
          $str.= '<div itemscope ';
          $str.= 'itemtype="http://data-vocabulary.org/Breadcrumb">';
          $str.= '<a href="'. get_category_link($ancestor);
          $str.= '" itemprop="url"><span itemprop="title">';
          $str.= get_cat_name($ancestor) .'</span></a> &gt; </div>';
        }
      }
      $str.= '<div itemscope itemtype="http://data-vocabulary.org/Breadcrumb">';
      $str.= '<a href="'. get_category_link($cat -> term_id);
      $str.= '" itemprop="url"><span itemprop="title">';
      $str.= $cat-> cat_name . '</span></a></div>';

    } elseif(is_page()) {
      if($post -> post_parent != 0 ){
        $ancestors = array_reverse(get_post_ancestors( $post->ID ));
        foreach($ancestors as $ancestor){
          $str.= '<div itemscope ';
          $str.= 'itemtype="http://data-vocabulary.org/Breadcrumb">';
          $str.= '<a href="'. get_permalink($ancestor);
          $str.= '" itemprop="url"><span itemprop="title">';
          $str.= get_the_title($ancestor) .'</span></a> &gt; </div>';
        }
      }
      $str.= '<div itemscope ';
      $str.= 'itemtype="http://data-vocabulary.org/Breadcrumb">';
      $str.= '<span itemprop="title">';
      $str.= get_the_title($post) .'</span></div>';

    } elseif(is_single()){
      $categories = get_the_category($post->ID);
      $cat = $categories[0];
      if($cat -> parent != 0){
        $ancestors = array_reverse(get_ancestors( $cat -> cat_ID, 'category' ));
        foreach($ancestors as $ancestor){
          $str.= '<div itemscope ';
          $str.= 'itemtype="http://data-vocabulary.org/Breadcrumb">';
          $str.= '<a href="'. get_category_link($ancestor).'" itemprop="url">';
          $str.= '<span itemprop="title">'. get_cat_name($ancestor);
          $str.= '</span></a> &gt; </div>';
        }
      }
      $str.='<div itemscope itemtype="http://data-vocabulary.org/Breadcrumb">';
      $str.= '<a href="'. get_category_link($cat -> term_id);
      $str.= '" itemprop="url"><span itemprop="title">';
      $str.= $cat-> cat_name . '</span></a></div>';

    } else{
      $str.= '<div>'. wp_title('', false) .'</div>';
    }

    $str.= '</div>';
  }
  echo $str;
}


// トップページのyoutubeのID指定
add_action('admin_menu', 'top_movie_create_menu');
function register_mysettings() {
  //register our settings
  register_setting( 'top-movie-settings-group', 'youtube-id' );
}

function top_movie_settings_page() {
?>
<div class="wrap">
<h2>Webサイトトップの動画ID</h2>

<form method="post" action="options.php">
    <?php settings_fields( 'top-movie-settings-group' ); ?>
    <?php do_settings_sections( 'top-movie-settings-group' ); ?>
    <table class="form-table">
        <tr valign="top">
        <th scope="row">Youtube ID(https://www.youtube.com/watch?v=xxxxxxx の xxxxxxx にあたる部分)</th>
        <td><input type="text" name="youtube-id" value="<?php echo esc_attr( get_option('youtube-id') ); ?>" /></td>
        </tr>
    </table>

    <?php submit_button(); ?>

    <iframe id="ytplayer" type="text/html" width="640" height="390"
  src="http://www.youtube.com/embed/<?php echo esc_attr( get_option('youtube-id') ); ?>"
  frameborder="0"/>

</form>
</div>
<?php }

function top_movie_create_menu() {
  //create new top-level menu
  add_menu_page('Top Page Youtube ID Settings', 'トップページのYoutube動画ID', 'administrator', __FILE__, 'top_movie_settings_page', '');
  //call register settings function
  add_action( 'admin_init', 'register_mysettings' );
}

function add_my_box() {
  add_meta_box('ambassador_info', '情報', 'ambassador_info_form', 'schedule', 'normal', 'high');
}
add_action('add_meta_boxes', 'add_my_box');

function ambassador_info_form() {
  global $post;
  wp_nonce_field(wp_create_nonce(__FILE__), 'my_nonce');
?>
  <div id="ambassador_info">
  <p>アンバサダーを選択してください。</p>
  <label>アンバサダー名</label>
  <select name="ambassador_id">
    <option name='0'>指定なし</option>
    <?php
    $current_id = get_post_meta( $post->ID, 'ambassador_id', true );
    $args = array( 'post_type' => 'ambassador');
    $loop = new WP_Query( $args );
    while ( $loop->have_posts() ) :
      $loop->the_post();
      $ambassador_id = get_the_ID();
      echo '<option value=' . $ambassador_id;
      if ( $ambassador_id == $current_id ):
        echo ' selected';
      endif;
      echo '>' . get_the_title() . '</option>';
    endwhile; ?>
  </select>
  </div>
<?php
}

function my_box_save($post_id) {
  global $post;
  $my_nonce = isset($_POST['my_nonce']) ? $_POST['my_nonce'] : null;
  if(!wp_verify_nonce($my_nonce, wp_create_nonce(__FILE__))) {
    return $post_id;
  }
  if(defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) { return $post_id; }
  if(!current_user_can('edit_post', $post->ID)) { return $post_id; }
  if($_POST['post_type'] == 'schedule'){
    update_post_meta($post->ID, 'ambassador_id', $_POST['ambassador_id']);
  }
}
add_action('save_post', 'my_box_save');

// CPTUI Post Type

add_action( 'init', 'cptui_register_my_cpts' );
function cptui_register_my_cpts() {
	$labels = array(
		"name" => __( 'Topic', 'salvageparty' ),
		"singular_name" => __( 'Topic', 'salvageparty' ),
		);

	$args = array(
		"label" => __( 'Topic', 'salvageparty' ),
		"labels" => $labels,
		"description" => "TOPICです",
		"public" => true,
		"publicly_queryable" => true,
		"show_ui" => true,
		"show_in_rest" => false,
		"rest_base" => "",
		"has_archive" => false,
		"show_in_menu" => true,
				"exclude_from_search" => false,
		"capability_type" => "post",
		"map_meta_cap" => true,
		"hierarchical" => false,
		"rewrite" => array( "slug" => "topic", "with_front" => true ),
		"query_var" => true,

		"supports" => array( "title", "editor", "thumbnail", "custom-fields" ),					);
	register_post_type( "topic", $args );

	$labels = array(
		"name" => __( 'Report', 'salvageparty' ),
		"singular_name" => __( 'Report', 'salvageparty' ),
		);

	$args = array(
		"label" => __( 'Report', 'salvageparty' ),
		"labels" => $labels,
		"description" => "",
		"public" => true,
		"publicly_queryable" => true,
		"show_ui" => true,
		"show_in_rest" => false,
		"rest_base" => "",
		"has_archive" => false,
		"show_in_menu" => true,
				"exclude_from_search" => false,
		"capability_type" => "post",
		"map_meta_cap" => true,
		"hierarchical" => false,
		"rewrite" => array( "slug" => "report", "with_front" => true ),
		"query_var" => true,

		"supports" => array( "title", "editor", "thumbnail" ),					);
	register_post_type( "report", $args );

	$labels = array(
		"name" => __( 'Interview and Column', 'salvageparty' ),
		"singular_name" => __( 'Interview & Column', 'salvageparty' ),
		);

	$args = array(
		"label" => __( 'Interview and Column', 'salvageparty' ),
		"labels" => $labels,
		"description" => "",
		"public" => true,
		"publicly_queryable" => true,
		"show_ui" => true,
		"show_in_rest" => false,
		"rest_base" => "",
		"has_archive" => false,
		"show_in_menu" => true,
				"exclude_from_search" => false,
		"capability_type" => "post",
		"map_meta_cap" => true,
		"hierarchical" => false,
		"rewrite" => array( "slug" => "interview", "with_front" => true ),
		"query_var" => true,

		"supports" => array( "title", "editor", "thumbnail" ),					);
	register_post_type( "interview", $args );

	$labels = array(
		"name" => __( 'Information', 'salvageparty' ),
		"singular_name" => __( 'Information', 'salvageparty' ),
		);

	$args = array(
		"label" => __( 'Information', 'salvageparty' ),
		"labels" => $labels,
		"description" => "",
		"public" => true,
		"publicly_queryable" => true,
		"show_ui" => true,
		"show_in_rest" => false,
		"rest_base" => "",
		"has_archive" => false,
		"show_in_menu" => true,
				"exclude_from_search" => false,
		"capability_type" => "post",
		"map_meta_cap" => true,
		"hierarchical" => false,
		"rewrite" => array( "slug" => "information", "with_front" => true ),
		"query_var" => true,

		"supports" => array( "title", "editor" ),					);
	register_post_type( "information", $args );

	$labels = array(
		"name" => __( 'Cooking(Movie)', 'salvageparty' ),
		"singular_name" => __( 'Cooking(Movie)', 'salvageparty' ),
		);

	$args = array(
		"label" => __( 'Cooking(Movie)', 'salvageparty' ),
		"labels" => $labels,
		"description" => "",
		"public" => true,
		"publicly_queryable" => true,
		"show_ui" => true,
		"show_in_rest" => false,
		"rest_base" => "",
		"has_archive" => false,
		"show_in_menu" => true,
				"exclude_from_search" => false,
		"capability_type" => "post",
		"map_meta_cap" => true,
		"hierarchical" => false,
		"rewrite" => array( "slug" => "cooking", "with_front" => true ),
		"query_var" => true,

		"supports" => array( "title", "editor", "custom-fields" ),					);
	register_post_type( "cooking", $args );

	$labels = array(
		"name" => __( 'Recipe', 'salvageparty' ),
		"singular_name" => __( 'Recipe', 'salvageparty' ),
		);

	$args = array(
		"label" => __( 'Recipe', 'salvageparty' ),
		"labels" => $labels,
		"description" => "",
		"public" => true,
		"publicly_queryable" => true,
		"show_ui" => true,
		"show_in_rest" => false,
		"rest_base" => "",
		"has_archive" => false,
		"show_in_menu" => true,
				"exclude_from_search" => false,
		"capability_type" => "post",
		"map_meta_cap" => true,
		"hierarchical" => false,
		"rewrite" => array( "slug" => "recipe", "with_front" => true ),
		"query_var" => true,

		"supports" => array( "title", "editor", "thumbnail" ),					);
	register_post_type( "recipe", $args );

	$labels = array(
		"name" => __( 'Chef', 'salvageparty' ),
		"singular_name" => __( 'Chef', 'salvageparty' ),
		);

	$args = array(
		"label" => __( 'Chef', 'salvageparty' ),
		"labels" => $labels,
		"description" => "",
		"public" => true,
		"publicly_queryable" => true,
		"show_ui" => true,
		"show_in_rest" => false,
		"rest_base" => "",
		"has_archive" => false,
		"show_in_menu" => true,
				"exclude_from_search" => false,
		"capability_type" => "post",
		"map_meta_cap" => true,
		"hierarchical" => false,
		"rewrite" => array( "slug" => "chef", "with_front" => true ),
		"query_var" => true,

		"supports" => array( "title", "editor", "thumbnail" ),					);
	register_post_type( "chef", $args );

	$labels = array(
		"name" => __( 'Producer', 'salvageparty' ),
		"singular_name" => __( 'Producer', 'salvageparty' ),
		);

	$args = array(
		"label" => __( 'Producer', 'salvageparty' ),
		"labels" => $labels,
		"description" => "",
		"public" => true,
		"publicly_queryable" => true,
		"show_ui" => true,
		"show_in_rest" => false,
		"rest_base" => "",
		"has_archive" => false,
		"show_in_menu" => true,
				"exclude_from_search" => false,
		"capability_type" => "post",
		"map_meta_cap" => true,
		"hierarchical" => false,
		"rewrite" => array( "slug" => "producer", "with_front" => true ),
		"query_var" => true,

		"supports" => array( "title", "editor", "thumbnail" ),					);
	register_post_type( "producer", $args );

	$labels = array(
		"name" => __( 'Ambassador', 'salvageparty' ),
		"singular_name" => __( 'Ambassador', 'salvageparty' ),
		);

	$args = array(
		"label" => __( 'Ambassador', 'salvageparty' ),
		"labels" => $labels,
		"description" => "",
		"public" => true,
		"publicly_queryable" => true,
		"show_ui" => true,
		"show_in_rest" => false,
		"rest_base" => "",
		"has_archive" => false,
		"show_in_menu" => true,
				"exclude_from_search" => false,
		"capability_type" => "post",
		"map_meta_cap" => true,
		"hierarchical" => false,
		"rewrite" => array( "slug" => "ambassador", "with_front" => true ),
		"query_var" => true,

		"supports" => array( "title", "editor", "thumbnail" ),					);
	register_post_type( "ambassador", $args );

	$labels = array(
		"name" => __( 'Schedule', 'salvageparty' ),
		"singular_name" => __( 'Schedule', 'salvageparty' ),
		);

	$args = array(
		"label" => __( 'Schedule', 'salvageparty' ),
		"labels" => $labels,
		"description" => "",
		"public" => true,
		"publicly_queryable" => true,
		"show_ui" => true,
		"show_in_rest" => false,
		"rest_base" => "",
		"has_archive" => false,
		"show_in_menu" => true,
				"exclude_from_search" => false,
		"capability_type" => "post",
		"map_meta_cap" => true,
		"hierarchical" => false,
		"rewrite" => array( "slug" => "schedule", "with_front" => true ),
		"query_var" => true,

		"supports" => array( "title", "editor", "thumbnail", "custom-fields" ),					);
	register_post_type( "schedule", $args );

	$labels = array(
		"name" => __( 'Partner', 'salvageparty' ),
		"singular_name" => __( 'Partner', 'salvageparty' ),
		);

	$args = array(
		"label" => __( 'Partner', 'salvageparty' ),
		"labels" => $labels,
		"description" => "",
		"public" => true,
		"publicly_queryable" => true,
		"show_ui" => true,
		"show_in_rest" => false,
		"rest_base" => "",
		"has_archive" => false,
		"show_in_menu" => true,
				"exclude_from_search" => false,
		"capability_type" => "post",
		"map_meta_cap" => true,
		"hierarchical" => false,
		"rewrite" => array( "slug" => "partner", "with_front" => true ),
		"query_var" => true,

		"supports" => array( "title", "editor", "thumbnail" ),					);
	register_post_type( "partner", $args );

// End of cptui_register_my_cpts()
}

// CPTUI Taxonomies

add_action( 'init', 'cptui_register_my_taxes' );
function cptui_register_my_taxes() {
	$labels = array(
		"name" => __( 'Information Tag', 'salvageparty' ),
		"singular_name" => __( 'Information Tag', 'salvageparty' ),
		);

	$args = array(
		"label" => __( 'Information Tag', 'salvageparty' ),
		"labels" => $labels,
		"public" => true,
		"hierarchical" => false,
		"label" => "Information Tag",
		"show_ui" => true,
		"show_in_menu" => true,
		"show_in_nav_menus" => true,
		"query_var" => true,
		"rewrite" => array( 'slug' => 'information_tag', 'with_front' => true, ),
		"show_admin_column" => false,
		"show_in_rest" => false,
		"rest_base" => "",
		"show_in_quick_edit" => false,
	);
	register_taxonomy( "information_tag", array( "information" ), $args );

	$labels = array(
		"name" => __( 'イベント開催地域', 'salvageparty' ),
		"singular_name" => __( 'イベント開催地域', 'salvageparty' ),
		);

	$args = array(
		"label" => __( 'イベント開催地域', 'salvageparty' ),
		"labels" => $labels,
		"public" => true,
		"hierarchical" => false,
		"label" => "イベント開催地域",
		"show_ui" => true,
		"show_in_menu" => true,
		"show_in_nav_menus" => true,
		"query_var" => true,
		"rewrite" => array( 'slug' => 'event_region', 'with_front' => true, ),
		"show_admin_column" => false,
		"show_in_rest" => false,
		"rest_base" => "",
		"show_in_quick_edit" => false,
	);
	register_taxonomy( "event_region", array( "schedule" ), $args );

// End cptui_register_my_taxes()
}

function update_custom_meta_views() {
  global $post;
  if ( 'publish' === get_post_status( $post ) && is_single() ) {
    $views = intval( get_post_meta( $post->ID, '_custom_meta_views', true ) );
    update_post_meta( $post->ID, '_custom_meta_views', ( $views + 1 ) );
  }
}
add_action( 'wp_head', 'update_custom_meta_views' );


function set_custom_meta_views() {
  global $post;
  if(!get_post_meta( $post->ID, '_custom_meta_views', true )) {
    add_post_meta( $post->ID, '_custom_meta_views', ( 0 ) );
  }
}
add_action( 'save_post', 'set_custom_meta_views' );

function create_pages_and_setting() {
  $sample_content = '
    これはサンプルページです。同じ位置に固定され、(多くのテーマでは) サイトナビゲーションメニューに含まれるため、ブログ投稿とは異なります。サイト訪問者に対して自分のことを説明する自己紹介ページを作成するのが一般的です。たとえば以下のようなものになります。
    <blockquote>はじめまして。昼間はバイク便のメッセンジャーとして働いていますが、俳優志望でもあります。これは僕のブログです。ロサンゼルスに住み、ジャックという名前のかわいい犬を飼っています。好きなものはピニャコラーダ (通り雨に濡れるのも) 。</blockquote>
    または、このようなものでもよいでしょう。
    <blockquote>XYZ 小道具株式会社は1971年の創立以来、高品質の小道具を皆様にご提供させていただいています。ゴッサム・シティに所在する当社では2,000名以上の社員が働いており、様々な形で地域のコミュニティへ貢献しています。</blockquote>
    新しく WordPress ユーザーになった方は、<a href="http://localhost:8001/wp-admin/">ダッシュボード</a>へ行ってこのページを削除し、独自のコンテンツを含む新しいページを作成してください。それでは、お楽しみください !
  ';
  $make_posts = array(
    array(
      'post_title'    => 'About',
      'post_name'     => 'about',
      'post_status'   => 'publish',
      'post_type'     => 'page',
      'page_template' => 'page.php',
      'post_content'  => $sample_content,
      'children'      => array(
        array(
          'post_title'    => 'サルベージ・パーティとは',
          'post_name'     => 'party',
          'post_status'   => 'publish',
          'post_type'     => 'page',
          'page_template' => 'page.php',
          'post_content'  => $sample_content,
          'post_parent'   => get_page_by_path('about')->ID,
        ),
        array(
          'post_title'    => 'フードロスの現状',
          'post_name'     => 'foodloss',
          'post_status'   => 'publish',
          'post_type'     => 'page',
          'page_template' => 'page_link.php',
          'post_content'  => $sample_content,
          'post_parent'   => get_page_by_path('about')->ID,
        ),
        array(
          'post_title'    => 'サルベージ・レシピの紹介',
          'post_name'     => 'recipe',
          'post_status'   => 'publish',
          'post_type'     => 'page',
          'page_template' => 'recipe.php',
          'post_content'  => '',
          'post_parent'   => get_page_by_path('about')->ID,
        ),
        array(
          'post_title'    => 'サルベージ・シェフの紹介',
          'post_name'     => 'chef',
          'post_status'   => 'publish',
          'post_type'     => 'page',
          'page_template' => 'chef.php',
          'post_content'  => '',
          'post_parent'   => get_page_by_path('about')->ID,
        ),
        array(
          'post_title'    => 'サルベージ・プロデューサーの紹介',
          'post_name'     => 'producer',
          'post_status'   => 'publish',
          'post_type'     => 'page',
          'page_template' => 'producer.php',
          'post_content'  => '',
          'post_parent'   => get_page_by_path('about')->ID,
        ),
        array(
          'post_title'    => 'サルベージ・アンバサダーの紹介',
          'post_name'     => 'ambassador',
          'post_status'   => 'publish',
          'post_type'     => 'page',
          'page_template' => 'ambassador.php',
          'post_content'  => '',
          'post_parent'   => get_page_by_path('about')->ID,
        ),
        array(
          'post_title'    => 'パートナー・賛同企業',
          'post_name'     => 'partner',
          'post_status'   => 'publish',
          'post_type'     => 'page',
          'page_template' => 'partner.php',
          'post_content'  => '',
          'post_parent'   => get_page_by_path('about')->ID,
        ),
        array(
          'post_title'    => '運営母体(外部リンク)',
          'post_name'     => 'organization',
          'post_status'   => 'publish',
          'post_type'     => 'page',
          'page_template' => 'page.php',
          'post_content'  => $sample_content,
          'post_parent'   => get_page_by_path('about')->ID,
        ),
      ),
    ),

    array(
      'post_title'    => 'Action',
      'post_name'     => 'action',
      'post_status'   => 'publish',
      'post_type'     => 'page',
      'page_template' => 'action.php',
      'post_content'  => $sample_content,
      'children'      => array(
        array(
          'post_title'    => 'パーティに参加する',
          'post_name'     => 'join',
          'post_status'   => 'publish',
          'post_type'     => 'page',
          'page_template' => 'page_sns_sharable.php',
          'post_content'  => $sample_content,
          'post_parent'   => get_page_by_path('action')->ID,
        ),
        array(
          'post_title'    => 'パーティを開く',
          'post_name'     => 'open',
          'post_status'   => 'publish',
          'post_type'     => 'page',
          'page_template' => 'page_sns_sharable.php',
          'post_content'  => $sample_content,
          'post_parent'   => get_page_by_path('action')->ID,
        ),
        array(
          'post_title'    => 'シェフになる',
          'post_name'     => 'chef',
          'post_status'   => 'publish',
          'post_type'     => 'page',
          'page_template' => 'page_sns_sharable.php',
          'post_content'  => $sample_content,
          'post_parent'   => get_page_by_path('action')->ID,
        ),
        array(
          'post_title'    => '資格をとる',
          'post_name'     => 'license',
          'post_status'   => 'publish',
          'post_type'     => 'page',
          'page_template' => 'page_wide.php',
          'post_content'  => $sample_content,
          'post_parent'   => get_page_by_path('action')->ID,
        ),
        array(
          'post_title'    => '企業として参加する',
          'post_name'     => 'company',
          'post_status'   => 'publish',
          'post_type'     => 'page',
          'page_template' => 'page_wide_download.php',
          'post_content'  => $sample_content,
          'post_parent'   => get_page_by_path('action')->ID,
        ),
      ),
    ),
    array(
      'post_title'    => 'Schedule',
      'post_name'     => 'schedule',
      'post_status'   => 'publish',
      'post_type'     => 'page',
      'page_template' => 'schedule.php',
      'post_content'  => $sample_content,
    ),
    array(
      'post_title'    => 'Topic',
      'post_name'     => 'topic',
      'post_status'   => 'publish',
      'post_type'     => 'page',
      'page_template' => 'topic.php',
      'post_content'  => $sample_content,
    ),
    array(
      'post_title'    => 'Report',
      'post_name'     => 'report',
      'post_status'   => 'publish',
      'post_type'     => 'page',
      'page_template' => 'report.php',
      'post_content'  => $sample_content,
    ),
    array(
      'post_title'    => 'Feature',
      'post_name'     => 'feature',
      'post_status'   => 'publish',
      'post_type'     => 'page',
      'page_template' => 'feature.php',
      'post_content'  => $sample_content,
    ),
    array(
      'post_title'    => 'Information',
      'post_name'     => 'information',
      'post_status'   => 'publish',
      'post_type'     => 'page',
      'page_template' => 'information.php',
      'post_content'  => $sample_content,
    ),
    array(
      'post_title'    => 'FAQ',
      'post_name'     => 'faq',
      'post_status'   => 'publish',
      'post_type'     => 'page',
      'page_template' => 'page_wide.php',
      'post_content'  => $sample_content,
    ),
    array(
      'post_title'    => 'Contact',
      'post_name'     => 'contact',
      'post_status'   => 'publish',
      'post_type'     => 'page',
      'page_template' => 'page_wide.php',
      'post_content'  => $sample_content,
    ),
  );
  $count_first = 0;
  foreach ($make_posts as $make_post) {
    if (NULL === get_page_by_path( $make_post['post_name'] )) {
      $insert_args = array_merge($make_post, array('menu_order' => $count_first));
      wp_insert_post($insert_args);
    } else {
      if (!(NULL === $make_post['children'])) {
        $count_second = 0;
        foreach ($make_post['children'] as $make_child) {
          if (NULL === get_page_by_path( $make_post['post_name'] . '/' . $make_child['post_name'] )) {
            $insert_args = array_merge($make_child, array('menu_order' => $count_second));
            wp_insert_post($insert_args);
          }
          $count_second++;
        }
      }
    }
    $count_first++;
  }

}

add_filter( 'image_send_to_editor', 'remove_image_attribute', 10 );
add_filter( 'post_thumbnail_html', 'remove_image_attribute', 10 );

function remove_image_attribute( $html ){
	$html = preg_replace( '/(width|height)="\d*"\s/', '', $html );
	$html = preg_replace( '/class=[\'"]([^\'"]+)[\'"]/i', '', $html );
	$html = preg_replace( '/title=[\'"]([^\'"]+)[\'"]/i', '', $html );
	$html = preg_replace( '/<a href=".+">/', '', $html );
	$html = preg_replace( '/<\/a>/', '', $html );
	return $html;
}
add_action('after_setup_theme', 'create_pages_and_setting');

add_action( 'admin_print_styles', 'admin_css_custom' );
function admin_css_custom() {
	echo '<style>.attachment-details label[data-setting="caption"], .attachment-details label[data-setting="description"], div.attachment-display-settings { display: none; }</style>';
}
