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
				<div id="breadcrumbs">
				<p id="breadcrumbs">
					COMMUNITY > NEWS
				</p>
				</div>
					<h3 id="left_column_title">NEWS</h3>
					<ul>
					<?php wp_list_categories('style=none&child_of='.$parent_cat_id);  ?>
					</ul>
			</div>
			<!-- END LEFT COLUMN --->	
			<!-- MIDDLE COLUMN --->
			<div class="span6" id="post_body">
	<?php 
		//query_posts( );
		$n_posts_per_page = 9; 
		query_posts($query_string . 'posts_per_page='.$n_posts_per_page ); 
		$postCount = 0; 
	?>
			<h6><?php  single_cat_title(); ?></h6>
			
			<?php if (have_posts()) : while (have_posts()) : the_post(); $postCount += 1;?>
			<?php if ($postCount <= 1) { ?>
			<?php the_title();?>
			<div id="featured_image">
			<?php 
				if ( has_post_thumbnail() ) { // check if the post has a Post Thumbnail assigned to it.
				the_post_thumbnail(array(700,250), array('class' => "category-featured-image"));
			}
			?>
			</div>
			<h4><?php the_title();?></h4> 
			<span id="post_info"> POSTED <?php the_date(); the_category(); ?> </span>

			<p><?php the_content(); ?></p>
	
	
			<?php } else {
			if ($postCount <= 2) { ?>
			<div class="row-fluid">
			<?php } ?>

				
			<div class="span6" >
			<div id="sub_featured_image">
			<?php 
			if ( has_post_thumbnail() ) { // check if the post has a Post Thumbnail assigned to it.
			the_post_thumbnail(array(300,150), array('class' => "category-featured-image"));
			}
			?>
			</div>
			<h5><?php the_title();?> </h5>
			<span id="post_info">POSTED <?php the_date(); the_category(); ?> </span>
			<p><?php the_content(); ?></p>
			</div>
		
		
		

		
			<?php }	?>
			<?php endwhile; endif; ?>
			<?php if ($postCount >= 2) { ?>
			</div>
			<?php }	?>
<!--
		<div id="featured_image"><img src="http://placehold.it/700x250"></img></div>
		<h4>THE UCONN DRAMATIC ARTS DEPARTMENT HAS DEVELOPED ONE OF THE FINEST UNIVERSITY-BASED ACTOR-TRANING PROGRAMS IN THE COUNTRY.</h4> 
		<span id="post_info">POSTED JULY 14, 2013 | FACULTY</span>

		<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse sagittis eget nisi nec dignissim. Aliquam tempor hendrerit tortor. Nunc sed lacus ut ligula bibendum fermentum eu sit amet nunc. Maecenas nec fermentum mi.</p>
-->
				
				<!-- START SUB CATEGORIES --->
				<div class="row-fluid">
				
					<div class="span6" >
					<div id="sub_featured_image"><img src="http://placehold.it/300x150"></img></div>
					<h5>Title 1</h5>
					<span id="post_info">POSTED JULY 14, 2013 | FACULTY</span>
					<p>Sed nec luctus metus. Aliquam sit amet tellus id dolor bibendum tempor eget at nunc. Vestibulum bibendum quam cursus arcu laoreet iaculis. Cum sociis natoque penatibus et magnis dis parturient montes.</p>
					</div>
					
					<div class="span6" >
					<div id="sub_featured_image"><img src="http://placehold.it/300x150"></img></div>
					<h5>Title 2</h5>
					<span id="post_info">POSTED JULY 14, 2013 | FACULTY</span>
					<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed vitae mauris nulla. Nunc tempor sagittis nulla et scelerisque.</p>
					</div>
					
				</div>
			<!-- END SUB CATEGORIES --->
			</div>
			<!-- END MIDDLE COLUMN --->
			
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
			
		</div>
	<!-- END MAIN BODY --->

<?php get_footer(); ?>
