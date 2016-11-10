<?php
/**
 * Set up the theme.
 *
 * @package     PurpleProdigy\Developers
 * @since       1.0.0
 * @author      Purple Prodigy
 * @link        http://www.purpleprodigy.com
 * @licence     GNU General Public License 2.0+
 */
namespace PurpleProdigy\Developers;

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
	//unregister_sidebar( 'sidebar' );
	//unregister_sidebar( 'sidebar-alt' );
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
		'content-sidebar',
		'content-sidebar-sidebar',
		'sidebar-content-sidebar',
		'sidebar-sidebar-content',
	);
	foreach( $layouts  as $layout ) {
		genesis_unregister_layout( $layout );
	}
	// temporary fix for Genesis bug 06.22.2016
	genesis_set_default_layout( 'full-width-content' );
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
		'custom-header' => array(
			'width'           => 600,
			'height'          => 160,
			'header-selector' => '.site-title a',
			'header-text'     => false,
			'flex-height'     => true,
		),
		'custom-background' => null,
		//'genesis-after-entry-widget-area' => null,
		//'genesis-footer-widgets' => 3,
		'genesis-menus' => array(
			'primary'   => __( 'After Header Menu', CHILD_TEXT_DOMAIN ),
			'secondary' => __( 'Footer Menu', CHILD_TEXT_DOMAIN )
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
			'width' => 720,
			'height' => 400,
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