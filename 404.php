<?php /* Template Name: Campaign */ ?>
<?php get_header(); ?>
	<div class="girt_404-wrap">
		<h1><?php the_field('404_title','option'); ?></h1>
		<div class="girt_404-content rte">
			<?php the_field('404_content','option'); ?>
		</div>
	</div>
</section>
<?php get_footer(); ?>