<?php get_header(); ?>
	<?php if (have_posts()) : while (have_posts()) : the_post();?>
	
	<!-- MAIN BODY --->	
		<div class="row-fluid">
			<!-- LEFT COLUMN --->	
			<div class="span2 left_column">
			
				<p id="breadcrumbs">
				Home > 404
				</p> 

					<h3 id="left_column_title">Whoops!</h3>

			</div>
			<!-- end LEFT COLUMN --->
			
			<!-- MIDDLE COLUMN --->
			<div class="span6" id="post_body">
				<h2 id="page_title">The page could not be found</h2>
				<p></p>
				
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
