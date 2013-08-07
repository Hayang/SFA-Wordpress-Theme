<?php get_header(); ?>
	<?php if (have_posts()) : while (have_posts()) : the_post();?>
	
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
				
				</p> <!-- end Breadcrumbs -->
				
				<?php 
					// Adding the current post ID to the array of its ancestor ID's
					$ancestor_id_list = array_merge((array)array($post->ID), (array) $ancestor_id_list);
					function print_page_link($kid,$k)
					{ 
						// This function is to print the <li> tag of the provide WP post object, classes will be printed as level $k
						?>
						<li class ="li_level<?php echo $k; ?>"><a href="<?php echo get_post_permalink($kid->ID); ?>" > <?php echo $kid->post_title; ?></a></li>

					 <?php
					}
					function print_all_children($ancestor_id_list,$k)
					{	
						// local redefine the size of ancestor_id_list
						$n_ancestor = sizeof( $ancestor_id_list);
						// get the array of children WP post objects
						$children = get_children('orderby=menu_order&order=ASC&post_parent='.$ancestor_id_list[$n_ancestor- $k]);
						if ($children) {
							$k += 1; // don't ask..
							echo '<ul class ="ul_level'. $k.'">';
							foreach ( $children as $kid ) { // for each WP post object
								print_page_link($kid,$k); // print <li> links
								// if the post id is next item in the ancestor_id_list, print the children of this post. Yep, it's recursive
								if ($kid->ID == $ancestor_id_list[$n_ancestor- $k] )  print_all_children($ancestor_id_list,$k);
							}	
							echo '</ul>';
						}
					}
				?>
					
						<h3 id="left_column_title">
						<a href=" <?php echo get_permalink($ancestor_id_list[$n_ancestor - 1]) ?> " >
						<?php echo get_the_title($ancestor_id_list[$n_ancestor - 1]); ?>
						</a> </h3>
						
						<?php 
							print_all_children($ancestor_id_list,1);						
						?>
			</div>
			<!-- end LEFT COLUMN --->
			
			<!-- MIDDLE COLUMN --->

			
			<div class="span6" id="post_body">
				<h2 id="bio_title">Richard Bass</h2>
				<ul id="bio_info">
					<li>Professor of Music</li>
					<li>(860)486-8197</li>
					<li>Richard.Bass@uconn.edu</li>
				</ul>
				<div id="bio_pic"><img src="http://placehold.it/290x320" id="bio_pic" /> <h2>Click here for artwork</h2>
				<p id="bio_content">Richard Bass is professor of music theory in the Department of 	Music. He holds degrees 
				in piano performance from Georgia State University and Northern Illinois University, and 
				a doctor of philosophy degree in music theory from the University of Texas at Austin. 
				He has also studied at the Aspen Music School and Indiana University and attended 
				Yale University as a visiting Faculty Fellow. Before joining the faculty at the University 
				of Connecticut in 1987, he held teaching appointments at institutions in Illinois, Texas
				</p>
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

			<?php endwhile; endif; ?>
<?php get_footer(); ?>
