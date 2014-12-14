<section id="nav" class="encontro-logo span3">
	<div class="encontro-logo">
	</div>
	<?php

global $post;
$encontro_home_slug = "encontro2015";
$encontro_home_object = get_page_by_path( $encontro_home_slug);
$encontro_home_id = $encontro_home_object->ID;

		$args = array(
			'child_of'     => $encontro_home_id,
			'link_after'   => '',
			'link_before'  => '',
			'post_type'    => 'page',
			'post_status'  => 'publish',
			'sort_column'  => 'menu_order',
			'title_li'     => ''
		);
echo "<ul class='encontro nav nav-tabs nav-stacked'>";
			wp_list_pages( $args );
echo "</ul>";			
		?>
	
<!-- print_r($wp_query); ?> -->

</section>