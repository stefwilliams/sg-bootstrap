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
?>