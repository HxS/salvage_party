<?php get_header(); ?>

<div id='index' class="index">

  <div class='index__movie'>
    <div class="index__movieWrapper">
      <div id="player"></div>
      <div class="eyecatch"></div>
    </div>
  </div>

  <ul class="index__banners wow slideInUp">
    <li>
      <a href="<?php
        echo esc_url( get_permalink( get_page_by_path( 'action/join' ) ) );
      ?>">
        <img src="<?php
          echo get_template_directory_uri() . '/images/banner_join.png';
        ?>" alt="" />
      </a>
    </li>
    <li>
      <a href="<?php
        echo esc_url( get_permalink( get_page_by_path( 'action/open' ) ) );
      ?>">
        <img src="<?php
          echo get_template_directory_uri() . '/images/banner_enjoy.png';
        ?>" alt="" />
      </a>
    </li>
    <li>
      <a href="<?php
        echo esc_url( get_permalink( get_page_by_path( 'action/license' ) ) );
      ?>">
        <img src="<?php
          echo get_template_directory_uri() . '/images/banner_promotion.png';
        ?>" alt="" />
      </a>
    </li>
    <li>
      <a href="<?php
        echo esc_url( get_permalink( get_page_by_path( 'action/company' ) ) );
      ?>">
        <img src="<?php
          echo get_template_directory_uri() . '/images/banner_organization.png';
        ?>" alt="" />
      </a>
    </li>
  </ul>

  <div class="index__pickUp pickUp wow slideInUp">
    <header class="indexTitles">
      <h2 class="indexTitles__title">
        Pick Up
      </h2>
    </header>
    <div class="pickUp__lists">

      <ul class="pickUpItemList">
        <?php
        $while_count = 0;
        $args = array( 'post_type' => 'topic', 'posts_per_page' => 6 );
        $loop = new WP_Query( $args );
        while ( $loop->have_posts() ) : $loop->the_post();
          $while_count++
        ?>
          <li class="pickUpItemList__item pickUpItem">
            <a href="<?php echo post_permalink($post->ID); ?>">
              <div class='pickUpItem__thumbnail' style="background-image: url('<?php
                echo the_post_thumbnail_url();
              ?>')" /><span class='pickUpItem__date'><?php the_time('Y.m.d'); ?></span></div>
              <div class="pickUpItem__description">
                <span class="pickUpItem__tag pickUpItem__tag--<?php
                  echo strtolower(get_post_meta( get_the_ID(), 'topic_tag', true ));
                ?>"><?php
                  echo get_post_meta( get_the_ID(), 'topic_tag', true );
                ?></span>
                <p class="pickUpItem__title">
                  <?php the_title(); ?>
                </p>
              </div>
            </a>
          </li>
          <?php if($while_count == 3) : ?>
            </ul>
            <ul class="pickUpItemList">
          <?php endif; ?>
        <?php
        endwhile; ?>
      </ul>
    </div>
    <a class="pickUp__moreButton" href="<?php
      echo esc_url( get_permalink( get_page_by_path( 'topic' ) ) );
    ?>">More</a>
  </div>

  <div class="index__report report wow slideInUp">
    <header class="indexTitles">
      <h2 class="indexTitles__title">
        Salvage Report
      </h2>
    </header>
    <div class="report__lists">
        <ul class="reportItemList">
          <?php
          $while_count = 0;
          $args = array( 'post_type' => 'report', 'posts_per_page' => 8 );
          $loop = new WP_Query( $args );
          while ( $loop->have_posts() ) : $loop->the_post();
            $while_count++
          ?>
            <li class="reportItemList__item reportItem">
              <a href="<?php echo post_permalink($post->ID); ?>">
                <div class='reportItem__thumbnail' style="background-image: url('<?php
                  echo the_post_thumbnail_url();
                ?>')" /><span class='reportItem__date'><?php the_time('m.d'); ?></span></div>
                <p class="reportItem__description">
                  <?php the_title(); ?>
                </p>
              </a>
            </li>
            <?php if($while_count == 4) : ?>
              </ul>
              <ul class="reportItemList">
            <?php endif; ?>
          <?php endwhile; ?>
        </ul>
    </div>
    <a class="report__moreButton" href="<?php
      echo esc_url( get_permalink( get_page_by_path( 'report' ) ) );
    ?>">More</a>
  </div>

  <div class="index__interview interview wow slideInUp">

    <header class="indexTitles">
      <h2 class="indexTitles__title indexTitles__title--left">
        Interview & Column
      </h2>
      <h2 class="indexTitles__title indexTitles__title--right">
        Information
      </h2>
    </header>

    <div class="interview__lists interviewLists">
      <div class="interviewLists--feature">
        <ul class="interviewItemList">
          <?php
          $while_count = 0;
          $args = array( 'post_type' => 'interview', 'posts_per_page' => 4 );
          $loop = new WP_Query( $args );
          while ( $loop->have_posts() ) : $loop->the_post();
            $while_count++
          ?>
            <li class="interviewItemList__item interviewFeature">
              <a href="<?php echo post_permalink($post->ID); ?>">
                <div class='interviewFeature__thumbnail' style="background-image: url('<?php
                  echo the_post_thumbnail_url();
                ?>')" /></div>
              </a>
            </li>
            <?php if($while_count == 2) : ?>
              </ul>
              <ul class="interviewItemList">
            <?php endif; ?>
          <?php endwhile; ?>
        </ul>
        <a class="interview__moreButton" href="<?php
          echo esc_url( get_permalink( get_page_by_path( 'feature' ) ) );
        ?>">More</a>
      </div>

      <ul class="interviewLists--newest">
        <?php
        $while_count = 0;
        $args = array( 'post_type' => 'information', 'posts_per_page' => 5 );
        $loop = new WP_Query( $args );
        while ( $loop->have_posts() ) : $loop->the_post();
          $while_count++
        ?>
          <li class="interviewItemList__item interviewNewest">
            <a href="<?php echo post_permalink($post->ID); ?>">
              <div class="interviewNewest__date"><?php the_time('Y.m.d'); ?></div>
              <div class="interviewNewest__title">
                <?php the_title(); ?>
              </div>
              <div class="interviewNewest__tag"><?php
                $term_list = wp_get_post_terms($post->ID, 'information_tag', array("fields" => "names"));
                echo $term_list[0];
              ?></div>
            </a>
          </li>
        <?php endwhile; ?>
      </ul>

    </div>
  </div>

  <hr>

  <div class="index__listContent listContent wow slideInUp">

    <div class="listContent__list listContent__List--recipe recipeList">
      <h3 class='recipeList__title'>
        Salvage<br>
        Recipe<br>
        <small>
          サルベージ・レシピ<br>
          <a href="<?php
            echo esc_url( get_permalink( get_page_by_path( 'about/recipe' ) ) );
          ?>">&gt; ALL</a>
        </small>
      </h3>
      <div class="scroll">
        <?php
          $while_count = 0;
          $args = array( 'post_type' => 'recipe', 'posts_per_page' => 10 );
          $loop = new WP_Query( $args );
          $content_count = $loop->post_count
        ?>
        <?php if($content_count == 0) : ?>
          <div class="recipeList__emptyMessage">Coming soon</div>
        <?php endif; ?>
        <ul class="recipeList__list" style="width: <?php echo 254 * $content_count; ?>px">
          <?php
          while ( $loop->have_posts() ) : $loop->the_post();
            $while_count++
          ?>
            <li class="recipeList__item recipeListItem">
              <a href="<?php echo post_permalink($post->ID); ?>">
                <div class='recipeListItem__thumbnail' style="background-image: url('<?php
                  echo the_post_thumbnail_url();
                ?>')" /></div>
                <?php the_title(); ?>
              </a>
            </li>
          <?php endwhile; ?>
        </ul>
      </div>
    </div>

    <div class="listContent__list listContent__List--chef chefList">
      <h3 class='chefList__title'>
        Salvage<br>
        Chef<br>
        <small>
          サルベージ・シェフ<br>
          <a href="<?php
            echo esc_url( get_permalink( get_page_by_path( 'about/chef' ) ) );
          ?>">&gt; ALL</a>
        </small>
      </h3>
      <div class="scroll">
        <?php
          $while_count = 0;
          $args = array( 'post_type' => 'chef', 'posts_per_page' => 10);
          $loop = new WP_Query( $args );
          $content_count = $loop->post_count < 10 ? $loop->post_count : 10;
        ?>
        <?php if($content_count == 0) : ?>
          <div class="chefList__emptyMessage">Coming soon</div>
        <?php endif; ?>
        <ul class="chefList__list" style="width: <?php echo 194 * $content_count; ?>px">
          <?php
          while ( $loop->have_posts() ) : $loop->the_post();
            $while_count++
          ?>
            <li class="chefList__item chefListItem">
              <a href="<?php echo post_permalink($post->ID); ?>">
                <div class='chefListItem__thumbnail' style="background-image: url('<?php
                  echo the_post_thumbnail_url();
                ?>')" /></div>
                <?php the_title(); ?>
              </a>
            </li>
          <?php endwhile; ?>
        </ul>
      </div>
    </div>

    <div class="listContent__list listContent__List--producer producerList">
      <h3 class='producerList__title'>
        Salvage<br>
        Producer<br>
        <small>
          サルベージ・プロデューサー<br>
          <a href="<?php
            echo esc_url( get_permalink( get_page_by_path( 'about/producer' ) ) );
          ?>">&gt; ALL</a>
        </small>
      </h3>
      <div class="scroll">
        <?php
          $while_count = 0;
          $args = array( 'post_type' => 'producer', 'posts_per_page' => 10);
          $loop = new WP_Query( $args );
          $content_count = $loop->post_count < 10 ? $loop->post_count : 10;
        ?>
        <?php if($content_count == 0) : ?>
          <div class="producerList__emptyMessage">Coming soon</div>
        <?php endif; ?>
        <ul class="producerList__list" style="width: <?php echo 194 * $content_count; ?>px">
          <?php
          while ( $loop->have_posts() ) : $loop->the_post();
            $while_count++
          ?>
            <li class="producerList__item producerListItem">
              <a href="<?php echo post_permalink($post->ID); ?>">
                <div class='producerListItem__thumbnail' style="background-image: url('<?php
                  echo the_post_thumbnail_url();
                ?>')" /></div>
                <?php the_title(); ?>
              </a>
            </li>
          <?php endwhile; ?>
        </ul>
      </div>
    </div>

    <div class="listContent__list listContent__List--movie movieList">
      <h3 class='movieList__title'>
        Salvage<br>
        Cooking<br>
        <small>サルベージ・クッキング</small>
      </h3>
      <div class="scroll">
        <?php
          $while_count = 0;
          $args = array( 'post_type' => 'cooking',);
          $loop = new WP_Query( $args );
          $content_count = $loop->post_count
        ?>
        <?php if($content_count == 0) : ?>
          <div class="movieList__emptyMessage">Coming soon</div>
        <?php endif; ?>
        <ul class="movieList__list" style="width: <?php echo 254 * $content_count; ?>px">
          <?php
          while ( $loop->have_posts() ) : $loop->the_post();
            $while_count++
          ?>
            <li class="movieList__item movieListItem">
              <a href="<?php echo post_permalink($post->ID); ?>">
                <div class='movieListItem__thumbnail'
                  style="background-image: url('http://i.ytimg.com/vi/<?php
                  echo get_post_meta( get_the_ID(), 'movie_id', true );
                ?>/mqdefault.jpg')" /></div>
                <?php the_title(); ?>
              </a>
            </li>
          <?php endwhile; ?>
        </ul>
      </div>
    </div>

  </div>

  <div class="index__instagram instagram wow slideInUp">
    <header class="indexTitles">
      <h2 class="indexTitles__title">
        あなたもサルベージアンバサダー<br>
        Instagram #サルベージパーティ #サルベージクッキング
      </h2>
    </header>
    <div class="instagram__lists">
      <?php echo do_shortcode('[instagram-feed]'); ?>
    </div>
  </div>

</div>

<script src="http://www.youtube.com/player_api"></script>
<script>
  var player;
  function onYouTubePlayerAPIReady() {
    player = new YT.Player('player', {
      playerVars: {
        'autoplay': 1,
        'controls': 0,
        'showinfo': 0,
        'autohide': 1,
        'loop': 1,
        'playlist': '<?php echo esc_attr( get_option('youtube-id') ); ?>',
        'wmode':'opaque' },
      videoId: '<?php echo esc_attr( get_option('youtube-id') ); ?>',
      events: {
        'onReady': onPlayerReady}
    });
   }

   function onPlayerReady(event) {
     event.target.mute();
   }
</script>

<?php get_footer(); ?>
