<?php
/*
Template Name: SCHEDULE
*/

get_header(); ?>


<div class="mainContent mainContent--schedule">
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
      <?php for($i=0;$i<5;$i++) { ?>
        <ul class="scheduleItemList">
          <li class="scheduleItemList__item scheduleItem">
            <div class='scheduleItem__thumbnail' /></div>
            <div class="scheduleItem__contents">
              <div class="wrapper">
                <div class="scheduleItem__outline scheduleOutline">
                  <span class='scheduleOutline__date'>3/21</span>
                  <span class='scheduleOutline__weekday'>[月・祝]</span>
                  <span class='scheduleOutline__region'>東京</span>
                  <h3 class="scheduleOutline__title">サルベージ・パーティ vol.4</h3>
                  <span class="scheduleOutline__location">@ 新宿御苑ガーデンプレイス</span>
                </div>
                <div class='scheduleItem__ambassador' /></div>
              </div>
              <p class="scheduleItem__description">
                今回で 14 回目を迎える、サルベージ・パーティ!
                どこの家にもある、使い切れずにいる野菜や加工食品、
                調味料。このままだと捨ててしまうかもしれない食材を持ち
                寄り、プロのシェフが即興でメニ
              </p>
              <div class="wrapper">
                <p class="scheduleItem__update">
                  更新日 : 2016.02.01
                </p>
                <a class="scheduleItem__join" href='#'>
                  参加する
                </a>
              </div>
            </div>
          </li>
        </ul>
      <?php } ?>

  		<ul class="pagination">
  			<li>1</li>
  			<li>2</li>
  			<li>3</li>
  			<li>4</li>
  		</ul>
      <!-- ここまで -->
      <?php the_content(); ?>
    </article>
  <?php get_sidebar(); ?>
</div>

<?php get_footer(); ?>
