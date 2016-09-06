<?php
/*
Template Name: ACTION
*/

get_header(); ?>


<div class="mainContent mainContent--action">
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
      <ul>
        <li>
          <a href="#">
            <img src="<?php
              echo get_template_directory_uri() . '/images/action_join.png';
            ?>" alt="" />
          </a>
        </li>
        <li>
          <a href="#">
            <img src="<?php
              echo get_template_directory_uri() . '/images/action_open.png';
            ?>" alt="" />
          </a>
        </li>
        <li>
          <a href="#">
            <img src="<?php
              echo get_template_directory_uri() . '/images/action_chef.png';
            ?>" alt="" />
          </a>
        </li>
        <li>
          <a href="#">
            <img src="<?php
              echo get_template_directory_uri() . '/images/action_license.png';
            ?>" alt="" />
          </a>
        </li>
        <li>
          <a href="#">
            <img src="<?php
              echo get_template_directory_uri() . '/images/action_company.png';
            ?>" alt="" />
          </a>
        </li>
      </ul>
      <!-- ここまで -->
      <?php the_content(); ?>
    </article>
  <?php get_sidebar(); ?>
</div>

<?php get_footer(); ?>
