<?php
/*
Template Name: [固定ページ]運営団体についてのリンク付き固定ページ
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
          <div class="links">
            <a class='link' href="#">運営母体について(Food Salvage)</a>
            <a class='link' href="#">特集記事</a>
          </div>
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
