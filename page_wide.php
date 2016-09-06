<?php
/*
Template Name: [固定ページ]横幅が広い固定ページ
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
          <p class="contentHeader__subTitle">
            サブタイトルを表示
          </p>
          <?php breadcrumb(); ?>
        </header>

        <article class="mainContent__article">
          <?php the_content(); ?>
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
