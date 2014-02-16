<div id="item-body">
	<div id="pag-top" class="pagination">
		<p>View messages sent in the last month. <br /><em>Note: </em>Messages are only stored for one month and are then deleted.</p>
</div>

	<?php
$this_group = bp_get_current_group_id();

$args = array(
	'post_type'		=> 'sg_grp_msg',
	'meta_key'		=> 'group_id',
	'meta_value'	=> $this_group,
	'order' => 'DESC',
	'posts_per_page'=> -1,

	);


	$this_grp_emails = new WP_Query ($args);
	$upload_dir = getcwd();

// The Loop
if ( $this_grp_emails->have_posts() ) {

        ?>
        <table>
        	<tr>
        		<th>From:</th>
        		<th>Subject:</th>
        		<th>Date:</th>
        		<th>File:</th>
        	</tr>

        <?php

	while ( $this_grp_emails->have_posts() ) {
		echo "<tr>";
		$this_grp_emails->the_post();
		$atts = get_post_meta( get_the_id(), 'attachments', true );
		echo '<td>' . get_the_author() . '</td>';
		echo '<td>';
		echo '<a data-toggle="modal" data-target="#modal'. get_the_id() .'" href="' . post_permalink() . '">';
		echo get_the_title(); 
		echo '</a>';
		echo '</td>';
		echo '<td>' . get_the_date() . '</td>';
		echo '<td>';
		if ($atts) {
			echo "<ol>";
			foreach ($atts as $att) { 
				$att = str_replace($upload_dir, '', $att);

				?>
		
			<li><a href="<?php echo $att; ?>"><?php echo basename($att); ?></a></li>
			
		<?php
			}
			echo "</ol>";

		}
		echo '</td>';
		echo "</tr>";
?>

<div id="modal<?php echo get_the_id(); ?>" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
    <h3 id="myModalLabel"><?php echo get_the_title(); ?></h3>
  </div>
  <div class="modal-body">
  </div>
  <div class="modal-footer">
    <button class="btn" data-dismiss="modal" aria-hidden="true">Close</button>
  </div>
</div>


        <?php 

	}
        echo '</table>'; 
} else {
	// no posts found
	echo "There are no emails to display...";
}
/* Restore original Post Data */
wp_reset_postdata();

?><script type="text/javascript">
//prevents modal from loading behind overlay
	jQuery('.modal').appendTo('body').modal('show');
</script>
</div><!--#item-body-->