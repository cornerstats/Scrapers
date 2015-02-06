<html>
<body>
<h4 class="entry-title">ChelseaStats Web Scraper</h4>
<p>Scrapping the the first data table on a page from https://www.thechels.co.uk.</p>
<div class="wrapper">
    <form name="form1" method="POST" action="<?php echo PHP_SELF; ?>">
        <label for="url">Enter the url of the page to be scrapped:</label>
        <input name="url"   type="text" id="url" size="85">
        <input type="submit" name="Submit" value="Submit">
    </form>
</div>
<?php
/******************************************************************************/
require('scraper.class.php');

$cfc = new cfc_scraper();
$url=$_GET['url'];
    if (isset($url) && $url !== '') {
        // do function - see below
        $cfc->stato($url);
    }
    else {
        echo "Enter the URL to be analysed";
    }
/******************************************************************************/
?>
</body>
</html>
