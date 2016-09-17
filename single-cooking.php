<?php get_header(); ?>


<div class="mainContent mainContent--topicDetail mainContent--widePage">
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


    <article class="mainContent__article ">
      <!-- ここから -->
      <iframe id="ytplayer" type="text/html" width="960" height="540" src="http://www.youtube.com/embed/<?php
        echo get_post_meta( get_the_ID(), 'movie_id', true );
      ?>" frameborder="0"></iframe>

      <?php the_content(); ?>

      <?php get_template_part('modules/module-sns'); ?>
      <!-- ここまで -->
    </article>
</div>

<?php get_footer(); ?>
