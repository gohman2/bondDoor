<?php
/**
 * bondTheme functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package bondTheme
 */

if ( ! function_exists( 'bondtheme_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function bondtheme_setup() {
		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on bondTheme, use a find and replace
		 * to change 'bondtheme' to the name of your theme in all the template files.
		 */
		load_theme_textdomain( 'bondtheme', get_template_directory() . '/languages' );

		// Add default posts and comments RSS feed links to head.
		add_theme_support( 'automatic-feed-links' );

		/*
		 * Let WordPress manage the document title.
		 * By adding theme support, we declare that this theme does not use a
		 * hard-coded <title> tag in the document head, and expect WordPress to
		 * provide it for us.
		 */
		add_theme_support( 'title-tag' );

		/*
		 * Enable support for Post Thumbnails on posts and pages.
		 *
		 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		 */
		add_theme_support( 'post-thumbnails' );

		// This theme uses wp_nav_menu() in one location.
		register_nav_menus( array(
			'menu-1' => esc_html__( 'Primary', 'bondtheme' ),
		) );

		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support( 'html5', array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
		) );

		// Set up the WordPress core custom background feature.
		add_theme_support( 'custom-background', apply_filters( 'bondtheme_custom_background_args', array(
			'default-color' => 'ffffff',
			'default-image' => '',
		) ) );

		// Add theme support for selective refresh for widgets.
		add_theme_support( 'customize-selective-refresh-widgets' );

		/**
		 * Add support for core custom logo.
		 *
		 * @link https://codex.wordpress.org/Theme_Logo
		 */
		add_theme_support( 'custom-logo', array(
			'height'      => 250,
			'width'       => 250,
			'flex-width'  => true,
			'flex-height' => true,
		) );
	}
