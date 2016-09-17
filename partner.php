<?php
/*
Template Name: PARTNER
*/

get_header(); ?>


<div class="mainContent mainContent--partner">
  <?php
    global $more;
    global $page_post;
    $page_post = $post;
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
      <h1>パートナー</h1>
      <ul class="partnerItemList">
        <?php
          $args = array(
            'post_type' => 'partner',
            'meta_query' => array(
              array(
                'key'     => 'partner_type',
                'value'   => 'パートナー',
              ),
            ),
          );
          $loop = new WP_Query( $args );
          while ( $loop->have_posts() ) : $loop->the_post();
            $while_count++;
        ?>
          <li class="partnerItemList__item partnerItem">
            <a href="<?php echo post_permalink($post->ID); ?>">
              <div class='partnerItem__thumbnail' style="background-image: url('<?php
                echo the_post_thumbnail_url();
                ?>')">
              </div>
              <?php the_title(); ?>
            </a>
          </li>
          <?php if ($while_count % 3 == 0) : ?>
            </ul>
            <ul class="partnerItemList">
          <?php endif; ?>
        <?php endwhile; ?>
      </ul>
      <h1>賛同企業</h1>
      <ul class="partnerItemList">
        <?php
          $args = array(
            'post_type' => 'partner',
            'meta_query' => array(
              array(
                'key'     => 'partner_type',
                'value'   => '賛同企業',
              ),
            ),
          );
          $loop = new WP_Query( $args );
          while ( $loop->have_posts() ) : $loop->the_post();
            $while_count++;
        ?>
          <li class="partnerItemList__item partnerItem">
            <a href="<?php echo post_permalink($post->ID); ?>">
              <div class='partnerItem__thumbnail' style="background-image: url('<?php
                echo the_post_thumbnail_url();
                ?>')">
              </div>
              <?php the_title(); ?>
            </a>
          </li>
          <?php if ($while_count % 3 == 0) : ?>
            </ul>
            <ul class="partnerItemList">
          <?php endif; ?>
        <?php endwhile; ?>
      </ul>
      <!-- ここまで -->
    </article>
  <?php
    $post = $page_post;
    get_sidebar();
  ?>
</div>

<?php get_footer(); ?>
