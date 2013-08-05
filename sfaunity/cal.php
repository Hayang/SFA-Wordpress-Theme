<?php
date_default_timezone_set('America/Jamaica');
//Configuration variables
	//substr number
	$charnum = 24;
	$pad = 28;
	//~ $calendar = 'Benton_Museum_of_Art1,Ballard_Institute_and_Museum_of_Puppetry1,Community_School_of_the_Arts1,Connecticut_Repertory_Theatre1,Jorgensen_Center_for_the_Performing_Arts1,UConn_Stamford_Art_Gallery1,von_der_Mehden_Recital_Hall1';
	require('calendar_select.php');
	
if(isset($_GET['ajax'])){
	$ch = curl_init("http://web2.uconn.edu/wdlcalendar/index.php/smallcal_ajax/".$_GET['ajax']);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
	echo curl_exec($ch);
	curl_close($ch);
	exit();
}


	
					
if (isset($_GET['t'])){
	//~ echo 'isset<br>';
	if ($_GET['t']=='m'){
		//~ echo 'is m<br>';

		$print_type = 'month';
		if (isset($_GET['month']) && isset($_GET['year'])){
			$month = $_GET['month'];
			$year = $_GET['year'];
		} else {

			$month = date('m');
			$year = date('Y');
		}

		$date = $year.'-'.$month.'-01';
		//~ echo '01-'.$month.'-'.$year;
		$stamp = strtotime('01-'.$month.'-'.$year);
	}
	elseif (($_GET['t']=='w')||($_GET['t']=='d')) {
			
		if ($_GET['t']=='w') {
			//~ echo 'is w<br>';
			$print_type = 'week';}
		else {
			//~ echo 'is d<br>';
			$print_type = 'day';}
			
			$month = date('n');
			$year = date('Y');
		if(isset($_GET['st'])){
			$stamp = $_GET['st'];
			$date = date('Y-m-d',$stamp) ;
			$month = date('m',$stamp );
			$year = date('Y',$stamp );
		}
		else {
			//~ echo 'no st<br>';
			$date = date('Y-m-d');
			$stamp = time();
			$month = date('n');;
			$year = date('Y');
		}
	}
	else {
		//~ echo 'not wd<br>';
		$print_type = 'day';
		$date = date('Y-m-d');
		$stamp = time();
		$month = date('n');;
		$year = date('Y');
	}
}
else {
	//~ echo 'not set<br>';
	$print_type = 'day';
	$date = date('Y-m-d');
	$stamp = time();
	$month = date('n');;
	$year = date('Y');
}
	
	//~ echo 'print type = '.$print_type.'<br>';
	
$FEED_URL = 'http://web2.uconn.edu/wdlcalendar/index.php/minical_feed/'.$date.'/All/All/'.$calendar.'/';
$ch = curl_init($FEED_URL);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
$output = curl_exec($ch);
curl_close($ch);
$data = unserialize($output);
//date('w',$data[0]);
$occurrences = $data[1];
//~ echo 'date is :  ' . $date.'<br>';
//~ echo 'data[0] = '.$data[0].'<br>';
//~ echo 'month is :  ' . $month.'<br>';
//~ echo 'year is :  ' . $year.'<br>';
//~ echo 'stamp is : ' . $stamp.'<br>';
$grid = new Grid($occurrences,$data[0],$month,$year,$charnum,$stamp);
switch ($print_type) {
    case 'month':
		$grid->printCalendar(); 
        break;
    case 'week':
		$grid->print_registered_week(); 
        break;
    default:
		$grid->print_registered_day();
}

