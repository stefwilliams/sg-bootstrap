<?php
/** content-single.php
 *
 * The template for displaying content in the single.php template
 *
 * @author		Konstantin Obenland
 * @package		The Bootstrap
 * @since		1.0.0 - 07.02.2012
 */


tha_entry_before(); ?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<?php tha_entry_top(); ?>
	
	<header class="page-header">
		<?php the_title( '<h2 class="entry-title">', '</h2>' ); ?>
		<!-- .entry-meta -->
	</header><!-- .entry-header -->

	<div class="entry-content clearfix">
		<?php
		if ( has_post_thumbnail() ) : ?>
		<a class="thumbnail post-thumbnail span2" href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
			<?php the_post_thumbnail( 'thumbnail' ); ?>
		</a>
		<?php endif;
		the_content();
		the_bootstrap_link_pages(); ?>
	</div><!-- .entry-content -->

	<footer class="entry-footer">
		<?php
		$categories_list = get_the_category_list( _x( ', ', 'used between list items, there is a space after the comma', 'the-bootstrap' ) );
		$tags_list = get_the_tag_list( '', _x( ', ', 'used between list items, there is a space after the comma', 'the-bootstrap' ) );
		
		if ( $categories_list )
			printf( '<span class="cat-links block">' . __( 'Posted in %1$s.', 'the-bootstrap' ) . '</span>', $categories_list );
		if ( $tags_list )
			printf( '<span class="tag-links block">' . __( 'Tagged %1$s.', 'the-bootstrap' ) . '</span>', $tags_list );
		?>
	</footer><!-- .entry-footer -->
	
	<?php tha_entry_bottom(); ?>
</article><!-- #post-<?php the_ID(); ?> -->
<?php tha_entry_after();



/* End of file content-single.php */
/* Location: ./wp-content/themes/the-bootstrap/partials/content-single.php */