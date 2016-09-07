<?php
/*
Template Name: CONTACT
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

        <?php
      endwhile;
    else: ?>

      <p>
        該当する記事が見当たりませんでした。
      </p>

    <?php endif; ?>


    <article class="mainContent__article">
      <?php the_content(); ?>
      <?php echo do_shortcode('[contact-form-7 id="7" title="Contact form 1"]'); ?>
    </article>
</div>

<?php get_footer(); ?>
