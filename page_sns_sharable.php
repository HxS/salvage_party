<?php
/*
Template Name: [固定ページ]SNSで共有可能な固定ページ
*/

get_header(); ?>

<div class="mainContent mainContent--page">
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
          <?php breadcrumb(); ?>
        </header>

        <article class="mainContent__article">
          <?php the_content(); ?>
          <?php get_template_part('modules/module-sns'); ?>
        </article>

        <?php
      endwhile;
    else: ?>

      <p>
        該当する記事が見当たりませんでした。
      </p>

    <?php endif; ?>

  <?php get_sidebar(); ?>
</div>

<?php get_footer(); ?>
