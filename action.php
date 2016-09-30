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
      <ul>
        <li>
          <a href="<?php
            echo esc_url( get_permalink( get_page_by_title( 'パーティに参加する' ) ) );
          ?>">
            <img src="<?php
              echo get_template_directory_uri() . '/images/action_join.png';
            ?>" alt="" />
          </a>
        </li>
        <li>
          <a href="<?php
            echo esc_url( get_permalink( get_page_by_title( 'パーティを開く' ) ) );
          ?>">
            <img src="<?php
              echo get_template_directory_uri() . '/images/action_open.png';
            ?>" alt="" />
          </a>
        </li>
        <li>
          <a href="<?php
            echo esc_url( get_permalink( get_page_by_title( 'シェフになる' ) ) );
          ?>">
            <img src="<?php
              echo get_template_directory_uri() . '/images/action_chef.png';
            ?>" alt="" />
          </a>
        </li>
        <li>
          <a href="<?php
            echo esc_url( get_permalink( get_page_by_title( '資格をとる' ) ) );
          ?>">
            <img src="<?php
              echo get_template_directory_uri() . '/images/action_license.png';
            ?>" alt="" />
          </a>
        </li>
        <li>
          <a href="<?php
            echo esc_url( get_permalink( get_page_by_title( '企業として参加する' ) ) );
          ?>">
            <img src="<?php
              echo get_template_directory_uri() . '/images/action_company.png';
            ?>" alt="" />
          </a>
        </li>
      </ul>
      <!-- ここまで -->
    </article>
  <?php get_sidebar(); ?>
</div>

<?php get_footer(); ?>