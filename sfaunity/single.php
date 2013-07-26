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
			<div class="span2 left_column">
				<div id="breadcrumbs"> 
					COMMUNITY > NEWS
				</div>
<!--
				<div id="breadcrumbs">PROGRAMS > ACTING</div>
-->
					<h3 id="left_column_title"><a href="<?php echo get_category_link( $parent_cat_id ); ?> " ><?php echo $category_parent->name ?></a></h3>
					<ul>
					<?php

					wp_list_categories('style=none&child_of='.$parent_cat_id); 
					?>
<!--
					<ul>
						BFA ACTING
						<li>COURSE OF STUDY</li>
						<li>AUDITION</li>
						<li>ADVANCEMENT & TRANSFERRING</li>
						<li>FINANCIAL AID</li>
						<li>PERFORMANCE OPPORTUNITIES</li>
					</ul>
					<ul>
						MFA ACTING
						<li>COURSE OF STUDY</li>
						<li>APPLICATION & AUDITION</li>
						<li>FINANCIAL AID</li>
						<li>PERFORMANCE OPPORTUNITIES</li>
					</ul>
-->
			</div>
			<!-- END LEFT COLUMN --->	
			<!-- MIDDLE COLUMN --->
			<div class="span6" id="post_body">
					<h3 id="post_title"><?php the_title();?></h3>
					 POSTED <?php the_date(); the_category(); ?>
					<p><?php the_content();?></p>
					
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

				<?php get_sidebar('two'); ?>
			</div>
<!--
				<div class="right_column_boxes">
				<p>Jesse Rifkin Writes on "What Makes Gatsby Your Classic?"</p>
				</div>
				
				<div class="right_column_boxes"><p>CRT Production "Hairspray is a family-friendly musical. </p>
				</div>
-->
			</div>
			<!-- END RIGHT COLUMN --->
			
		</div>
	<!-- END MAIN BODY --->
<?php endwhile; endif; ?>	
<?php get_footer(); ?>
