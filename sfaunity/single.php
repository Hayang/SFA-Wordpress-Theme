<?php get_header(); ?>
	<?php if (have_posts()) : while (have_posts()) : the_post();?>
	<?php 
		$this_post_id = get_the_ID();
		$category = get_the_category(); 
		$parent_cat_id = $category[0]->parent;
		$has_parents = ($parent_cat_id != 0) ;
		if ($has_parents) {
			$category_parent  = get_category($parent_cat_id ,false);
		} 
		else {
			$category_parent = $category[0];
			$parent_cat_id = $category[0]->term_id ;
		}
		
		?>
		
		<!-- MAIN BODY --->	
		<div class="row-fluid">
		
			<!-- LEFT COLUMN --->	
			<div id="left_column" class="span2">
				<p id="breadcrumbs">
					COMMUNITY > NEWS
				</p>
					<h3 id="left_column_title"><a href="<?php echo get_category_link( $parent_cat_id ); ?> " ><?php echo $category_parent->name ?></a></h3>
					<ul>
					<?php

					wp_list_categories('style=none&child_of='.$parent_cat_id); 
					?>
					
			</div> <!-- end LEFT COLUMN --->	
			
			<!-- MIDDLE COLUMN --->
			<div id="post_body" class="span6">
					<h3 id="post_title"><?php the_title();?><?php edit_post_link(' &#9997<span class="post-edit-text"> Click to edit this post</span>','',' '); ?></h3>
					<h6 class="post_meta">POSTED <?php the_date(); ?>&nbsp;&nbsp;|&nbsp;&nbsp;
					
					<?php
					$igc=0;
					foreach((get_the_category()) as $category) {
						if ($category->cat_name != 'uncategorized') {
					if($igc != 0) { echo ', '; }; $igc++;
						echo '<a href="' . get_category_link( $category->term_id ) . '" title="' . sprintf( __( "View all posts in %s" ), $category->name ) . '" ' . '>' . $category->name.'</a>';
					}
					}
					?></h6>
					
					<p><?php the_content();?></p>
					
			</div> <!-- end MIDDLE COLUMN --->
			
			<!-- RIGHT COLUMN --->
			<div id="right_column">
				<?php 
					if ( has_post_thumbnail() ) // check if the post has a Post Thumbnail assigned to it.
					{ 
					the_post_thumbnail( 'featured_image_right_column' );
					?>
					
					<p class="featured_image_caption"><?php the_post_thumbnail_caption(); 
					} 
					?>
				</p>

				<?php get_sidebar('post'); ?>
			</div> <!-- end RIGHT COLUMN --->
			
		</div> <!-- end MAIN BODY --->	

<?php endwhile; endif; ?>	
<?php get_footer(); ?>
