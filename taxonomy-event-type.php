<?php /* Template Name: Events Landing */ ?>
<?php get_header(); ?>
<section class="girt_fp-content-block girt_fp-hero">
	<div class="girt_hero-content" style="background:url(<?php bloginfo('stylesheet_directory'); ?>/img/banner-test.jpg) no-repeat center center;background-size:cover;">

	</div>
</section>
<section class="girt_event-landing-wrap">
	<div class="girt_wrap">
		<aside>
			<div class="girt_event-category-filter">
				<?php
					$terms = get_terms( array(
						'taxonomy' => 'event-type',
						'hide_empty' => false,
						'parent'   => 0
					) );
				?>
				<ul>
					<li><input type="checkbox"></input> All events</li>
				<?php
					if ( ! empty( $terms ) && ! is_wp_error( $terms ) ){

						foreach ( $terms as $term ) {
							echo '<li><input type="checkbox" value="' . $term->slug . '"></input>' . $term->name . '</li>';
						}
					}
				?>
				</ul>
			</div>
		</aside>
		<main>
			<h1>Event Listings</h1>
			<?php
				$today = date('Ymd');
				$eventargs = array(
					'post_type' => 'event',
					'meta_key'	=> 'event_date',
					'orderby'	=> 'meta_value_num',
					'order'		=> 'ASC',
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
									<div class="girt_event-list-category test">
										<span><?php the_terms( $post->ID, 'event-type', '', '' ); ?></span>
									</div>
									<div class="girt_event-content-cont">
										<div class="rte taxonomy"><?php the_content(); ?></div>
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
			<?php endif; ?>
		</main>
	</div>
</section>
<?php get_footer(); ?>
