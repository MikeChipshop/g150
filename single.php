<?php get_header(); ?>
<div class="girt_single-news-hero">
	<?php the_post_thumbnail(); ?>
</div>
<article class="girt_single-news-wrap">
	<?php if ( have_posts() ): ?>
		<?php while ( have_posts() ): the_post(); ?>
			<h1><?php the_title(); ?></h1>
			<div class="rte">
				<?php the_content(); ?>
			</div>
		<?php endwhile; ?>
	<?php endif; ?>
</article>
<?php get_footer(); ?>