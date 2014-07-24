<?php
function change_excerpt_to_band_info() { 
	remove_meta_box('postexcerpt', 'event', 'normal'); 
	add_meta_box('postexcerpt', __('Info for Band Members'), 'band_info_meta_box', 'event', 'normal'); 
	
} 

function band_info_meta_box(){ 
	$post = get_post();	?>
	<textarea name="excerpt" id="excerpt"><?php echo esc_html( $post->post_excerpt ); ?></textarea> 
	<p>Put instructions and other band-specific info in here. Stuff that is NOT for the public.</p>
	<?php
}

add_action( 'admin_init', 'change_excerpt_to_band_info' ); 

//ensure event Open Graph tags are generated from content, NOT excerpt (which is used for Band only info)

function sg_event_description_tag( $tags ) {

	global $post;

$pt = get_post_type( $post );
// print_r($pt);

	if (get_post_type( $post ) == 'event') {

        // Remove the default description added by Jetpack
		unset( $tags['og:description'] );

		$content = $post->post_content;
		$tags['og:description'] = strip_tags($content);
		// print_r($tags);
	}
		return $tags;  
}
add_filter( 'jetpack_open_graph_tags', 'sg_event_description_tag' );





?>