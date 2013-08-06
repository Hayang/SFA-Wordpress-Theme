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
				
				</p> 

					
						<h3 id="left_column_title">
						<a href=" <?php echo get_permalink($ancestor_id_list[$n_ancestor - 1]) ?> " >
						<?php echo get_the_title($ancestor_id_list[$n_ancestor - 1]); ?>
						</a> </h3>
						<ul>
						<?php 
						$kid_list = ''; $first_child = true;

						for ($k = 1; $k <= $n_ancestor; $k++) {
							$children  = get_children('post_parent='.$ancestor_id_list[$n_ancestor- $k]); 
							foreach ( $children as $kid ) { 
								if (!$first_child)  $kid_list = $kid_list . ',';
								$first_child = false;
								$kid_list = $kid_list . $kid->ID;
							}							
						}
							$children = get_children('post_parent='.$post->ID); 
							foreach ( $children as $kid ) { 
								if (!$first_child)  $kid_list = $kid_list . ',';
								$first_child = false;
								$kid_list = $kid_list . $kid->ID;
							}
							$dont_display_list = ($n_ancestor == 0) && empty($children);
						if ($dont_display_list == false) wp_list_pages("sort_column=menu_order&title_li=&include=".$kid_list);
						
						?></ul>
			</div>
			<!-- end LEFT COLUMN --->
			
			<!-- MIDDLE COLUMN --->

			
			<div class="span6" id="post_body">
				<h2 id="page_title"><?php the_title() ?><?php edit_post_link(' &#9997<span class="post-edit-text"> Click to edit this page</span>','',' '); ?></h2>
				<?php the_content(); ?>
				
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
