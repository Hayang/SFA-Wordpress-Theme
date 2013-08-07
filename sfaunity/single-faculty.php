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
					FACULTY DIRECTORY
				</p>
					<h3 id="left_column_title">Directory</h3>
					<ul>

					
			</div> <!-- end LEFT COLUMN --->	
			
			<!-- MIDDLE COLUMN --->
			<?php
					$custom_fields = get_post_custom();
					$terms = get_the_terms($custom_posts->ID, areafield_selection);
			?>
			
			
			

							
			<div class="span6" id="post_body">
			
			<div class="row-fluid">
				<div id="bio_title" class="span6">
					<h2><?php echo($custom_fields[fac_first_name][0]. ' ' . $custom_fields[fac_last_name][0]); ?> <?php edit_post_link(' &#9997<span class="post-edit-text"> Edit</span>','',' '); ?></h2>
					<h3><?php echo $custom_fields[job_title][0]; ?></h3>
				</div>
			
				<div id="bio_info" class="span6">
					<ul>
						<li class="bio_phone"><strong>PHONE: </strong>
							<ul>
								<?php echo $custom_fields[fac_phone_number][0]; ?>
							</ul>
						</li>
						<li class="bio_email"><strong>EMAIL: </strong>
							<ul>
								<?php echo $custom_fields[fac_email][0]; ?>
							</ul>
						</li>
						<li class="bio_website"><strong>WEBSITE: </strong>
							<ul>
								<a href="<?php echo $custom_fields[fac_website][0]; ?>" >
								<?php echo $custom_fields[fac_website][0]; ?></a>
							</ul>
						</li>
					</ul>
				</div>	
			</div>
			
			<div class="row-fluid">	
				<p id="bio_content"><?php echo $custom_fields[fac_biography][0]; ?>
				</p>
			</div>
				
		
					
					
					
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
			</div> <!-- end RIGHT COLUMN --->
			
		</div> <!-- end MAIN BODY --->	

<?php endwhile; endif; ?>	
<?php get_footer(); ?>
