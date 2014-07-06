<html>
<body>
<h4>WSL League Generator</h4>
  	<div class="span12">
		<?php
		/******************************************************************************/

		$url='http://www.skysports.com/football/league/0,,28474,00.html';
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_HEADER, 0);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);  //Set curl to return the data instead of printing it to the browser.
		curl_setopt($ch, CURLOPT_URL, $url);
		$raw = curl_exec($ch);
		curl_close($ch);
		$newlines=array("\t","\n","\r","\x20\x20","\0","\x0B","<br/>","<p>","</p>","<br>");
		$content=str_replace($newlines, "", html_entity_decode($raw));
                $content=str_replace('Tottenham','Spurs',$content);
        	$content=str_replace('Chelsea','<b>Chelsea</b>',$content);




		/******************************************************************************/

		$start=strpos($content,'<table id="ss-stat-sort"');
		$end = strpos($content,'</table>');
		$table = substr($content,$start,$end-$start);
		preg_match_all("|<tr(.*)</tr>|U",$table,$rows);
		$rank=array();

             echo '<span class="span5">[cann]';
		
		foreach ($rows[0] as $row)
			{  
			            if ((strpos($row,'<th')===false)) :
			                // pos, team, pld, gd, pts
				        preg_match_all("|<td(.*)</td>|U",$row,$cells);
					$f0  = strip_tags($cells[0][0]);
                                        $f1  = strip_tags($cells[0][1]);
					$f2  = strip_tags($cells[0][2]);
					$f3  = strip_tags($cells[0][3]); 
					$f4  = strip_tags($cells[0][4]);
					$f5  = strip_tags($cells[0][5]);
					$f6  = strip_tags($cells[0][6]);
					$f7  = strip_tags($cells[0][7]);
					$f8  = strip_tags($cells[0][8]);
					$f9  = strip_tags($cells[0][9]);
					$f10 = strip_tags($cells[0][10]);
					$f11 = strip_tags($cells[0][11]);
                                           if(isset($f2) && $f2 <>'') :
					$f2=str_replace(' ','_',$f2);
                                         array_push($rank,$f10,"$f2 ($f3)");
                                          endif;
				   endif;
      
	     } // end foreach

/******************************************************************************/

$output = array();
foreach($rank as $key => $value) {

// we want value 1 as key, value 2 as value. modulus baby.
  if($key % 2 > 0) { //every second item
    $index = $rank[$key-1];

// we cannot have duplicate keys so we concatenate values to the key.
if(array_key_exists($index,$output)) {
    $output[$index] .= ', '.$value;
}
else {
    $output[$index] = $value;
}
  }
}

krsort($output);
$new=array();
reset($output);
$first=key($output);
reset($output);
$last = key( array_slice( $output, -1, 1, TRUE ) );

$i = $last;
while ($i < $first):
    if (!array_key_exists($output)):
    	    $new[$i]=" ";
	endif;
    $i++;
endwhile;

reset($output);
$output= $output + $new;
krsort($output);

// make sexy
print '<table>
<thead>
<tr>
<th>Points</th>
<th>Team</th>
</tr>
</thead>
<tbody>';
foreach($output as $key => $value) {
print '<tr><td>'.$key.'</td><td>'.$output[$key].'</td></tr>';
}
print '</table>[cann-foot]<br/></span>';
       
/******************************************************************************/

$gdl=array();
echo '<span class="span5">[gdl]';
                         
		foreach ($rows[0] as $row)
			{            
			            if ((strpos($row,'<th')===false)) :
			                // pos, team, pld, gd, pts
				    preg_match_all("|<td(.*)</td>|U",$row,$cells);
					$f0  = strip_tags($cells[0][0]);
                                        $f1  = strip_tags($cells[0][1]);
					$f2  = strip_tags($cells[0][2]);
					$f3  = strip_tags($cells[0][3]); 
					$f4  = strip_tags($cells[0][4]);
					$f5  = strip_tags($cells[0][5]);
					$f6  = strip_tags($cells[0][6]);
					$f7  = strip_tags($cells[0][7]);
					$f8  = strip_tags($cells[0][8]);
					$f9  = strip_tags($cells[0][9]);
					$f10 = strip_tags($cells[0][10]);
					$f11 = strip_tags($cells[0][11]);
                                           if(isset($f2) && $f2 <>'') :
					 $f2=str_replace(' ','_',$f2);
                                         array_push($gdl, $f9,"$f2 ($f3)");
                                          endif;
				   endif;
		         } // end foreach

$output = array();
foreach($gdl as $key => $value) {
// we want value 1 as key, value 2 as value. modulus baby.
  if($key % 2 > 0) { //every second item
    $index = $gdl[$key-1];
// we cannot have duplicate keys so we concatenate values to the key.
if(array_key_exists($index,$output)) {
    $output[$index] .= ', '.$value;
}
else {
    $output[$index] = $value;
}
  }
}

krsort($output);
$new=array();
reset($output);
$first=key($output);
reset($output);
$last = key( array_slice( $output, -1, 1, TRUE ) );

$i = $last;
while ($i < $first):
    if (!array_key_exists($output)):
    	   $new[$i]=" ";
	endif;
    $i++;
endwhile;
reset($output);
$output= $output + $new;
krsort($output);

// make sexy
print '<table>
<thead>
<tr>
<th>GD</th>
<th>Team</th>
</tr>
</thead>
<tbody>';
foreach($output as $key => $value) {
print '<tr><td>'.$key.'</td><td>'.$output[$key].'</td></tr>';
}
print '</table><br/><br/>';
echo '</span>';   

/******************************************************************************/
?>
</div>
</body>
</html>
