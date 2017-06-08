<?php
/**
 * Set up the theme.
 *
 * @package     EssentialOilRecipes
 * @since       1.0.0
 * @author      Purple Prodigy
 * @link        http://www.purpleprodigy.com
 * @licence     GNU General Public License 2.0+
 */
namespace EssentialOilRecipes;

add_action( 'genesis_setup', __NAMESPACE__ . '\setup_child_theme', 15 );
/**
 * Setup child theme.
 *
 * @since 1.0.0
 *
 * @return void
 */
function setup_child_theme() {
	load_child_theme_textdomain( CHILD_TEXT_DOMAIN, apply_filters( 'child_theme_textdomain', CHILD_THEME_DIR . '/languages', CHILD_TEXT_DOMAIN ) );
	unregister_layouts();
	unregister_genesis_callbacks();
	add_theme_supports();
	adds_new_image_sizes();
}
/**
 * Unregister the Genesis Layouts.
 *
 * @since 1.0.0
 *
 * @return void
 */
function unregister_layouts() {
	$layouts = array(
		'sidebar-content',
		'content-sidebar-sidebar',
		'sidebar-content-sidebar',
		'sidebar-sidebar-content',
	);
	foreach( $layouts  as $layout ) {
		genesis_unregister_layout( $layout );
	}
}
add_filter( 'genesis_post_info', __NAMESPACE__ . '\modify_post_info' );
/**
 * Modify post info to remove date and show on blog posts only, not downloads (EDD).
 *
 * @since 1.0.0
 *
 * @param $post_info
 *
 * @return string
 */
function modify_post_info($post_info) {
	if ( in_category( 'aromatherapy' ) ) {
		$post_info = 'Posted by [post_author_posts_link] [post_comments] [post_edit]';

		return $post_info;
	}
}

/**
 * Unregister Genesis callbacks.  We do this here because the child theme loads before Genesis.
 *
 * @since 1.0.0
 *
 * @return void
 */
function unregister_genesis_callbacks() {
	unregister_menu_callbacks();
}

/**
 * Add theme supports to the site.
 *
 * @since 1.0.0
 *
 * @return void
 */
function add_theme_supports () {
	$config = array(
		'html5' => array( 'caption', 'comment-form', 'comment-list', 'gallery', 'search-form' ),
		'genesis-accessibility' => array(
			'404-page',
			'drop-down-menu',
			'headings',
			'rems',
			'search-form',
			'skip-links'
		),
		'genesis-responsive-viewport' => null,
		'custom-background' => null,
		'genesis-footer-widgets' => 1,
		'genesis-menus' => array(
			'primary'   => __( 'After Header Menu', CHILD_TEXT_DOMAIN )
		)
	);
	foreach ( $config as $feature => $args ) {
		add_theme_support( $feature, $args);
	}
}

/**
 * Add images sizes to the site.
 *
 * @since 1.0.0
 *
 * @return void
 */
function adds_new_image_sizes () {
	$config = array(
		'featured-image' => array(
			'width' => 300,
			'height' => 250,
			'crop' => true,
		),
		'edd-image' => array(
			'width' => 200,
			'height' => 315,
			'crop' => true,
		),
	);
	foreach ( $config as $name => $args ) {
		$crop = array_key_exists( 'crop', $args ) ? $args['crop'] : false;
		add_image_size( $name, $args['width'], $args['height'], $crop );
	}
}

add_filter( 'genesis_theme_settings_defaults', __NAMESPACE__ . '\set_theme_settings_defaults' );
/**
 * Set the theme settings defaults.
 *
 * @since 1.0.0
 *
 * @param array $defaults
 *
 * @return array
 */
function set_theme_settings_defaults( array $defaults) {
	$config = get_theme_settings_defaults();
	$defaults = wp_parse_args( $config, $defaults );

	return $defaults;
}
add_action( 'after_switch_theme', __NAMESPACE__ . '\update_theme_setting_defaults' );
/**
 * Update the theme settings defaults.
 *
 * @since 1.0.0
 *
 * @return void
 */
function update_theme_setting_defaults() {
	$config = get_theme_settings_defaults();
	if ( function_exists( 'genesis_update_settings' ) ) {
		genesis_update_settings( $config );
	}

	update_option( 'post_per_page', $config['blog_cat_num'] );
}

/**
 * Get theme settings defaults.
 *
 * @since 1.0.0
 *
 * @return array
 */
function get_theme_settings_defaults() {
	return array(
		'blog_cat_num'              => 12,
		'content_archive'           => 'full',
		'content_archive_limit'     => 0,
		'content_archive_thumbnail' => 0,
		'posts_nav'                 => 'numeric',
		'site_layout'               => 'content-sidebar',
	);
}
//* Modify the length of post excerpts

add_filter( 'excerpt_length', __NAMESPACE__ . '\change_excerpt_length' );
/**
 * Change the length of the post excerpt on the blog archive page.
 *
 * @since 1.0.0
 *
 * @param $length
 *
 * @return int
 */
function change_excerpt_length( $length ) {
	return 70;
}

// Add Read More Link to Excerpts
add_filter('excerpt_more', __NAMESPACE__ . '\get_read_more_link');
add_filter( 'the_content_more_link',  __NAMESPACE__ . '\get_read_more_link' );
/**
 * Add a read more link to post excerpts on the blog archive page.
 *
 * @since 1.0.0
 *
 * @return string
 */
function get_read_more_link() {
	return '...&nbsp;<a href="' . get_permalink() . '">Continue Reading</a>';
}