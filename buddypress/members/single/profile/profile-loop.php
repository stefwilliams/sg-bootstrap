<?php do_action( 'bp_before_profile_loop_content' ); ?>

<?php 
global $field;
global $bp;
$user_login = $bp->displayed_user->userdata->user_login;
if (bp_is_my_profile()) {
	$is_profile = true;
}
else {
	$is_profile = false;
}

$prof_args = array(
	// 'user_id' =>	'15',
	'hide_empty_groups' => false,
	'hide_empty_fields' => false,
	);

	if ( bp_has_profile($prof_args) ) : ?>

	<?php while ( bp_profile_groups() ) : bp_the_profile_group(); ?>

	<?php do_action( 'bp_before_profile_field_content' ); ?>

	<div class="bp-widget <?php bp_the_profile_group_slug(); ?>">

		<h4><?php bp_the_profile_group_name(); ?></h4>

		<table class="profile-fields">

			<?php while ( bp_profile_fields() ) : bp_the_profile_field(); ?>

			<?php if ( bp_field_has_data() ) : ?>

			<tr<?php bp_field_css_class(); ?>>

			<td class="label"><?php bp_the_profile_field_name(); ?></td>

			<td class="data"><?php bp_the_profile_field_value(); ?></td>

		</tr>
	<?php else : ?>


	<?php $edit_link = '/members-directory/'.$user_login.'/profile/edit/group/'.$field->group_id.'/'; ?>
	<tr<?php bp_field_css_class(); ?>>

	<td class="label"><?php bp_the_profile_field_name(); ?></td>

	<td class="data">
		<?php if ($is_profile) {
			?>
			--no data-- <a href="<?php echo $edit_link; ?>">(edit)</a>

			<?php 
		} 
		else {
			echo "--not specified--";
		}
		?>
	</td>

</tr>						

<?php endif; ?>

<?php do_action( 'bp_profile_field_item' ); ?>

<?php endwhile; ?>

</table>
</div>

<?php do_action( 'bp_after_profile_field_content' ); ?>



<?php endwhile; ?>

<?php do_action( 'bp_profile_field_buttons' ); ?>

<?php endif; ?>

<?php do_action( 'bp_after_profile_loop_content' ); ?>
