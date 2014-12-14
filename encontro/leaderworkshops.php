<?php

$leader_name = explode(' ',trim($post->post_title)); 
$leader_name = $leader_name[0];


					$ws_term = get_term_by( 'name', 'workshop', 'event-categories');
					$ws_term_id = $ws_term->term_id;
					$leader_id = $post->ID;
					// print_r($leader_id);
					$ws_args = array(
						'post_type' => 'event',
						'posts_per_page' => -1,
						'post_status' => 'publish',
						'tax_query' => array(
							array(
								'taxonomy' => 'event-categories',
								'field'    => 'slug',
								'terms'    => 'workshop',
							),
						),
						'meta_query' => array(
							array(
								'key' => 'event_leaders',
								'value'   => $leader_id,
								// 'type'    => 'NUMERIC',
								'compare' => 'LIKE',
							),
						),
					);

					// $all_workshops = em_get_events ($ws_args);
					$all_workshops = new WP_Query( $ws_args );
				// 	echo "<pre>";
				// print_r($all_workshops);
				// echo "</pre>";
					$leader_workshops = array();
					foreach ($all_workshops->posts as $workshop) {
						// $event_leaders = get_post_meta($workshop->ID, 'event_leaders', true);
						
						// print_r($workshop->ID);
						// print_r($event_leaders);
						array_push($leader_workshops, $workshop->ID);
						// em_event($workshop->ID);
					}
					// print_r($leader_workshops);
					if (!empty($leader_workshops)) {
						echo "<h4>All ".$leader_name."'s workshops</h4>";
					$ws_list = implode(',', $leader_workshops);
					$ws_args = array(
						'post_id' => $ws_list, 
						);
					echo do_shortcode( '[events_list post_id='.$ws_list.']
					<table>
					<tbody>
					<tr>
					<td width="150">#_EVENTDATES<br />
					#_EVENTTIMES</td>
					<td><strong>#_EVENTLINK</strong><br />
					#_EVENTEXCERPT{30,...}</td>
					</tr>
					</tbody>
					</table>
					[/events_list]' );
					// em_events( $ws_args);
					}		
					wp_reset_query();