<?php
/*
Template Name: CHEF
*/

get_header(); ?>


<div class="mainContent wow slideInUp mainContent--chef">
  <?php the_content(); ?>
  <?php
  global $more;
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


  <article class="mainContent__article wow slideInLeft">
    <!-- ここから -->

    <ul class="chefList__list">
      <?php
        $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
        $args = array(
          'post_type' => 'chef',
          'posts_per_page' => 16,
          'paged' => $paged
        );
        $loop = new WP_Query( $args );
        while ( $loop->have_posts() ) : $loop->the_post();
          $ambassador_id = get_post_meta($post->ID, "ambassador_id", true);
      ?>
        <li class="chefList__item chefListItem">
          <a href="<?php echo post_permalink($post->ID); ?>">
            <div class="chefListItem__thumbnail" style="background-image: url('<?php
             echo the_post_thumbnail_url();
            ?>')">
            </div>
            <?php the_title(); ?>
          </a>
        </li>
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
  <?php get_sidebar(); ?>
</div>

<?php get_footer(); ?>
