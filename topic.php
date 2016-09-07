<?php
/*
Template Name: TOPIC
*/

get_header(); ?>


<div class="mainContent mainContent--topic">
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
		<ul class="topicList__list">
			<?php for($i=0;$i<8;$i++) { ?>
				<li class="topicList__item topicListItem topicListItem-topic">
					<a href="#">
						<div class="topicListItem__thumbnail-tag">TOPIC</div>
						<div class="topicListItem__thumbnail" style="background-image: url('<?php
							echo get_template_directory_uri() . '/images/mock_recipe.png';
							?>')">
						</div>
						<div class="topicListItem__description">
							<time>2016.2.19</time>
							<title>タイトルタイトルタイトルタイトル</title>
							<small>抜粋が入ります抜粋が入ります抜粋が入ります抜粋が入ります抜粋が入ります抜粋が入ります抜粋が入ります抜粋が入ります抜粋が入ります抜粋が入ります抜粋が入ります抜粋が入ります抜粋が入ります抜粋が入ります抜粋が入ります抜粋が入ります抜粋が入ります</small>
						</div>
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