class Grid{

var $output = '';
var $displaydate; //date to display on top of the calendar
var $dow; //starting day of week
var $numcells = 0; //number of cells including fillers in the beginning
var $numrows = 5;
var $day_binary = array(); //the array of cells; // vi's edit

var $cells = array(); //the array of cells;
var $rows = array(); //array of rows;
var $nextDateBlock; 
var $lastDateBlock;
var $charnum;

var $stamp;
var $last_month = array();
var $next_month = array();
var $this_month = array();
	function Grid($occurrences, $dstart, $month, $year, $charnum,$stamp){
		$this->charnum = $charnum;
		$this->setAdjacentDates($month,$year);
		$this->this_month['month'] = $month;
		$this->this_month['year'] = $year;
		$this->stamp = $stamp;
		//~ echo('constructor : '.$stamp.'<br>');
		$this->occurrences = $occurrences;
		$this->displaydate = date('F Y',$dstart);
		$this->dow = date('w',$dstart);	//day of week M - F
		$this->numcells = date('w',$dstart) + 1 + date('t',$dstart);
		if($this->numcells > 35)
			$this->numrows = 6;
	}

	function print_registered_day(){
		$today = date('mdY',$this->stamp) ;
		$one_day_worth_of_seconds =  60 * 60 * 24;
		$n = 1; $max_events = 8;
		$event_list = array();
		$already_display_date = true;
				?>
			<!-- MIDDLE COLUMN, DAILY EVENTS LISTING --->
			
			<div class="span8" id="post_body">
				<?php 
					$yesterday = $this->stamp - $one_day_worth_of_seconds;
					$tomorrow  = $this->stamp + $one_day_worth_of_seconds;
				?>
				<!-- Previous Day Button -->
				<a id="previous_button" href="<?php echo (get_permalink( $post->ID ).'&t=d&st='.$yesterday  )?>" alt="Go to the previous day">
					<img src="http://placehold.it/30x30" />
				</a> 
				
				<!-- Week Title -->
				<h2 id="event_page_title"> <?php echo date('l, F j',$this->stamp); ?></h2>
				
				<!-- Next Day Button -->
				<a id="next_button"  href="<?php echo (get_permalink( $post->ID ).'&t=d&st='.$tomorrow  )?>" alt="Go to the next day">

					<img src="http://placehold.it/30x30" />
				</a>
			<!-- START LISTING EVENTS -->
				<?php
		foreach($this->occurrences as $key => $occurrence){
			
			$day = date('mdY',$occurrence->start);
			if ($today == $day)  {
				?>
								<!-- ONE EVENT -->
				<div class="row-fluid">

					<!-- Image, for the first event only -->
					<img class="span3 event_day_image featued_image_1col" src="http://web2.uconn.edu/wdlcalendar/Images/events/l_<?php echo ($occurrence->image)?>" />
					
					<div class="span9"> 
							<!-- First event for the day -->
							<a href="http://web2.uconn.edu/wdlcalendar/index.php/occurrence/<?php echo $occurrence->id ?>">
								<h5 class="event_day_title">
									<b><?php echo(date('g:iA - ',$occurrence->start) )?></b> <?php echo ($occurrence->title); ?>
								</h5>
								<h6 class="event_day_location">at <?php echo ($occurrence->building); ?></h6>
								<p> <?php echo ($occurrence->description); ?>	</p>
							</a>

					</div>
				</div> <!-- END ONE EVENT -->

								<?php
				$n ++;
			}
		}
			if ($n <= 1) {
			echo( "<h3>No events today</h3>");
			}
	?></div><?php

	}

