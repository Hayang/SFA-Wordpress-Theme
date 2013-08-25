
					<div class="box_headers" >
						<h3><a href="#" ><?php echo get_theme_mod('tri_left_setting'); ?></a></h3>
						<a href="<?php echo get_permalink(get_page_by_title('events')); ?>"><div id="cal_icon"></div></a>
					</div>
					
					<?php $n_posts = 0; ?>
					<div class="box_contents"> 
						<?php 
						query_posts('category_name='. get_theme_mod('tri_left_content') ); 
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
						<?php if ($n_posts < 2) {
						date_default_timezone_set('America/Jamaica');
							$charnum = 24;
							$pad = 28;
							//~ $calendar = 'Benton_Museum_of_Art1,Ballard_Institute_and_Museum_of_Puppetry1,Community_School_of_the_Arts1,Connecticut_Repertory_Theatre1,Jorgensen_Center_for_the_Performing_Arts1,UConn_Stamford_Art_Gallery1,von_der_Mehden_Recital_Hall1';
							$calendar = get_theme_mod('calendar_setting'); 
						if(isset($_GET['ajax'])){
							$ch = curl_init("http://web2.uconn.edu/wdlcalendar/index.php/smallcal_ajax/".$_GET['ajax']);
							curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
							echo curl_exec($ch);
							curl_close($ch);
							exit();
						}
						$n_loops = 0;
						$display_time = time() - 30 * 24 * 60 * 60;
while (($n_posts < 2)&&($n_loops < 12)){
						$n_loops += 1;
						$display_time += 30 * 24 * 60 * 60;
						
						$date = date('Y-m-d',$display_time);
							
						$FEED_URL = 'http://web2.uconn.edu/wdlcalendar/index.php/minical_feed/'.$date.'/All/All/'.$calendar.'/';
						$ch = curl_init($FEED_URL);
						curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
						$output = curl_exec($ch);
						curl_close($ch);
						$data = unserialize($output);
						$occurrences = $data[1];

							
							$today = date('mdY') ;
							//~ $one_day_worth_of_seconds =  60 * 60 * 24;
							$max_events = 2;
							//~ $event_list = array();
							//~ $already_display_date = true;


			//~ echo count($occurrences);
							foreach($occurrences as $key => $occurrence){
								//~ print_r($occurrence);
								
								
								
								$day = date('mdY',$occurrence->start);
					if (($today <= $day) && ($n_posts < 2)) {
									?>
										<!-- ONE EVENT -->
											<div class="tri_box_single left_box"><a href="http://web2.uconn.edu/wdlcalendar/index.php/occurrence/<?php echo $occurrence->id ?>">
												<?php $excerpt = $occurrence->title;
												echo string_limit_words($excerpt, 15);
												?><br /></a>
												
												<div class="readmore_container">
													<a class="box_readmore" href="http://web2.uconn.edu/wdlcalendar/index.php/occurrence/<?php echo $occurrence->id ?>"><p>Read More ›</p></a>
												</div>
											</div>
											
											
											
											
								

								
								<?php
								$n_posts ++;
								}
							
								 }
							}
							}?>
					</div>
