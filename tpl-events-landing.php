<?php /* Template Name: Events Landing */ ?>
<?php get_header(); ?>
<?php if(get_field('event_banner_type') === "single"): ?>
	<?php if(get_field('event_hero_banner_image')): ?>
		<section class="girt_fp-content-block girt_fp-hero event-lists">
			<?php
				$attachment_id = get_field('event_hero_banner_image');
				$size = "full";
				$image = wp_get_attachment_image_src( $attachment_id, $size );
			?>
			<img src="<?php echo $image[0] ?>" alt="Girton Events">
			<?php if(get_field('event_hero_banner_image_title')): ?>
				<div class="girt_slider-title">
					<h1><?php the_field('event_hero_banner_image_title'); ?></h1>
				</div>
			<?php endif; ?>
			</div>
		</section>
	<?php endif; ?>

<?php else: ?>

	<section class="girt_fp-content-block girt_fp-hero event-lists">
		<ul id="lightSlider">
			<?php if( have_rows('banner_slider') ): ?>
				<?php  while ( have_rows('banner_slider') ) : the_row(); ?>
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
<section class="girt_event-landing-wrap">
	<div class="girt_wrap">
		<aside>

			<h1>Filter Events</h1>
			<div class="girt_clear-fields">
				<a href="<?php bloginfo('url'); ?>/events">Clear all fields</a>
			</div>
			<div class="girt_event-category-filter active">
				<h2><div>Event Types</div></h2>
				<?php
					$terms = get_terms( array(
						'taxonomy' => 'event-type',
						'hide_empty' => false,
						'parent'   => 0,
						'exclude' => 13,
					) );
				?>
				<ul>
					<li><a href="<?php bloginfo('url'); ?>/events/" title="Go to all events">Back To All Events</a></li>
					<li><a href="<?php bloginfo('url'); ?>/girton150-festival/" title="Go to multi day events"><input class="styled-checkbox" type="checkbox"><label>Girton150 Festival</label></a></li>
					<form action="<?php echo site_url() ?>/wp-admin/admin-ajax.php" method="POST" id="filter">
					<?php
							if ( ! empty( $terms ) && ! is_wp_error( $terms ) ){

								foreach ( $terms as $term ) {
									echo '<li><div><input name="categoryfilter[]" class="styled-checkbox" id="checkbox-' . $term->slug . '" type="checkbox" value="' . $term->term_id . '"></input><label for="checkbox-' . $term->slug . '">' . $term->name . '</label></div></li>';
								}
							}
						?>
						<li class="apply-list-item">
							<button>Apply filter</button>
							<input type="hidden" name="action" value="myfilter">
						</li>
					</form>
					<li><a href="<?php bloginfo('url'); ?>/event-archives/" title="Go to archived events"><input class="styled-checkbox" type="checkbox"><label>Archived Events</label></a></li>
				</ul>
			</div>
			<div class="girt_event-calendar-filter">
				<h2><div>Events Calendar</div></h2>
				<div class="girt_calendar-wrap">
					<?php
						$today = date('Ymd');
						$paged = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;
						$eventargs = array(
							'post_type' => 'event',
							'meta_key'	=> 'event_date',
							'orderby'	=> 'meta_value_num',
							'order'		=> 'ASC',
							'posts_per_page' => 1,
							'paged' => $paged,
							'meta_query' => array(
								 array(
									'key'		=> 'event_date',
									'compare'	=> '>=',
									'value'		=> $today,
								)
							),
						);
					?>
					<?php $eventloop = new WP_Query( $eventargs ); if ( $eventloop->have_posts() ) : ?>
					<?php while ( $eventloop->have_posts() ) : $eventloop->the_post(); ?>
						<?php
							$startcal = get_field('event_date', false, false);
							$startcal = new DateTime($startcal);
							$startcal = $startcal->format('Y-m-d');
						?>
					<script>
						// echo a php value into a js variable on page
					  	var startcal = '<?php  echo $startcal; ?>';
					</script>
					<?php endwhile; wp_reset_postdata();?>
					<?php endif; ?>
					<?php echo do_shortcode("[fullcalendar]"); ?>
				</div>
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
						'relation' => 'AND',
						 array(
							'key'		=> 'event_date',
							'compare'	=> '>=',
							'value'		=> $today,
						),
						array(
						  'key' => 'do_not_display',
						  'value' => '0',
						)
					),
					/*'meta_query' => array(
						array(
						  'key' => 'event_multi_day_event',
						  'value' => '0',
						  'compare' => '=='
						)
					)*/
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
									<div class="girt_event-content-cont">
										<div class="rte landing"><?php the_field('event_excerpt'); ?></div>
										<?php if(get_field('event_multi_day_event')): ?>
											<?php $post_object = get_field('multi_day_event_selection'); ?>
											<?php if( $post_object ): ?>
												<?php
													// override $post;
													$post = $post_object;
													setup_postdata( $post );
												?>
												<a class="girt_event-button" href="<?php bloginfo('url'); ?>/events/multi-day-events#post-<?php echo $post_object; ?>">
													Part of the <?php the_title(); ?> - View more
												</a>
    											<?php wp_reset_postdata(); // IMPORTANT - reset the $post object so the rest of the page works correctly ?>
											<?php endif; ?>
										<?php else: ?>
											<?php if(get_field('event_show_more_button')): ?>
												<?php if(get_field('event_more_link_type') == 'morei'): ?>
													<a class="girt_event-button" href="<?php the_permalink(); ?>">More</a>
												<?php else: ?>
													<a class="girt_event-button" href="<?php the_field('more_externall_field'); ?>">More</a>
												<?php endif; ?>
											<?php endif; ?>
										<?php endif; ?>
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
