<?php
// whoscored shots analysis
$url='live.html';
// set some php ini warnings and dump lengths etc
error_reporting(E_ALL ^ E_NOTICE);
ini_set('user_agent', 'Mozilla/5.0');
ini_set('xdebug.var_display_max_depth', 100000);
ini_set('xdebug.var_display_max_children', 512000);
ini_set('xdebug.var_display_max_data', 10240000);

    
_stato($url);

/******************************************************************************/
function _stato($url) {
        $raw=file_get_contents_curl($url) or die('could not select');
        $newlines=array("\t","\n","\r","\x20\x20","\0","\x0B","<br/>","<p>","</p>","<br>");
        $content=str_replace($newlines, "", html_entity_decode($raw));
        $content=str_replace('-','0',$content);
        echo '<pre>';
        $start=strpos($content,'commentaryUpdater');
        $end = strpos($content,'Comments');
        $table = substr($content,$start,$end-$start);
        $table=str_replace('commentaryUpdater.load([[','',$content);
        $table=str_replace('comments','',$content);    
        $table=str_replace('[',"\n".'[',$content);
        print $table;    
        echo '</pre>';
}

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
