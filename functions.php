<?php

/**
 * Set the content width based on the theme's design and stylesheet.
 */
if ( ! isset( $content_width ) )
	$content_width = 680;

/** Tell WordPress to run twentyten_setup() when the 'after_setup_theme' hook is run. */
add_action( 'after_setup_theme', 'twentyten_setup' );

if ( ! function_exists( 'twentyten_setup' ) ):
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which runs
 * before the init hook. The init hook is too late for some features, such as indicating
 * support post thumbnails.
 *
 * To override twentyten_setup() in a child theme, add your own twentyten_setup to your child theme's
 * functions.php file.
 *
 * @uses add_theme_support() To add support for post thumbnails and automatic feed links.
 * @uses register_nav_menus() To add support for navigation menus.
 * @uses add_custom_background() To add support for a custom background.
 * @uses add_editor_style() To style the visual editor.
 * @uses load_theme_textdomain() For translation/localization support.
 * @uses add_custom_image_header() To add support for a custom header.
 * @uses register_default_headers() To register the default custom header images provided with the theme.
 * @uses set_post_thumbnail_size() To set a custom post thumbnail size.
 *
 * @since Twenty Ten 1.0
 */
function twentyten_setup() {
	// This theme styles the visual editor with editor-style.css to match the theme style.
	add_editor_style();

	// Add featured thumbnails to the index, and header.
	if ( function_exists( 'add_image_size' ) ) add_theme_support( 'post-thumbnails' );
	if ( function_exists( 'add_image_size' ) ) {
		add_image_size( 'thumb', 200, 200, true );
		add_image_size( 'peoplehoz', 384, 392, true );
		add_image_size( 'campaign-thumb', 500, 500, true );
		add_image_size( 'product-thumb', 440, 688, true );
		add_image_size( 'campaign-header', 700, 9999, false );
		add_image_size( 'background', 2400, 9999, false );
	}

	// Add default posts and comments RSS feed links to head
	add_theme_support( 'automatic-feed-links' );

	// Make theme available for translation
	// Translations can be filed in the /languages/ directory
	load_theme_textdomain( 'twentyten', TEMPLATEPATH . '/languages' );

	$locale = get_locale();
	$locale_file = TEMPLATEPATH . "/languages/$locale.php";
	if ( is_readable( $locale_file ) )
		require_once( $locale_file );
}
endif;


/****************************************************
EXCERPTS
*****************************************************/

function cust_excerpt_length($length) {
	return 50;
}
add_filter('excerpt_length', 'cust_excerpt_length');
/* Returns a "Continue Reading" link for excerpts */
function twentyeleven_continue_reading_link() {
	return ' <a class="read-more" href="'. esc_url( get_permalink() ) . '">' . __( 'read more &raquo;', 'twentyeleven' ) . '</a>';
}

/**
 * Replaces "[...]" (appended to automatically generated excerpts) with an ellipsis and twentyeleven_continue_reading_link() */
function twentyeleven_auto_excerpt_more( $more ) {
	return '&hellip;' . twentyeleven_continue_reading_link();
}
add_filter( 'excerpt_more', 'twentyeleven_auto_excerpt_more' );


/****************************************************
ENQUEUES
*****************************************************/
function miniman_load_scripts() {
	wp_register_script( 'site-common',  get_template_directory_uri() . '/js/site-common.js', array(),'',true  );
	wp_register_script( 'font-awesome',  'https://use.fontawesome.com/d56fd4ea5d.js', array(),'',true  );
	wp_register_script( 'flipjs',  get_template_directory_uri() . '/js/jquery.flipster.min.js', array(),'',true  );
	wp_register_script( 'litejs',  get_template_directory_uri() . '/js/lightslider.min.js', array(),'',true  );
	wp_register_style( 'main-css', get_template_directory_uri() . '/style.css','','', 'screen' );
	wp_register_style( 'raleway-css', 'https://fonts.googleapis.com/css?family=Raleway:400,500,700,800','','', 'screen' );
	wp_register_style( 'minion-css', '"https://use.typekit.net/kbq5hwv.css','','', 'screen' );
	wp_register_style( 'flipcss',  get_template_directory_uri() . '/css/jquery.flipster.min.css','','', 'screen' );
	wp_register_style( 'liteslide',  get_template_directory_uri() . '/css/lightslider.min.css','','', 'screen' );

	wp_enqueue_script('jquery');
	wp_enqueue_script( 'site-common' );
	wp_enqueue_script( 'font-awesome' );
	wp_enqueue_script( 'flipjs' );
	wp_enqueue_script( 'litejs' );
	wp_enqueue_style( 'main-css' );
	wp_enqueue_style( 'raleway-css' );
	wp_enqueue_style( 'minion-css' );
	wp_enqueue_style( 'flipcss' );
	wp_enqueue_style( 'liteslide' );
}
add_action('wp_enqueue_scripts', 'miniman_load_scripts');


/***************************************************
/ Options Pages
/***************************************************/

if(function_exists('acf_add_options_page')) {

	acf_add_options_page();

}
add_theme_support( 'title-tag' );

/* Event */

function pagination_bar( $custom_query ) {

    $total_pages = $custom_query->max_num_pages;
    $big = 999999999;

    if ($total_pages > 1){
        $current_page = max(1, get_query_var('paged'));

        echo paginate_links(array(
            'base' => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
            'format' => '?paged=%#%',
            'current' => $current_page,
            'total' => $total_pages,
			'prev_text'          => __('<'),
			'next_text'          => __('>'),
        ));
    }
}

/* Event AJAX Loop */

