<?php /* Template Name: Event Results */ ?>
<?php get_header(); ?>
<section class="girt_fp-content-block girt_fp-hero">
	<div class="girt_hero-content" style="background:url(<?php bloginfo('stylesheet_directory'); ?>/img/banner-test.jpg) no-repeat center center;background-size:cover;">

	</div>
</section>
<section class="girt_event-landing-wrap">
	<div class="girt_wrap">
		<aside>

			<h1>Filter Events</h1>
			<div class="girt_clear-fields">
				<a href="<?php bloginfo('url'); ?>/events">Clear all fields</a>
			</div>
			<div class="girt_event-calendar-filter">
				<h2><div>Events Calendar</div><span class="fa fa-sort-desc" aria-hidden="true"></span></h2>
				<div class="girt_calendar-wrap">
					<?php echo do_shortcode("[fullcalendar]"); ?>
				</div>
			</div>
			<div class="girt_event-category-filter active">
				<h2><div>Event Types</div><span class="fa fa-sort-desc" aria-hidden="true"></span></h2>
				<?php
					$terms = get_terms( array(
						'taxonomy' => 'event-type',
						'hide_empty' => false,
						'parent'   => 0,
						'exclude' => 13,
					) );
				?>
				<ul>
					<form action="<?php echo site_url() ?>/wp-admin/admin-ajax.php" method="POST" id="filter">
					<li><a href="<?php bloginfo('url'); ?>/events/" title="Go to all events">All Events</a></li>
				<?php
					if ( ! empty( $terms ) && ! is_wp_error( $terms ) ){

						foreach ( $terms as $term ) {
							echo '<li><div><input name="categoryfilter[]" class="styled-checkbox" id="checkbox-' . $term->slug . '" type="checkbox" value="' . $term->term_id . '"></input><label for="checkbox-' . $term->slug . '">' . $term->name . '</label></div></li>';
						}
					}
				?>
					<li><button>Apply filter</button>
	<input type="hidden" name="action" value="myfilter"></li>
					</form>
				</ul>
			</div>
		</aside>
		<?php

		?>
		<main>
			<h1>Event Listings</h1>
			<div id="response">
			<?php
				$today = date('Ymd');
				$paged = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;
				$eventargs = array(
					'post_type' => 'event',
					'meta_key'	=> 'event_date',
					'orderby'	=> 'meta_value_num',
					'order'		=> 'ASC',
					'posts_per_page' => -1,
            		'paged' => $paged,
					'meta_query' => array(
						 array(
							'key'		=> 'event_date',
							'compare'	=> '<',
							'value'		=> $today,
						),
						array(
						  'key' => 'do_not_display',
						  'value' => '0',
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
									<h2><?php the_title(); ?> test</h2>
									<div class="girt_event-list-category test">
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
									<div class="girt_event-content-cont">
										<div class="rte results"><?php the_content(); ?></div>
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
