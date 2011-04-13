<?php
error_reporting(E_ALL);
ini_set("display_errors", 1);

$pageid = "home";
require_once('include/common.php');

get_document('doctype');

//DYNAMIC <html> tag
get_document('html');
?>

<head>
  <?php
	  echo get_meta('charset'); //UTF-8 CHARSET
		echo get_meta('chromeframe'); //FORCES IE TO ACT LIKE CHROME
		echo get_meta('viewport'); //MOBILE VIEWPORT
		
		echo get_document('stylesheets'); //EMBED STYLESHEETS
		echo get_document('favicon'); //FAVICONS
		echo get_document('scripts_header'); //HEADER JAVASCRIPTS
  ?>

  <title>Welcome<?php echo get_meta('title_append'); ?></title>
  <meta name="description" content="">
  <meta name="author" content="<?php echo get_meta('author'); ?>">
  
</head>

<body>

  <div id="container">
    <header>
			<h1>Mileage Generator</h1>
    </header>
    
    <article id="main">
			<?php
			if ( isset($_POST['submit']) ):
			//FORM HAS BEEN SUBMITTED
			extract($_POST);
			
			//Create a new variable to work with
			$miles = $startMiles;
			
			//DO SOME MATH
			$totalMiles = $endMiles - $startMiles; // 25k - 10k = 15k
			
			echo '<ul>';
			echo '<li>Miles: '.$startMiles.' - '.$endMiles.'</li>';
			echo '<li>Total Miles Driven: '.$totalMiles.'</li>';
//			echo '<li>Average Monthly Miles: '.$monthlyMiles.'</li>';
//			echo '<li>Monthly Trips: '.$monthlyTrips.'</li>';
			echo '</ul>';
			
			//CREATE A COUNTER
			$monthCounter = 1;

			//LOOP THROUGH THE MONTHS
			while ( $monthCounter <= $months && $miles <= $endMiles ) {

					//MAXIMUM NUMBER OF MONTHLY MILES
					$monthlyMiles = round($miles / $months);
					
					//CHOOSE AN INTEGER FOR THE MAXIMUM MILES THAT COULD BE DRIVEN IN A MONTH
					$monthlyMileMax = round(rand($monthlyMiles - 5,$monthlyMiles));
					
					// FOR EACH MONTH, CHOOSE A RANDOM NUMBER OF TRIPS
					$monthlyTrips = round(rand($monthlyTripMin,$monthlyTripMax));
					
					//AVERAGE THE MILES PER TRIP
					$avgTripMiles = round($monthlyMileMax / $monthlyTrips);
					
					//CREATE A COUNTER
					$tripCounter = 0;
					
					//WHAT IS THE MONTH?
					$currentMonth = mktime(0,0,0,$monthStart);

					echo '<table width="100%">';
					echo '<thead>';
					echo '<tr>';
					echo '<td>';
					echo '<h3>Month of '.date('F, Y',$currentMonth).'</h3>';
					echo '</td>';
					echo '<td>';
					echo 'Maximum miles in this month: '.$monthlyMileMax;
					echo '</td>';
					echo '<td>';
					echo 'Trips made this month: '.$monthlyTrips;
					echo '</td>';
					echo '<td>';
					echo 'Average miles per trip: '.$avgTripMiles;
					echo '</td>';
					echo '</tr>';
					echo '</thead>';
					
					echo '<tbody>';
					//LOOP THROUGH THE TRIPS
					while ( ($tripCounter < $monthlyTrips)) {
						
						//CHOOSE A RANDOM NUMBER OF MILES FOR THE TRIP
						$tripMiles = round(rand(5,$avgTripMiles));
					
						echo '<tr>';
						echo '<td colspan="4">';
						echo '<strong>Trip '.($tripCounter + 1).':</strong> ';
						echo $miles.' - '.($miles + $tripMiles);
						echo ' ('.$tripMiles.' miles)';
						echo '</td>';
						echo '</tr>';
						
						//ADD THE MILEAGE TO THE STARTING MILEAGE
						$miles = $miles + $tripMiles;
						
						//INCREMENT THE COUNTER
						$tripCounter++;
						
						// CREATE A RANDOM NUMBER SO SEQUENCES ARE NON-SEQUENTIAL
						// BETWEEN TRIPS
						if ( $tripCounter != $monthlyTrips ) {
						$miles = $miles + round(rand(0,20));
						}
						
					}
					echo '</tbody>';

					echo '<tfoot>';
					echo '<tr>';
					echo '<td colspan="4">';
					echo '<h5>The odometer currently reads: '.$miles.'</h4>';
					echo '</td>';
					echo '</tr>';
					echo '</tfoot>';
					echo '</table>';
				
					//INCREMENT THE MONTHS
					$monthCounter++;
					$monthStart++;
				}
			?>
			
			<div class="message warning">
			<h5>You drove <?php echo $totalMiles; ?> miles in <?php echo $months; ?> months.</h5>
			</div>
			<?php
			else:
			//NO FORM HAS BEEN SUBMITTED
			?>
			<form action="" method="post" id="input">
				<fieldset id="general">
					<legend>General settings</legend>
					
					<label for="months">How many months should I generate?</label>
					<input type="text" name="months" value="" class="text" />
					
					<div class="inline first">
					<label for="monthStart">Begin on month:</label>
					<select name="monthStart" id="monthStart">
						<option value="1" selected>January</option>
						<option value="2">February</option>
						<option value="3">March</option>
						<option value="4">April</option>
						<option value="5">May</option>
						<option value="6">June</option>
						<option value="7">July</option>
						<option value="8">August</option>
						<option value="9">September</option>
						<option value="10">October</option>
						<option value="11">November</option>
						<option value="12">December</option>
					</select>
					</div>
					
					<div class="inline last">
					<label for="yearStart">Begin on year</label>
					<select name="yearStart" id="yearStart">
					<?php
						$now = date('Y');
						$yearStart = $now - 5;
						
						while( $yearStart <= $now ) {
							if ($yearStart == $now) {
								echo '<option selected value="'.$yearStart.'">'.$yearStart.'</option>';
							} else {
								echo '<option value="'.$yearStart.'">'.$yearStart.'</option>';
							}
							$yearStart++;
						}
					?>
					</select>
					</div>
					
					<label for="startMiles">Starting Mileage</label>
					<input type="text" name="startMiles" value="" class="text" />
					
					<label for="endMiles">Ending Mileage</label>
					<input type="text" name="endMiles" value="" class="text" />
					
					<label for="monthlyTripMin">How many trips do you make in a month?</label>
					<span class="inline first">Between <input type="text" name="monthlyTripMin" value="10" class="small" /></span>
					<span class="inline"> trips and <input type="text" name="monthlyTripMax" value="30" class="small" /> trips per month</span>
					
					<input type="submit" name="submit" value="Submit" class="button blue medium" />
					
				</fieldset>
			</form>
			<?php
			endif;
			?>
			
    </article>
    
    <footer>
			<?php include_once(DOCUMENT_ROOT.'footer.php'); ?>
    </footer>
  </div> <!-- #container -->

  <?php echo get_document('scripts_footer'); ?>
  
</body>
</html>