<?php
// whoscored shots analysis
$url='ucl.js';
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
        // $newlines=array("\t","\n","\r","\x20\x20","\0","\x0B","<br/>","<p>","</p>","<br>");
        $newlines=array("<br>");
        $content=str_replace($newlines, "", html_entity_decode($raw));
        $content=str_replace('-','0',$content);
        echo '<pre>';
$content=str_replace('"protected" : false,','',$content);
$content=str_replace('"screen_name" :','',$content);    
$content=str_replace('"verified" : false','',$content);
$content=str_replace('"geo" : { },','',$content);   
$content=str_replace('"source" : ','',$content);      
$content=str_replace('}, {','',$content);            
$content=str_replace('"id_str" :','',$content);
$content=str_replace('"139809966",','',$content);
$content=str_replace('"https:\/\/pbs.twimg.com\/profile_images\/1533349463\/stats_normal.jpg",','',$content);
$content=str_replace('"id" : 139809966,','',$content);
$content=str_replace('"verified" : false','',$content);
$content=str_replace('"profile_image_url_https" : ','',$content);
$content=str_replace('"entities" : {
    "user_mentions" : [ ],
    "media" : [ ],
    "hashtags" : [ ],
    "urls" : [ ]
  },','',$content); 

$content=str_replace('"user" : {
    "name" : "Chelsea Stats",
     "ChelseaStats",','',$content);
$content=str_replace('"\u003Ca href=\"http:\/\/tapbots.com\/tweetbot\" rel=\"nofollow\"\u003ETweetbot for iOS\u003C\/a\u003E",','',$content);   
$newlines=array("\t","\n","\r","\x20\x20","\0","\x0B","<br/>","<p>","</p>","<br>");    
$content=str_replace($newlines,'',$content); 
$content=str_replace('text','<br/>',$content);    
$content=str_replace(' : ',',',$content);       

$content=str_replace('"created_at"','',$content);     
$content=str_replace('"ChelseaStats"','',$content);     
$content=str_replace('"in_reply_to_status_id"','',$content);     
$content=str_replace('"','',$content);    
 
        print $content;    
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
