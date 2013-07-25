<?php get_header(); ?>
	
	<!-- MAIN BODY --->	
		<div class="row-fluid">
			<!-- LEFT COLUMN --->	
			<div class="span2 left_column">
			
				<div id="breadcrumbs">
				<?php 
				//~ get_post_ancestors( $post->ID )    
					$ancestor_id_list = get_post_ancestors( $post->ID );
					$n_ancestor = sizeof( $ancestor_id_list);
					for ($i=1; $i<=$n_ancestor; $i++) {
						$j = $n_ancestor - $i;
						echo get_the_title($ancestor_id_list[$j]);
						echo " > ";
					}
					the_title();
					?> 
				</div> 
					
					<?php 
						$load_2nd_ancestor = ($n_ancestor >= 2); 

					?>
					
					<h3 id="left_column_title"><?php if($load_2nd_ancestor) echo (get_the_title($ancestor_id_list[$n_ancestor- 2])); else the_title() ?></h3>
					<ul>  
					<?php
					  //~ wp_list_pages("title_li=&child_of=$id&show_date=modified&date_format=$date_format"); 
					  
					if ($load_2nd_ancestor ) {
						wp_list_pages("title_li=&depth=2&child_of=".$ancestor_id_list[$n_ancestor- 2]); 
					
					}
					else {
						
						wp_list_pages("title_li=&depth=2&child_of=".$post->ID); 
				
					}
						?>
						
			</div>
			<!-- END LEFT COLUMN --->
			
			<!-- MIDDLE COLUMN --->
			<div class="span6" id="post_body">
				<?php if (have_posts()) : ?>
					<h4><?php printf( __( 'Search Results for: %s' ), '<span>"' . get_search_query() . '"</span>' ); ?></h4>
         
			<?php while (have_posts()) : the_post(); ?>
				<div class="row-fluid">
						<?php if ( has_post_thumbnail()) : ?> <a href=" <?php the_permalink(); ?> " title=" <?php the_title_attribute(); ?>" > <?php the_post_thumbnail('thumbnail', array('class' => 'span4 featued_image_1col')); ?> </a>
<?php else: ?> <img src="http://clubworld360.com/data/venues/1775/full_noImage%20-%20Copy%20(2)%20-%20Copy.jpg" class="span4 featued_image_1col wp-post-image" /> <?php endif; ?>
						
						<div class="span8">
						<h5><a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title(); ?>"><?php the_title(); ?></a></h5>
							<span id="post_info">POSTED <?php the_time('F j, Y') ?> | <?php the_category(', ') ?> <?php edit_post_link('Edit', ' | ', '  '); ?></span>
							<p> <?php the_excerpt(); ?> </p>
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
    <h3 class="center">No posts found. Try a different search?</h3>
    <p>&nbsp;</p><center><?php include (TEMPLATEPATH . '/searchform.php'); ?></center>
<?php endif; ?>

				
			</div>
			
			<!-- END MIDDLE COLUMN --->
			
			<!-- RIGHT COLUMN --->
	<?php get_sidebar('one'); ?>
			<!-- END RIGHT COLUMN --->
			
		</div>
	<!-- END MAIN BODY --->

			
<?php get_footer(); ?>
