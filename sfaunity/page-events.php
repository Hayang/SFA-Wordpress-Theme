<?php get_header(); ?>
	<?php if (have_posts()) : while (have_posts()) : the_post();?>
	

	<!-- MAIN BODY --->	
		<div class="row-fluid">
		
			<!-- LEFT COLUMN, STATIC TITLE, LINKS TO EVENT PAGES --->	
			<div class="span2 left_column">
				<div id="breadcrumbs">
				<p>COMMUNITY > EVENTS</p>
				</div>
					<h3 id="left_column_title">EVENTS</h3>
					<ul>
						<a href="<?php echo (get_permalink( $post->ID ).'&t=d') ?>"><li>DAILY EVENTS</li></a>
						<a href="<?php echo (get_permalink( $post->ID ).'&t=w') ?>"><li>WEEKLY EVENTS</li></a>
						<a href="<?php echo (get_permalink( $post->ID ).'&t=m') ?>"><li>MONTHLY EVENTS</li></a>
						<?php // (this should work, double check) wp_list_categories('style=none&child_of='.$parent_cat_id);  ?>
					</ul>
			</div>
			
			
			<!-- MIDDLE COLUMN, ONE WEEK EVENTS LISTING --->
			
			<div class="span8" id="post_body">
				
				<?php require( 'cal.php'); 	?>
			</div>	<!-- END MIDDLE COLUMN --->
			
			
			<!-- RIGHT COLUMN, LEAVE BLANK LIKE THIS --->
			<div class="span4" id="right_column_small">

			</div>
			<!-- END RIGHT COLUMN --->
			
		</div>
	<!-- END MAIN BODY --->


			<?php endwhile; endif; ?>
<?php get_footer(); ?>
