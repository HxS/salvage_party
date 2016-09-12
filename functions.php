<?php

// 以前のサイトのCPT UIからインポート
add_action( 'init', 'cptui_register_my_cpts_news' );
function cptui_register_my_cpts_news() {
  $labels = array(
    "name" => __( 'NEWS', 'salvageparty' ),
    "singular_name" => __( 'news', 'salvageparty' ),
  );

  $args = array(
    "label" => __( 'NEWS', 'salvageparty' ),
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
    "rewrite" => array( "slug" => "news", "with_front" => true ),
    "query_var" => true,
    "supports" => array( "title", "custom-fields", "post-formats" ),
  );
  register_post_type( "news", $args );
}
// End of cptui_register_my_cpts_news()

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
