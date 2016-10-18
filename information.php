<?php
/*
Template Name: INFORMATION
*/

get_header(); ?>


<div class="mainContent wow slideInUp mainContent--topic">
  <?php the_content(); ?>
  <?php
  global $more;
  global $page_post;
  $page_post = $post;
  if(have_posts()) :
    while(have_posts()) :
      $more = 1;
    the_post(); ?>

    <header class="mainContent__header contentHeader">
      <h2 class="contentHeader__title">
        <?php the_title(); ?>
      </h2>
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
    <ul class="topicList__list clearfix">
      <?php $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
        $args = array(
          'post_type' => 'information',
          'posts_per_page' => 8,
          'paged' => $paged
        );
        if ($_GET['sort'] == 'popular') :
          $args = array_merge($args, array(
            'orderby' => 'meta_value_num',
            'meta_key' => '_custom_meta_views',
            'order' => 'DESC'
          ));
        endif;
        $loop = new WP_Query( $args );
        $while_count = 0;
        while ( $loop->have_posts() ) : $loop->the_post();
          $while_count++;
      ?>
        <li class="topicList__item topicListItem topicListItem-topic">
          <a href="<?php echo post_permalink($post->ID); ?>">
            <div class="topicListItem__thumbnail-tag topicListItem__thumbnail-tag--<?php
              $term_list = wp_get_post_terms($post->ID, 'information_tag', array("fields" => "names"));
              echo strtolower($term_list[0]);
            ?>"><?php
              echo $term_list[0];
            ?></div>
            <div class="topicListItem__thumbnail" style="background-image: url('<?php
              echo the_post_thumbnail_url();
              ?>')">
            </div>
            <div class="topicListItem__description">
              <time><?php the_time('Y/m/d') ?></time>
              <title><?php the_title(); ?></title>
              <small><?php
                if(mb_strlen($post->post_content, 'UTF-8')>100){
                  $content= mb_substr(strip_tags($post->post_content), 0, 100, 'UTF-8');
                  echo $content.'……';
                }else{
                  echo $post->post_content;
                }
              ?></small>
            </div>
          </a>
        </li>
        <?php if ($while_count % 2 == 0) : ?>
          </ul>
          <ul class="topicList__list clearfix">
        <?php endif; ?>
      <?php endwhile; ?>
    </ul>
    <?php
    $big = 999999999; // need an unlikely integer

    echo paginate_links( array(
      'format' => '?paged=%#%',
      'current' => max( 1, get_query_var('paged') ),
      'total' => $loop->max_num_pages
    ) );

    $post = $page_post;
    ?>
    <!-- ここまで -->
  </article>
  <?php get_sidebar('information'); ?>
</div>

<?php get_footer(); ?>
