<?php
/** single-sg_grp_msg.php
 *
 * The Template for displaying single group emails.
 *
 * @author		Stef
 * @package		The Bootstrap
 * @since		1.0.0 - 05.02.2012
 */

?>



	<?php tha_content_before(); ?>
	<div id="content" role="main">
		<?php tha_content_top();

		while ( have_posts() ) {
			the_post();

		$atts = get_post_meta( get_the_id(), 'attachments', true );
	$upload_dir = getcwd();
	?>
		<header class="page-header">

		<div class="entry-meta"><?php 	
		$time_string = ( get_the_time( 'U' ) == get_the_modified_time( 'U' ) )
				 ? '<a href="%1$s" title="%2$s" rel="bookmark"><time class="entry-date published updated" datetime="%3$s" pubdate>%4$s</time></a>'
				 : '<a href="%1$s" title="%2$s" rel="bookmark"><time class="entry-date published" datetime="%3$s" pubdate>%4$s</time><time class="assistive-text updated" datetime="%5$s">%6$s</time></a>';

	$time = sprintf(
		$time_string . '<span class="by-author"> <span class="sep">',
		esc_url( get_permalink() ),
		esc_attr( get_the_time() ),
		esc_attr( get_the_date( 'c' ) ),
		esc_html( get_the_date() ),
		esc_attr( get_the_modified_date( 'c' ) ),
		esc_html( get_the_modified_date() )
	);

	$author = sprintf(
		'</span><span class="author vcard"><a class="url fn n" href="%1$s" title="%2$s" rel="author">%3$s</a></span></span>',
		esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ),
		esc_attr( sprintf( __( 'View all posts by %s', 'the-bootstrap' ), get_the_author() ) ),
		get_the_author()
	);

	printf( __( 'Sent on %1$s by %2$s', 'the-bootstrap' ), $time, $author ); ?></div><!-- .entry-meta -->
	</header><!-- .entry-header -->

	<div class="entry-content clearfix">
		<?php
		the_content();
		?>
	</div><!-- .entry-content -->



	<?php		
			
		if ($atts) {
			echo "<h4>Attachments</h4><ul>";
			foreach ($atts as $att) { 
				$att = str_replace($upload_dir, '', $att);

				?>
		
			<li><a href="<?php echo $att; ?>"><?php echo basename($att); ?></a></li>
			
		<?php
			}
			echo "</ul>";

		}
		} ?>

		<?php tha_content_bottom(); ?>
	</div><!-- #content -->
	<?php tha_content_after(); ?>

<?php



/* End of file index.php */
/* Location: ./wp-content/themes/the-bootstrap/single.php */