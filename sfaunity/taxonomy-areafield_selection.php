<?php
/*
Template Name: Faculty List
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
					Faculty and Staff
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
			<div class="span6" id="post_body">
			
			<?php if  ( (strtolower( get_the_title()) == 'faculties') ||( strtolower( get_the_title()) == 'faculty') )
				{ ?>
				<h2 id="page_title"><?php the_title(); ?></h2>
				<?php
				} else { ?>
				<h2 id="page_title"><?php echo($wp_query->queried_object->name); ?></h2>
				<?php } ?>
			
				<!-- START SUB CATEGORIES --->
				
				<?php if (have_posts()) : while (have_posts()) : the_post();	
				//~ the_title();
				if  ( (strtolower( get_the_title()) == 'faculties') ||( strtolower( get_the_title()) == 'faculty') )
				{ ?>
					<?php the_content(); ?>
					<?php
				} else { ?>
					
					<?php $custom_fields = get_post_custom(); ?>
					<ul>
						<li>
							<a href="<?php echo the_permalink(); ?>"><?php echo($custom_fields[fac_first_name][0]. ' ' . $custom_fields[fac_last_name][0]); ?></a>
						</li>
						<li><?php echo $custom_fields[job_title][0];  ?></li>
						<li><?php echo $custom_fields[fac_email][0]; ?></li>
						<li><?php echo $custom_fields[fac_phone_number][0]; ?></li>
					</ul>
				<?php } ?>
				

				
			<?php endwhile; endif; ?>	
			<!-- END SUB CATEGORIES --->
			</div>
			<!-- END MIDDLE COLUMN --->
			
			
		<!-- RIGHT COLUMN --->
		<div id="right_column">
			<div id="right_column_push">
			<?php get_sidebar('post'); ?>
			</div>
		</div> <!-- end RIGHT COLUMN --->
			
	</div> <!-- end MAIN BODY --->

<?php get_footer(); ?>
