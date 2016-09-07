<?php
/*
Template Name: PARTNER
*/

get_header(); ?>


<div class="mainContent mainContent--partner">
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
      <?php the_content(); ?>
      <!-- ここから -->
      <h1>パートナー</h1>
      <?php for($i=0;$i<2;$i++) { ?>
        <ul class="partnerItemList">
          <?php for($j=0;$j<3;$j++) { ?>
            <li class="partnerItemList__item partnerItem">
              <a href="#">
                <div class='partnerItem__thumbnail' /></div>
                企業名
              </a>
            </li>
          <?php } ?>
        </ul>
      <?php } ?>
      <h1>賛同企業</h1>
      <?php for($i=0;$i<1;$i++) { ?>
        <ul class="partnerItemList">
          <?php for($j=0;$j<3;$j++) { ?>
            <li class="partnerItemList__item partnerItem">
              <a href="#">
                <div class='partnerItem__thumbnail' /></div>
                企業名
              </a>
            </li>
          <?php } ?>
        </ul>
      <?php } ?>
      <!-- ここまで -->
    </article>
  <?php get_sidebar(); ?>
</div>

<?php get_footer(); ?>
