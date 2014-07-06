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
$start=strpos($raw,'<image x="0" y="0" width="760" height="529" xlink:href="/sites/fourfourtwo.com/modules/custom/statzone/files/statszone_football_pitch.png" />');
$end = strpos($raw,'</svg>');
$table = substr($raw,$start,$end-$start);

// oh but wait there is loads of junk here we can strip out too
$table = str_replace('/><line class="pitch-object',"\n",$table);
$table = str_replace('marker-end="url(#smallblue)"','',$table); 
$table = str_replace('style="stroke:blue;stroke-width:3"','',$table);
$table = str_replace('style="stroke:red;stroke-width:3"','',$table);   
$table = str_replace('marker-end="url(#smallred)"','',$table);      
$table = str_replace('marker-end="url(#smalldeepskyblue)"','',$table);
$table = str_replace('style="stroke:deepskyblue;stroke-width:3"','',$table);
$table = str_replace('<image x="0" y="0" width="760" height="529" xlink:href="/sites/fourfourtwo.com/modules/custom/statzone/files/statszone_football_pitch.png"','',$table);    
    
// poop poop poop    
var_dump($table);    

}

// example url:
// http://www.fourfourtwo.com/statszone/8-2013/matches/695238/team-stats/80/1_PASS_01#tabs-wrapper-anchor


$url=$_GET['url'];

if (isset($url) && $url !== '')
{

_stato($url);
}
else
{
    echo "Enter the URL to be analysed";
}

?>
</body>
    </html>
