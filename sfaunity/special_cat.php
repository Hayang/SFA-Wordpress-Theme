<?php
/*
Template Name: Category Page Template
*/
?>
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
						$children = get_children('orderby=menu_order&post_type=page&order=ASC&post_parent='.$ancestor_id_list[$n_ancestor- $k]);
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
						<?php $n_ancestor = sizeof( $ancestor_id_list); ?>
						<h3 id="left_column_title">
						<a href=" <?php echo get_permalink($ancestor_id_list[$n_ancestor - 1]) ?> " >
						<?php echo get_the_title($ancestor_id_list[$n_ancestor - 1]); ?>
						</a> </h3>
						
						<div id="left_navigation">
							<?php 
								print_all_children($ancestor_id_list,1);						
							?>
						</div>
			</div>
			<!-- end LEFT COLUMN --->
			
			<!-- MIDDLE COLUMN --->

			
			<div class="span6" id="post_body">
			<div class="flush">
		
				<h3 id="page_blacktitle"><?php the_title() ?><?php edit_post_link(' &#9997<span class="post-edit-text"> Click to edit this page</span>','',' '); ?></h3>
				
				<?php the_content(); ?>
				
				<?php $postCount = 0;
					$cat_title = get_the_title();
				if( is_term( $cat_title , 'category' ) ) {
						$my_query = new WP_Query( 'category_name='.strtolower($cat_title));
						if ( $my_query->have_posts() ) { 
							while ( $my_query->have_posts() ) { 
							   $my_query->the_post(); $postCount += 1; ?>
				
								<?php if ($postCount <= 1) { ?> <!-- if first post -->
								<div class="row-fluid listing_row"> 
									<a href="<?php the_permalink(); ?>">
										<div class="featured_image">
											<?php 
												if ( has_post_thumbnail() ) { // check if the post has a Post Thumbnail assigned to it.
												the_post_thumbnail( 'listing_featured_image' );
											}
											?>
										</div>
										<h3 class="post_listing_title"><?php the_title();?></h3>
									</a>
									<h6 class="post_meta">POSTED <?php the_date();?>&nbsp;&nbsp;|&nbsp;&nbsp;<?php the_category(', '); ?></h6>
									<?php the_excerpt(); ?>
								</div>
								
								<?php } else { ?> <!-- if it's a post after first post -->
							   
								<?php
								if ( ($postCount > 1) && ($postCount % 2 == 0) ) { ?> 
								<!-- if the post is the first of two in a row, start a new row -->
								<div class="row-fluid listing_row"> 
								<?php } ?>
								
							   	<div class="span6" >
									<a href="<?php the_permalink(); ?>">
										<div class="sub_featured_image">
											<?php 
											if ( has_post_thumbnail() ) { // check if the post has a Post Thumbnail assigned to it.
											the_post_thumbnail( 'listing_small_featured_image' );
											}
											?>
										</div>
										<h4 class="post_listing_title"><?php the_title();?> </h4>
									</a>
									<h6 class="post_meta"><?php the_date();?>&nbsp;&nbsp;|&nbsp;&nbsp;<?php the_category(', '); ?></h6>
									<?php the_excerpt(); ?>
								</div>
									
								<?php
								if ( ($postCount > 1) && ($postCount % 2 == 1) ) { ?>
								</div> 
								<?php } 
								}
								
				
							}
					
						}?>
				
				<?php
				if ( ($postCount > 1) && ($postCount % 2 == 0) ) { ?>
				</div> 
				<?php } ?>
							
				<?php
				wp_reset_postdata();
				
			} ?>
				 
			</div><!-- end flush -->
			</div><!-- end MIDDLE COLUMN --->
				
			<!-- RIGHT COLUMN --->
			<div id="right_column" class=".hidden-phone">
				<?php get_sidebar('page'); ?>
			</div>
			<!-- end RIGHT COLUMN --->
			
		</div>
	<!-- end MAIN BODY --->

			<?php endwhile; endif; ?>
<?php get_footer(); ?>
