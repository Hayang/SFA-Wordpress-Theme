<?php get_header(); ?>

	<?php 
		$category_name = single_cat_title('',FALSE);
		$category_id = get_cat_ID( $category_name );  
		$category = get_category($category_id ,false);
		$parent_cat_id = $category->parent;
		$has_parents = ($parent_cat_id != 0) ;
		if ($has_parents) {
			$category_parent  = get_category($parent_cat_id ,false);
		} 
		else {
			$category_parent = $category;
			$parent_cat_id = $category->term_id ;
		}
		?>
		
	<!-- MAIN BODY --->	
	<div class="row-fluid">
		
		<!-- LEFT COLUMN --->	
		<div id="left_column" class="span2">
			<p id="breadcrumbs">
			<?php echo get_category_parents($category, TRUE, ' > ', TRUE); ?>
			</p>
				<h3 id="left_column_title"><a href="<?php echo get_category_link( $parent_cat_id ); ?> " ><?php echo $category_parent->name ?></a></h3>
				<ul>
				<?php wp_list_categories('title_li=&child_of='.$parent_cat_id);  ?>
				</ul>
		</div> <!-- end LEFT COLUMN --->	
			
		<!-- MIDDLE COLUMN --->
		<div class="span6" id="post_body">
		<div class="flush">
		
			<?php 
				$paged = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;
				$postCount = 0; 
			?>
			<h3 id="page_blacktitle"><?php  single_cat_title(); ?></h3>
		
			<?php if (have_posts()) : while (have_posts()) : the_post(); $postCount += 1;?>
			
				
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
					if ( ($postCount > 1) && ($postCount % 2 == 0) ) { ?> <!-- if the post is the first of two in a row, start a new row -->
						<div class="row-fluid listing_row"> 
					<?php } ?>
					
						<div class="span6">
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
					<?php } ?>

				<?php } ?> <!-- end if it's a post after first post -->
					
				<?php endwhile; endif; ?> <!-- end output of posts -->
			
				<?php if ( ($postCount > 1) && ($postCount % 2 == 0) ) { ?>
				</div> 
				<?php }	?>	
		

		<?php
			next_posts_link( 'Older Entries' );
			previous_posts_link( 'Newer Entries' );
		?>

		</div><!-- end flush -->
		</div><!-- end MIDDLE COLUMN --->
		
			
		<!-- RIGHT COLUMN --->
		<div id="right_column">
			<div id="right_column_push">
			<?php get_sidebar('post'); ?>
			</div>
		</div> <!-- end RIGHT COLUMN --->
			
	</div> <!-- end MAIN BODY --->

<?php get_footer(); ?>
