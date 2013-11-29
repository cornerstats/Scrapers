<div class="one_full">
<h4 class="entry-title">IMDB Scraper</h4>
<?php
//Get data in local variable
$submit=$_GET['Submit'];
$v01=$_GET['F01'];
$v02=$_GET['F02'];
$v01=strtoupper($_GET['F01']);
if ( isset($v01) && $v01!=="" && $v02!=="")
{
//Get header and class file
include("class.imdb.php"); 
//init class and function
$imdb= new Imdb();
$moviearray=$imdb->getMovieInfo('$v01');
//create the variables
$X1=$moviearray['title'];
// these are the useful ones
$U1=$moviearray['year'];
$U2=$moviearray['title_id'];
$value=$moviearray['directors'];
$U3=is_array($value)?implode(",",$value):$value;
$U4=$moviearray['runtime'];
$U5=$moviearray['rating'];

$query="INSERT INTO xxxxxxxx (F_TITLE,F_YEAR,F_IMDB,F_DIRECTOR,F_RUNTIME,F_RATING,F_IMDB_RATED) 
        VALUES ('$v01','$U1','$U2','$U3','$U4','$U5','$v02')";
$result=mysql_query($query) or die(mysql_error());
// ENDS
echo "<h3>1 record added for $v01 : $v02</h3>
      <ul><li>$U1</li><li>$U2</li><li>$U3</li><li>$v02</li><li>$U4</li></ul>";

define("CONSUMER_KEY", "yVxxxxxxxxxxxag");
define("CONSUMER_SECRET", "TxxxxxxxxhXqM");
define("OAUTH_TOKEN", "1xxxxxxxxxnVG");
define("OAUTH_SECRET", "xxxxxxxxxxxxx");
$connection = new TwitterOAuth(CONSUMER_KEY, CONSUMER_SECRET, OAUTH_TOKEN, OAUTH_SECRET);
$content = $connection->get('account/verify_credentials');
$connection->post('statuses/update', array('status' => 'Watched '.$v01.' & rated it '.$v02.' / 10  . '));

echo '<div class="block-message block-message-success">" Watched '.$v01.' & rated it '.$v02.' / 10  . "</div>';
?>
<br/><br/>
<a href="/insert-film/" class="btn primary">add another</a>
<br/><br/>
<?php }  else  { ?>   
<form method="GET" action=" ??">
    <label for="name">Film:</label>
        <input type="text" name="F01" value=""/>
    <label for="email">Rating (0-10):</label>
        <input type="text" name="F02" value=""/>
        <br/>      
        <br/>
    <input type="submit" tabindex="3" name="Submit" value="Submit" />
</form>	   
<?php 
    }
?>
</div>
