		<?php
						//&&($n_loops < 10)
							date_default_timezone_set('America/Jamaica');
							$charnum = 24;
							$pad = 28;
							$calendar = 'Benton_Museum_of_Art1,Ballard_Institute_and_Museum_of_Puppetry1,Community_School_of_the_Arts1,Connecticut_Repertory_Theatre1,Jorgensen_Center_for_the_Performing_Arts1,UConn_Stamford_Art_Gallery1,von_der_Mehden_Recital_Hall1';
					
					function string_limit_words($string, $word_limit)
					{
						$words = explode(' ', $string, ($word_limit + 1));
						if(count($words) > $word_limit)
						array_pop($words);
						return implode(' ', $words);
					}
						
						if(isset($_GET['ajax'])){
							$ch = curl_init("http://web2.uconn.edu/wdlcalendar/index.php/smallcal_ajax/".$_GET['ajax']);
							curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
							echo curl_exec($ch);
							curl_close($ch);
							exit();
						}
						$display_time = time() - 30 * 24 * 60 * 60;
						$n_loops = 0;
						$print_something = 0;
					if (isset($_GET['calname'])){
						$calendar = $_GET['calname'];
					}
					$n_posts = 2;
					if (isset($_GET['nposts'])){
						$n_posts = $_GET['nposts'];
					}
//~ print_r($n_posts);
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
						$max_events = 2;
						
						foreach($occurrences as $key => $occurrence){
								//~ print_r($occurrence);
															
							$day = date('mdY',$occurrence->start);
							if (($today <= $day) && ($n_posts < 2)) {
								?>
								<!-- ONE EVENT --> 
										<div class="tri_box_single left_box"><a href="http://web2.uconn.edu/wdlcalendar/index.php/occurrence/<?php echo $occurrence->id ?>">
										<?php 
										$excerpt = $occurrence->title;
										echo string_limit_words($excerpt, 15);
										//~ echo $excerpt;
										?><br /></a>
										
										<div class="readmore_container">
											<a class="box_readmore" href="http://web2.uconn.edu/wdlcalendar/index.php/occurrence/<?php echo $occurrence->id ?>"><p>Read More ›</p></a>
										</div>
									</div>
								<?php
								$print_something = 1;
								$n_posts ++;
							}	
								

							
						}
						
							
					}
					
					?>
