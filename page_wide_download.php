<?php
/*
Template Name: [固定ページ]入会案内DLリンク付き固定ページ
*/

get_header(); ?>

<div class="mainContent mainContent--widePage">
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
            <a  href="#">入会案内をダウンロード</a>
          </div>
        </article>

        <?php
      endwhile;
    else: ?>

      <p>
        該当する記事が見当たりませんでした。
      </p>

    <?php endif; ?>
</div>

<?php get_footer(); ?>
