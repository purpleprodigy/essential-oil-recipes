<?php
/**
 * Remove Post Info and Post Meta from Archive Page.
 *
 * @package     EssentialOilRecipes
 * @since       1.0.0
 * @author      Purple Prodigy
 * @link        http://www.purpleprodigy.com
 * @licence     GNU General Public License 2.0+
 */
namespace EssentialOilRecipes;

add_action ( 'genesis_entry_header', __NAMESPACE__ . '\remove_post_meta_from_archive' );
/**
 * Remove Post Info and Post Meta from Archive Page
 *
 * @since 1.0.0
 *
 * @return void
 */
function remove_post_meta_from_archive() {
	if (is_archive()) {
		remove_action( 'genesis_entry_header', 'genesis_post_info', 12 );
		remove_action( 'genesis_entry_footer', 'genesis_post_meta' );
	}
}
