<?php
/*
Template Name: Faculties
*/
?>
<?php get_header(); ?>
	
	<!-- MAIN BODY --->	
		<div class="row-fluid">
			<!-- LEFT COLUMN --->	
			<div id="left_column" class="span2">
			
				<p id="breadcrumbs">
				<?php 
				//~ get_post_ancestors( $post->ID )    
					$ancestor_id_list = get_post_ancestors( $post->ID );
					$n_ancestor = sizeof( $ancestor_id_list);
					if ($n_ancestor <= 0 ) {?>
						<a href=" <?php the_permalink(); ?> " >
						<?php the_title(); ?>
						</a> 
						
					<?php }
					elseif ($n_ancestor == 1 ) {?>
						<a href=" <?php echo get_permalink($ancestor_id_list[$n_ancestor-1]) ?> " >
						<?php echo get_the_title($ancestor_id_list[$n_ancestor-1]); ?>
						</a> > 
						<a href=" <?php the_permalink(); ?> " >
						<?php the_title(); ?>
						</a> 
						<?php 
					}
					else { ?>
						<a href=" <?php echo get_permalink($ancestor_id_list[$n_ancestor-1]) ?> " >
						<?php echo get_the_title($ancestor_id_list[$n_ancestor-1]); ?>
						</a> > 
						<a href=" <?php echo get_permalink($ancestor_id_list[$n_ancestor - 2]) ?> " >
						<?php echo get_the_title($ancestor_id_list[$n_ancestor - 2]); ?>
						</a> 
						<?php } 
						?>
				
				</p> 
				<?php 
					// Adding the current post ID to the array of its ancestor ID's
					$ancestor_id_list = array_merge((array)array($post->ID), (array) $ancestor_id_list);
					function print_page_link($kid,$k)
					{ 
						// This function is to print the <li> tag of the provide WP post object, classes will be printed as level $k
						?>
						<li class ="li_level<?php echo $k; ?>"><a href="<?php echo $kid->guid; ?>" > <?php echo $kid->post_title; ?></a></li>

					 <?php
					}
					function print_all_children($ancestor_id_list,$k)
					{	
						// local redefine the size of ancestor_id_list
						$n_ancestor = sizeof( $ancestor_id_list);
						// get the array of children WP post objects
						$children  = get_children('orderby=menu_order&post_parent='.$ancestor_id_list[$n_ancestor- $k]); 
						if ($children) {
							$k += 1; // don't ask..
							echo '<li ><ul class ="ul_level'. $k.'">';
							foreach ( $children as $kid ) { // for each WP post object
								print_page_link($kid,$k); // print <li> links
								// if the post id is next item in the ancestor_id_list, print the children of this post. Yep, it's recursive
								if ($kid->ID == $ancestor_id_list[$n_ancestor- $k] )  print_all_children($ancestor_id_list,$k);
							}	
							echo '</ul></li>';
						}
					}
				?>
					
						<h3 id="left_column_title">
						<a href=" <?php echo get_permalink($ancestor_id_list[$n_ancestor - 1]) ?> " >
						<?php echo get_the_title($ancestor_id_list[$n_ancestor - 1]); ?>
						</a> </h3>
						<h5><ul> 
						<?php 
							print_all_children($ancestor_id_list,1);						
						?> </ul></h5> 
			</div>
			<!-- end LEFT COLUMN --->
			
			<!-- MIDDLE COLUMN --->

			
			<h2>ACADEMIC</h2>
				<div class="row-fluid">
				  <div class="span6">
					<div class="row-fluid">
					  <div class="span6">
						  
<!--
						  <h5>DRAWING</h5>
-->
						<ul>
<?php 
				$custom_posts = new WP_Query('post_type=faculty');
				while ($custom_posts->have_posts()) : $custom_posts->the_post();
					$custom_fields = get_post_custom();
					$terms = get_the_terms($custom_posts->ID, areafield_selection);
					
					
				?>
					<div class=""> <h4>
						<a href="<?php the_permalink(); ?> " >  
							<li>
								<?php echo($custom_fields[fac_first_name][0]. ' ' . $custom_fields[fac_last_name][0]); ?> 
							</li> 
							<li>
								<?php echo $terms[29]->name; ?> 
							</li>
							<li>
								<?php echo $custom_fields[fac_email][0]; ?> 
							</li> 
							<li>
								<?php echo $custom_fields[fac_phone_number][0]; ?> 
							</li>
						</a> 
						<div class = "" > 
							<a href=" <?php echo $custom_fields[fac_website][0]; ?>" > 
								<?php echo $custom_fields[fac_website][0]; ?> 
							</a> 
						</div>
					</h4></div> <?php
				endwhile;
?>
					  </div></div>
				  </div>
				  </div>
			  </div>
			
			<!-- end MIDDLE COLUMN --->
			

			
			
			<!-- RIGHT COLUMN --->
			<div id="right_column" class=".hidden-phone">
				<?php 
					if ( has_post_thumbnail() ) // check if the post has a Post Thumbnail assigned to it.
					{ 
					the_post_thumbnail( 'featured_image_right_column' );
					?>
					
					<p class="featured_image_caption"><?php the_post_thumbnail_caption(); 
					} 
					?>
				</p>

				<?php get_sidebar('page'); ?>
			</div>
			<!-- end RIGHT COLUMN --->
			
		</div>
	<!-- end MAIN BODY --->

<?php get_footer(); ?>
