<?php get_header(); ?>

<?php if(get_field('',24) === "single"): ?>
	<?php if(get_field('event_hero_banner_image',24)): ?>
		<section class="girt_fp-content-block girt_fp-hero event-lists">
			<?php
				$attachment_id = get_field('event_hero_banner_image',24);
				$size = "full";
				$image = wp_get_attachment_image_src( $attachment_id, $size );
			?>
			<img src="<?php echo $image[0] ?>" alt="Girton Events">

			</div>
		</section>
	<?php endif; ?>

<?php else: ?>

	<section class="girt_fp-content-block girt_fp-hero event-lists">

	</section>

<?php endif; ?>

<section class="girt_event-landing-wrap">
	<div class="girt_wrap">
		<aside>

			<h1>Filter Events</h1>
			<div class="girt_clear-fields">
				<a href="<?php bloginfo('url'); ?>/events">Clear all fields</a>
			</div>
			
			<div class="girt_event-category-filter">
				<h2><div>Event Types</div></h2>
				<ul>					
					<li><a href="<?php bloginfo('url'); ?>/events/" title="Go to all events">Back to All Events</a></li>
					<li><a href="<?php bloginfo('url'); ?>/girton150-festival/" title="Go to multi day events">Girton150 Festival</a></li>
					<li><a href="<?php bloginfo('url'); ?>/event-archives/" title="Go to archived events">Archived Events</a></li>
					<li>&nbsp;</li>
				</ul>
			</div>
			<div class="girt_event-calendar-filter">
				<h2><div>Events Calendar</div></h2>
				<div class="girt_calendar-wrap">
					<?php echo do_shortcode("[fullcalendar]"); ?>
				</div>
			</div>
		</aside>
		<?php

		?>
		<main>
			<h1>Archived Events</h1>
			<div id="response">
			<?php
				$today = date('Ymd');
				$paged = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;
				$eventargs = array(
					'post_type' => 'event',
					'meta_key'	=> 'event_date',
					'orderby'	=> 'meta_value_num',
					'order'		=> 'ASC',
					'posts_per_page' =>20,
            		'paged' => $paged,
					'meta_query' => array(
						 array(
							'key'		=> 'event_date',
							'compare'	=> '<',
							'value'		=> $today,
						)
					),
				);


			?>
			<?php $eventloop = new WP_Query( $eventargs ); if ( $eventloop->have_posts() ) : ?>
				<ul>
					<?php while ( $eventloop->have_posts() ) : $eventloop->the_post(); ?>
						<li id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
							<div class="girt_event-excerpt-cont">
								<div class="girt_event-list-date">
									<?php
										$date = get_field('event_date', false, false);
										$date = new DateTime($date);
									?>
									<div class="girt_event-list-month"><?php echo $date->format('l'); ?></div>
									<div class="girt_event-list-day"><?php echo $date->format('j'); ?></div>
									<div class="girt_event-list-year"><?php echo $date->format('F Y'); ?></div>
								</div>
								<div class="girt_event-list-title">
									<h2><?php the_title(); ?></h2>
									<div class="girt_event-list-category">
										<?php
											$terms = get_the_terms($post->ID, 'event-type');
											$count = count($terms);
												 if ( $count > 0 ){
													  foreach ( $terms as $term ) {
										?><span><?php echo $term->name; ?></span><?php
												}
											}
										?>
									</div>
									<div class="girt_event-content-cont result">
										<div class="rte archive"><?php the_content(); ?></div>
										<a class="girt_event-button" href="<?php the_permalink(); ?>">More</a>
										<?php if(get_field('event_book_now_button')):?>
											<a href="<?php the_field('book_now_button_url'); ?>" target="_blank" class="girt_event-button">Book Now</a>
										<?php endif; ?>
									</div>
								</div>
								<div class="girt_event-list-icon">
									<i class="fa fa-sort-desc" aria-hidden="true"></i>
								</div>
							</div>

						</li>
					<?php endwhile; ?>
				</ul>
			<nav class="girt_custom-pagination">
				<?php pagination_bar( $eventloop ); ?>
			</nav>
			<?php wp_reset_postdata(); ?>
			<?php endif; ?>
			</div>
		</main>
	</div>
</section>
<?php get_footer(); ?>
