<?php
  $query_date = $_GET['date_filter'] ? (int)$_GET['date_filter'] : 0;
?>
<ul class="sidebar">
  <li>
    <a href="<?php
      echo esc_url( get_permalink( get_page_by_title( 'Schedule' ) ) );
    ?>?date_filter=1<?php
      if (isset($_GET['organizer'])):
        echo '&organizer=' . $_GET['organizer'];
      endif;
    ?>">
      <p>予約受付中のイベント</p>
    </a>
  </li>
  <li>
    <a href="<?php
      echo esc_url( get_permalink( get_page_by_title( 'Schedule' ) ) );
    ?>?date_filter=2<?php
      if (isset($_GET['organizer'])):
        echo '&organizer=' . $_GET['organizer'];
      endif;
    ?>">
      <p>終了したイベント</p>
    </a>
  </li>
  <li>
    <a href="<?php
      echo esc_url( get_permalink( get_page_by_title( 'Schedule' ) ) );
    ?>?date_filter=<?php echo $query_date ?>&organizer=公式主催">
      <p>主催イベント</p>
    </a>
  </li>
  <li>
    <a href="<?php
      echo esc_url( get_permalink( get_page_by_title( 'Schedule' ) ) );
    ?>?date_filter=<?php echo $query_date ?>&organizer=アンバサダー主催">
      <p>アンバサダーイベント</p>
    </a>
  </li>
</ul>
