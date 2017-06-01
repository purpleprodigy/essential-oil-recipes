<?php
/**
 * Footer HTML markup structure.
 *
 * @package     EssentialOilRecipes
 * @since       1.0.0
 * @author      Purple Prodigy
 * @link        https://www.purpleprodigy.com
 * @licence     GNU General Public License 2.0+
 */
namespace EssentialOilRecipes;
add_filter( 'genesis_footer_creds_text', __NAMESPACE__ . '\pp_footer_creds_filter' );
/**
 * Customise  footer credits
 *
 * @since 1.0.0
 *
 * @param $creds
 *
 * @return string
 */
function pp_footer_creds_filter( $creds ) {
	$creds = 'Copyright [footer_copyright] <a href="https://www.essential-oil-recipes.com">Essential Oil Recipes</a> &middot; <a href="/sitemap/" rel="nofollow">Sitemap</a> &middot; <a href="/privacy/" rel="nofollow">Privacy</a> &middot; Website by <a href="https://www.purpleprodigy.com">Purple Prodigy</a>';
	return $creds;
}