<?php get_header(); ?>
	
	<!-- MAIN BODY --->	
		<div class="row-fluid grid_aligned">
			<!-- LEFT COLUMN --->	
			<div id="left_column" class="span2">
			
				<p id="breadcrumbs">
					Information > Search
				</p> 
				<h3 id="left_column_title">Search</h3>
			</div>
			<!-- end LEFT COLUMN --->
			
			<!-- MIDDLE COLUMN --->
			<div class="span6" id="post_body">
			<div class="flush">
				
				<?php if (have_posts()) : ?>
				<h3 id="page_blacktitle"><?php printf( __( 'Search Results for: %s' ), '<span><strong>"' . get_search_query() . '"</strong></span>' ); ?></h3>
				<?php get_search_form(); ?>
				<?php while (have_posts()) : the_post(); ?>
				<div class="row-fluid search_listing listing_row">
						<?php if ( has_post_thumbnail()) : ?> <a href=" <?php the_permalink(); ?> " title=" <?php the_title_attribute(); ?>" > <?php the_post_thumbnail('listing_search_featured_image', array('class' => 'span4')); ?> </a>
						<?php else: ?> <img src="<?php bloginfo('template_directory');?>/img/assets/noimage.png" height="160" class="span4 noimage_search wp-post-image" /> <?php endif; ?>
						
						<div class="span8">
						<h3><a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title(); ?>"><?php the_title(); ?></a></h3>
							<h6 class="post_meta"><?php echo get_post_type() ?> CREATED ON <?php the_time('F j, Y') ?> | <?php the_category(', ') ?><?php edit_post_link(' &#9997<span class="post-edit-text"> Click to edit this entry</span>','',' '); ?></h6>
							<?php the_excerpt(); ?>
						</div>
				</div>
				<?php endwhile; ?>
			
				<?php
				global $wp_query;

				$big = 999999999; // need an unlikely integer

				echo paginate_links( array(
					'base' => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
					'format' => '?paged=%#%',
					'current' => max( 1, get_query_var('paged') ),
					'total' => $wp_query->max_num_pages
				) );
				?>

				<?php else : ?>
					<h3 id="page_blacktitle">No pages found for <strong>"<?php echo get_search_query(); ?>"</strong>. Try a different search?</h3>
					<?php include (TEMPLATEPATH . '/searchform.php'); ?>
				<?php endif; ?>
				
			</div>
			</div> <!-- end MIDDLE COLUMN --->
			
			<!-- RIGHT COLUMN --->
			<div id="right_column">
				<?php get_sidebar('page'); ?>
			</div> <!-- end RIGHT COLUMN --->
		
		</div>
	<!-- end MAIN BODY --->

			
<?php get_footer(); ?>
