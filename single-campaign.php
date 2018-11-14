<?php get_header(); ?>
<div class="girt_single-campaign-wrap">
	<div class="girt_campaign-content-inner girt_campaign-bg-<?php the_field('campaign_background_colour'); ?>" id="girt_campaign-content-result">
		<?php if ( have_posts() ) :?>
			<?php while ( have_posts() ) : the_post(); ?>
				<?php if(get_field('campaign_default_header_type') == 'video'): ?>
					<div class="girt_campaign-video">
						<iframe src="https://www.youtube.com/embed/<?php the_field('campaign_default_video'); ?>?modestbranding=1&autohide=1&showinfo=0&controls=0" frameborder="0" gesture="media" allow="encrypted-media" allowfullscreen></iframe>
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
			<?php if(get_field('campaign_content_type') == 'formatted'): ?>
				<div class="girt_single-campaign-content formatted">
					<cite>
						<?php if(get_field('campaign_name')): ?><span><?php the_field('campaign_name'); ?> | </span><?php endif; ?>
						<?php if(get_field('campaign_position')): ?><?php the_field('campaign_position'); ?>, <?php endif; ?>
						<?php if(get_field('campaign_year')): ?><?php the_field('campaign_year'); ?><?php endif; ?>
					</cite>
					<?php if(get_field('campaign_quote')): ?><blockquote>&ldquo;<?php the_field('campaign_quote'); ?>&rdquo;</blockquote><?php endif; ?>
					<?php if(get_field('campaign_button_url')): ?>
						<a target="_blank" href="//<?php the_field('campaign_button_url'); ?>" class="girt_give-button">
							<?php the_field('campaign_button_text'); ?>
						</a>
					<?php endif; ?>
				</div>
			<?php elseif(get_field('campaign_content_type') == 'content'): ?>
				<div class="girt_single-campaign-content content">
					<h2><?php the_field('campaign_content_block_title'); ?></h2>
					<div class="girt_single-campaign-content-wrap">
						<?php the_field('campaign_content_block'); ?>
					</div>
				</div>
			<?php endif; ?>
			<?php endwhile; ?>
		<?php endif; ?>
	</div>
</div>
<?php get_footer(); ?>
