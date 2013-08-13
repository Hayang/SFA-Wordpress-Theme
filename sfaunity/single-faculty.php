<?php get_header(); ?>
	<?php if (have_posts()) : while (have_posts()) : the_post();?>
	<?php 
		
		?>
		
		<!-- MAIN BODY --->	
		<div class="row-fluid">
		
			<!-- LEFT COLUMN --->	
			<div id="left_column" class="span2">
			
			<p id="breadcrumbs">
				Directory
			</p>
			
			<h3 id="left_column_title">	
					Faculty and Staff
			</h3>
			
			<div id="left_navigation">
			<ul>
			<?php
				$taxonomy_name = 'areafield_selection';
				$term = $wp_query->get_queried_object();
				//~ print_r($term);
				//~ $term_id = $term->term_id;
				//~ $term_slug = $term->slug;
				$args_cats = array(
					'taxonomy' => $taxonomy_name,
					'hierarchical' => true,
					//~ 'child_of' => $term_id,
					'depth' => '2',
					'hide_empty' => '0',
					'title_li' => '',
					'echo' => '0',
				);
				$args_children = array(
					'parent' => $term_id,
					'hide_empty' => false
				);
				$children = get_terms( 'areafield_selection', $args_children);
				if($children) {
					echo wp_list_categories($args_cats);
				} else {
					$args = array(
						'post_type' => 'lessons',
						'order' => 'ASC',
						'tax_query' => array (
							array (
								'taxonomy' => 'topic',
								'field' => 'slug',
								'terms' => $term_slug
							)
						)
					);
				}
				//~ $query = new WP_Query( $args );
				//~ if ( $query->have_posts() ) {
					//~ while ( $query->have_posts() ) {
					//~ $query->the_post();
					//~ the_title();
				//~ 
					//~ }
				//~ }

			?>
			</ul>
			</div>
				
			</div> <!-- end LEFT COLUMN --->	
			
			<!-- MIDDLE COLUMN --->
			<?php
				$custom_fields = get_post_custom();
				$terms = get_the_terms(get_the_ID(), 'areafield_selection');
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
			
			<?php the_content(); ?>
			
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
