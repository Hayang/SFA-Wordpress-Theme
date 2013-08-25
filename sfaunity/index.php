<?php get_header(); ?>
		
		<!-- HERO UNIT -->

		<div id="slider_main" class="top_header row-fluid" >
			<div class="span12" id="">
				<?php get_sidebar('slider'); ?>
			</div> 
		</div> 
		<!-- HERO UNIT -->

		<!-- THREE CONTENT UNIT -->
		
		<div class="row-fluid">
			<div class="box_content">
				<div id="whatson" class="span4 tri_box">
				<?php $calendar = get_theme_mod('calendar_setting'); ?>				
				<!-- ACTUAL CODE -->
					<div id="events_listing" >
					<?php require('index_mix_cal_no_ajax.php'); ?>
					</div>
				</div>
				
				<div class="span4 tri_box">
					<div class="box_headers" >
						<h3><a href="#" ><?php echo get_theme_mod('tri_middle_setting'); ?></a></h3>
						
					</div>
					<!-- ACTUAL CODE -->
					<div class="box_contents"> 
						<?php query_posts('category_name='. get_theme_mod('tri_middle_content') . '&posts_per_page=2'); ?>
						<?php while (have_posts()) : the_post(); ?>
						<div class="tri_box_single middle_box"><a href="<?php the_permalink(); ?>">
							<?php $excerpt = get_the_title();
							echo string_limit_words($excerpt, 15);
							?><br /></a>
							<div class="readmore_container">
								<a class="box_readmore" href="<?php the_permalink(); ?>"><p>Read More ›</p></a>
							</div>
						</div>
						<?php endwhile;?>
					</div>
				</div>
				
			
				<div class="span4 tri_box">
					<div class="box_headers" >
						<h3><a href="#" ><?php echo get_theme_mod('tri_right_setting'); ?></a></h3>
					</div>
					<div class="box_contents"> 
						<?php query_posts('category_name='. get_theme_mod('tri_right_content') . '&posts_per_page=2'); ?>
						<?php while (have_posts()) : the_post(); ?>
						<div class="tri_box_single right_box"><a href="<?php the_permalink(); ?>">
							<?php $excerpt = get_the_title();
							echo string_limit_words($excerpt, 15);
							?><br /></a>
							<div class="readmore_container">
								<a class="box_readmore" href="<?php the_permalink(); ?>"><p>Read More ›</p></a>
							</div>
						</div>
						<?php endwhile;?>
					</div>
				</div>
				
			</div>
		</div> 
		<!-- END THREE CONTENT UNIT --->
  
<?php get_footer(); ?>
