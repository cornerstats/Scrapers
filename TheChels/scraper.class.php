<?php 
class CFC_scraper {

        function stato($url) {

            echo '<pre>';
    
            $raw = $this->file_get_contents_curl($url) or die('could not select');
            $newlines=array("\t","\n","\r","\x20\x20","\0","\x0B","<br/>","<p>","</p>","<br>");
            $content=str_replace($newlines, "", html_entity_decode($raw));
            //$content=str_replace('-','0',$content);
            $start=strpos($content,'</h4>');
            $end = strpos($content,'<br>');
            $table = substr($content,$start,$end-$start);
            preg_match_all("|<tr(.*)</tr>|U",$table,$rows);


            foreach ($rows[0] as $row){
                    if ((strpos($row,'<th')===false)) {
          
                                 preg_match_all("|<td(.*)</td>|U",$row,$cells);
                                 $counter = count($cells) ."<br/>";
                                 $i = 0;
                                 $output;
                                     while ($i <= $counter) :
                                            /*
                                            foreach cell append to output or if you want to target individual cells/columns
                                            use below.
                                            $field2   = strip_tags($cells[0][1])
                                            $field3   = strip_tags($cells[0][2])
                                            otherwise we'll loop through them all...
                                            */
	                                        $output .= ($cells[0][$i]) . PHP_EOL;
                                            $i++;
		                             endwhile;


	                }

            }

	        // you can format the data as you please, this is comma seperated
	        // try an insert statement for Mysql
	        // or put into a csv or json
	        print $output .PHP_EOL;
    
            echo '</pre>';
        }


        function file_get_contents_curl($url) {
	        $ch = curl_init();
	        curl_setopt($ch, CURLOPT_HEADER, 0);
	        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); //Set curl to return the data instead of printing it to the browser.
	        curl_setopt($ch, CURLOPT_URL, $url);
            /* you made need to add proxy stuff here */
	        $raw = curl_exec($ch);
	        curl_close($ch);
	        return $raw;
        }
}
