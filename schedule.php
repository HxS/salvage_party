<?php
/*
Template Name: SCHEDULE
*/

get_header(); ?>


<div class="mainContent mainContent--schedule">
  <?php
    global $more;
    if(have_posts()) :
      while(have_posts()) :
        $more = 1;
        the_post(); ?>

        <header class="mainContent__header contentHeader">
          <h2 class="contentHeader__title">
            <?php the_title(); ?>
          </h2>
          <p class="contentHeader__subTitle">
            サブタイトルを表示
          </p>
          <?php breadcrumb(); ?>
        </header>

        <?php
      endwhile;
    else: ?>

      <p>
        該当する記事が見当たりませんでした。
      </p>

    <?php endif; ?>


    <article class="mainContent__article">
      <!-- ここから -->
      <ul class="scheduleItemList">
        <?php
        $args = array( 'post_type' => 'schedule', 'posts_per_page' => 5 );
        $loop = new WP_Query( $args );
        while ( $loop->have_posts() ) : $loop->the_post();
        ?>
          <li class="scheduleItemList__item scheduleItem">
            <div class='scheduleItem__thumbnail' style="background-image: url('<?php
              echo the_post_thumbnail_url();
            ?>')"/></div>
            <div class="scheduleItem__contents">
              <div class="wrapper">
                <div class="scheduleItem__outline scheduleOutline">
                  <span class='scheduleOutline__date'><?php
                    $full_date_string = implode('-', array_reverse(explode('/',get_post_meta($post->ID, 'date', true))));
                    $formatted_date_string = date('n/j',strtotime($full_date_string));
                    echo $formatted_date_string;
                  ?></span>
                  <span class='scheduleOutline__weekday'>[<?php
                    $weekday_list = ['日', '月', '火', '水', '木', '金', '土'];
                    echo $weekday_list[(int)date('w',strtotime($full_date_string))];
                  ?>]</span>
                  <span class='scheduleOutline__region'><?php
                    $term_list = wp_get_post_terms($post->ID, 'event_region', array("fields" => "names"));
                    echo $term_list[0];
                  ?></span>
                  <h3 class="scheduleOutline__title"><?php the_title(); ?></h3>
                  <span class="scheduleOutline__location">
                    @ <?php echo get_post_meta($post->ID, 'location', true); ?>
                  </span>
                </div>
                <div class='scheduleItem__ambassador' /></div>
              </div>
              <p class="scheduleItem__description">
                <?php
                  if(mb_strlen($post->post_content, 'UTF-8')>100){
                  	$content= mb_substr(strip_tags($post->post_content), 0, 100, 'UTF-8');
                  	echo $content.'……';
                  }else{
                  	echo $post->post_content;
                  }
                ?>
              </p>
              <div class="wrapper">
                <p class="scheduleItem__update">
                  更新日 : <?php the_modified_date('Y/m/d') ?>
                </p>
                <a class="scheduleItem__join" href='#'>
                  参加する
                </a>
              </div>
            </div>
          </li>
        <?php endwhile; ?>
      </ul>

      <?php
        pagination($additional_loop->max_num_pages);
      ?>
      <!-- ここまで -->
    </article>
  <?php get_sidebar(); ?>
</div>

<?php get_footer(); ?>
