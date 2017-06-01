<?php
/**
 * Post HTML markup structure.
 *
 * @package     EssentialOilRecipes
 * @since       1.0.0
 * @author      Purple Prodigy
 * @link        http://www.purpleprodigy.com
 * @licence     GNU General Public License 2.0+
 */
namespace EssentialOilRecipes;

/**
 * Add adsense to pages, posts and search page.
 *
 * @since 1.0.0
 *
 * @return void
 */
add_filter( 'genesis_entry_content', __NAMESPACE__ . '\add_google_adsense' );

function add_google_adsense() {
	if ( is_category( 'downloads' ) || is_category( '1' ) ) {
		return;
	} elseif ( is_page() || in_category( '1' ) || is_search() ) { ?>
        <div class="adsense">
            <script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
            <!-- 300x250, created 10/8/10 EOR -->
            <ins class="adsbygoogle"
                 style="display:inline-block;width:300px;height:250px"
                 data-ad-client="ca-pub-5283332689335671"
                 data-ad-slot="7778000632"></ins>
            <script>
				(
					adsbygoogle = window.adsbygoogle || []
				).push( {} );
            </script>
        </div>
		<?php
	}
}