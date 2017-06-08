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

add_action( 'genesis_entry_header', __NAMESPACE__ . '\single_post_featured_image', 15 );
/**
 * Automagically add the featured thumbnail image to the top of each post.
 *
 * @since 1.0.0
 *
 * @return void
 */
function single_post_featured_image() {
	if ( is_single( array( '878', '871', '839' ) ) ) {
		return;
	} elseif ( ! is_singular( 'post' ) ) {
		return;
	}
	$img = genesis_get_image( array(
		'format' => 'html',
		'size'   => 'thumbnail',
		'attr'   => array( 'class' => 'alignright' )
	) );
	printf( '<a href="%s" title="%s">%s</a>', get_permalink(), the_title_attribute( 'echo=0' ), $img );
}

add_action( 'genesis_entry_header', __NAMESPACE__ . '\single_page_featured_image', 15 );
/**
 * Automagically add the featured image to the top of each page.
 *
 * @since 1.0.0
 *
 * @return void
 */
function single_page_featured_image() {
	if ( ! is_singular( 'page' ) ) {
		return;
	}
	$img = genesis_get_image( array(
		'format' => 'html',
		'size'   => 'medium',
		'attr'   => array( 'class' => 'alignright' )
	) );
	printf( '<a href="%s" title="%s">%s</a>', get_permalink(), the_title_attribute( 'echo=0' ), $img );

}

add_filter( 'genesis_entry_content', __NAMESPACE__ . '\add_google_adsense' );
/**
 * Add adsense to pages, posts and search page.
 *
 * @since 1.0.0
 *
 * @return void
 */
function add_google_adsense() {
	if ( is_category( 'downloads' ) || is_category( '1' ) || is_page( array( '1249', '1250', '1251', '1252' ) ) ) {
		return;
	} elseif ( is_page() || in_category( '1' ) || is_search() ) { ?>
        <!--        <div class="adsense">-->
        <!--            <script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>-->
        <!--            <!-- 300x250, created 10/8/10 EOR -->-->
        <!--            <ins class="adsbygoogle"-->
        <!--                 style="display:inline-block;width:300px;height:250px"-->
        <!--                 data-ad-client="ca-pub-5283332689335671"-->
        <!--                 data-ad-slot="7778000632"></ins>-->
        <!--            <script>-->
        <!--				(-->
        <!--					adsbygoogle = window.adsbygoogle || []-->
        <!--				).push( {} );-->
        <!--            </script>-->
        <!--        </div>-->
		<?php
	}
}