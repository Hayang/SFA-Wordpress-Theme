<?php get_header(); ?>
		
		<!-- HERO UNIT --->

		<div id="top_header slider_main" class="row-fluid" >
			<div class="span12" id="">
				<?php echo get_new_royalslider(1); ?>
			</div> 
		</div> 
		<!-- HERO UNIT --->

		<!-- THREE CONTENT UNIT --->
		
		<div class="row-fluid">
			<div class="box_content">
			
				<div class="span4 tri_box">
					<div class="box_headers" >
						<h3><a href="#" >What's On</a></h3>
					</div>
					<div class="box_contents"> 
						<?php query_posts('category_name=whatson&posts_per_page=2'); ?>
						<?php while (have_posts()) : the_post(); ?>
						<div class="tri_box_single left_box"><a href="<?php the_permalink(); ?>">
							<?php $excerpt = get_the_title();
							echo string_limit_words($excerpt, 15);
							?><br /></a>
						<a class="box_readmore" href="<?php the_permalink(); ?>"><p>Read More ›</p></a>
						</div>
						<?php endwhile;?>
					</div>
				</div>
				
				<div class="span4 tri_box">
					<div class="box_headers" >
						<h3><a href="#" >Featured</a></h3>
						
					</div>
					<!-- ACTUAL CODE -->
					<div class="box_contents"> 
						<?php query_posts('category_name=Featured&posts_per_page=2'); ?>
						<?php while (have_posts()) : the_post(); ?>
						<div class="tri_box_single middle_box"><a href="<?php the_permalink(); ?>">
							<?php $excerpt = get_the_title();
							echo string_limit_words($excerpt, 15);
							?><br /></a>
						<a class="box_readmore" href="<?php the_permalink(); ?>"><p>Read More ›</p></a>
						</div>
						<?php endwhile;?>
					</div>
				</div>
				
			
				<div class="span4 tri_box">
					<div class="box_headers" >
						<h3><a href="#" >News</a></h3>
					</div>
					<div class="box_contents"> 
						<?php query_posts('category_name=News&posts_per_page=2'); ?>
						<?php while (have_posts()) : the_post(); ?>
						<div class="tri_box_single right_box"><a href="<?php the_permalink(); ?>">
							<?php $excerpt = get_the_title();
							echo string_limit_words($excerpt, 15);
							?><br /></a>
						<a class="box_readmore" href="<?php the_permalink(); ?>"><p>Read More ›</p></a>
						</div>
						<?php endwhile;?>
					</div>
				</div>
				
			</div>
		</div> 
		<!-- END THREE CONTENT UNIT --->
  
<?php get_footer(); ?>
