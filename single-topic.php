<?php get_header(); ?>


<div class="mainContent wow slideInUp mainContent--topicDetail">
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
      <div class="topicTag topicTag--<?php
        echo strtolower(get_post_meta( get_the_ID(), 'topic_tag', true ));
      ?>"><?php
        echo get_post_meta( get_the_ID(), 'topic_tag', true );
      ?></div>
      <time><?php the_time('Y/m/d') ?></time>
      <?php if (get_the_post_thumbnail_url()): ?>
        <img class="topicDetail__image" src="<?php
          echo the_post_thumbnail_url();
        ?>">
      <?php endif; ?>

      <?php the_content(); ?>

      <?php get_template_part('modules/module-sns'); ?>
      <!-- ここまで -->
    </article>
  <?php get_sidebar('detail'); ?>
</div>

<?php get_footer(); ?>