endif;
add_action( 'after_setup_theme', 'bondtheme_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function bondtheme_content_width() {
	// This variable is intended to be overruled from themes.
	// Open WPCS issue: {@link https://github.com/WordPress-Coding-Standards/WordPress-Coding-Standards/issues/1043}.
	// phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound
	$GLOBALS['content_width'] = apply_filters( 'bondtheme_content_width', 640 );
}
add_action( 'after_setup_theme', 'bondtheme_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function bondtheme_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar', 'bondtheme' ),
		'id'            => 'sidebar-1',
		'description'   => esc_html__( 'Add widgets here.', 'bondtheme' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
}
add_action( 'widgets_init', 'bondtheme_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function bondtheme_scripts() {
	wp_enqueue_style( 'bondtheme-style', get_stylesheet_uri() );
//    wp_enqueue_style( 'google_fonts_opensans', "https://fonts.googleapis.com/css?family=Libre+Baskerville");
    wp_enqueue_style( 'custom_opensans', "https://fonts.googleapis.com/css?family=Open+Sans:300,400");
	wp_enqueue_script( 'bondtheme-navigation', get_template_directory_uri() . '/js/navigation.js', array(), '20151215', true );
    wp_enqueue_script( 'diagram', get_template_directory_uri() . '/js/jquery.circliful.min.js', array(), '20151215', true );
//    wp_enqueue_script( 'diagram-init', get_template_directory_uri() . '/js/diagram-init.js', array(), '20151215', true );
    wp_enqueue_script( 'custom-js', get_template_directory_uri() . '/js/custom.js', array(), '20151215', true );
    wp_localize_script( 'custom-js', 'myajax',
        array(
            'url' => admin_url('admin-ajax.php'),
            'nonce' => wp_create_nonce('myajax-nonce')
        )
    );
    wp_enqueue_script( 'bondtheme-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20151215', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'bondtheme_scripts' );

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
if ( defined( 'JETPACK__VERSION' ) ) {
	require get_template_directory() . '/inc/jetpack.php';
}

/* --------------------------------------------------------------------------
 * disable Emojii
 * -------------------------------------------------------------------------- */
remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
remove_action( 'wp_print_styles', 'print_emoji_styles' );
remove_action( 'admin_print_styles', 'print_emoji_styles' );
remove_filter( 'the_content_feed', 'wp_staticize_emoji' );
remove_filter( 'comment_text_rss', 'wp_staticize_emoji' );
remove_filter( 'wp_mail', 'wp_staticize_emoji_for_email' );
add_filter( 'tiny_mce_plugins', 'disable_wp_emojis_in_tinymce' );
function disable_wp_emojis_in_tinymce( $plugins ) {
    if ( is_array( $plugins ) ) {
        return array_diff( $plugins, array( 'wpemoji' ) );
    } else {
        return array();
    }
}
/* --------------------------------------------------------------------------- */

/*
 * disable rss feed
 * */
function fb_disable_feed() {
wp_redirect(get_option('siteurl'));
}

add_action('do_feed', 'fb_disable_feed', 1);
add_action('do_feed_rdf', 'fb_disable_feed', 1);
add_action('do_feed_rss', 'fb_disable_feed', 1);
add_action('do_feed_rss2', 'fb_disable_feed', 1);
add_action('do_feed_atom', 'fb_disable_feed', 1);

remove_action( 'wp_head', 'feed_links_extra', 3 );
remove_action( 'wp_head', 'feed_links', 2 );
remove_action( 'wp_head', 'rsd_link' );
remove_action( 'wp_head', 'wp_generator' );
remove_action( 'wp_head', 'wlwmanifest_link' );
remove_action( 'wp_head', 'wp_shortlink_wp_head');
remove_action( 'wp_head', 'adjacent_posts_rel_link_wp_head');

/*
 * remove image page
 * */
add_action( 'template_redirect', function() {
    if( is_attachment() ) {
        header("Status: 404 Not Found");
        global $wp_query;
        $wp_query->set_404();
        status_header(404);
        nocache_headers();
    }
} );

/* get location from google api*/
function getCity(){
    $cityArray = array();
    $query_array = array(
        'post_type' => 'city',
        'post_status' => 'publish',
        'posts_per_page' => '-1',
    );
    $cityPosts = new WP_Query( $query_array );
    if ( $cityPosts->have_posts() ):
        while ( $cityPosts->have_posts() ): $cityPosts->the_post();
            $cityId = get_the_ID();
            $title = get_the_title();
            $title = str_replace(' ', '+', $title);
            $response = file_get_contents('http://maps.googleapis.com/maps/api/geocode/json?address='.$title.'&region=gb&sensor=false&language=ru');
            $response = json_decode($response);
            $lat = $response->results[0]->geometry->location->lat;
            $lng = $response->results[0]->geometry->location->lng;
            $location = array(
                'lat'   => $lat,
                'lng'   => $lng,
                'city'  => $title,
                'cityID'  => $cityId,
            );
            $cityArray[] = $location;
        endwhile; endif;

    return $cityArray;
}

function getMenuItem(){
    $menuItems = array();
    $terms = get_terms( array(
        'taxonomy'      => array( 'feature' ),
        'orderby'       => 'term_order',
        'order'         => 'ASC',
        'hide_empty'    => false,
        'object_ids'    => null, //
    ) );

    if($terms){
        foreach ($terms as $term){
            $id_cat = $term->term_id;
            $categoryName = $term->name;
            $menu['category'] = $categoryName;
//            $menuItems[] = $categoryName;
                $query_array = array(
                    'post_type' => 'city',
                    'post_status' => 'publish',
                    'posts_per_page' => '-1',
                    'tax_query' => array(
                        array(
                            'taxonomy' => 'feature',
                            'field' => 'id',
                            'terms' => $id_cat
                        )
                    )
                );

                $cities = new WP_Query( $query_array );
                $childsItem = array();
                if ( $cities->have_posts() ):
                    while ( $cities->have_posts() ): $cities->the_post();
                        $post_pay_id = get_the_ID();
                        $title = get_the_title();
                        $valueArray = array('name'=> $title, 'cityId' => $post_pay_id);
                        $childsItem[] =  $valueArray;

                    endwhile;
                endif;
            $menu['child'] = $childsItem;
            $menuItems[] = $menu;
        }
    }
    return $menuItems;
}


/*city popup query*/
/*ajax news*/
function cityPopup() {
    check_ajax_referer( 'myajax-nonce', 'nonce_code' );
    $content = '';
    $resultArray = array();
    if( isset( $_POST['cityId'] ) ) {
        $cityId = $_POST['cityId'];
        $startFeture = $_POST['startFeture'];
        $title = get_the_title( $cityId );
        $title2 = str_replace(' ', '+', $title);
        $response = file_get_contents('http://maps.googleapis.com/maps/api/geocode/json?address='.$title2.'&region=gb&sensor=false&language=ru');
        $response = json_decode($response);
        $lat = $response->results[0]->geometry->location->lat;
        $lng = $response->results[0]->geometry->location->lng;
        $informations = get_field('information', $cityId);
        if( $informations ){
            $infContent = '';
            /*inf content top popup*/
            foreach ( $informations as $inf){
                $infContent .= '<div class="city-popup-info">'.$inf['title'].' <span>'.$inf['value'].'</span></div>';
            }
        }
        $features = get_field('features_city', $cityId);
        if( $features ){
            /*feture popup*/
            $fetureConetnt = '';
            foreach ( $features as $feature){
                if($startFeture == $feature['name']){
                    $startScore = $feature['score'];
                    continue;
                }
                $fetureConetnt .= ' <li data-percent="'.$feature['score'].'" class="navigation-item"><span>'.$feature['score'].'</span>'.$feature['name'].'</li>';

            }
        }
        if( get_field('description', $cityId)){
            $description = get_field('description', $cityId);
        }
        $resultArray = array('title' => $title, 'topContent' => $infContent, 'fetureContent' => $fetureConetnt, 'description' => $description, 'startFeture'=>$startFeture, 'startScore'=>$startScore, 'lat' => $lat, 'lng' => $lng );
    }
    wp_send_json($resultArray);
    die();
}

add_action('wp_ajax_city-popup', 'cityPopup');
add_action('wp_ajax_nopriv_city-popup', 'cityPopup');


if( function_exists('acf_add_options_page') ) {

    acf_add_options_page('Main Settings');

}

show_admin_bar(false);