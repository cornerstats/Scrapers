<?php
/******************************************************************************/
$url = array(
'http://fulltime.thefa.com/ListPublicResult.do?selectedFixtureGroupKey=1_2744919&selectedRelatedFixtureOption=2&selectedClub=&selectedTeam=6968181&selectedDateCode=all&selectednavpage1=All&navPageNumber1=1&previousSelectedFixtureGroupKey=1_2744919&previousSelectedClub=&seasonID=1033162&selectedSeason=1033162',
    
'http://fulltime.thefa.com/ListPublicResult.do?selectedFixtureGroupKey=1_7724688&selectedRelatedFixtureOption=2&selectedClub=&selectedTeam=6968181&selectedDateCode=all&selectednavpage1=All&navPageNumber1=All&previousSelectedFixtureGroupKey=1_7724688&previousSelectedClub=&seasonID=1303354&selectedSeason=1303354', 
    
'http://fulltime.thefa.com/ListPublicResult.do?selectedFixtureGroupKey=1_7168040&selectedRelatedFixtureOption=2&selectedClub=&selectedTeam=6968181&selectedDateCode=all&selectednavpage1=All&navPageNumber1=1&previousSelectedFixtureGroupKey=1_7168040&previousSelectedClub=&seasonID=4784342&selectedSeason=4784342', 
    
'http://fulltime.thefa.com/ListPublicResult.do?selectedFixtureGroupKey=1_9511663&selectedRelatedFixtureOption=2&selectedClub=&selectedTeam=6968181&selectedDateCode=all&selectednavpage1=All&navPageNumber1=1&previousSelectedFixtureGroupKey=1_9511663&previousSelectedClub=&seasonID=908183&selectedSeason=908183',
    
'http://fulltime.thefa.com/ListPublicResult.do?selectedFixtureGroupKey=1_9669444&selectedRelatedFixtureOption=2&selectedClub=&selectedTeam=6968181&selectedDateCode=all&selectednavpage1=All&navPageNumber1=1&previousSelectedFixtureGroupKey=1_9669444&previousSelectedClub=&seasonID=1127981&selectedSeason=1127981',
    
'http://fulltime.thefa.com/ListPublicResult.do?selectedFixtureGroupKey=1_2629368&selectedRelatedFixtureOption=2&selectedClub=&selectedTeam=6968181&selectedDateCode=all&selectednavpage1=All&navPageNumber1=1&previousSelectedFixtureGroupKey=1_2629368&previousSelectedClub=&seasonID=2497014&selectedSeason=2497014',
    
'http://fulltime.thefa.com/ListPublicResult.do?selectedFixtureGroupKey=1_6636377&selectedRelatedFixtureOption=2&selectedClub=&selectedTeam=6968181&selectedDateCode=all&selectednavpage1=All&navPageNumber1=1&previousSelectedFixtureGroupKey=1_6636377&previousSelectedClub=&seasonID=5890115&selectedSeason=5890115',
    
'http://fulltime.thefa.com/ListPublicResult.do?selectedRelatedFixtureOption=2&selectedDateCode=all&selectedFixtureGroupKey=&selectedTeam=2303629&divisionseason=7417834&league=872938'
     
    );
foreach ($url as $value) {
     __stato($value);
     echo "<br/>***<br/>";
}


/******************************************************************************/

function __stato($url) {
print ('<br/><br/><table><thead>
<th>COMP</th>
<th>LOC</th>
<th>DATE</th>
<th>TIME</th>
<th>RES</th>
<th>FOR</th>
<th>AGAINST</th>
<th>OPP</th>
        </thead><tbody>');
$raw=file_get_contents($url) or die('could not select');
$newlines=array("\t","\n","\r","\x20\x20","\0","\x0B","<br/>");
$content=str_replace($newlines, "", html_entity_decode($raw));
$content=str_replace(' - ', ',',$content);
/******************************************************************************/
$start=strpos($content,'<tbody> ');
$end = strpos($content,'</tbody>');
$table = substr($content,$start,$end-$start);
preg_match_all("|<tr(.*)</tr>|U",$table,$rows);
foreach ($rows[0] as $row){
if ((strpos($row,'<th')===false)){
 // array to vars
		preg_match_all("|<td(.*)</td>|U",$row,$cells);
		$junk = strip_tags($cells[0][0]); // junk and not needed.
		$junk2 = strip_tags($cells[0][1]);  // junk and not needed.
		$date = str_replace(' ',',',strip_tags($cells[0][2]));
        $date = preg_split("/[\s,]+/",$date);
        $res = strip_tags($cells[0][4]);
        $res = preg_split("/[\s,]+/",$res);
        $home = strtoupper(strip_tags($cells[0][3]));
		$junk3= strip_tags($cells[0][5]); // junk and not needed.
        $away = strtoupper(strip_tags($cells[0][6]));
        $comp = strtoupper(strip_tags($cells[0][7]));
    
 if ($away=='CHELSEA LFC' || $away=='CHELSEA LFC (RESERVES)' ) {
   $loc = 'A';
   $for = $res[2];
   $against = $res[1];
   $opp=$home;
   
   }      
 else {
   $loc = 'H';
   $for = $res[1];
   $against = $res[2];
   $opp=$away;
 }
 
 $sum = $for-$against;
 if ( $sum > 0) {
   $result='W';
 }
else if ( $sum == 0) {
  $result='D';
}
else {
  $result='L';
}

 
 echo "<tr><td>{$comp}</td><td>{$loc}</td><td>{$date[0]}</td><td>{$date[1]}</td>
        <td>{$result}</td><td>{$for}</td><td>{$against}</td><td>{$opp}</td></tr>";
	}
}
print ('</tbody></table>');
}
?>