	function print_registered_week(){
		$today = date('mdY',$this->stamp) ;
		//~ $today_date_string = date('d-m-Y',$this->stamp);
		$one_day_worth_of_seconds =  60 * 60 * 24;
		$one_week_worth_of_seconds =  60 * 60 * 24 * 7;
		$beginning_of_day = strtotime('midnight', $this->stamp);
		$beginning_of_week= $beginning_of_day - date('w',$this->stamp) *$one_day_worth_of_seconds ;

		$n = 1; $max_events = 8;
		$event_list = array();
		$already_display_date = true;
				?>
			<!-- MIDDLE COLUMN, DAILY EVENTS LISTING --->
			
			<div class="span8" id="post_body">
				<?php 
					$last_week = $this->stamp - $one_week_worth_of_seconds;
					$next_week  = $this->stamp + $one_week_worth_of_seconds;
					//~ $yesterday = $this->stamp - $one_day_worth_of_seconds;
					//~ $tomorrow  = $this->stamp + $one_day_worth_of_seconds;
				?>
				
				<!-- Previous Week Button -->
				<a id="previous_button" href="<?php echo (get_permalink( $post->ID ).'&t=w&st='.$last_week  )?>" alt="Go to the previous week">
					<img src="http://placehold.it/30x30" />
				</a> 
				
				<!-- Week Title -->
				<h2 id="event_page_title"> WEEK OF <?php //echo date('j',$beginning_of_week).'-'.(date('t',$beginning_of_week));
				echo date('j',$beginning_of_week).'-'.((date('j',$beginning_of_week)+6)%date('t',$beginning_of_week));?></h2>
				
				<!-- Next Week Button -->
				<a id="next_button"  href="<?php echo (get_permalink( $post->ID ).'&t=w&st='.$next_week  )?>" alt="Go to the next week">

					<img src="http://placehold.it/30x30" />
				</a>
			<!-- START LISTING EVENTS -->
				<?php
				$started_loop = false;
		foreach($this->occurrences as $key => $occurrence){
					
				
			$day = date('mdY',$occurrence->start);
			//~ if ($today == $day)  {
			if (( ($occurrence->start  -  $beginning_of_week) > 0) 
			&& (($occurrence->start  -  $beginning_of_week) <= $one_week_worth_of_seconds)  
			){
				$same_day = (($day == $the_loop_day) && ($started_loop) ) ;
				$the_loop_day = date('mdY',$occurrence->start);
				$started_loop = true;
							?>
				<!-- Second eventful day of the week (Identical) -->
				<div class="row-fluid"><? ?>
					<h4 id="event_week_day" class="span3 event_week_day"><?php if (!$same_day) echo date('j l',$occurrence->start); ?></h4>

					<!-- Image, for the first event only --> 
					<img class="span3 event_week_image featued_image_1col" src="http://web2.uconn.edu/wdlcalendar/Images/events/l_<?php echo ($occurrence->image)?>" />
					
					<div class="span6">
							<!-- First event for the day -->
							<a href="UCONN EVENTS, SINGLE EVENT DETAILS">
								<h5 class="event_week_single">
									<b><?php echo(date('g:iA ',$occurrence->start) )?></b> <?php echo ($occurrence->title); ?>
								</h5>
							</a>
							


					</div>
				</div>
					<?php
				$n ++;
			}
		}
			if ($n <= 1) {
			echo( "<h3>No events today</h3>");
			}
	?></div><?php

	}




	
	function setAdjacentDates($month,$year){
		if($month == '12'){
			$this->nextDateBlock = 'month=01&amp;year='.($year+1);
			$this->lastDateBlock = 'month=11&amp;year='.$year;
			$this->last_month['month'] = '11';
			$this->last_month['year'] = $year;
			$this->next_month['month'] = '01';
			$this->next_month['year'] = $year+1;
		}
		else if($month == '01'){
			$this->nextDateBlock = 'month=02&amp;year='.$year;
			$this->lastDateBlock = 'month=12&amp;year='.($year-1);
			$this->last_month['month'] = '12';
			$this->last_month['year'] = $year-1;
			$this->next_month['month'] = '02';
			$this->next_month['year'] = $year;
		} else {
			$nm = $month + 1;
			$lm = $month - 1;
			if($nm < 10){
				$nm = "0".$nm;
			}
			if($lm < 10){
				$lm = "0".$lm;
			}
			$this->nextDateBlock = 'month='.$nm.'&amp;year='.$year;
			$this->lastDateBlock = 'month='.$lm.'&amp;year='.$year;
			$this->last_month['month'] = $lm;
			$this->last_month['year'] = $year;
			$this->next_month['month'] = $nm;
			$this->next_month['year'] = $year;
		}
	}
	
