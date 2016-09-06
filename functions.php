<?php

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
