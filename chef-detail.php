<?php
/*
Template Name: CHEF DETAIL
*/

get_header(); ?>


<div class="mainContent mainContent--chefDetail">
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
      <h3 class="contentHeader__articleTitle">シェフ名</h3>
      <img class="chefDetail__image" src="<?php
             echo get_template_directory_uri() . '/images/mock_recipe.png';
            ?>">
      <div class="chefDetail__info">
        <p>出身地 : ○○県○○市</p>
        <p>誕生日 : ○月○日</p>
        <p>ダミーの段落 シェフの紹介シェフの紹介シェフの紹介シェフの紹介シェフの紹介シェフの紹介シェフの紹介シェフの紹介シェフの紹介シェフの紹介シェフの紹介シェフの紹介シェフの紹介シェフの紹介シェフの紹介シェフの紹介</p>
      </div>

      <div class="articleShareButtons">
        <button>FACEBOOK でシェア</button>
        <button>TWITTER でシェア</button>
      </div>
      <!-- ここまで -->
      <?php the_content(); ?>
    </article>
  <?php get_sidebar(); ?>
</div>

<?php get_footer(); ?>
