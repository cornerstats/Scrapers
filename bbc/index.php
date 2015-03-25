<html>
<body>
<h4> League Generator</h4>
		<div class="span12">
		<?php
		/******************************************************************************/
		$url='http://www.bbc.co.uk/sport/0/football/';
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_HEADER, 0);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);  //Set curl to return the data instead of printing it to the browser.
		curl_setopt($ch, CURLOPT_URL, $url);
		$raw = curl_exec($ch);
		curl_close($ch);
		$newlines=array("\t","\n","\r","\x20\x20","\0","\x0B","<br/>","<p>","</p>","<br>");
		$content=str_replace($newlines, "", html_entity_decode($raw));
                $content=str_replace('Tottenham','Spurs',$content);
                $content=str_replace('class=','',$content);
		/******************************************************************************/
		
		$start=strpos($content,'<table class="table-stats">');
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
					$f0 = strip_tags($cells[0][0]);
                                        $f1 = strip_tags($cells[0][1]);
					$f2 = strip_tags($cells[0][2]);
					$f3 = strip_tags($cells[0][3]); 
					$f4 = strip_tags($cells[0][4]);
                                        $f0 =str_replace('No movement','',$f0);
					$f0 =str_replace('Moving down','',$f0);
					$f0 =str_replace('Moving up','',$f0);
                                           if(isset($f2) && $f2 <>'') :
                                         array_push($rank,$f4,"$f1 ($f2)");
                                          endif;
				   endif;
      
	     } // end foreach

#################################################################

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
<th>Points&nbsp;&nbsp;&nbsp;&nbsp;</th>
<th>Team&nbsp;&nbsp;</th>
</tr>
</thead>
<tbody>';
foreach($output as $key => $value) {
print '<tr><td>'.$key.'</td><td>'.$output[$key].'</td></tr>';
}
print '</table><br/><br/>';
       
##############################################################################

$gdl=array();
echo '<span class="span5">';
                         
		foreach ($rows[0] as $row)
			{            
			            if ((strpos($row,'<th')===false)) :
			                // pos, team, pld, gd, pts
				    preg_match_all("|<td(.*)</td>|U",$row,$cells);
					$f0 = strip_tags($cells[0][0]);
                                        $f1 = strip_tags($cells[0][1]);
					$f2 = strip_tags($cells[0][2]);
					$f3 = strip_tags($cells[0][3]); 
					$f4 = strip_tags($cells[0][4]);
                                        $f0=str_replace('No movement','',$f0);
					$f0=str_replace('Moving down','',$f0);
					$f0=str_replace('Moving up','',$f0);
                                           if(isset($f2) && $f2 <>'') :
                                         array_push($gdl, $f3,"$f1 ($f2)");
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
?>
</div>
</body>
</html>
