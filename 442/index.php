<?php

				error_reporting(E_ALL ^ E_NOTICE);
				ini_set('user_agent', 'Mozilla/5.0');
				ini_set('xdebug.var_display_max_depth', 100000);
				ini_set('xdebug.var_display_max_children', 512000);
				ini_set('xdebug.var_display_max_data', 10240000);

				// use curl to load the html
				/******************************************************************************/
				function file_get_contents_curl($url) {
					$ch = curl_init();
					// you might need proxy settings added here if it times out.
					curl_setopt($ch, CURLOPT_HEADER, 0);
					curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); //Set curl to return the data instead of printing it to the browser.
					curl_setopt($ch, CURLOPT_URL, $url);

					$raw = curl_exec($ch);
					curl_close($ch);

					return $raw;
				}

				function _debug($title,$var) {

					print '<pre>';
					print '<h4>'.$title.'</h4>';
					print_r($var);
					print '</pre>';

				}

				function _stato($url) {

					$raw=file_get_contents_curl($url) or die('could not select');
// $newlines=array("\t","\n","\r","\x20\x20","\0","\x0B","<br/>","<p>","</p>","<br>");
// $content=str_replace($newlines, "", html_entity_decode($raw));


// here is the start and finish points we don't care about the stuff either side
					$start=strpos($raw,'<h2>Shots - All attempts</h2>');
					$end = strpos($raw,'</svg>');

					$table = substr($raw,$start,$end-$start);

// oh but wait there is loads of junk here we can strip out too
					$table = str_replace('<svg',"\n",$table);

					$table = str_replace('<img',"\n",$table);

					$table = str_replace('<defs>'," ",$table);
					$table = str_replace('</def>'," ",$table);

					$table = str_replace('/><line class="pitch-object',"\n",$table);
					$table = str_replace('marker-end="url(#smallblue)"','',$table);
					$table = str_replace('style="stroke:blue;stroke-width:3"','',$table);
					$table = str_replace('style="stroke:red;stroke-width:3"','',$table);
					$table = str_replace('marker-end="url(#smallred)"','',$table);
					$table = str_replace('marker-end="url(#smalldeepskyblue)"','',$table);
					$table = str_replace('style="stroke:deepskyblue;stroke-width:3"','',$table);
					$table = str_replace('<image x="0" y="0" width="760" height="529" xlink:href="/sites/fourfourtwo.com/modules/custom/statzone/files/statszone_football_pitch.png"','',$table);
					$table = str_replace('<','',$table);
					$table = str_replace('>','',$table);
					$table = str_replace('style="stroke:yellow;stroke-width:3"','',$table);

					$start =  'xlink:href="/sites/fourfourtwo.com/modules/custom/statzone/files/statszone_football_pitch_shot.png"';

					$table = explode($start,$table);
					// split the code from the start point above and keep the second part 1, of 0/1
					$table = $table['1'];

					// remove some more stuff so we are left with basic info
					$table = str_replace('marker-start="url(#'," ",$table);
					$table = str_replace('marker-end="url(#bigyellow)"'," ",$table);
					$table = str_replace('marker-end="url(#bigred)"'," ",$table);
					$table = str_replace('marker-end="url(#bigblue)"'," ",$table);
					$table = str_replace('marker-end="url(#bigdarkgrey)"'," ",$table);
					$table = str_replace(')"'," ",$table);
					$table = str_replace('style="stroke:darkgrey;stroke-width:3"'," ",$table);

					$table = str_replace(' x',',x',$table);
					$table = str_replace(' y',',y',$table);
					$table = str_replace('" ','"',$table);
					$table = str_replace('big',',',$table);
					$table = str_replace('end','',$table);
					$table = str_replace('"','',$table);
					$table = str_replace('-',', ',$table);
					$table = str_replace('timer','',$table);

					$table = str_replace('x1=','',$table);
					$table = str_replace('x2=','',$table);
					$table = str_replace('y1=','',$table);
					$table = str_replace('y2=','',$table);

					// replace colours with shot type
					$table = str_replace('yellow','Goal',$table);
					$table = str_replace('blue','Save',$table);
					$table = str_replace('red','Wide',$table);
					$table = str_replace('darkgrey','Block',$table);

					// tidy up the output a little.
					$table = str_replace('   /',"\n\n",$table);
					$table = str_replace(' ,',',',$table);
					$table = str_replace('  ,',',',$table);
					$table = str_replace(', ',',',$table);



					// print what is left to screen.
					print '<pre>';
					print $table;
					print '</pre>';

				}

				// we should probably validate these to make sure they are integers
				$match  =  isset($_POST['match']) ? $_POST['match'] : $_POST['match'];
				$team1  =  isset($_POST['team1']) ? $_POST['team1'] : $_POST['team1'];
				$team2  =  isset($_POST['team2']) ? $_POST['team2'] : $_POST['team2'];

				// create the urls
				$url_1 = "http://www.fourfourtwo.com/statszone/8-2014/matches/{$match}/team-stats/{$team1}/";
				$url_2 = "http://www.fourfourtwo.com/statszone/8-2014/matches/{$match}/team-stats/{$team2}/";


				if (isset($match) && $match !== '') {



					// shot type array but we only care about all of them at the moment so use 01.
					$array = array('01');
					// $array = array('01','02','03','04','05','55','56','06','07','08','09','10','11','12','13','14');

					foreach ($array as $k => $v) {

						// foreach value in the array look through the function for the url and output
						$query_1 = $url_1.'0_SHOT_'.$v.'#tabs-wrapper-anchor';
						print '<hr/><p>'.$query_1.' : '.$v.'</p>';
						_stato($query_1);

						$query_2 = $url_2.'0_SHOT_'.$v.'#tabs-wrapper-anchor';
						print '<hr/><p>'.$query_2.' : '.$v.'</p>';
						_stato($query_2);
					}
				} else {
					?>
					<form action="<?php $_SERVER['PHP_SELF'];?>" method="POST">

						<div class="form-group">
							<label for="match">match ID:</label>
							<input name="match"   type="text" id="match">
						</div>

						<div class="form-group">
							<label for="team1">Home Team ID:</label>
							<input name="team1"   type="text" id="team1">
						</div>

						<div class="form-group">
							<label for="team2">Away Team ID:</label>
							<input name="team2"   type="text" id="team2">
						</div>

						<div class="form-group">
							<input type="submit" value="submit" class="btn btn-primary">
						</div>

					</form>
				<?php } ?>
		</div>
	</div>
	<div class="clearfix"><p>&nbsp;</p></div>
