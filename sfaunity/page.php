<?php get_header(); ?>
			<?php if (have_posts()) : while (have_posts()) : the_post();?>
	<!-- MAIN BODY --->	
		<div class="row-fluid">
			<!-- LEFT COLUMN --->	
			<div class="span4 left_column">
				<div id="breadcrumbs" style="text-transform:uppercase;"><!-- make rule in CSS!!!!!!!!!!!!!!! -->
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
					<!--
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
			<!-- RIGHT COLUMN --->



    
    
    
			<div class="span8" id="post_body">
			<h4><?php the_title();?></h4>
			<p><?php the_content(); ?></p>
				<!--
					<h4>THE UCONN DRAMATIC ARTS DEPARTMENT HAS DEVELOPED ONE OF THE FINEST UNIVERSITY-BASED ACTOR-TRANING PROGRAMS IN THE COUNTRY.</h4>
					<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse sagittis eget nisi nec dignissim. Aliquam tempor hendrerit tortor. Nunc sed lacus ut ligula bibendum fermentum eu sit amet nunc. Maecenas nec fermentum mi. Ut eleifend, quam pulvinar dapibus molestie, augue nisi egestas tortor, a luctus mi turpis quis libero. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Interdum et malesuada fames ac ante ipsum primis in faucibus. Nulla quis elit eget nisi suscipit sodales. Aenean hendrerit vehicula molestie. Cras cursus eu justo vitae vehicula. Nulla sit amet nulla blandit, porttitor lectus vel, ultrices sapien. Pellentesque fermentum ligula eu ultricies sagittis. Aliquam a accumsan diam. Fusce tellus libero, dapibus nec augue faucibus, mattis volutpat eros.</p>
					
					<h5>ACTOR-TRAINING PHILOSOPHY</h5>
					<p>Nunc congue nibh nec eros euismod consectetur. Duis pellentesque, lectus et pretium consequat, risus est imperdiet nibh, eu dictum nisl urna fermentum nisl. Aenean vehicula quam at pulvinar mattis. Praesent non commodo libero. Nullam est mi, congue vel laoreet ac, ullamcorper eu lacus. Duis vitae risus ut dolor tempus tempus. Quisque ut magna faucibus, volutpat ipsum et, cursus leo. Nullam odio magna, pretium eu adipiscing luctus, vehicula non augue. Suspendisse fringilla, massa tincidunt porta porttitor, diam felis lobortis nulla, sit amet euismod ligula nulla id orci. In hac habitasse platea dictumst. Interdum et malesuada fames ac ante ipsum primis in faucibus. Nam auctor nulla at urna vestibulum, sit amet varius purus varius</p>
					-->
			</div>
			<!-- END RIGHT COLUMN --->
		</div>
	<!-- END MAIN BODY --->

			<?php endwhile; endif; ?>
<?php get_footer(); ?>
