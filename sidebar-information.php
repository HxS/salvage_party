<?php
  $current_sort_query = '';

  if (isset($_GET['sort'])) :
    $current_sort_query = '&sort=' . $_GET['sort'];
  endif;
?>

<ul class="sidebar wow slideInRight">

  <li>
    <span>ソート</span>
  </li>
  <li>
    <a href="<?php
      echo esc_url( get_permalink( get_page_by_path( 'information' ) ) );
    ?>&sort=newest">
      <p>新着順</p>
    </a>
  </li>
  <li>
    <a href="<?php
      echo esc_url( get_permalink( get_page_by_path( 'information' ) ) );
    ?>&sort=popular">
      <p>人気順</p>
    </a>
  </li>
</ul>
