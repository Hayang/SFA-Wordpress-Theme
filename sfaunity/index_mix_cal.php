
				<div class="box_headers">
					<h3><a href="#" ><?php echo get_theme_mod('tri_left_setting'); ?></a></h3>
					<a href="<?php echo get_permalink(get_page_by_title('events')); ?>"><div id="cal_icon"></div></a>
				</div>
				
				

					</div>
					<?php $n_posts = 0; ?>
					<div class="box_contents"> 
						<?php 
						query_posts('category_name='. get_theme_mod('tri_left_content') . '&posts_per_page=2');
						
						?>

						<?php while (have_posts()) : the_post(); ?>
											<?php 
											$custom_fields = get_post_custom(); 
											
						$expiration_date = strtotime($custom_fields[expiration_date_day][0].'-'.$custom_fields[expiration_date_month][0].'-'.$custom_fields[expiration_date_year][0]);
											if (($expiration_date > time()) && ($n_posts < 2 ) ) {
											?>
						<div class="tri_box_single left_box"><a href="<?php the_permalink(); ?>">
							<?php $excerpt = get_the_title();
							echo string_limit_words($excerpt, 15);
							?><br /></a>
							
							<div class="readmore_container">
								<a class="box_readmore" href="<?php the_permalink(); ?>"><p>Read More ›</p></a>
							</div>
						</div>
						<?php $n_posts += 1; } ?>
						<?php endwhile;?>
						
						
						<?php if ($n_posts < 2) { ?>

							<div id="events_listing_index"> </div>
						<?php $calendar = get_theme_mod('calendar_setting'); ?> 
						
						<script>
						$(document).ready(function(){

							$("#events_listing_index").load("<?php bloginfo('stylesheet_directory'); ?>/load_cal.php?calname=<?php echo $calendar; ?>&nposts=<?php echo $n_posts ; ?>");
						});
						</script>
						
					<?php
					$n_posts ++;
							}?>
					</div>
