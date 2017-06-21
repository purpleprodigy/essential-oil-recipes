<?php
/**
 * Add a related posts feature to all blog posts.
 *
 * @package     EssentialOilRecipes
 * @since       1.0.0
 * @author      Purple Prodigy
 * @link        http://www.purpleprodigy.com
 * @licence     GNU General Public License 2.0+
 */
namespace EssentialOilRecipes;

add_action( 'genesis_after_entry_content', __NAMESPACE__ . '\add_related_posts_feature_to_blog' );
/**
 * Add related posts at the end of each blog entry.
 *
 * @since 1.0.0
 *
 * @return void
 */
function add_related_posts_feature_to_blog() {
	if ( is_category( array('1', '134', '135', '136', '137', '138', '139' ) ) ) {
		return;
	} elseif (in_category( '1' )) {
		global $post;
		$orig_post = $post;
		$tags      = wp_get_post_tags( $post->ID );
		if ( $tags ) {
			$tag_ids = array();
			foreach ( $tags as $individual_tag ) {
				$tag_ids[] = $individual_tag->term_id;
			}
			$args     = array(
				'tag__in'             => $tag_ids,
				'post__not_in'        => array( $post->ID ),
				'posts_per_page'      => 5, // Number of related posts that will be shown.
				'ignore_sticky_posts' => 1
			);
			$my_query = new \WP_Query( $args );
			if ( $my_query->have_posts() ) {
				echo '<div id="related-posts"><h3>Similar aromatherapy and essential oil recipes info:</h3><ul>';
				while ( $my_query->have_posts() ) {
					$my_query->the_post(); ?>
                    <li>
                        <a href="<?php the_permalink() ?>" rel="bookmark"
                           title="<?php the_title(); ?>"><?php the_title(); ?></a>
                    </li>
				<?php }
				echo '</ul></div>';
			}

		}
		$post = $orig_post;
		wp_reset_query();
	}
}