function misha_filter_function(){
	$today = date('Ymd');
	$paged = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;
	$args = array(
		'post_type' => 'event',
		'meta_key'	=> 'event_date',
		'orderby'	=> 'meta_value_num',
		'order'		=> 'ASC',
		'posts_per_page' => -1,
        'paged' => $paged,
		/*'meta_query' => array(
			 array(
				'key'		=> 'event_date',
				'compare'	=> '>=',
				'value'		=> $today,
			)
		),*/
		'meta_query' => array(
		array(
		  'key' => 'do_not_display',
		  'value' => '0',
		)
			),
	);

	// for taxonomies / categories
	if( isset( $_POST['categoryfilter'] ) )
		$args['tax_query'][] = array(
			array(
				'taxonomy' => 'event-type',
				'field' => 'id',
				'terms' => $_POST['categoryfilter']
			)
		);

	// For Archives
	if( isset( $_POST['archivefilter'] ) ):
		$args['meta_query'][] = array(
			array(
				'key'		=> 'event_date',
				'compare'	=> '<',
				'value'		=> $today,
			)
		);
	else:
		$args['meta_query'][] = array(
			array(
				'key'		=> 'event_date',
				'compare'	=> '>=',
				'value'		=> $today,
			)
		);
	endif;

	$query = new WP_Query( $args );

	if( $query->have_posts() ) :
		echo "<ul>";
			while( $query->have_posts() ): $query->the_post(); ?>
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
										<div class="rte newresult"><?php the_field('event_excerpt'); ?></div>
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
<?php wp_reset_postdata();
	else :
		echo 'No posts found';
	endif;

	die();
}


add_action('wp_ajax_myfilter', 'misha_filter_function');
add_action('wp_ajax_nopriv_myfilter', 'misha_filter_function');

/***************************************************
/ Sidebars
/***************************************************/

if ( function_exists('register_sidebar') ) {
	register_sidebar(array(
		'name' => 'Calendar',
		'id' => 'calendar',
		'description' => 'Holds widget content for the event calendar',
		'before_widget' => '',
		'after_widget' => '',
		'before_title' => '',
		'after_title' => '',
	));
};

/* Event CPT Admin columns */

add_filter('manage_event_posts_columns' , 'girton_add_event_columns');

function girton_add_event_columns( $columns ) {
  $columns = array(
    'cb'           => '<input type="checkbox" />',
    'title'        => 'Title',
    'event_date'   => 'Event Date',
	'multiday'   => 'Multi Day',
    'event-type'   => 'Event Type'
  );
  return $columns;
}

add_action( 'manage_event_posts_custom_column', 'girton_custom_event_columns', 9, 2 );

function girton_custom_event_columns( $column ) {
  global $post;
  switch ( $column ) {

	// If Event Date
    case 'event_date':
		echo date('d/m/Y', strtotime(get_field( "event_date", $post->ID )));
    break;

	// If event length
	case 'multiday':

		  if(get_field( "event_multi_day_event", $post->ID ) == true):
		  	echo "&#10004;";
		  else:
		  endif;
    break;

	// If event Type
	case 'event-type' :
		 $terms = get_the_terms( $post_id, 'event-type' );

		  if ( !empty( $terms ) ) {

				$out = array();

				/* Loop through each term, linking to the 'edit posts' page for the specific term. */
				foreach ( $terms as $term ) {
					$out[] = sprintf( '<a href="%s">%s</a>',
						esc_url( add_query_arg( array( 'post_type' => $post->post_type, 'event-type' => $term->slug ), 'edit.php' ) ),
						esc_html( sanitize_term_field( 'name', $term->name, $term->term_id, 'event-type', 'display' ) )
					);
				}

				/* Join the terms, separating them with a comma. */
				echo join( ', ', $out );
			}

			/* If no terms were found, output a default message. */
			else {
				_e( 'No event type assigned' );
			}

	break;
  }

}

add_filter( 'manage_edit-event_sortable_columns', 'girton_sortable_event_column' );
function girton_sortable_event_column( $columns ) {
    $columns['event_date'] = 'event_date';
    return $columns;
}

add_action('pre_get_posts', 'girton_admin_orderby');

function girton_admin_orderby($query) {
  if(!is_admin())
    return;

	global $pagenow;
	global $typenow;
	if($pagenow == 'edit.php' && "event" == $typenow){
		$query->set('meta_key', 'event_date');
		$query->set('orderby', 'meta_value');
		$query->set('order', 'ASC');
		$query->set('meta_query', array(
			array(
				'key' => 'event_date',
				'value' => date('d/m/Y', 0),
				'compare' => '>=',
				'type' => 'DATE'
				)
			)
		);
	}
}





// Column for sort order

add_filter('manage_campaign_posts_columns' , 'girton_add_campaign_columns');

function girton_add_campaign_columns( $columns_camp ) {

  $columns_camp = array(
    'cb'           => '<input type="checkbox" />',
    'title'        => 'Title',
    'sort-order'   => 'Sort Order',
  );
  return $columns_camp;
}

add_action( 'manage_campaign_posts_custom_column', 'girton_custom_campaign_columns', 10, 2 );
function girton_custom_campaign_columns( $columns_camp ) {
	global $post;

	switch ( $columns_camp ) {

		case 'sort-order':
		  echo get_field( "sort_order", $post->ID );
		break;

	}
}



/*
add_action( 'pre_get_posts', 'girton_event_orderby');
function girton_event_orderby( $query ) {
    if( ! is_admin() )
        return;

    $orderby = $query->get( 'orderby');

    if( 'event_date' == $orderby ) {
        $query->set('meta_key','event_date');
        $query->set('orderby','meta_value');
    }
}
*/
