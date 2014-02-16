<?php
/**
 * 
 *
 */
?>
<?php get_header(); ?>
<?php //$sidebar = get_post_meta($post->ID, 'selected_sidebar', true); ?>
<div class="container masthead">
	<h1><?php the_title(); ?></h1>
</div>

<div class="container content">
	<div class="row">
		<div class="span8">
			<div class="breadcrumb">
				<?php do_action('icl_navigation_breadcrumb'); ?>
			</div>
			<?php while ( have_posts() ) : the_post(); ?>
			<?php get_template_part( 'excerpt'); ?>  
			<?php get_template_part( 'content', 'page' ); ?>		
		<?php endwhile; // end of the loop. ?>	
		<?php wp_reset_postdata(); ?>
		<?php
			//Get Director blogs
		$blog_args = array(
			'post_type'	=> 'lmw_resource',	
			'resource-cats' => 'directors-blog',
			// 'resource-types' => 'vid',
			'suppress_filters' => true,	
			'orderby' => 'date',
			'order' => 'DESC',
			);
			// $bazza_blogs = get_posts($blog_args); 
		$bazza_blogs = new WP_Query($blog_args);
		?>
		<style type="text/css">
		#director_blog li.entypo:before {
			left: -25px;
		}
		#director_blog li.entypo {
			border-bottom:1px solid #ddd;
		}
		#director_blog li.entypo .entypo.comment{
			color: #ccc;
			font-size: 20px;
			display:inline-block;
			position: relative;
			font-size: 35px;
			z-index: 1;-moz-transform: scaleX(-1);
			-o-transform: scaleX(-1);
			-webkit-transform: scaleX(-1);
			transform: scaleX(-1);
			filter: FlipH;
			-ms-filter: 'FlipH';
		}
		#director_blog li.entypo .comment_no {
			text-align:left;
			position: relative;
			left: -25px;
			top:-13px;
			z-index: 2;
		}
		</style>
		<div id="director_blog" class="well">
			<h3 class="entypo megaphone">Director's Blog</h3>
			<?php _e("<p>LMW's Director, Barry Kennard, gives his take on Leadership and Management issues in a new weekly blog. </p><p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam in viverra est. Ut vitae adipiscing lorem, sed luctus tortor. Vivamus egestas nibh ac viverra luctus. Etiam quis lorem ut felis condimentum fringilla. Proin in pharetra nunc. Suspendisse potenti. Nunc tristique magna nisl, nec scelerisque mauris dapibus interdum. </p><p>Check back regularly for more posts.</p>", 'lmw'); ?>
			<ul>
				<?php
				while ($bazza_blogs->have_posts()) : $bazza_blogs->the_post(); ?>
				<li class="entypo pencil">
					<a href="<?php echo get_permalink( get_the_ID() ); ?>"><?php the_title(); ?></a><div class="text-right"><span class="entypo comment"></span><span class="comment_no"> <a href="<?php echo get_permalink( get_the_ID() ); ?>#comments"><?php comments_number('0', '1', '%'); ?></a></span></div>
				</li>
				<?php endwhile;
				echo "</ul>";?>
				<?php wp_reset_postdata(); ?>

			</div>
			<div class="row">
				<div id="leader_tips" class="span4">
					<?php
			//Get Top tips
					$tip_args = array(
						'post_type'	=> 'lmw_resource',	
						'resource-cats' => 'top-tips',
			// 'resource-types' => 'vid',
						'suppress_filters' => true,	
						'orderby' => 'date',
						'order' => 'DESC',
						);
					$toptips = new WP_Query($tip_args);
					if ($toptips) {
						?>
						<h4 class="entypo thumbs-up">Leadership Top Tip</h4>
						<?php 			
						$first_tip = true;
						$acc = 1;
						while ($toptips->have_posts()) : $toptips->the_post(); ?>
						<?php
						if ($first_tip) { 
							echo "<h5>";
							the_title( );
							echo "</h5>";
							the_content( );
							$first_tip = false;
							if (($toptips->post_count) > 1) { ?>
								<h5>Previous Tips</h5>
								<div class="accordion" id="accordion2">
									<div class="accordion-group">		
					<?php	}
									}
									else { ?>
									<div class="accordion-heading">
										<a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="#collapse<?php echo $acc; ?>">
											<?php the_title( ); ?>
										</a>
									</div>
									<div id="collapse<?php echo $acc; ?>" class="accordion-body collapse">
										<div class="accordion-inner">
											<?php the_content( ); ?>
										</div>
									</div>
									<?php	$acc ++;		}
									endwhile; ?>
								</div>
							</div>
							<?php
						}		?>
						<?php wp_reset_postdata(); ?>
					</div>

					<div id="leader_tips" class="span4">
						<?php
			//Get Top tips
						$pod_args = array(
							'post_type'	=> 'lmw_resource',	
							'resource-cats' => 'the-hub',
							'resource-types' => 'podcast',
			// 'suppress_filters' => true,	
							'orderby' => 'date',
							'order' => 'DESC',
							);
						$podcasts = new WP_Query($pod_args);
						if ($podcasts) {
							?>
							<h4 class="entypo microphone">Latest Leadership Podcast</h4>
							<?php 			
							$first_tip = true;
							while ($podcasts->have_posts()) : $podcasts->the_post(); ?>
							<?php 
							if ($first_tip) { 
								echo "<h5>";
								the_title( );
								echo "</h5>";
								the_content();
								$first_tip = false;
								if (($podcasts->post_count) > 1) {
									echo "<h5>Previous Podcasts</h5>";
									echo "<ul class='prev_posts'>";
					# code...
								}

							}
							else {
								echo "<li>";
								the_title( );
								echo "</li>";
							}

							endwhile;
							echo "</ul>";
						}		?>
						<?php wp_reset_postdata(); ?>


					</div>
				</div>
				<div class="row">
					<div class="span8">
						<h2 class="entypo play">Featured Videos</h2>
						<?php echo do_shortcode( '[listvideos categories="the-hub"]' ); ?>
					</div>
				</div>
			</div>	
			<div class="span3 offset1">   
				<?php 

				$instance = array();
				$instance['title'] = 'Latest Tweets';	
				$instance['profile_img'] = 'true';
				$instance['pre_text'] = 'Join the Twitter Conversation';		
		// $instance['profile_id'] = 'lmwarc';
				$instance['hashtag'] = 'LMWhub';
				$instance['count'] = '5';
		// $instance['post_text'] = 'more text in here?';	


				the_widget( 'CU_Twidget', $instance, $args ); ?>   

			</div>
		</div>
	</div>
	<?php get_footer(); ?>