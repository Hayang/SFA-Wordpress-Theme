<?php get_header(); ?>
		
		<!-- HERO UNIT --->
		<div class="row-fluid" >
			<div class="hero-unit span12" id="slider_main">
				ROYAL SLIDER EMBED HERE
			</div> 
		</div> 
		<!-- HERO UNIT --->
		
		<!-- THREE CONTENT UNIT --->
		
		<div class="row-fluid">
			<div class="box_content">
			
				<div class="span4 tri_box">
					<div class="box_headers" >
						<h3><a href="#" >Featured</a></h3>
					</div>
					<div class="box_contents"> 
						<?php query_posts('category_name=Featured&posts_per_page=2'); ?>
						<?php while (have_posts()) : the_post(); ?>
						<div class="left_box"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
						<a class="box_readmore" href="<?php the_permalink(); ?>">Read More ›</a></div>
						<?php endwhile;?>
					</div>
				</div>
				
				<div class="span4 tri_box">
					<div class="box_headers" >
						<h3><a href="#" >Events</a></h3>
						
					</div>
					<div class="box_contents"> 
						<?php query_posts('category_name=Events&posts_per_page=2'); ?>
						<?php while (have_posts()) : the_post(); ?>
						<div class="middle_box"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
						<a class="box_readmore" href="<?php the_permalink(); ?>">Read More ›</a></div>
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
						<div class="right_box"><a href="<?php the_permalink(); ?>"><?php the_title(); ?><br /></a>
						<a class="box_readmore" href="<?php the_permalink(); ?>"><p>Read More ›</p></a>
						</div>
						<?php endwhile;?>
					</div>
				</div>
				
			</div>
		</div> 
		<!-- END THREE CONTENT UNIT --->
  
<?php get_footer(); ?>
