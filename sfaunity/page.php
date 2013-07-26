<?php get_header(); ?>
	<?php if (have_posts()) : while (have_posts()) : the_post();?>
	
	<!-- MAIN BODY --->	
		<div class="row-fluid">
			<!-- LEFT COLUMN --->	
			<div class="span2 left_column">
			
				<div id="breadcrumbs">
				Back to Music Programs
				</div> 
					
					<?php 
						$load_2nd_ancestor = ($n_ancestor >= 2); 

					?>
					
					<h3 id="left_column_title"><?php if($load_2nd_ancestor) echo (get_the_title($ancestor_id_list[$n_ancestor- 2])); else the_title() ?></h3>
					<ul>  
					<?php
					  //~ wp_list_pages("title_li=&child_of=$id&show_date=modified&date_format=$date_format"); 
					  
					if ($load_2nd_ancestor ) {
						wp_list_pages("title_li=&depth=2&child_of=".$ancestor_id_list[$n_ancestor- 2]); 
					
					}
					else {
						
						wp_list_pages("title_li=&depth=2&child_of=".$post->ID); 
				
					}
						?>
						
			</div>
			<!-- END LEFT COLUMN --->
			
			<!-- MIDDLE COLUMN --->
			<div class="span6" id="post_body">
				<h2 id="page_title"><?php the_title() ?></h2>
				<?php the_content(); ?>
				
			</div>
			
			<!-- END MIDDLE COLUMN --->
			
			<!-- RIGHT COLUMN --->
			<div id="right_column">
				<?php 
					if ( has_post_thumbnail() ) // check if the post has a Post Thumbnail assigned to it.
					{ 
					the_post_thumbnail( 'featured_image_right_column' );
					?>
					
					<p class="featured_image_caption"><strong>ABOVE: </strong><?php the_post_thumbnail_caption(); 
					} 
					?>
				</p>

				<?php get_sidebar('one'); ?>
			</div>
			<!-- END RIGHT COLUMN --->
			
		</div>
	<!-- END MAIN BODY --->

			<?php endwhile; endif; ?>
<?php get_footer(); ?>
