<?php /* Template Name: Campaign */ ?>
<?php get_header(); ?>
<?php if ( have_posts() ) :?>
				<?php while ( have_posts() ) : the_post(); ?>
	<section class="girt_campaign-intro">
		<?php if(get_field('campaign_landing_placeholder_main_title')): ?>
								<h1><?php the_field('campaign_landing_placeholder_main_title'); ?></h1>
							<?php endif; ?>
		<?php if(get_field('campaign_landing_placeholder_button_location')): ?>
								<a target="_blank" class="girt_campaign-placeholder_button" href="<?php the_field('campaign_landing_placeholder_button_location'); ?>"><?php the_field('campaign_landing_placeholder_button_text'); ?></a>
							<?php endif; ?>

							<?php if(get_field('campaign_landing_placeholder_subheader')): ?>
								<h2><?php the_field('campaign_landing_placeholder_subheader'); ?></h2>
							<?php endif; ?>

							<?php if(get_field('campaign_landing_placeholder_content')): ?>
								<div class="girt_campaign-placeholder-copy rte">
									<?php the_field('campaign_landing_placeholder_content'); ?>
								</div>
							<?php endif; ?>

							
	</section>
<?php endwhile; wp_reset_query(); ?>
<?php endif; ?>
<section class="girt_campaign-wrap">
	<div class="girt_campaign-nav">
		<?php
			$camargs = array(
				'post_type' => 'campaign',
				'posts_per_page'=> -1,
				'order'				=> 'ASC',
				'orderby'			=> 'meta_value_num',
				'meta_key'			=> 'sort_order',
				);
		?>
		<?php $camloop = new WP_Query($camargs); ?>
		<?php if ( $camloop->have_posts() ) : ?>
			<ul>
				<?php while ( $camloop->have_posts() ) : $camloop->the_post(); ?>
					<li>
						<a href="<?php the_permalink(); ?>">
							<?php the_post_thumbnail('campaign-thumb'); ?>
						</a>
					</li>
				<?php endwhile; ?>
			</ul>
		<?php endif; wp_reset_query(); ?>
	</div>
	<div class="girt_campaign-content" style="background:url('<?php bloginfo('stylesheet_directory'); ?>/img/stats-bg.jpg') no-repeat center center;background-size:cover;">
		<div class="girt_campaign-placeholder">
			<?php if ( have_posts() ) :?>
				<?php while ( have_posts() ) : the_post(); ?>
					<div class="girt_campaign-placeholder-content">
						<?php if(get_field('campaign_default_header_type') == 'video'): ?>
							<div class="girt_campaign-video">
								<iframe src="https://www.youtube.com/embed/<?php the_field('campaign_default_video'); ?>?modestbranding=1&autohide=1&showinfo=0" frameborder="0" gesture="media" allow="encrypted-media" allowfullscreen></iframe>
							</div>
						<?php elseif(get_field('campaign_default_header_type') == 'image'): ?>
							<div class="girt_campaign-header-image">
								<?php
									$attachment_id = get_field('campaign_default_image');
									$size = "campaign-header";
									$image = wp_get_attachment_image_src( $attachment_id, $size );
								?>
								<img src="<?php echo $image[0] ?>" alt="<?php the_field('campaign_landing_placeholder_main_title'); ?>">
							</div>
						<?php endif; ?>
						<div class="girt_campaign-content-wrap rte">
							<?php if(get_field('campaign_instructions')): ?>
								<?php the_field('campaign_instructions'); ?>
							<?php endif; ?>

						</div>
					</div>
				<?php endwhile; ?>
			<?php endif; ?>
		</div>
	</div>
</section>
<?php get_footer(); ?>
