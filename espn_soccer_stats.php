<h4 class="entry-title">ESPN STATS LOADER</h4>
<div class="wrapper">
    <form name="form1" method="GET" action="??">
<label for="url">URL:</label>
<input name="url"   type="text" id="url" size="85">
<label for="dater">Date:</label> 
<input name="dater" type="text" id="dater" size="15">
<label for="gameid">Gameid:</label>
<input name="gamer" type="text" id="gamer" size="15">
<br/>   
<input type="submit" name="Submit" value="Submit">
    </form>
</div>
<?php
/******************************************************************************/
$url=$_GET['url'];
$gamer=$_get['gameid'];
$dater=$_get['date'];

if (isset($url) && $url !== '')
{

    __stato($url,$dater,$gamer);

}
else
{
    echo "Enter the URL to be analysed";
}

?>

<?php
/******************************************************************************/
function __stato($url,$dater,$gamer) {

$raw=file_get_contents_curl($url) or die('could not select');
$newlines=array("\t","\n","\r","\x20\x20","\0","\x0B","<br/>","<p>","</p>","<br>");
$content=str_replace($newlines, "", html_entity_decode($raw));
$content=str_replace('-','0',$content);

/******************************************************************************/

$sql="select F_ID from xxxxx where F_DATE='$dater' ";
$result=mysql_query($sql) or die ('could not select');
$value=mysql_fetch_array($result);
$num=mysql_num_rows($result);
if ($num>0)
{
  $gameid=$value['F_ID'];
}
else
{
  echo '<div class="block-message block-message-warning">Oh-noes! failure to find the date.... '.$date.'</div>';
}

/******************************************************************************/
    echo '<pre>';
$start=strpos($content,'homeTeamPlayerStats');
$end = strpos($content,'</div>');
// $end = strpos($content,'</div>',$start +47);
$table = substr($content,$start,$end-$start);
preg_match_all("|<tr(.*)</tr>|U",$table,$rows);
$table=str_replace('substitutes','<h4>substitutes!!!</h4>',$table);
foreach ($rows[0] as $row){
if ((strpos($row,'<th')===false)){
 // // sqno, name, SH ,SG ,G ,A ,OF ,FD ,FC ,SV ,YC ,RC
		preg_match_all("|<td(.*)</td>|U",$row,$cells);
		$squadnumber = strip_tags($cells[0][0]);
		$name = strip_tags($cells[0][1]); // junk and not needed.
		$SH = strip_tags($cells[0][2]);
		$SG = strip_tags($cells[0][3]);
		$G = strip_tags($cells[0][4]);
		$A = strip_tags($cells[0][5]);
		$OF = strip_tags($cells[0][6]);
		$FD = strip_tags($cells[0][7]);
		$FC = strip_tags($cells[0][8]);
		$SV = strip_tags($cells[0][9]);
		$YC = strip_tags($cells[0][10]);
		$RC = strip_tags($cells[0][11]);
		$apps = '1';
		$subs = '0';	
echo " INSERT INTO xxxxxx (`F_DATE`, fieldlist `F_GAMEID`)";

echo "<br/> VALUES ('{$date}','{$squadnumber}','{$SH}','{$SG}','{$G}','{$A}','{$OF}','{$FD}','{$FC}','{$SV}','{$YC}','{$RC}','{$apps}','{$subs}','{$gameid}');\n<br/>";
	}
        else echo ('if failed');
}
}
    echo '</pre>';
/******************************************************************************/
function file_get_contents_curl($url) {
	$ch = curl_init();

	curl_setopt($ch, CURLOPT_HEADER, 0);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); //Set curl to return the data instead of printing it to the browser.
	curl_setopt($ch, CURLOPT_URL, $url);

	$raw = curl_exec($ch);
	curl_close($ch);

	return $raw;
}
?>
