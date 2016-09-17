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
