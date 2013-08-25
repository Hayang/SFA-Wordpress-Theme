<?php
/*
Template Name: Faculty and/or Staff List
*/
?>

<?php get_header(); ?>

	<!-- MAIN BODY --->	
	<div class="row-fluid">
		
		<!-- LEFT COLUMN --->	
			<div id="left_column" class="span2">
			
			<p id="breadcrumbs">
				Directory
			</p>
			
			<h3 id="left_column_title">	
				Faculty<br />
				and Staff
			</h3>
			
			<div id="left_navigation">
				<ul>
				<?php
					$taxonomy_name = 'areafield_selection';
					$term = $wp_query->get_queried_object();
					//~ print_r($term);
					//~ $term_id = $term->term_id;
					$term_slug = $term->slug;
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
					$taxonomy = 'areafield_selection';

					$children = get_terms( 'areafield_selection', $args_children);
					if($children) {
						echo wp_list_categories($args_cats);
					} else {
						$args = array(
							'post_type' => 'areafield_selection',
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
				?>
				</ul>
			</div>
				
			</div>
			<!-- END LEFT COLUMN --->	
			
			<!-- MIDDLE COLUMN --->
				<?php if (is_tax()) // If this is a taxonomy page (if it is a Faculty Area/Field Category), give the name of the category.
				{ ?>
				<div class="span8" id="post_body">
					<h2 id="page_title">
						<?php echo($wp_query->queried_object->name); ?><?php edit_post_link(' &#9997<span class="post-edit-text"> Click to edit this page</span>'); ?>
					</h2>
				<?php
				} 
				else { // If this is just a normal page using the "Faculty and/or Staff List" Template, give the title.
				if (have_posts()) : while (have_posts()) : the_post();?>
				<div class="span6" id="post_body">
					<h2 id="page_title">
						<?php the_title(); ?><?php edit_post_link(' &#9997<span class="post-edit-text"> Click to edit this page</span>','',' '); ?>
					</h2>
				<?php endwhile; endif; ?>	
				<?php } ?>
				
				<?php the_content(); ?>
				
				<!-- START SUB CATEGORIES --->
				<?php 
				if (is_tax()) { // If this is a taxonomy page, start printing the posts.
				$posts = query_posts($query_string . '&posts_per_page=-1&orderby=title&order=asc');
				$postCount = 0; 
				if (have_posts()) : while (have_posts()) : the_post(); $postCount += 1;?>

					<?php if ( $postCount % 2 == 1 ) { ?>
						<div class="row-fluid"> 
					<?php } ?>
					
					<?php $custom_fields = get_post_custom(); ?>
					
					<ul class="fac_list span6 row-fluid">
						<div class="span8">
							<li class="fac_list_title">
								<h3><a href="<?php echo the_permalink(); ?>"><?php echo($custom_fields[fac_last_name][0]. ', ' . $custom_fields[fac_first_name][0]); ?></a></h3>
							</li>
							<li class="fac_list_small"><strong><?php echo $custom_fields[job_title][0];  ?></strong></li>
							<li class="fac_list_small"><?php echo $custom_fields[fac_email][0]; ?></li>
							<li class="fac_list_small"><?php echo $custom_fields[fac_phone_number][0]; ?></li>
						</div>
						<div class="span4">
							<?php
								// Must be inside a loop.

								if ( has_post_thumbnail() ) {
									the_post_thumbnail( array(100,100) );
								}
								else {
									echo '<img width="100" height="100" src="' . get_bloginfo( 'stylesheet_directory' ) . '/img/assets/noimage.png" />';
								}
							?>
						</div>
					</ul>
					
					<?php if ( $postCount % 2 == 0 ) { ?>
						</div>
					<?php } ?>
				
				<?php endwhile; endif; ?>	
				
				<?php if ( $postCount % 2 == 1 ) { ?>
				</div> 
				<?php }
				} ?>
			
			<!-- END SUB CATEGORIES --->
			</div> <!-- end MIDDLE COLUMN --->
			
	</div> <!-- end MAIN BODY --->
<?php get_footer(); ?>