	function createCells(){
		for($i = 1; $i < $this->numrows * 7 + 1; $i++){
			//$day = ((($i-$this->dow) < 1)?'':($i-$this->dow));
			if(($i-$this->dow) > 0 && $i < $this->numcells){
				$day = $i-$this->dow;
				//~ $datareplace = ".:[$day]:.";
				//~ echo( $this->day_binary[$day] );
				
				//~ $date_string_1 = $i.'-'.$ 
				$this_date = $day.'-'.$this->this_month['month'].'-'.$this->this_month['year'];
				$this_timestamp = strtotime($this_date);
				if ($this->day_binary[$day] ) {
					$num_rep = '<h2 class="has_events"><a class="daynum '.$this_date.'" href="'.get_permalink( $post->ID ).'&t=d&st='.$this_timestamp.'">'.$day.'</a></h2>';
				} else {
					$num_rep = '<h2 class="">'.$day.'</h2>';
				}
				$cell = '<td class="daybox">'.
									''.
									$num_rep.
									//'<div>'.$datareplace.'</div>'.
							 '</td>';
				
			} else {
				$cell = '<td>&nbsp;</td>';
			}
			$this->cells[$i] = $cell;
		}
	}
	
	function check_day(){
		//~ for ($i = 1; $i <= 31; $i++) {
			//~ $this->day_binary[$i] =  false;
		//~ }
		$this->day_binary= array_fill(1,31,false);
		//~ $obarr = array();
		foreach($this->occurrences as $key => $occurrence){
		//var_dump($occurrence);
			$day = date('j',$occurrence->start);
			$this->day_binary[$day] = true;
			//~ $obarr[$day+$this->dow] .= '<li><a href="http://web2.uconn.edu/wdlcalendar/index.php/occurrence/'.$occurrence->id.'" id="o'.$occurrence->id.'" class="occurrence" >'.substr($occurrence->title,0,$this->charnum).'<br /><span>'.date("h:i a",$occurrence->start).'</span></a></li>';
			//echo "[".$day."] [".$occurrence->title."]<br />";

		}
		//~ var_dump($this->day_binary);
		//~ foreach($this->day_binary as $key => $day_b){
			//~ echo($day_b);
		//~ }
	}

	function populateRows(){
		$rowdex = -1;
		foreach($this->cells as $key=>$cell){
			if($key%7 == 1){
				$rowdex++;
			}
			$this->rows[$rowdex] .= $cell;
		}
	}

	function printCalendar(){
		$this->check_day();
		$this->createCells();
		$this->populateRows();
		$monthName = date("F", mktime(0, 0, 0, $this->this_month['month'], 10));

		echo '<table id="sctable">';
			echo '<div id="cal_info">';
			echo '<h2 id="big_cal_date">'.$monthName. ' ' . $this->this_month['year'].'</h2>';
			echo '<div id="big_cal_month_buttons">';
			echo '<a class="whitebutton" href="'.get_permalink( $post->ID ).'&t=m&'.$this->lastDateBlock.'">Previous Month</a>&nbsp;&nbsp;';
			echo '<a class="whitebutton" href="'.get_permalink( $post->ID ).'&t=m&'.$this->nextDateBlock.'">Next Month</a>';
			echo '</div></div>';
			
		echo '<thead>';
			echo '<tr class="cal_head_row">';
				echo '<th>Sunday</th>
							<th>Monday</th>
							<th>Tuesday</th>
							<th>Wednesday</th>
							<th>Thursday</th>
							<th>Friday</th>
							<th>Saturday</th>';
			echo '</tr>';
		echo '</thead>';
		echo '<tbody>';
		foreach($this->rows as $key => $row){
			echo '<tr class="weekrow" >';
			echo $row;
			echo '</tr>';
		}
		echo '</tbody>';
		
		echo '</table>';
	}



}



?>
