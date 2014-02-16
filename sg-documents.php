<?php
/** sg-documents.php
 *
 * Template Name: SG Documents
 * The template for displaying all pages.
 *
 * This is the template for displaying documents, including minutes and the Sacred SG Constitution...
 *
 * @author		Stef Williams
 * @package		sg-bootstrap
 * @since		1.0.0 - 02.12.2012
 */

get_header(); 


global $pods;

// Minutes columns: "name", "type", "meeting_date", "file"
 
$ctee_params = array (
'orderby' => 'meeting_date DESC',	
'where' => 'type = "Committee"' 
);

$agm_params = array(
'orderby' => 'meeting_date DESC',	
'where' => 'type = "AGM"' 
);

$ctee_minutes = pods ('sgminutes', $ctee_params);
$agm_minutes = pods ('sgminutes', $agm_params);
?>

<div id="primary" class="span9">
	<div id="content" role="main">
		<div class="row">
			<div class="span4">			
<?php
if ($ctee_minutes>0){
		echo '<h2>Committee Minutes</h2>';
		echo '<ul>';
	while ($ctee_minutes->fetchRecord()) {
	    	echo '<li>';
	    	echo '<a href ="'.$ctee_minutes->get_field('file.guid').'">';
	    	echo $ctee_minutes->get_field('meeting_date');
	    	echo '</a>';
	    	echo '</li>';
		}
	    echo '</ul>';
}

?>


			</div>
			<div class="span5">
<?php
if ($agm_minutes>0){
			echo '<h2>AGM Minutes</h2>';
		echo '<ul>';
	while ($agm_minutes->fetchRecord()) {
	    	echo '<li>';
	    	echo '<a href ="'.$agm_minutes->get_field('file.guid').'">';
	   		echo $agm_minutes->get_field('meeting_date');
	    	echo '</a>';
	    	echo '</li>';
		}
	    echo '</ul>';
}
?>
			</div>
		</div>
	</div><!-- #content -->
</div><!-- #primary -->

<?php
get_sidebar();
get_footer();


/* End of file sg-documents.php */
/* Location: ./wp-content/themes/sg-bootstrap/sg-documents.php */