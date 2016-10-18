<?php
  $current_tag_query = '';
  $current_sort_query = '';
  if (isset($_GET['topic_tag'])) :
    $current_tag_query = '&topic_tag=' . $_GET['topic_tag'];
  endif;
  if (isset($_GET['sort'])) :
    $current_sort_query = '&sort=' . $_GET['sort'];
  endif;
?>

<ul class="sidebar wow slideInRight">
  <li>
    <a href="<?php
      echo esc_url( get_permalink( get_page_by_path( 'topic' ) ) );
    ?>&topic_tag=Event<?php echo $current_sort_query; ?>">
      <p>イベント</p>
    </a>
  </li>
  <li>
    <a href="<?php
      echo esc_url( get_permalink( get_page_by_path( 'topic' ) ) );
    ?>&topic_tag=Party<?php echo $current_sort_query; ?>">
      <p>パーティ</p>
    </a>
  </li>
  <li>
    <a href="<?php
      echo esc_url( get_permalink( get_page_by_path( 'topic' ) ) );
    ?>&topic_tag=Class<?php echo $current_sort_query; ?>">
      <p>講習</p>
    </a>
  </li>
  <li>
    <a href="<?php
      echo esc_url( get_permalink( get_page_by_path( 'topic' ) ) );
    ?>&topic_tag=News<?php echo $current_sort_query; ?>">
      <p>ニュース</p>
    </a>
  </li>
  <li>
    <span></span>
  </li>
  <li>
    <span>ソート</span>
  </li>
  <li>
    <a href="<?php
      echo esc_url( get_permalink( get_page_by_path( 'topic' ) ) );
      echo $current_tag_query ;
    ?>&sort=newest">
      <p>新着順</p>
    </a>
  </li>
  <li>
    <a href="<?php
      echo esc_url( get_permalink( get_page_by_path( 'topic' ) ) );
      echo $current_tag_query ;
    ?>&sort=popular">
      <p>人気順</p>
    </a>
  </li>
</ul>
