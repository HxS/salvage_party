<?php
/*
Template Name: CHEF
*/

get_header(); ?>


<div class="mainContent mainContent--chef">
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

		<h3 class="contentHeader__articleTitle">サルベージ・シェフの紹介</h3>
		<ul class="chefList__list">
			<?php for($i=0;$i<16;$i++) { ?>
				<li class="chefList__item chefListItem">
					<a href="#">
						<div class="chefListItem__thumbnail" style="background-image: url('<?php
						 echo get_template_directory_uri() . '/images/mock_chef.png';
						?>')">
						</div>
						シェフの名前
					</a>
				</li>
			<?php } ?>
		</ul>
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
