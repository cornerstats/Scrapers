<html>
    <head>
<style>
   body { color:blue};
</style>
    </head>
<body>
<div class="wrapper">
    <form name="form1" method="GET" action="<?php ?>">
<label for="url">URL:</label>
<input name="url"   type="text" id="url" size="85">
<br/>   
<input type="submit" name="Submit" value="Submit">
    </form>
</div>
<?php
// scrappy scrapie doo

// set some php ini warnings and dump lengths etc
error_reporting(E_ALL ^ E_NOTICE);
ini_set('user_agent', 'Mozilla/5.0');
ini_set('xdebug.var_display_max_depth', 100000);
ini_set('xdebug.var_display_max_children', 512000);
ini_set('xdebug.var_display_max_data', 10240000);

// use curl to load the html

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
$start=strpos($raw,'<image x="0" y="0" width="760" height="529" xlink:href="/sites/fourfourtwo.com/modules/custom/statzone/files/statszone_football_pitch_shot.png" />');
$end = strpos($raw,'</svg>');
$table = substr($raw,$start,$end-$start);
$fname1=substr($url,52,6);
$fname2=substr($url,-1,1);
$fname=$fname1.$fname2;
// oh but wait there is loads of junk here we can strip out too
//$table = str_replace('/><line class="pitch-object',"\n",$table);
$table = str_replace('/><line class',"\n",$table);
//$table = str_replace('marker-end="url(#smallblue)"','',$table); 
$table = str_replace('style="stroke:blue;stroke-width:3"','',$table);
$table = str_replace('style="stroke:red;stroke-width:3"','',$table);   
//$table = str_replace('marker-end="url(#smallred)"','',$table);      
//$table = str_replace('marker-end="url(#smalldeepskyblue)"','',$table);
$table = str_replace('style="stroke:deepskyblue;stroke-width:3"','',$table);
//$table = str_replace('marker-end="url(#smallyellow)"','',$table);
$table = str_replace('style="stroke:yellow;stroke-width:3"','',$table);
$table = str_replace('<image x="0" y="0" width="760" height="529" xlink:href="/sites/fourfourtwo.com/modules/custom/statzone/files/statszone_football_pitch_shot.png"','',$table);    
$table = str_replace(' />','',$table);    

// poop poop poop    
//var_dump($table);    
//$arvals= explode("x1", $table);
//var_dump($pieces);  

//  header("Content-type: text/plain");
//   header("Content-Disposition: attachment; filename=savethis.txt");
//print $table;



//Get Output File
$myFile = "{$fname}.txt"; 
$myContent = $table; 

file_put_contents($myFile, utf8_encode($myContent)); 

//$fp = fopen('file.csv', 'w');

//foreach ($arvals as $fields) {
//    fputcsv($fp, $fields);
}

