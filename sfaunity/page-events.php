<?php get_header(); ?>
	<?php if (have_posts()) : while (have_posts()) : the_post();?>
	

	<!-- MAIN BODY --->	
		<div class="row-fluid">
		
			<!-- LEFT COLUMN, STATIC TITLE, LINKS TO EVENT PAGES --->	
			<div id="left_column" class="span2">
				<p id="breadcrumbs">
				COMMUNITY > EVENTS
				</p>
					<h3 id="left_column_title">Events</h3>
					<div id="left_navigation">
						<ul>
							<a href="<?php echo (get_permalink( $post->ID ).'&t=d') ?>"><li>DAILY EVENTS</li></a>
							<a href="<?php echo (get_permalink( $post->ID ).'&t=w') ?>"><li>WEEKLY EVENTS</li></a>
							<a href="<?php echo (get_permalink( $post->ID ).'&t=m') ?>"><li>MONTHLY EVENTS</li></a>
							<?php // (this should work, double check) wp_list_categories('style=none&child_of='.$parent_cat_id);  ?>
						</ul>
					</div>
			</div>
			
			
			<!-- MIDDLE COLUMN, ONE WEEK EVENTS LISTING --->
			
			<div class="span8" id="post_body">
				<div class="flush">
				
					<?php require('cal.php'); 	?>
					
				</div>  <!-- end flush --->
			</div>	<!-- end MIDDLE COLUMN --->
			
			
			<!-- RIGHT COLUMN, LEAVE BLANK LIKE THIS --->

			<!-- end RIGHT COLUMN --->
			
		</div>
	<!-- end MAIN BODY --->


			<?php endwhile; endif; ?>
<?php get_footer(); ?>
