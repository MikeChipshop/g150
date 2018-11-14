<?php get_header(); ?>
<?php if(get_field('event_banner_type',24) === "single"): ?>
	<?php if(get_field('event_hero_banner_image',24)): ?>
		<section class="girt_fp-content-block girt_fp-hero event-lists">
			<?php
				$attachment_id = get_field('event_hero_banner_image',24);
				$size = "full";
				$image = wp_get_attachment_image_src( $attachment_id, $size );
			?>
			<img src="<?php echo $image[0] ?>" alt="Girton Events">
			<?php if(get_field('event_hero_banner_image_title',24)): ?>
				<div class="girt_slider-title">
					<h1><?php the_field('event_hero_banner_image_title',24); ?></h1>
				</div>
			<?php endif; ?>
			</div>
		</section>
	<?php endif; ?>

<?php else: ?>

	<section class="girt_fp-content-block girt_fp-hero event-lists">
		<ul id="lightSlider">
			<?php if( have_rows('banner_slider',24) ): ?>
				<?php  while ( have_rows('banner_slider',24) ) : the_row(); ?>
					<li>
						<a href="<?php the_sub_field('event_hero_slider_link'); ?>">
							<?php
								$attachment_id = get_sub_field('event_hero_slider_image');
								$size = "full";
								$image = wp_get_attachment_image_src( $attachment_id, $size );
							?>
							<img src="<?php echo $image[0] ?>" alt="Girton Events">
							<?php if(get_sub_field('event_hero_slider_title')): ?>
								<div class="girt_slider-title">
									<h1><?php the_sub_field('event_hero_slider_title'); ?></h1>
								</div>
							<?php endif; ?>
						</a>
					</li>
				<?php endwhile; ?>
			<?php endif; ?>
		</ul>
	</section>

<?php endif; ?>
<article class="girt_single-news-wrap">
	<?php if ( have_posts() ): ?>
		<?php while ( have_posts() ): the_post(); ?>
			<h1><?php the_title(); ?></h1>
			<?php
				$terms = get_the_terms( $post->ID, 'event-type' );
				if ( !empty( $terms ) ){
					// get the first term
					$term = array_shift( $terms );
				}
			?>
			<div class="girt_single-event-meta girt-event-tax-color-<?php echo $term->slug; ?>">
				<div class="girt_single-event-meta-category">
					<?php if(get_field('event_multi_day_event')): ?>
						<div class="girt_single-event-multi-parent">
							<?php $parent_title = get_field('multi_day_event_selection'); ?>
							
							<?php echo get_the_title( $parent_title ); ?>
						</div>
					<?php else: ?>
						<?php the_terms( $post->ID, 'event-type', '', '' ); ?>
					<?php endif; ?>
				</div>
				<div class="girt_single-event-meta-date">
					<?php
						$date = get_field('event_date', false, false);
						$date = new DateTime($date);
					
						$start_time = get_field('event_start_time', false, false);
						$start_time = new DateTime($start_time);
					
						$end_time = get_field('event_end_time', false, false);
						$end_time = new DateTime($end_time);
					?>
					
					<?php echo $date->format('j'); ?><sup><?php echo $date->format('S'); ?></sup> <?php echo $date->format('F Y'); ?> 
					<?php if(get_field('event_start_time')): ?>
						<?php echo "<span class='date-divider'>|</span>".$start_time->format('H:i'); ?>
						<?php if(get_field('event_end_time')): ?>
							<?php echo " - " .$end_time->format('H:i'); ?>
						<?php endif; ?>
					<?php endif; ?>
				</div>
			</div>
			<?php if(get_field('event_excerpt')): ?>
				<div class="girt_single-event-excerpt rte">
					<?php the_field('event_excerpt'); ?>	
				</div>
			<?php endif; ?>
			<?php if(get_field('event_content')): ?>
				<div class="rte">
					<?php the_field('event_content'); ?>
				</div>
			<?php endif; ?>
			<?php if(get_field('event_book_now_button')):?>
				<a href="<?php the_field('book_now_button_url'); ?>" target="_blank" class="girt_event-button girt-tax-<?php echo $term->slug; ?>">Book Now</a>
			<?php endif; ?>
		<?php endwhile; ?>
	<?php endif; ?>
</article>
<?php get_footer(); ?>