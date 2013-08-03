<?php
/*
Template Name: Search Page
*/
?>

<?php get_header(); ?>
	<?php if (have_posts()) : while (have_posts()) : the_post();?>
	
	<!-- MAIN BODY --->	
		<div class="row-fluid">
			<!-- LEFT COLUMN --->	
			<div id="left_column" class="span2">
				<p id="breadcrumbs">Home > Information > Search</p>
				<h3 id="left_column_title">Search</h3>
			</div>
			<!-- END LEFT COLUMN --->
			
			<!-- MIDDLE COLUMN --->
			<div class="span6" id="post_body">
			<h3 id="post_title">Search within the the <?php echo bloginfo('name'); ?> website</h3>
			<?php get_search_form(); ?>
				
			</div>
			
			<!-- END MIDDLE COLUMN --->
			
			<!-- RIGHT COLUMN --->
			<div id="right_column" class=".hidden-phone">
				<div id="right_column_push">
				<?php get_sidebar('post'); ?>
				</div>
			</div>
			<!-- END RIGHT COLUMN --->
			
		</div>
	<!-- END MAIN BODY --->

			<?php endwhile; endif; ?>
<?php get_footer(); ?>