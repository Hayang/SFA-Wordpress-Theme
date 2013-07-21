<?php get_header(); ?>
	<?php if (have_posts()) : while (have_posts()) : the_post();?>
	<?php 
		$this_post_id = get_the_ID();
		$category = get_the_category(); 
		$parent_cat_id = $category[0]->parent;
		$has_parents = ($parent_cat_id != 0) ;
		if ($has_parents) {
			$category_parent  = get_category($parent_cat_id ,false);
		} 
		else {
			$category_parent = $category[0];
			$parent_cat_id = $category[0]->term_id ;
		}
		
		?>
	<!-- MAIN BODY --->	
		<div class="row-fluid">
			<!-- LEFT COLUMN --->	
			<div class="span2 left_column">
				<div id="breadcrumbs"> 
				<?php echo get_category_parents($category, TRUE, ' > '); ?>
				</div>
<!--
				<div id="breadcrumbs">PROGRAMS > ACTING</div>
-->
					<h3 id="left_column_title"><a href="<?php echo get_category_link( $parent_cat_id ); ?> " ><?php echo $category_parent->name ?></a></h3>
					<ul>
					<?php

					wp_list_categories('style=none&child_of='.$parent_cat_id); 
					?>
<!--
					<ul>
						BFA ACTING
						<li>COURSE OF STUDY</li>
						<li>AUDITION</li>
						<li>ADVANCEMENT & TRANSFERRING</li>
						<li>FINANCIAL AID</li>
						<li>PERFORMANCE OPPORTUNITIES</li>
					</ul>
					<ul>
						MFA ACTING
						<li>COURSE OF STUDY</li>
						<li>APPLICATION & AUDITION</li>
						<li>FINANCIAL AID</li>
						<li>PERFORMANCE OPPORTUNITIES</li>
					</ul>
-->
			</div>
			<!-- END LEFT COLUMN --->	
			<!-- MIDDLE COLUMN --->
			<div class="span6" id="post_body">
					<h4><?php the_title();?></h4>
					 POSTED <?php the_date(); the_category(); ?>
					<p><?php the_content();?></p>
					

				<!--
					<h4>THE UCONN DRAMATIC ARTS DEPARTMENT HAS DEVELOPED ONE OF THE FINEST UNIVERSITY-BASED ACTOR-TRANING PROGRAMS IN THE COUNTRY.</h4>
					<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse sagittis eget nisi nec dignissim. Aliquam tempor hendrerit tortor. Nunc sed lacus ut ligula bibendum fermentum eu sit amet nunc. Maecenas nec fermentum mi. Ut eleifend, quam pulvinar dapibus molestie, augue nisi egestas tortor, a luctus mi turpis quis libero. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Interdum et malesuada fames ac ante ipsum primis in faucibus. Nulla quis elit eget nisi suscipit sodales. Aenean hendrerit vehicula molestie. Cras cursus eu justo vitae vehicula. Nulla sit amet nulla blandit, porttitor lectus vel, ultrices sapien. Pellentesque fermentum ligula eu ultricies sagittis. Aliquam a accumsan diam. Fusce tellus libero, dapibus nec augue faucibus, mattis volutpat eros.</p>
					
					<h5>ACTOR-TRAINING PHILOSOPHY</h5>
					<p>Nunc congue nibh nec eros euismod consectetur. Duis pellentesque, lectus et pretium consequat, risus est imperdiet nibh, eu dictum nisl urna fermentum nisl. Aenean vehicula quam at pulvinar mattis. Praesent non commodo libero. Nullam est mi, congue vel laoreet ac, ullamcorper eu lacus. Duis vitae risus ut dolor tempus tempus. Quisque ut magna faucibus, volutpat ipsum et, cursus leo. Nullam odio magna, pretium eu adipiscing luctus, vehicula non augue. Suspendisse fringilla, massa tincidunt porta porttitor, diam felis lobortis nulla, sit amet euismod ligula nulla id orci. In hac habitasse platea dictumst. Interdum et malesuada fames ac ante ipsum primis in faucibus. Nam auctor nulla at urna vestibulum, sit amet varius purus varius</p>
				-->
			</div>
			<!-- END MIDDLE COLUMN --->
			
			<!-- RIGHT COLUMN --->
			<?php get_sidebar(); ?>
				<div class="column_3_img">
<!--
					<img src="http://placehold.it/450x300"></img>
					-->
					<?php 
						if ( has_post_thumbnail() ) { // check if the post has a Post Thumbnail assigned to it.
						the_post_thumbnail(array(450,300), array('class'	=> "post-featured-image"));
						
					 ?>
					<h5>Above: 
					<?php
						the_excerpt();
					
					}
					?>
			<?php endwhile; endif; ?>
<!--
					Professor Sagnik and Professor Cardinal discuss matters.
-->
					</h5>
				</div>
				<span>OTHER NEWS AT UCONN <?php bloginfo( 'name' ); ?> </span>
				<?php echo ($category_parent->name); ?>

		
				<?php $page_count = 0; ?>
				<?php $my_query = new WP_Query('category_name='.$category_parent->name.'&posts_per_page=3'); ?>

				<?php while ($my_query->have_posts()) : $my_query->the_post(); ?>
				<?php $page_count += 1;
				if ( ($this_post_id != get_the_ID()) && ($page_count <= 2 ) )	{ ?>
				
					<div class="column_3_boxes">
					<p> <a href="<?php the_permalink(); ?>"> <?php the_excerpt(); ?> </a></p>
					</div>
					
				<?php } ?>
				<?php endwhile; ?>

				
<!--
				<div class="column_3_boxes">
				<p>Jesse Rifkin Writes on "What Makes Gatsby Your Classic?"</p>
				</div>
				
				<div class="column_3_boxes"><p>CRT Production "Hairspray is a family-friendly musical. </p>
				</div>
-->
			</div>
			<!-- END RIGHT COLUMN --->
			
		</div>
	<!-- END MAIN BODY --->

<?php get_footer(); ?>
