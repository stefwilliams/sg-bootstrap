<?php
/** sg-documents.php
 *
 * Template Name: SG Edit Documents
 * The template for displaying all pages.
 *
 * This is the template for displaying documents, including minutes and the Sacred SG Constitution...
 *
 * @author		Stef Williams
 * @package		sg-bootstrap
 * @since		1.0.0 - 02.12.2012
 */

get_header(); 



// Minutes columns: "name", "type", "meeting_date", "file"
 

?>

<div id="primary" class="span9">
    <?php tha_content_before(); ?>
	<div id="content" role="main">
        <?php tha_content_top();
        the_post();
        get_template_part( '/partials/content', 'page' );

        global $pods;
        $mypod = pods( 'documents' );
        $fields = array( 'document_type', 'publication_date', 'file_upload' );
        echo $mypod->form($fields);

        tha_content_bottom(); ?>
	</div><!-- #content -->
    <?php tha_content_after(); ?>
</div><!-- #primary -->
<?php
get_sidebar();
get_footer();

/* End of file sg-documents.php */
/* Location: ./wp-content/themes/sg-bootstrap/sg-documents.php */
?>