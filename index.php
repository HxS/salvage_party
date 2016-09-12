<?php get_header(); ?>

<div id='index' class="index">

  <div class='index__movie'>
    <div class="index__movieWrapper">
      <div id="player"></div>
      <div class="eyecatch"></div>
    </div>
  </div>

  <ul class="index__banners">
    <li>
      <a href="#">
        <img src="<?php
          echo get_template_directory_uri() . '/images/banner_join.png';
        ?>" alt="" />
      </a>
    </li>
    <li>
      <a href="#">
        <img src="<?php
          echo get_template_directory_uri() . '/images/banner_enjoy.png';
        ?>" alt="" />
      </a>
    </li>
    <li>
      <a href="#">
        <img src="<?php
          echo get_template_directory_uri() . '/images/banner_promotion.png';
        ?>" alt="" />
      </a>
    </li>
    <li>
      <a href="#">
        <img src="<?php
          echo get_template_directory_uri() . '/images/banner_organization.png';
        ?>" alt="" />
      </a>
    </li>
  </ul>

  <div class="index__pickUp pickUp">
    <header class="indexTitles">
      <h2 class="indexTitles__title">
        Pick Up
      </h2>
    </header>
    <div class="pickUp__lists">
      <?php for($i=0;$i<2;$i++) { ?>
        <ul class="pickUpItemList">
          <?php for($j=0;$j<3;$j++) { ?>
            <li class="pickUpItemList__item pickUpItem">
              <a href="#">
                <div class='pickUpItem__thumbnail' style="background-image: url('<?php
                  echo get_template_directory_uri() . '/images/mock_event.png';
                ?>')" /><span class='pickUpItem__date'>2016.06.01</span></div>
                <div class="pickUpItem__description">
                  <span class="pickUpItem__tag--event">EVENT</span>
                  <p class="pickUpItem__title">
                    3/21サルベージ・パーティvol.4開催のお知らせ @ 新宿御苑
                  </p>
                </div>
              </a>
            </li>
          <?php } ?>
        </ul>
      <?php } ?>
    </div>
    <a class="pickUp__moreButton" href="#">More</a>
  </div>

  <div class="index__report report">
    <header class="indexTitles">
      <h2 class="indexTitles__title">
        Salvage Report
      </h2>
    </header>
    <div class="report__lists">
      <?php for($i=0;$i<2;$i++) { ?>
        <ul class="reportItemList">
          <?php for($j=0;$j<4;$j++) { ?>
            <li class="reportItemList__item reportItem">
              <a href="#">
                <div class='reportItem__thumbnail' style="background-image: url('<?php
                  echo get_template_directory_uri() . '/images/mock_report.png';
                ?>')" /><span class='reportItem__date'>06.01</span></div>
                <p class="reportItem__description">
                  3/21サルベージ・パーティvol.4開催のお知らせ @ 新宿御苑
                </p>
              </a>
            </li>
          <?php } ?>
        </ul>
      <?php } ?>
    </div>
    <a class="report__moreButton" href="#">More</a>
  </div>

  <div class="index__interview interview">

    <header class="indexTitles">
      <h2 class="indexTitles__title indexTitles__title--left">
        Interview & Column
      </h2>
      <h2 class="indexTitles__title indexTitles__title--right">
        Interview
      </h2>
    </header>

    <div class="interview__lists interviewLists">
      <div class="interviewLists--feature">
        <?php for($i=0;$i<2;$i++) { ?>
          <ul class="interviewItemList">
            <?php for($j=0;$j<2;$j++) { ?>
              <li class="interviewItemList__item interviewFeature">
                <a href="#">
                  <div class='interviewFeature__thumbnail' style="background-image: url('<?php
                    echo get_template_directory_uri() . '/images/mock_feature' . ($i * 2 + $j + 1) . '.png';
                  ?>')" /></div>
                </a>
              </li>
            <?php } ?>
          </ul>
        <?php } ?>
        <a class="interview__moreButton" href="#">More</a>
      </div>

      <ul class="interviewLists--newest">
        <?php for($i=0;$i<5;$i++) { ?>
          <li class="interviewItemList__item interviewNewest">
            <a href="#">
              <div class="interviewNewest__date">2016.02.14</div>
              <div class="interviewNewest__title">
                2/15 テレビ東京「TOKYOガルリ」に取り上げていただきます。
              </div>
              <div class="interviewNewest__tag">MEDIA</div>
            </a>
          </li>
        <?php } ?>
      </ul>

    </div>
  </div>

  <hr>

  <div class="index__listContent listContent">

    <div class="listContent__list listContent__List--movie movieList">
      <h3 class='movieList__title'>
        Salvage<br>
        Cooking<br>
        <small>サルベージ・クッキング</small>
      </h3>
      <div class="scroll">
        <ul class="movieList__list">
          <?php for($j=0;$j<10;$j++) { ?>
            <li class="movieList__item movieListItem">
              <a href="#">
                <div class='movieListItem__thumbnail' style="background-image: url('<?php
                  echo get_template_directory_uri() . '/images/mock_cooking.png';
                ?>')" /></div>
                動画タイトル
              </a>
            </li>
          <?php } ?>
        </ul>
      </div>
    </div>

    <div class="listContent__list listContent__List--recipe recipeList">
      <h3 class='recipeList__title'>
        Salvage<br>
        Recipe<br>
        <small>
          サルベージ・レシピ<br>
          <a href="#">&gt; ALL</a>
        </small>
      </h3>
      <div class="scroll">
        <ul class="recipeList__list">
          <?php for($j=0;$j<10;$j++) { ?>
            <li class="recipeList__item recipeListItem">
              <a href="#">
                <div class='recipeListItem__thumbnail' style="background-image: url('<?php
                  echo get_template_directory_uri() . '/images/mock_recipe.png';
                ?>')" /></div>
                レシピ
              </a>
            </li>
          <?php } ?>
        </ul>
      </div>
    </div>

    <div class="listContent__list listContent__List--chef chefList">
      <h3 class='chefList__title'>
        Salvage<br>
        Chef<br>
        <small>
          サルベージ・シェフ<br>
          <a href="#">&gt; ALL</a>
        </small>
      </h3>
      <div class="scroll">
        <ul class="chefList__list">
          <?php for($j=0;$j<10;$j++) { ?>
            <li class="chefList__item chefListItem">
              <a href="#">
                <div class='chefListItem__thumbnail' style="background-image: url('<?php
                  echo get_template_directory_uri() . '/images/mock_chef.png';
                ?>')" /></div>
                シェフの名前
              </a>
            </li>
          <?php } ?>
        </ul>
      </div>
    </div>

  </div>

  <div class="index__instagram instagram">
    <header class="indexTitles">
      <h2 class="indexTitles__title">
        Instagram #サルベージパーティ #サルベージクッキング
      </h2>
    </header>
    <div class="instagram__lists">
      <?php for($i=0;$i<2;$i++) { ?>
        <ul class="instagramItemList">
          <?php for($j=0;$j<10;$j++) { ?>
            <li class="instagramItemList__item instagramItem">
              <a href="#">
                <img class="instagramItemList__thumbnail" src='<?php
                  echo get_template_directory_uri() . '/images/mock_instagram.png';
                ?>' alt='instagram' />
              </a>
            </li>
          <?php } ?>
        </ul>
      <?php } ?>
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
        'playlist': 'n4JFXi9lOJ8',
        'wmode':'opaque' },
      videoId: 'n4JFXi9lOJ8',
      events: {
        'onReady': onPlayerReady}
    });
   }

   function onPlayerReady(event) {
     event.target.mute();
   }
</script>

<?php get_footer(); ?>