//fclose($fp);
//void set_time_limit ( int $seconds );
set_time_limit(2000);
$url="http://www.fourfourtwo.com/statszone/8-2013/matches/695271/team-stats/8/0_SHOT_09#A";$fname=substr($url,52,6);_stato($url);
$url="http://www.fourfourtwo.com/statszone/8-2013/matches/695272/team-stats/31/0_SHOT_09#A";$fname=substr($url,52,6);_stato($url);
$url="http://www.fourfourtwo.com/statszone/8-2013/matches/695273/team-stats/11/0_SHOT_09#A";$fname=substr($url,52,6);_stato($url);
$url="http://www.fourfourtwo.com/statszone/8-2013/matches/695274/team-stats/4/0_SHOT_09#A";$fname=substr($url,52,6);_stato($url);
$url="http://www.fourfourtwo.com/statszone/8-2013/matches/695275/team-stats/21/0_SHOT_09#A";$fname=substr($url,52,6);_stato($url);
$url="http://www.fourfourtwo.com/statszone/8-2013/matches/695276/team-stats/3/0_SHOT_09#A";$fname=substr($url,52,6);_stato($url);
$url="http://www.fourfourtwo.com/statszone/8-2013/matches/695277/team-stats/1/0_SHOT_09#A";$fname=substr($url,52,6);_stato($url);
$url="http://www.fourfourtwo.com/statszone/8-2013/matches/695278/team-stats/80/0_SHOT_09#A";$fname=substr($url,52,6);_stato($url);
$url="http://www.fourfourtwo.com/statszone/8-2013/matches/695279/team-stats/7/0_SHOT_09#A";$fname=substr($url,52,6);_stato($url);
$url="http://www.fourfourtwo.com/statszone/8-2013/matches/695280/team-stats/110/0_SHOT_09#A";$fname=substr($url,52,6);_stato($url);
$url="http://www.fourfourtwo.com/statszone/8-2013/matches/695178/team-stats/35/0_SHOT_09#A";$fname=substr($url,52,6);_stato($url);
$url="http://www.fourfourtwo.com/statszone/8-2013/matches/695185/team-stats/7/0_SHOT_09#A";$fname=substr($url,52,6);_stato($url);
$url="http://www.fourfourtwo.com/statszone/8-2013/matches/695234/team-stats/88/0_SHOT_09#A";$fname=substr($url,52,6);_stato($url);
$url="http://www.fourfourtwo.com/statszone/8-2013/matches/695264/team-stats/14/0_SHOT_09#A";$fname=substr($url,52,6);_stato($url);
$url="http://www.fourfourtwo.com/statszone/8-2013/matches/695261/team-stats/35/0_SHOT_09#A";$fname=substr($url,52,6);_stato($url);
$url="http://www.fourfourtwo.com/statszone/8-2013/matches/695263/team-stats/45/0_SHOT_09#A";$fname=substr($url,52,6);_stato($url);
$url="http://www.fourfourtwo.com/statszone/8-2013/matches/695270/team-stats/6/0_SHOT_09#A";$fname=substr($url,52,6);_stato($url);
$url="http://www.fourfourtwo.com/statszone/8-2013/matches/695262/team-stats/88/0_SHOT_09#A";$fname=substr($url,52,6);_stato($url);
$url="http://www.fourfourtwo.com/statszone/8-2013/matches/695266/team-stats/56/0_SHOT_09#A";$fname=substr($url,52,6);_stato($url);
$url="http://www.fourfourtwo.com/statszone/8-2013/matches/695267/team-stats/97/0_SHOT_09#A";$fname=substr($url,52,6);_stato($url);
$url="http://www.fourfourtwo.com/statszone/8-2013/matches/695268/team-stats/54/0_SHOT_09#A";$fname=substr($url,52,6);_stato($url);
$url="http://www.fourfourtwo.com/statszone/8-2013/matches/695269/team-stats/20/0_SHOT_09#A";$fname=substr($url,52,6);_stato($url);
$url="http://www.fourfourtwo.com/statszone/8-2013/matches/695265/team-stats/43/0_SHOT_09#A";$fname=substr($url,52,6);_stato($url);
$url="http://www.fourfourtwo.com/statszone/8-2013/matches/695251/team-stats/4/0_SHOT_09#A";$fname=substr($url,52,6);_stato($url);
$url="http://www.fourfourtwo.com/statszone/8-2013/matches/695258/team-stats/97/0_SHOT_09#A";$fname=substr($url,52,6);_stato($url);
$url="http://www.fourfourtwo.com/statszone/8-2013/matches/695254/team-stats/8/0_SHOT_09#A";$fname=substr($url,52,6);_stato($url);
$url="http://www.fourfourtwo.com/statszone/8-2013/matches/695252/team-stats/43/0_SHOT_09#A";$fname=substr($url,52,6);_stato($url);
$url="http://www.fourfourtwo.com/statszone/8-2013/matches/695256/team-stats/11/0_SHOT_09#A";$fname=substr($url,52,6);_stato($url);
$url="http://www.fourfourtwo.com/statszone/8-2013/matches/695253/team-stats/88/0_SHOT_09#A";$fname=substr($url,52,6);_stato($url);
$url="http://www.fourfourtwo.com/statszone/8-2013/matches/695257/team-stats/6/0_SHOT_09#A";$fname=substr($url,52,6);_stato($url);
$url="http://www.fourfourtwo.com/statszone/8-2013/matches/695259/team-stats/7/0_SHOT_09#A";$fname=substr($url,52,6);_stato($url);
$url="http://www.fourfourtwo.com/statszone/8-2013/matches/695260/team-stats/21/0_SHOT_09#A";$fname=substr($url,52,6);_stato($url);
$url="http://www.fourfourtwo.com/statszone/8-2013/matches/695255/team-stats/45/0_SHOT_09#A";$fname=substr($url,52,6);_stato($url);
$url="http://www.fourfourtwo.com/statszone/8-2013/matches/695246/team-stats/35/0_SHOT_09#A";$fname=substr($url,52,6);_stato($url);
$url="http://www.fourfourtwo.com/statszone/8-2013/matches/695248/team-stats/14/0_SHOT_09#A";$fname=substr($url,52,6);_stato($url);
$url="http://www.fourfourtwo.com/statszone/8-2013/matches/695245/team-stats/3/0_SHOT_09#A";$fname=substr($url,52,6);_stato($url);
$url="http://www.fourfourtwo.com/statszone/8-2013/matches/695244/team-stats/1/0_SHOT_09#A";$fname=substr($url,52,6);_stato($url);
$url="http://www.fourfourtwo.com/statszone/8-2013/matches/695249/team-stats/54/0_SHOT_09#A";$fname=substr($url,52,6);_stato($url);
$url="http://www.fourfourtwo.com/statszone/8-2013/matches/695241/team-stats/20/0_SHOT_09#A";$fname=substr($url,52,6);_stato($url);
$url="http://www.fourfourtwo.com/statszone/8-2013/matches/695242/team-stats/110/0_SHOT_09#A";$fname=substr($url,52,6);_stato($url);
$url="http://www.fourfourtwo.com/statszone/8-2013/matches/695247/team-stats/80/0_SHOT_09#A";$fname=substr($url,52,6);_stato($url);
$url="http://www.fourfourtwo.com/statszone/8-2013/matches/695250/team-stats/31/0_SHOT_09#A";$fname=substr($url,52,6);_stato($url);
$url="http://www.fourfourtwo.com/statszone/8-2013/matches/695243/team-stats/56/0_SHOT_09#A";$fname=substr($url,52,6);_stato($url);
$url="http://www.fourfourtwo.com/statszone/8-2013/matches/695157/team-stats/31/0_SHOT_09#A";$fname=substr($url,52,6);_stato($url);
$url="http://www.fourfourtwo.com/statszone/8-2013/matches/695159/team-stats/56/0_SHOT_09#A";$fname=substr($url,52,6);_stato($url);
$url="http://www.fourfourtwo.com/statszone/8-2013/matches/695240/team-stats/21/0_SHOT_09#A";$fname=substr($url,52,6);_stato($url);
$url="http://www.fourfourtwo.com/statszone/8-2013/matches/695233/team-stats/43/0_SHOT_09#A";$fname=substr($url,52,6);_stato($url);
$url="http://www.fourfourtwo.com/statszone/8-2013/matches/695238/team-stats/8/0_SHOT_09#A";$fname=substr($url,52,6);_stato($url);
$url="http://www.fourfourtwo.com/statszone/8-2013/matches/695231/team-stats/7/0_SHOT_09#A";$fname=substr($url,52,6);_stato($url);
$url="http://www.fourfourtwo.com/statszone/8-2013/matches/695232/team-stats/45/0_SHOT_09#A";$fname=substr($url,52,6);_stato($url);
$url="http://www.fourfourtwo.com/statszone/8-2013/matches/695235/team-stats/97/0_SHOT_09#A";$fname=substr($url,52,6);_stato($url);
$url="http://www.fourfourtwo.com/statszone/8-2013/matches/695236/team-stats/4/0_SHOT_09#A";$fname=substr($url,52,6);_stato($url);
$url="http://www.fourfourtwo.com/statszone/8-2013/matches/695237/team-stats/11/0_SHOT_09#A";$fname=substr($url,52,6);_stato($url);
$url="http://www.fourfourtwo.com/statszone/8-2013/matches/695239/team-stats/6/0_SHOT_09#A";$fname=substr($url,52,6);_stato($url);
$url="http://www.fourfourtwo.com/statszone/8-2013/matches/695229/team-stats/56/0_SHOT_09#A";$fname=substr($url,52,6);_stato($url);
$url="http://www.fourfourtwo.com/statszone/8-2013/matches/695224/team-stats/3/0_SHOT_09#A";$fname=substr($url,52,6);_stato($url);
$url="http://www.fourfourtwo.com/statszone/8-2013/matches/695230/team-stats/14/0_SHOT_09#A";$fname=substr($url,52,6);_stato($url);
$url="http://www.fourfourtwo.com/statszone/8-2013/matches/695226/team-stats/20/0_SHOT_09#A";$fname=substr($url,52,6);_stato($url);
$url="http://www.fourfourtwo.com/statszone/8-2013/matches/695221/team-stats/54/0_SHOT_09#A";$fname=substr($url,52,6);_stato($url);
$url="http://www.fourfourtwo.com/statszone/8-2013/matches/695222/team-stats/31/0_SHOT_09#A";$fname=substr($url,52,6);_stato($url);
$url="http://www.fourfourtwo.com/statszone/8-2013/matches/695225/team-stats/80/0_SHOT_09#A";$fname=substr($url,52,6);_stato($url);
$url="http://www.fourfourtwo.com/statszone/8-2013/matches/695227/team-stats/1/0_SHOT_09#A";$fname=substr($url,52,6);_stato($url);
$url="http://www.fourfourtwo.com/statszone/8-2013/matches/695228/team-stats/35/0_SHOT_09#A";$fname=substr($url,52,6);_stato($url);
$url="http://www.fourfourtwo.com/statszone/8-2013/matches/695223/team-stats/110/0_SHOT_09#A";$fname=substr($url,52,6);_stato($url);
$url="http://www.fourfourtwo.com/statszone/8-2013/matches/695218/team-stats/21/0_SHOT_09#A";$fname=substr($url,52,6);_stato($url);
$url="http://www.fourfourtwo.com/statszone/8-2013/matches/695213/team-stats/11/0_SHOT_09#A";$fname=substr($url,52,6);_stato($url);
$url="http://www.fourfourtwo.com/statszone/8-2013/matches/695214/team-stats/6/0_SHOT_09#A";$fname=substr($url,52,6);_stato($url);
$url="http://www.fourfourtwo.com/statszone/8-2013/matches/695215/team-stats/7/0_SHOT_09#A";$fname=substr($url,52,6);_stato($url);
$url="http://www.fourfourtwo.com/statszone/8-2013/matches/695212/team-stats/8/0_SHOT_09#A";$fname=substr($url,52,6);_stato($url);
$url="http://www.fourfourtwo.com/statszone/8-2013/matches/695216/team-stats/4/0_SHOT_09#A";$fname=substr($url,52,6);_stato($url);
$url="http://www.fourfourtwo.com/statszone/8-2013/matches/695217/team-stats/88/0_SHOT_09#A";$fname=substr($url,52,6);_stato($url);
$url="http://www.fourfourtwo.com/statszone/8-2013/matches/695219/team-stats/45/0_SHOT_09#A";$fname=substr($url,52,6);_stato($url);
$url="http://www.fourfourtwo.com/statszone/8-2013/matches/695220/team-stats/97/0_SHOT_09#A";$fname=substr($url,52,6);_stato($url);
$url="http://www.fourfourtwo.com/statszone/8-2013/matches/695211/team-stats/43/0_SHOT_09#A";$fname=substr($url,52,6);_stato($url);
$url="http://www.fourfourtwo.com/statszone/8-2013/matches/695189/team-stats/88/0_SHOT_09#A";$fname=substr($url,52,6);_stato($url);
$url="http://www.fourfourtwo.com/statszone/8-2013/matches/695184/team-stats/56/0_SHOT_09#A";$fname=substr($url,52,6);_stato($url);
$url="http://www.fourfourtwo.com/statszone/8-2013/matches/695175/team-stats/43/0_SHOT_09#A";$fname=substr($url,52,6);_stato($url);
$url="http://www.fourfourtwo.com/statszone/8-2013/matches/695186/team-stats/11/0_SHOT_09#A";$fname=substr($url,52,6);_stato($url);
$url="http://www.fourfourtwo.com/statszone/8-2013/matches/695190/team-stats/80/0_SHOT_09#A";$fname=substr($url,52,6);_stato($url);
$url="http://www.fourfourtwo.com/statszone/8-2013/matches/695209/team-stats/20/0_SHOT_09#A";$fname=substr($url,52,6);_stato($url);
$url="http://www.fourfourtwo.com/statszone/8-2013/matches/695201/team-stats/110/0_SHOT_09#A";$fname=substr($url,52,6);_stato($url);
$url="http://www.fourfourtwo.com/statszone/8-2013/matches/695203/team-stats/3/0_SHOT_09#A";$fname=substr($url,52,6);_stato($url);
$url="http://www.fourfourtwo.com/statszone/8-2013/matches/695202/team-stats/14/0_SHOT_09#A";$fname=substr($url,52,6);_stato($url);
$url="http://www.fourfourtwo.com/statszone/8-2013/matches/695204/team-stats/80/0_SHOT_09#A";$fname=substr($url,52,6);_stato($url);
$url="http://www.fourfourtwo.com/statszone/8-2013/matches/695205/team-stats/35/0_SHOT_09#A";$fname=substr($url,52,6);_stato($url);
$url="http://www.fourfourtwo.com/statszone/8-2013/matches/695206/team-stats/54/0_SHOT_09#A";$fname=substr($url,52,6);_stato($url);
$url="http://www.fourfourtwo.com/statszone/8-2013/matches/695207/team-stats/31/0_SHOT_09#A";$fname=substr($url,52,6);_stato($url);
$url="http://www.fourfourtwo.com/statszone/8-2013/matches/695208/team-stats/56/0_SHOT_09#A";$fname=substr($url,52,6);_stato($url);
$url="http://www.fourfourtwo.com/statszone/8-2013/matches/695210/team-stats/1/0_SHOT_09#A";$fname=substr($url,52,6);_stato($url);
$url="http://www.fourfourtwo.com/statszone/8-2013/matches/695195/team-stats/14/0_SHOT_09#A";$fname=substr($url,52,6);_stato($url);
$url="http://www.fourfourtwo.com/statszone/8-2013/matches/695200/team-stats/3/0_SHOT_09#A";$fname=substr($url,52,6);_stato($url);
$url="http://www.fourfourtwo.com/statszone/8-2013/matches/695194/team-stats/43/0_SHOT_09#A";$fname=substr($url,52,6);_stato($url);
$url="http://www.fourfourtwo.com/statszone/8-2013/matches/695192/team-stats/97/0_SHOT_09#A";$fname=substr($url,52,6);_stato($url);
$url="http://www.fourfourtwo.com/statszone/8-2013/matches/695193/team-stats/4/0_SHOT_09#A";$fname=substr($url,52,6);_stato($url);
$url="http://www.fourfourtwo.com/statszone/8-2013/matches/695196/team-stats/45/0_SHOT_09#A";$fname=substr($url,52,6);_stato($url);
$url="http://www.fourfourtwo.com/statszone/8-2013/matches/695197/team-stats/21/0_SHOT_09#A";$fname=substr($url,52,6);_stato($url);
$url="http://www.fourfourtwo.com/statszone/8-2013/matches/695198/team-stats/31/0_SHOT_09#A";$fname=substr($url,52,6);_stato($url);
$url="http://www.fourfourtwo.com/statszone/8-2013/matches/695199/team-stats/35/0_SHOT_09#A";$fname=substr($url,52,6);_stato($url);
$url="http://www.fourfourtwo.com/statszone/8-2013/matches/695191/team-stats/8/0_SHOT_09#A";$fname=substr($url,52,6);_stato($url);
$url="http://www.fourfourtwo.com/statszone/8-2013/matches/695188/team-stats/1/0_SHOT_09#A";$fname=substr($url,52,6);_stato($url);
$url="http://www.fourfourtwo.com/statszone/8-2013/matches/695181/team-stats/54/0_SHOT_09#A";$fname=substr($url,52,6);_stato($url);
$url="http://www.fourfourtwo.com/statszone/8-2013/matches/695183/team-stats/20/0_SHOT_09#A";$fname=substr($url,52,6);_stato($url);
$url="http://www.fourfourtwo.com/statszone/8-2013/matches/695187/team-stats/110/0_SHOT_09#A";$fname=substr($url,52,6);_stato($url);
$url="http://www.fourfourtwo.com/statszone/8-2013/matches/695182/team-stats/6/0_SHOT_09#A";$fname=substr($url,52,6);_stato($url);
$url="http://www.fourfourtwo.com/statszone/8-2013/matches/695171/team-stats/45/0_SHOT_09#A";$fname=substr($url,52,6);_stato($url);
$url="http://www.fourfourtwo.com/statszone/8-2013/matches/695179/team-stats/31/0_SHOT_09#A";$fname=substr($url,52,6);_stato($url);
$url="http://www.fourfourtwo.com/statszone/8-2013/matches/695180/team-stats/97/0_SHOT_09#A";$fname=substr($url,52,6);_stato($url);
$url="http://www.fourfourtwo.com/statszone/8-2013/matches/695172/team-stats/21/0_SHOT_09#A";$fname=substr($url,52,6);_stato($url);
$url="http://www.fourfourtwo.com/statszone/8-2013/matches/695173/team-stats/8/0_SHOT_09#A";$fname=substr($url,52,6);_stato($url);
$url="http://www.fourfourtwo.com/statszone/8-2013/matches/695174/team-stats/4/0_SHOT_09#A";$fname=substr($url,52,6);_stato($url);
$url="http://www.fourfourtwo.com/statszone/8-2013/matches/695177/team-stats/3/0_SHOT_09#A";$fname=substr($url,52,6);_stato($url);
$url="http://www.fourfourtwo.com/statszone/8-2013/matches/695176/team-stats/14/0_SHOT_09#A";$fname=substr($url,52,6);_stato($url);
$url="http://www.fourfourtwo.com/statszone/8-2013/matches/695164/team-stats/80/0_SHOT_09#A";$fname=substr($url,52,6);_stato($url);
$url="http://www.fourfourtwo.com/statszone/8-2013/matches/695166/team-stats/7/0_SHOT_09#A";$fname=substr($url,52,6);_stato($url);
$url="http://www.fourfourtwo.com/statszone/8-2013/matches/695167/team-stats/6/0_SHOT_09#A";$fname=substr($url,52,6);_stato($url);
$url="http://www.fourfourtwo.com/statszone/8-2013/matches/695162/team-stats/11/0_SHOT_09#A";$fname=substr($url,52,6);_stato($url);
$url="http://www.fourfourtwo.com/statszone/8-2013/matches/695161/team-stats/88/0_SHOT_09#A";$fname=substr($url,52,6);_stato($url);
$url="http://www.fourfourtwo.com/statszone/8-2013/matches/695165/team-stats/110/0_SHOT_09#A";$fname=substr($url,52,6);_stato($url);
$url="http://www.fourfourtwo.com/statszone/8-2013/matches/695168/team-stats/54/0_SHOT_09#A";$fname=substr($url,52,6);_stato($url);
$url="http://www.fourfourtwo.com/statszone/8-2013/matches/695169/team-stats/20/0_SHOT_09#A";$fname=substr($url,52,6);_stato($url);
$url="http://www.fourfourtwo.com/statszone/8-2013/matches/695170/team-stats/56/0_SHOT_09#A";$fname=substr($url,52,6);_stato($url);
$url="http://www.fourfourtwo.com/statszone/8-2013/matches/695163/team-stats/1/0_SHOT_09#A";$fname=substr($url,52,6);_stato($url);
$url="http://www.fourfourtwo.com/statszone/8-2013/matches/695151/team-stats/1/0_SHOT_09#A";$fname=substr($url,52,6);_stato($url);
$url="http://www.fourfourtwo.com/statszone/8-2013/matches/695154/team-stats/80/0_SHOT_09#A";$fname=substr($url,52,6);_stato($url);
$url="http://www.fourfourtwo.com/statszone/8-2013/matches/695160/team-stats/6/0_SHOT_09#A";$fname=substr($url,52,6);_stato($url);
$url="http://www.fourfourtwo.com/statszone/8-2013/matches/695158/team-stats/14/0_SHOT_09#A";$fname=substr($url,52,6);_stato($url);
$url="http://www.fourfourtwo.com/statszone/8-2013/matches/695152/team-stats/7/0_SHOT_09#A";$fname=substr($url,52,6);_stato($url);
$url="http://www.fourfourtwo.com/statszone/8-2013/matches/695153/team-stats/20/0_SHOT_09#A";$fname=substr($url,52,6);_stato($url);
$url="http://www.fourfourtwo.com/statszone/8-2013/matches/695156/team-stats/45/0_SHOT_09#A";$fname=substr($url,52,6);_stato($url);
$url="http://www.fourfourtwo.com/statszone/8-2013/matches/695155/team-stats/8/0_SHOT_09#A";$fname=substr($url,52,6);_stato($url);
$url="http://www.fourfourtwo.com/statszone/8-2013/matches/695150/team-stats/11/0_SHOT_09#A";$fname=substr($url,52,6);_stato($url);
$url="http://www.fourfourtwo.com/statszone/8-2013/matches/695145/team-stats/54/0_SHOT_09#A";$fname=substr($url,52,6);_stato($url);
$url="http://www.fourfourtwo.com/statszone/8-2013/matches/695144/team-stats/3/0_SHOT_09#A";$fname=substr($url,52,6);_stato($url);
$url="http://www.fourfourtwo.com/statszone/8-2013/matches/695141/team-stats/21/0_SHOT_09#A";$fname=substr($url,52,6);_stato($url);
$url="http://www.fourfourtwo.com/statszone/8-2013/matches/695142/team-stats/4/0_SHOT_09#A";$fname=substr($url,52,6);_stato($url);
$url="http://www.fourfourtwo.com/statszone/8-2013/matches/695143/team-stats/35/0_SHOT_09#A";$fname=substr($url,52,6);_stato($url);
$url="http://www.fourfourtwo.com/statszone/8-2013/matches/695146/team-stats/43/0_SHOT_09#A";$fname=substr($url,52,6);_stato($url);
$url="http://www.fourfourtwo.com/statszone/8-2013/matches/695147/team-stats/110/0_SHOT_09#A";$fname=substr($url,52,6);_stato($url);
$url="http://www.fourfourtwo.com/statszone/8-2013/matches/695148/team-stats/88/0_SHOT_09#A";$fname=substr($url,52,6);_stato($url);
$url="http://www.fourfourtwo.com/statszone/8-2013/matches/695149/team-stats/97/0_SHOT_09#A";$fname=substr($url,52,6);_stato($url);
$url="http://www.fourfourtwo.com/statszone/8-2013/matches/695136/team-stats/8/0_SHOT_09#A";$fname=substr($url,52,6);_stato($url);
$url="http://www.fourfourtwo.com/statszone/8-2013/matches/695139/team-stats/14/0_SHOT_09#A";$fname=substr($url,52,6);_stato($url);
$url="http://www.fourfourtwo.com/statszone/8-2013/matches/695131/team-stats/31/0_SHOT_09#A";$fname=substr($url,52,6);_stato($url);
$url="http://www.fourfourtwo.com/statszone/8-2013/matches/695137/team-stats/56/0_SHOT_09#A";$fname=substr($url,52,6);_stato($url);
$url="http://www.fourfourtwo.com/statszone/8-2013/matches/695140/team-stats/80/0_SHOT_09#A";$fname=substr($url,52,6);_stato($url);
$url="http://www.fourfourtwo.com/statszone/8-2013/matches/695132/team-stats/45/0_SHOT_09#A";$fname=substr($url,52,6);_stato($url);
$url="http://www.fourfourtwo.com/statszone/8-2013/matches/695133/team-stats/7/0_SHOT_09#A";$fname=substr($url,52,6);_stato($url);
$url="http://www.fourfourtwo.com/statszone/8-2013/matches/695134/team-stats/20/0_SHOT_09#A";$fname=substr($url,52,6);_stato($url);
$url="http://www.fourfourtwo.com/statszone/8-2013/matches/695135/team-stats/6/0_SHOT_09#A";$fname=substr($url,52,6);_stato($url);
$url="http://www.fourfourtwo.com/statszone/8-2013/matches/695138/team-stats/1/0_SHOT_09#A";$fname=substr($url,52,6);_stato($url);
$url="http://www.fourfourtwo.com/statszone/8-2013/matches/695121/team-stats/35/0_SHOT_09#A";$fname=substr($url,52,6);_stato($url);
$url="http://www.fourfourtwo.com/statszone/8-2013/matches/695127/team-stats/110/0_SHOT_09#A";$fname=substr($url,52,6);_stato($url);
$url="http://www.fourfourtwo.com/statszone/8-2013/matches/695129/team-stats/21/0_SHOT_09#A";$fname=substr($url,52,6);_stato($url);
$url="http://www.fourfourtwo.com/statszone/8-2013/matches/695130/team-stats/43/0_SHOT_09#A";$fname=substr($url,52,6);_stato($url);
$url="http://www.fourfourtwo.com/statszone/8-2013/matches/695124/team-stats/97/0_SHOT_09#A";$fname=substr($url,52,6);_stato($url);
$url="http://www.fourfourtwo.com/statszone/8-2013/matches/695125/team-stats/4/0_SHOT_09#A";$fname=substr($url,52,6);_stato($url);
$url="http://www.fourfourtwo.com/statszone/8-2013/matches/695126/team-stats/3/0_SHOT_09#A";$fname=substr($url,52,6);_stato($url);
$url="http://www.fourfourtwo.com/statszone/8-2013/matches/695128/team-stats/54/0_SHOT_09#A";$fname=substr($url,52,6);_stato($url);
$url="http://www.fourfourtwo.com/statszone/8-2013/matches/695122/team-stats/88/0_SHOT_09#A";$fname=substr($url,52,6);_stato($url);
$url="http://www.fourfourtwo.com/statszone/8-2013/matches/695123/team-stats/11/0_SHOT_09#A";$fname=substr($url,52,6);_stato($url);
$url="http://www.fourfourtwo.com/statszone/8-2013/matches/695119/team-stats/11/0_SHOT_09#A";$fname=substr($url,52,6);_stato($url);
$url="http://www.fourfourtwo.com/statszone/8-2013/matches/695118/team-stats/6/0_SHOT_09#A";$fname=substr($url,52,6);_stato($url);
$url="http://www.fourfourtwo.com/statszone/8-2013/matches/695112/team-stats/1/0_SHOT_09#A";$fname=substr($url,52,6);_stato($url);
$url="http://www.fourfourtwo.com/statszone/8-2013/matches/695117/team-stats/20/0_SHOT_09#A";$fname=substr($url,52,6);_stato($url);
$url="http://www.fourfourtwo.com/statszone/8-2013/matches/695111/team-stats/54/0_SHOT_09#A";$fname=substr($url,52,6);_stato($url);
$url="http://www.fourfourtwo.com/statszone/8-2013/matches/695113/team-stats/110/0_SHOT_09#A";$fname=substr($url,52,6);_stato($url);
$url="http://www.fourfourtwo.com/statszone/8-2013/matches/695115/team-stats/97/0_SHOT_09#A";$fname=substr($url,52,6);_stato($url);
$url="http://www.fourfourtwo.com/statszone/8-2013/matches/695116/team-stats/88/0_SHOT_09#A";$fname=substr($url,52,6);_stato($url);
$url="http://www.fourfourtwo.com/statszone/8-2013/matches/695120/team-stats/4/0_SHOT_09#A";$fname=substr($url,52,6);_stato($url);
$url="http://www.fourfourtwo.com/statszone/8-2013/matches/695114/team-stats/7/0_SHOT_09#A";$fname=substr($url,52,6);_stato($url);
$url="http://www.fourfourtwo.com/statszone/8-2013/matches/695101/team-stats/3/0_SHOT_09#A";$fname=substr($url,52,6);_stato($url);
$url="http://www.fourfourtwo.com/statszone/8-2013/matches/695107/team-stats/43/0_SHOT_09#A";$fname=substr($url,52,6);_stato($url);
$url="http://www.fourfourtwo.com/statszone/8-2013/matches/695109/team-stats/14/0_SHOT_09#A";$fname=substr($url,52,6);_stato($url);
$url="http://www.fourfourtwo.com/statszone/8-2013/matches/695105/team-stats/8/0_SHOT_09#A";$fname=substr($url,52,6);_stato($url);
$url="http://www.fourfourtwo.com/statszone/8-2013/matches/695102/team-stats/21/0_SHOT_09#A";$fname=substr($url,52,6);_stato($url);
$url="http://www.fourfourtwo.com/statszone/8-2013/matches/695103/team-stats/45/0_SHOT_09#A";$fname=substr($url,52,6);_stato($url);
$url="http://www.fourfourtwo.com/statszone/8-2013/matches/695104/team-stats/56/0_SHOT_09#A";$fname=substr($url,52,6);_stato($url);
$url="http://www.fourfourtwo.com/statszone/8-2013/matches/695108/team-stats/35/0_SHOT_09#A";$fname=substr($url,52,6);_stato($url);
$url="http://www.fourfourtwo.com/statszone/8-2013/matches/695110/team-stats/31/0_SHOT_09#A";$fname=substr($url,52,6);_stato($url);
$url="http://www.fourfourtwo.com/statszone/8-2013/matches/695106/team-stats/80/0_SHOT_09#A";$fname=substr($url,52,6);_stato($url);
$url="http://www.fourfourtwo.com/statszone/8-2013/matches/695099/team-stats/43/0_SHOT_09#A";$fname=substr($url,52,6);_stato($url);
$url="http://www.fourfourtwo.com/statszone/8-2013/matches/695091/team-stats/97/0_SHOT_09#A";$fname=substr($url,52,6);_stato($url);
$url="http://www.fourfourtwo.com/statszone/8-2013/matches/695092/team-stats/45/0_SHOT_09#A";$fname=substr($url,52,6);_stato($url);
$url="http://www.fourfourtwo.com/statszone/8-2013/matches/695093/team-stats/21/0_SHOT_09#A";$fname=substr($url,52,6);_stato($url);
$url="http://www.fourfourtwo.com/statszone/8-2013/matches/695094/team-stats/88/0_SHOT_09#A";$fname=substr($url,52,6);_stato($url);
$url="http://www.fourfourtwo.com/statszone/8-2013/matches/695096/team-stats/8/0_SHOT_09#A";$fname=substr($url,52,6);_stato($url);
$url="http://www.fourfourtwo.com/statszone/8-2013/matches/695097/team-stats/11/0_SHOT_09#A";$fname=substr($url,52,6);_stato($url);
$url="http://www.fourfourtwo.com/statszone/8-2013/matches/695098/team-stats/7/0_SHOT_09#A";$fname=substr($url,52,6);_stato($url);
$url="http://www.fourfourtwo.com/statszone/8-2013/matches/695100/team-stats/4/0_SHOT_09#A";$fname=substr($url,52,6);_stato($url);
$url="http://www.fourfourtwo.com/statszone/8-2013/matches/695095/team-stats/6/0_SHOT_09#A";$fname=substr($url,52,6);_stato($url);
$url="http://www.fourfourtwo.com/statszone/8-2013/matches/695084/team-stats/20/0_SHOT_09#A";$fname=substr($url,52,6);_stato($url);
$url="http://www.fourfourtwo.com/statszone/8-2013/matches/695087/team-stats/3/0_SHOT_09#A";$fname=substr($url,52,6);_stato($url);
$url="http://www.fourfourtwo.com/statszone/8-2013/matches/695083/team-stats/14/0_SHOT_09#A";$fname=substr($url,52,6);_stato($url);
$url="http://www.fourfourtwo.com/statszone/8-2013/matches/695089/team-stats/110/0_SHOT_09#A";$fname=substr($url,52,6);_stato($url);
$url="http://www.fourfourtwo.com/statszone/8-2013/matches/695090/team-stats/35/0_SHOT_09#A";$fname=substr($url,52,6);_stato($url);
$url="http://www.fourfourtwo.com/statszone/8-2013/matches/695081/team-stats/80/0_SHOT_09#A";$fname=substr($url,52,6);_stato($url);
$url="http://www.fourfourtwo.com/statszone/8-2013/matches/695085/team-stats/54/0_SHOT_09#A";$fname=substr($url,52,6);_stato($url);
$url="http://www.fourfourtwo.com/statszone/8-2013/matches/695086/team-stats/31/0_SHOT_09#A";$fname=substr($url,52,6);_stato($url);
$url="http://www.fourfourtwo.com/statszone/8-2013/matches/695088/team-stats/1/0_SHOT_09#A";$fname=substr($url,52,6);_stato($url);
$url="http://www.fourfourtwo.com/statszone/8-2013/matches/695082/team-stats/56/0_SHOT_09#A";$fname=substr($url,52,6);_stato($url);
$url="http://www.fourfourtwo.com/statszone/8-2013/matches/695075/team-stats/1/0_SHOT_09#A";$fname=substr($url,52,6);_stato($url);
$url="http://www.fourfourtwo.com/statszone/8-2013/matches/695071/team-stats/31/0_SHOT_09#A";$fname=substr($url,52,6);_stato($url);
$url="http://www.fourfourtwo.com/statszone/8-2013/matches/695072/team-stats/20/0_SHOT_09#A";$fname=substr($url,52,6);_stato($url);
$url="http://www.fourfourtwo.com/statszone/8-2013/matches/695073/team-stats/80/0_SHOT_09#A";$fname=substr($url,52,6);_stato($url);
$url="http://www.fourfourtwo.com/statszone/8-2013/matches/695074/team-stats/56/0_SHOT_09#A";$fname=substr($url,52,6);_stato($url);
$url="http://www.fourfourtwo.com/statszone/8-2013/matches/695077/team-stats/110/0_SHOT_09#A";$fname=substr($url,52,6);_stato($url);
$url="http://www.fourfourtwo.com/statszone/8-2013/matches/695078/team-stats/54/0_SHOT_09#A";$fname=substr($url,52,6);_stato($url);
$url="http://www.fourfourtwo.com/statszone/8-2013/matches/695079/team-stats/35/0_SHOT_09#A";$fname=substr($url,52,6);_stato($url);
$url="http://www.fourfourtwo.com/statszone/8-2013/matches/695080/team-stats/3/0_SHOT_09#A";$fname=substr($url,52,6);_stato($url);
$url="http://www.fourfourtwo.com/statszone/8-2013/matches/695076/team-stats/14/0_SHOT_09#A";$fname=substr($url,52,6);_stato($url);
$url="http://www.fourfourtwo.com/statszone/8-2013/matches/695061/team-stats/8/0_SHOT_09#A";$fname=substr($url,52,6);_stato($url);
$url="http://www.fourfourtwo.com/statszone/8-2013/matches/695066/team-stats/6/0_SHOT_09#A";$fname=substr($url,52,6);_stato($url);
$url="http://www.fourfourtwo.com/statszone/8-2013/matches/695069/team-stats/11/0_SHOT_09#A";$fname=substr($url,52,6);_stato($url);
$url="http://www.fourfourtwo.com/statszone/8-2013/matches/695064/team-stats/97/0_SHOT_09#A";$fname=substr($url,52,6);_stato($url);
$url="http://www.fourfourtwo.com/statszone/8-2013/matches/695062/team-stats/4/0_SHOT_09#A";$fname=substr($url,52,6);_stato($url);
$url="http://www.fourfourtwo.com/statszone/8-2013/matches/695063/team-stats/43/0_SHOT_09#A";$fname=substr($url,52,6);_stato($url);
$url="http://www.fourfourtwo.com/statszone/8-2013/matches/695065/team-stats/21/0_SHOT_09#A";$fname=substr($url,52,6);_stato($url);
$url="http://www.fourfourtwo.com/statszone/8-2013/matches/695067/team-stats/7/0_SHOT_09#A";$fname=substr($url,52,6);_stato($url);
$url="http://www.fourfourtwo.com/statszone/8-2013/matches/695068/team-stats/45/0_SHOT_09#A";$fname=substr($url,52,6);_stato($url);
$url="http://www.fourfourtwo.com/statszone/8-2013/matches/695070/team-stats/88/0_SHOT_09#A";$fname=substr($url,52,6);_stato($url);
$url="http://www.fourfourtwo.com/statszone/8-2013/matches/695051/team-stats/1/0_SHOT_09#A";$fname=substr($url,52,6);_stato($url);
$url="http://www.fourfourtwo.com/statszone/8-2013/matches/695058/team-stats/80/0_SHOT_09#A";$fname=substr($url,52,6);_stato($url);
$url="http://www.fourfourtwo.com/statszone/8-2013/matches/695059/team-stats/14/0_SHOT_09#A";$fname=substr($url,52,6);_stato($url);
$url="http://www.fourfourtwo.com/statszone/8-2013/matches/695056/team-stats/3/0_SHOT_09#A";$fname=substr($url,52,6);_stato($url);
$url="http://www.fourfourtwo.com/statszone/8-2013/matches/695052/team-stats/35/0_SHOT_09#A";$fname=substr($url,52,6);_stato($url);
$url="http://www.fourfourtwo.com/statszone/8-2013/matches/695053/team-stats/31/0_SHOT_09#A";$fname=substr($url,52,6);_stato($url);
$url="http://www.fourfourtwo.com/statszone/8-2013/matches/695054/team-stats/54/0_SHOT_09#A";$fname=substr($url,52,6);_stato($url);
$url="http://www.fourfourtwo.com/statszone/8-2013/matches/695057/team-stats/20/0_SHOT_09#A";$fname=substr($url,52,6);_stato($url);
$url="http://www.fourfourtwo.com/statszone/8-2013/matches/695060/team-stats/56/0_SHOT_09#A";$fname=substr($url,52,6);_stato($url);
$url="http://www.fourfourtwo.com/statszone/8-2013/matches/695055/team-stats/110/0_SHOT_09#A";$fname=substr($url,52,6);_stato($url);
$url="http://www.fourfourtwo.com/statszone/8-2013/matches/695049/team-stats/88/0_SHOT_09#A";$fname=substr($url,52,6);_stato($url);
$url="http://www.fourfourtwo.com/statszone/8-2013/matches/695043/team-stats/7/0_SHOT_09#A";$fname=substr($url,52,6);_stato($url);
$url="http://www.fourfourtwo.com/statszone/8-2013/matches/695041/team-stats/11/0_SHOT_09#A";$fname=substr($url,52,6);_stato($url);
$url="http://www.fourfourtwo.com/statszone/8-2013/matches/695045/team-stats/4/0_SHOT_09#A";$fname=substr($url,52,6);_stato($url);
$url="http://www.fourfourtwo.com/statszone/8-2013/matches/695042/team-stats/97/0_SHOT_09#A";$fname=substr($url,52,6);_stato($url);
$url="http://www.fourfourtwo.com/statszone/8-2013/matches/695044/team-stats/21/0_SHOT_09#A";$fname=substr($url,52,6);_stato($url);
$url="http://www.fourfourtwo.com/statszone/8-2013/matches/695046/team-stats/43/0_SHOT_09#A";$fname=substr($url,52,6);_stato($url);
$url="http://www.fourfourtwo.com/statszone/8-2013/matches/695047/team-stats/8/0_SHOT_09#A";$fname=substr($url,52,6);_stato($url);
$url="http://www.fourfourtwo.com/statszone/8-2013/matches/695050/team-stats/45/0_SHOT_09#A";$fname=substr($url,52,6);_stato($url);
$url="http://www.fourfourtwo.com/statszone/8-2013/matches/695048/team-stats/6/0_SHOT_09#A";$fname=substr($url,52,6);_stato($url);
$url="http://www.fourfourtwo.com/statszone/8-2013/matches/695031/team-stats/88/0_SHOT_09#A";$fname=substr($url,52,6);_stato($url);
$url="http://www.fourfourtwo.com/statszone/8-2013/matches/695033/team-stats/45/0_SHOT_09#A";$fname=substr($url,52,6);_stato($url);
$url="http://www.fourfourtwo.com/statszone/8-2013/matches/695034/team-stats/11/0_SHOT_09#A";$fname=substr($url,52,6);_stato($url);
$url="http://www.fourfourtwo.com/statszone/8-2013/matches/695035/team-stats/7/0_SHOT_09#A";$fname=substr($url,52,6);_stato($url);
$url="http://www.fourfourtwo.com/statszone/8-2013/matches/695036/team-stats/97/0_SHOT_09#A";$fname=substr($url,52,6);_stato($url);
$url="http://www.fourfourtwo.com/statszone/8-2013/matches/695037/team-stats/8/0_SHOT_09#A";$fname=substr($url,52,6);_stato($url);
$url="http://www.fourfourtwo.com/statszone/8-2013/matches/695038/team-stats/4/0_SHOT_09#A";$fname=substr($url,52,6);_stato($url);
$url="http://www.fourfourtwo.com/statszone/8-2013/matches/695039/team-stats/43/0_SHOT_09#A";$fname=substr($url,52,6);_stato($url);
$url="http://www.fourfourtwo.com/statszone/8-2013/matches/695040/team-stats/6/0_SHOT_09#A";$fname=substr($url,52,6);_stato($url);
$url="http://www.fourfourtwo.com/statszone/8-2013/matches/695032/team-stats/21/0_SHOT_09#A";$fname=substr($url,52,6);_stato($url);
$url="http://www.fourfourtwo.com/statszone/8-2013/matches/695029/team-stats/1/0_SHOT_09#A";$fname=substr($url,52,6);_stato($url);
$url="http://www.fourfourtwo.com/statszone/8-2013/matches/695025/team-stats/14/0_SHOT_09#A";$fname=substr($url,52,6);_stato($url);
$url="http://www.fourfourtwo.com/statszone/8-2013/matches/695023/team-stats/20/0_SHOT_09#A";$fname=substr($url,52,6);_stato($url);
$url="http://www.fourfourtwo.com/statszone/8-2013/matches/695026/team-stats/80/0_SHOT_09#A";$fname=substr($url,52,6);_stato($url);
$url="http://www.fourfourtwo.com/statszone/8-2013/matches/695021/team-stats/56/0_SHOT_09#A";$fname=substr($url,52,6);_stato($url);
$url="http://www.fourfourtwo.com/statszone/8-2013/matches/695022/team-stats/3/0_SHOT_09#A";$fname=substr($url,52,6);_stato($url);
$url="http://www.fourfourtwo.com/statszone/8-2013/matches/695024/team-stats/110/0_SHOT_09#A";$fname=substr($url,52,6);_stato($url);
$url="http://www.fourfourtwo.com/statszone/8-2013/matches/695028/team-stats/31/0_SHOT_09#A";$fname=substr($url,52,6);_stato($url);
$url="http://www.fourfourtwo.com/statszone/8-2013/matches/695030/team-stats/54/0_SHOT_09#A";$fname=substr($url,52,6);_stato($url);
$url="http://www.fourfourtwo.com/statszone/8-2013/matches/695027/team-stats/35/0_SHOT_09#A";$fname=substr($url,52,6);_stato($url);
$url="http://www.fourfourtwo.com/statszone/8-2013/matches/695018/team-stats/7/0_SHOT_09#A";$fname=substr($url,52,6);_stato($url);
$url="http://www.fourfourtwo.com/statszone/8-2013/matches/695015/team-stats/6/0_SHOT_09#A";$fname=substr($url,52,6);_stato($url);
$url="http://www.fourfourtwo.com/statszone/8-2013/matches/695011/team-stats/1/0_SHOT_09#A";$fname=substr($url,52,6);_stato($url);
$url="http://www.fourfourtwo.com/statszone/8-2013/matches/695012/team-stats/14/0_SHOT_09#A";$fname=substr($url,52,6);_stato($url);
$url="http://www.fourfourtwo.com/statszone/8-2013/matches/695013/team-stats/80/0_SHOT_09#A";$fname=substr($url,52,6);_stato($url);
$url="http://www.fourfourtwo.com/statszone/8-2013/matches/695014/team-stats/31/0_SHOT_09#A";$fname=substr($url,52,6);_stato($url);
$url="http://www.fourfourtwo.com/statszone/8-2013/matches/695016/team-stats/45/0_SHOT_09#A";$fname=substr($url,52,6);_stato($url);
$url="http://www.fourfourtwo.com/statszone/8-2013/matches/695017/team-stats/56/0_SHOT_09#A";$fname=substr($url,52,6);_stato($url);
$url="http://www.fourfourtwo.com/statszone/8-2013/matches/695020/team-stats/20/0_SHOT_09#A";$fname=substr($url,52,6);_stato($url);
$url="http://www.fourfourtwo.com/statszone/8-2013/matches/695019/team-stats/8/0_SHOT_09#A";$fname=substr($url,52,6);_stato($url);
$url="http://www.fourfourtwo.com/statszone/8-2013/matches/695010/team-stats/4/0_SHOT_09#A";$fname=substr($url,52,6);_stato($url);
$url="http://www.fourfourtwo.com/statszone/8-2013/matches/695008/team-stats/43/0_SHOT_09#A";$fname=substr($url,52,6);_stato($url);
$url="http://www.fourfourtwo.com/statszone/8-2013/matches/695005/team-stats/3/0_SHOT_09#A";$fname=substr($url,52,6);_stato($url);
$url="http://www.fourfourtwo.com/statszone/8-2013/matches/695009/team-stats/110/0_SHOT_09#A";$fname=substr($url,52,6);_stato($url);
$url="http://www.fourfourtwo.com/statszone/8-2013/matches/695001/team-stats/97/0_SHOT_09#A";$fname=substr($url,52,6);_stato($url);
$url="http://www.fourfourtwo.com/statszone/8-2013/matches/695002/team-stats/35/0_SHOT_09#A";$fname=substr($url,52,6);_stato($url);
$url="http://www.fourfourtwo.com/statszone/8-2013/matches/695003/team-stats/11/0_SHOT_09#A";$fname=substr($url,52,6);_stato($url);
$url="http://www.fourfourtwo.com/statszone/8-2013/matches/695004/team-stats/54/0_SHOT_09#A";$fname=substr($url,52,6);_stato($url);
$url="http://www.fourfourtwo.com/statszone/8-2013/matches/695007/team-stats/88/0_SHOT_09#A";$fname=substr($url,52,6);_stato($url);
$url="http://www.fourfourtwo.com/statszone/8-2013/matches/695006/team-stats/21/0_SHOT_09#A";$fname=substr($url,52,6);_stato($url);
$url="http://www.fourfourtwo.com/statszone/8-2013/matches/694992/team-stats/6/0_SHOT_09#A";$fname=substr($url,52,6);_stato($url);
$url="http://www.fourfourtwo.com/statszone/8-2013/matches/694991/team-stats/80/0_SHOT_09#A";$fname=substr($url,52,6);_stato($url);
$url="http://www.fourfourtwo.com/statszone/8-2013/matches/694996/team-stats/8/0_SHOT_09#A";$fname=substr($url,52,6);_stato($url);
$url="http://www.fourfourtwo.com/statszone/8-2013/matches/694993/team-stats/1/0_SHOT_09#A";$fname=substr($url,52,6);_stato($url);
$url="http://www.fourfourtwo.com/statszone/8-2013/matches/694994/team-stats/56/0_SHOT_09#A";$fname=substr($url,52,6);_stato($url);
$url="http://www.fourfourtwo.com/statszone/8-2013/matches/694995/team-stats/45/0_SHOT_09#A";$fname=substr($url,52,6);_stato($url);
$url="http://www.fourfourtwo.com/statszone/8-2013/matches/694997/team-stats/20/0_SHOT_09#A";$fname=substr($url,52,6);_stato($url);
$url="http://www.fourfourtwo.com/statszone/8-2013/matches/694998/team-stats/31/0_SHOT_09#A";$fname=substr($url,52,6);_stato($url);
$url="http://www.fourfourtwo.com/statszone/8-2013/matches/694999/team-stats/7/0_SHOT_09#A";$fname=substr($url,52,6);_stato($url);
$url="http://www.fourfourtwo.com/statszone/8-2013/matches/695000/team-stats/14/0_SHOT_09#A";$fname=substr($url,52,6);_stato($url);
$url="http://www.fourfourtwo.com/statszone/8-2013/matches/694988/team-stats/4/0_SHOT_09#A";$fname=substr($url,52,6);_stato($url);
$url="http://www.fourfourtwo.com/statszone/8-2013/matches/694982/team-stats/43/0_SHOT_09#A";$fname=substr($url,52,6);_stato($url);
$url="http://www.fourfourtwo.com/statszone/8-2013/matches/694989/team-stats/21/0_SHOT_09#A";$fname=substr($url,52,6);_stato($url);
$url="http://www.fourfourtwo.com/statszone/8-2013/matches/694990/team-stats/88/0_SHOT_09#A";$fname=substr($url,52,6);_stato($url);
$url="http://www.fourfourtwo.com/statszone/8-2013/matches/694983/team-stats/3/0_SHOT_09#A";$fname=substr($url,52,6);_stato($url);
$url="http://www.fourfourtwo.com/statszone/8-2013/matches/694981/team-stats/11/0_SHOT_09#A";$fname=substr($url,52,6);_stato($url);
$url="http://www.fourfourtwo.com/statszone/8-2013/matches/694984/team-stats/35/0_SHOT_09#A";$fname=substr($url,52,6);_stato($url);
$url="http://www.fourfourtwo.com/statszone/8-2013/matches/694985/team-stats/110/0_SHOT_09#A";$fname=substr($url,52,6);_stato($url);
$url="http://www.fourfourtwo.com/statszone/8-2013/matches/694986/team-stats/97/0_SHOT_09#A";$fname=substr($url,52,6);_stato($url);
$url="http://www.fourfourtwo.com/statszone/8-2013/matches/694987/team-stats/54/0_SHOT_09#A";$fname=substr($url,52,6);_stato($url);
$url="http://www.fourfourtwo.com/statszone/8-2013/matches/694973/team-stats/54/0_SHOT_09#A";$fname=substr($url,52,6);_stato($url);
$url="http://www.fourfourtwo.com/statszone/8-2013/matches/694971/team-stats/6/0_SHOT_09#A";$fname=substr($url,52,6);_stato($url);
$url="http://www.fourfourtwo.com/statszone/8-2013/matches/694976/team-stats/14/0_SHOT_09#A";$fname=substr($url,52,6);_stato($url);
$url="http://www.fourfourtwo.com/statszone/8-2013/matches/694972/team-stats/97/0_SHOT_09#A";$fname=substr($url,52,6);_stato($url);
$url="http://www.fourfourtwo.com/statszone/8-2013/matches/694974/team-stats/88/0_SHOT_09#A";$fname=substr($url,52,6);_stato($url);
$url="http://www.fourfourtwo.com/statszone/8-2013/matches/694975/team-stats/20/0_SHOT_09#A";$fname=substr($url,52,6);_stato($url);
$url="http://www.fourfourtwo.com/statszone/8-2013/matches/694977/team-stats/35/0_SHOT_09#A";$fname=substr($url,52,6);_stato($url);
$url="http://www.fourfourtwo.com/statszone/8-2013/matches/694978/team-stats/56/0_SHOT_09#A";$fname=substr($url,52,6);_stato($url);
$url="http://www.fourfourtwo.com/statszone/8-2013/matches/694980/team-stats/45/0_SHOT_09#A";$fname=substr($url,52,6);_stato($url);
$url="http://www.fourfourtwo.com/statszone/8-2013/matches/694979/team-stats/43/0_SHOT_09#A";$fname=substr($url,52,6);_stato($url);
$url="http://www.fourfourtwo.com/statszone/8-2013/matches/694966/team-stats/8/0_SHOT_09#A";$fname=substr($url,52,6);_stato($url);
$url="http://www.fourfourtwo.com/statszone/8-2013/matches/694967/team-stats/80/0_SHOT_09#A";$fname=substr($url,52,6);_stato($url);
$url="http://www.fourfourtwo.com/statszone/8-2013/matches/694969/team-stats/21/0_SHOT_09#A";$fname=substr($url,52,6);_stato($url);
$url="http://www.fourfourtwo.com/statszone/8-2013/matches/694970/team-stats/3/0_SHOT_09#A";$fname=substr($url,52,6);_stato($url);
$url="http://www.fourfourtwo.com/statszone/8-2013/matches/694965/team-stats/11/0_SHOT_09#A";$fname=substr($url,52,6);_stato($url);
$url="http://www.fourfourtwo.com/statszone/8-2013/matches/694961/team-stats/4/0_SHOT_09#A";$fname=substr($url,52,6);_stato($url);
$url="http://www.fourfourtwo.com/statszone/8-2013/matches/694962/team-stats/110/0_SHOT_09#A";$fname=substr($url,52,6);_stato($url);
$url="http://www.fourfourtwo.com/statszone/8-2013/matches/694963/team-stats/7/0_SHOT_09#A";$fname=substr($url,52,6);_stato($url);
$url="http://www.fourfourtwo.com/statszone/8-2013/matches/694964/team-stats/31/0_SHOT_09#A";$fname=substr($url,52,6);_stato($url);
$url="http://www.fourfourtwo.com/statszone/8-2013/matches/694968/team-stats/1/0_SHOT_09#A";$fname=substr($url,52,6);_stato($url);
$url="http://www.fourfourtwo.com/statszone/8-2013/matches/694952/team-stats/4/0_SHOT_09#A";$fname=substr($url,52,6);_stato($url);
$url="http://www.fourfourtwo.com/statszone/8-2013/matches/694957/team-stats/45/0_SHOT_09#A";$fname=substr($url,52,6);_stato($url);
$url="http://www.fourfourtwo.com/statszone/8-2013/matches/694958/team-stats/14/0_SHOT_09#A";$fname=substr($url,52,6);_stato($url);
$url="http://www.fourfourtwo.com/statszone/8-2013/matches/694960/team-stats/8/0_SHOT_09#A";$fname=substr($url,52,6);_stato($url);
$url="http://www.fourfourtwo.com/statszone/8-2013/matches/694951/team-stats/43/0_SHOT_09#A";$fname=substr($url,52,6);_stato($url);
$url="http://www.fourfourtwo.com/statszone/8-2013/matches/694953/team-stats/97/0_SHOT_09#A";$fname=substr($url,52,6);_stato($url);
$url="http://www.fourfourtwo.com/statszone/8-2013/matches/694954/team-stats/21/0_SHOT_09#A";$fname=substr($url,52,6);_stato($url);
$url="http://www.fourfourtwo.com/statszone/8-2013/matches/694955/team-stats/35/0_SHOT_09#A";$fname=substr($url,52,6);_stato($url);
$url="http://www.fourfourtwo.com/statszone/8-2013/matches/694956/team-stats/31/0_SHOT_09#A";$fname=substr($url,52,6);_stato($url);
$url="http://www.fourfourtwo.com/statszone/8-2013/matches/694959/team-stats/3/0_SHOT_09#A";$fname=substr($url,52,6);_stato($url);
$url="http://www.fourfourtwo.com/statszone/8-2013/matches/694943/team-stats/80/0_SHOT_09#A";$fname=substr($url,52,6);_stato($url);
$url="http://www.fourfourtwo.com/statszone/8-2013/matches/694950/team-stats/110/0_SHOT_09#A";$fname=substr($url,52,6);_stato($url);
$url="http://www.fourfourtwo.com/statszone/8-2013/matches/694941/team-stats/6/0_SHOT_09#A";$fname=substr($url,52,6);_stato($url);
$url="http://www.fourfourtwo.com/statszone/8-2013/matches/694945/team-stats/1/0_SHOT_09#A";$fname=substr($url,52,6);_stato($url);
$url="http://www.fourfourtwo.com/statszone/8-2013/matches/694947/team-stats/7/0_SHOT_09#A";$fname=substr($url,52,6);_stato($url);
$url="http://www.fourfourtwo.com/statszone/8-2013/matches/694944/team-stats/20/0_SHOT_09#A";$fname=substr($url,52,6);_stato($url);
$url="http://www.fourfourtwo.com/statszone/8-2013/matches/694946/team-stats/88/0_SHOT_09#A";$fname=substr($url,52,6);_stato($url);
$url="http://www.fourfourtwo.com/statszone/8-2013/matches/694948/team-stats/56/0_SHOT_09#A";$fname=substr($url,52,6);_stato($url);
$url="http://www.fourfourtwo.com/statszone/8-2013/matches/694949/team-stats/11/0_SHOT_09#A";$fname=substr($url,52,6);_stato($url);
$url="http://www.fourfourtwo.com/statszone/8-2013/matches/694942/team-stats/54/0_SHOT_09#A";$fname=substr($url,52,6);_stato($url);
$url="http://www.fourfourtwo.com/statszone/8-2013/matches/694939/team-stats/14/0_SHOT_09#A";$fname=substr($url,52,6);_stato($url);
$url="http://www.fourfourtwo.com/statszone/8-2013/matches/694936/team-stats/21/0_SHOT_09#A";$fname=substr($url,52,6);_stato($url);
$url="http://www.fourfourtwo.com/statszone/8-2013/matches/694935/team-stats/31/0_SHOT_09#A";$fname=substr($url,52,6);_stato($url);
$url="http://www.fourfourtwo.com/statszone/8-2013/matches/694931/team-stats/4/0_SHOT_09#A";$fname=substr($url,52,6);_stato($url);
$url="http://www.fourfourtwo.com/statszone/8-2013/matches/694933/team-stats/35/0_SHOT_09#A";$fname=substr($url,52,6);_stato($url);
$url="http://www.fourfourtwo.com/statszone/8-2013/matches/694934/team-stats/97/0_SHOT_09#A";$fname=substr($url,52,6);_stato($url);
$url="http://www.fourfourtwo.com/statszone/8-2013/matches/694937/team-stats/43/0_SHOT_09#A";$fname=substr($url,52,6);_stato($url);
$url="http://www.fourfourtwo.com/statszone/8-2013/matches/694938/team-stats/3/0_SHOT_09#A";$fname=substr($url,52,6);_stato($url);
$url="http://www.fourfourtwo.com/statszone/8-2013/matches/694940/team-stats/45/0_SHOT_09#A";$fname=substr($url,52,6);_stato($url);
$url="http://www.fourfourtwo.com/statszone/8-2013/matches/694932/team-stats/8/0_SHOT_09#A";$fname=substr($url,52,6);_stato($url);
$url="http://www.fourfourtwo.com/statszone/8-2013/matches/694924/team-stats/1/0_SHOT_09#A";$fname=substr($url,52,6);_stato($url);
$url="http://www.fourfourtwo.com/statszone/8-2013/matches/694928/team-stats/80/0_SHOT_09#A";$fname=substr($url,52,6);_stato($url);
$url="http://www.fourfourtwo.com/statszone/8-2013/matches/694930/team-stats/6/0_SHOT_09#A";$fname=substr($url,52,6);_stato($url);
$url="http://www.fourfourtwo.com/statszone/8-2013/matches/694925/team-stats/88/0_SHOT_09#A";$fname=substr($url,52,6);_stato($url);
$url="http://www.fourfourtwo.com/statszone/8-2013/matches/694921/team-stats/11/0_SHOT_09#A";$fname=substr($url,52,6);_stato($url);
$url="http://www.fourfourtwo.com/statszone/8-2013/matches/694926/team-stats/54/0_SHOT_09#A";$fname=substr($url,52,6);_stato($url);
$url="http://www.fourfourtwo.com/statszone/8-2013/matches/694927/team-stats/20/0_SHOT_09#A";$fname=substr($url,52,6);_stato($url);
$url="http://www.fourfourtwo.com/statszone/8-2013/matches/694929/team-stats/110/0_SHOT_09#A";$fname=substr($url,52,6);_stato($url);
$url="http://www.fourfourtwo.com/statszone/8-2013/matches/694923/team-stats/56/0_SHOT_09#A";$fname=substr($url,52,6);_stato($url);
$url="http://www.fourfourtwo.com/statszone/8-2013/matches/694916/team-stats/8/0_SHOT_09#A";$fname=substr($url,52,6);_stato($url);
$url="http://www.fourfourtwo.com/statszone/8-2013/matches/694912/team-stats/43/0_SHOT_09#A";$fname=substr($url,52,6);_stato($url);
$url="http://www.fourfourtwo.com/statszone/8-2013/matches/694920/team-stats/80/0_SHOT_09#A";$fname=substr($url,52,6);_stato($url);
$url="http://www.fourfourtwo.com/statszone/8-2013/matches/694914/team-stats/3/0_SHOT_09#A";$fname=substr($url,52,6);_stato($url);
$url="http://www.fourfourtwo.com/statszone/8-2013/matches/694913/team-stats/35/0_SHOT_09#A";$fname=substr($url,52,6);_stato($url);
$url="http://www.fourfourtwo.com/statszone/8-2013/matches/694915/team-stats/45/0_SHOT_09#A";$fname=substr($url,52,6);_stato($url);
$url="http://www.fourfourtwo.com/statszone/8-2013/matches/694917/team-stats/21/0_SHOT_09#A";$fname=substr($url,52,6);_stato($url);
$url="http://www.fourfourtwo.com/statszone/8-2013/matches/694918/team-stats/56/0_SHOT_09#A";$fname=substr($url,52,6);_stato($url);
$url="http://www.fourfourtwo.com/statszone/8-2013/matches/694919/team-stats/31/0_SHOT_09#A";$fname=substr($url,52,6);_stato($url);
$url="http://www.fourfourtwo.com/statszone/8-2013/matches/694911/team-stats/14/0_SHOT_09#A";$fname=substr($url,52,6);_stato($url);
$url="http://www.fourfourtwo.com/statszone/8-2013/matches/694922/team-stats/7/0_SHOT_09#A";$fname=substr($url,52,6);_stato($url);
$url="http://www.fourfourtwo.com/statszone/8-2013/matches/694905/team-stats/4/0_SHOT_09#A";$fname=substr($url,52,6);_stato($url);
$url="http://www.fourfourtwo.com/statszone/8-2013/matches/694903/team-stats/6/0_SHOT_09#A";$fname=substr($url,52,6);_stato($url);
$url="http://www.fourfourtwo.com/statszone/8-2013/matches/694902/team-stats/88/0_SHOT_09#A";$fname=substr($url,52,6);_stato($url);
$url="http://www.fourfourtwo.com/statszone/8-2013/matches/694904/team-stats/110/0_SHOT_09#A";$fname=substr($url,52,6);_stato($url);
$url="http://www.fourfourtwo.com/statszone/8-2013/matches/694906/team-stats/11/0_SHOT_09#A";$fname=substr($url,52,6);_stato($url);
$url="http://www.fourfourtwo.com/statszone/8-2013/matches/694907/team-stats/54/0_SHOT_09#A";$fname=substr($url,52,6);_stato($url);
$url="http://www.fourfourtwo.com/statszone/8-2013/matches/694909/team-stats/20/0_SHOT_09#A";$fname=substr($url,52,6);_stato($url);
$url="http://www.fourfourtwo.com/statszone/8-2013/matches/694910/team-stats/97/0_SHOT_09#A";$fname=substr($url,52,6);_stato($url);
$url="http://www.fourfourtwo.com/statszone/8-2013/matches/695281/team-stats/7/0_SHOT_09#A";$fname=substr($url,52,6);_stato($url);
$url="http://www.fourfourtwo.com/statszone/8-2013/matches/694908/team-stats/1/0_SHOT_09#A";$fname=substr($url,52,6);_stato($url);

// example url:
// http://www.fourfourtwo.com/statszone/8-2013/matches/695238/team-stats/80/0_SHOT_01#tabs-wrapper-anchor








?>
</body>
    </html>