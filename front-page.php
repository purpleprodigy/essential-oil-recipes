<?php

/**
 * Front page template
 *
 * @package     EssentialOilRecipes\FrontPage
 * @since       1.0.0
 * @author      Purple Prodigy
 * @link        https://www.purpleprodigy.com
 * @licence     GNU General Public License 2.0+
 */
namespace EssentialOilRecipes\FrontPage;

add_action( 'genesis_meta', __NAMESPACE__ . '\render_front_page' );
/**
 * Add widget support for homepage. If no widgets active, display the default loop.
 *
 */
function render_front_page() {

	if ( is_active_sidebar( 'front-page-1' ) || is_active_sidebar( 'front-page-2' ) || is_active_sidebar( 'front-page-3' ) ) {

		//* Add front-page body class
		add_filter( 'body_class', __NAMESPACE__ . '\eor_body_class' );
		function eor_body_class( $classes ) {

			$classes[] = 'front-page';

			return $classes;

		}

		//* Force full width content layout
		add_filter( 'genesis_pre_get_option_site_layout', '__genesis_return_full_width_content' );

		//* Remove After Header
//		if ( is_active_sidebar( 'front-page-1' ) ) {
//			remove_action( 'genesis_after_header', 'suelund_open_after_header', 5 );
//			remove_action( 'genesis_after_header', 'suelund_close_after_header', 15 );
//		}

		//* Remove breadcrumbs
		remove_action( 'genesis_before_loop', 'genesis_do_breadcrumbs' );

		//* Remove the default Genesis loop
		remove_action( 'genesis_loop', 'genesis_do_loop' );

		//* Add homepage widgets
		add_action( 'genesis_loop', __NAMESPACE__ . '\eor_front_page_widgets' );

	}

}

//* Add markup for front page widgets
function eor_front_page_widgets() {

	echo '<h2 class="screen-reader-text">' . __( 'Main Content', CHILD_TEXT_DOMAIN ) . '</h2>';

	genesis_widget_area( 'front-page-1', array(
		'before' => '<div id="front-page-1" class="front-page-1"><div class="wrap">',
		'after'  => '</div></div>',
	) );

	genesis_widget_area( 'front-page-2', array(
		'before' => '<div id="front-page-2" class="front-page-2"><div class="wrap">',
		'after'  => '</div></div>',
	) );
	genesis_widget_area( 'front-page-3', array(
		'before' => '<div id="front-page-3" class="front-page-3"><div class="wrap">',
		'after'  => '</div></div>',
	) );
}

//* Run the Genesis loop
genesis();