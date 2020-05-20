<?php
require('phpQuery/phpQuery.php');

// $typec $limit $URL
 $maxiterations = $argv[1];
 $URL     = $argv[2];
 $description = "Description";
 $mysql_host = 'undcsmysql.mysql.database.azure.com';
 $mysql_username = 'b.shrestha@undcsmysql';
 $mysql_password = 'bshrestha9152';
 $mysql_database = 'b_shrestha';
 $conn = mysqli_connect( $mysql_host, $mysql_username, $mysql_password, $mysql_database );
// $URL = "https://www.w3schools.com/xml/";
 // Our 2 global arrays containing our links to be crawled.
 $already_crawled = array();
 $crawling = array();
file_put_contents('result.txt', '');
file_put_contents('final.txt', '');
file_put_contents('copy_result.txt', '');
file_put_contents('resultfile.txt', '');

// $cmd = "lynx -listonly -nonumbers -unique_urls -dump '" . $URL . "'  | sort | uniq | grep -oe '". $URL . "[^ ]*' > result.txt";
 $cmd = "lynx -listonly -nonumbers -dump '" . $URL . "' | uniq | sort |";
 $cmd.= "grep -oe '" . $URL . "[^ ]*' > result.txt";
 system( "chmod 777 result.txt ../../515/2/" );
 system( $cmd );

// $final = file("result.txt", FILE_IGNORE_NEW_LINES);
 system("sort result.txt copy_result.txt | uniq > final.txt");
 system("cat final.txt > copy_result.txt");
 array_push($alreadyCrawled,$URL);
 $final = file("final.txt", FILE_IGNORE_NEW_LINES);
 echo count($final);

 // Give our function access to our crawl arrays.
 $count = count($final);
 echo "after this";
 echo $count;
 if($count<$maxiterations){
        $final = file("final.txt", FILE_IGNORE_NEW_LINES);

        echo $count;
        for ($i = 0; $i < count($final); $i++){
                if (!in_array($final, $already_crawled)) {
                        if ($i <=$maxiterations) {

                           $cmd = "lynx -listonly -nonumbers -dump '" . $final[$i] . "'  | sort | uniq | grep -oe '". $URL . "[^ ]*' > result.txt";
                           system( "chmod 777 result.txt ../../515/2/" );
                           system( $cmd );
                           system("sort result.txt copy_result.txt | uniq > final.txt");
                           system("cat final.txt > copy_result.txt");
                           array_push($already_crawled,$final[$i]);
                           $final = file("final.txt", FILE_IGNORE_NEW_LINES);

                        }else{
                           break;
                        }
                }
        }
}
echo $cmd;
$final = file("final.txt", FILE_IGNORE_NEW_LINES);
 echo "<pre>";
echo count($final);
echo "k cha";
 echo "</pre>";
                        $myhashmap = array();

       for ($i = 1; $i < count($final); $i++){
           if ($i <= $maxiterations) {

                 echo $final[$i];
		$cmd = "lynx -dump -source '" . $final[$i] . "' > resultfile.txt";
                           system( "chmod 777 resultfile.txt ../../515/2/" );
			echo $cmd;
                           system( $cmd );
                            file_put_contents('finalfile.txt', '');

                            file_put_contents('finalfilestop.txt', '');
                           //system("sort resultfile.txt copy_resultfile.txt | uniq > finalfile.txt");
                           system("cat resultfile.txt > finalfile.txt");

                           $finalline = file("finalfile.txt", FILE_IGNORE_NEW_LINES);

			    $command = escapeshellcmd('python test.py ');
			    $output = shell_exec($command);
                           $command = escapeshellcmd('python test1.py ');
                            $output = shell_exec($command);
//echo $output;
		//	system("chmod +x test.py");

			   $finalstopwords = file("finalfilestop.txt", FILE_IGNORE_NEW_LINES);

			   $file = file_get_contents('finalfiles.txt', true);
//echo $file;
	                   $array = explode(" ",$file);

                           $myhashmaps = array_count_values(explode(" ",$file));
			   arsort($myhashmaps);
			   $st = 50;
			  	foreach($myhashmaps as $x => $x_value) {
	                        

				  echo "Key=" . $x . ", Value=" . $x_value;
			  echo "<br>";
  //$options = array('http'=>array('method'=>"GET", 'headers'=>"User-Agent: howBot/0.1\n"));
    //            $context = stream_context_create($options);
      //          $doc = new DOMDocument();
        //        @$doc->loadHTML(@file_get_contents($final[$i], false, $context));
          //      $nodes = $doc->getElementsByTagName("*");
//
  //    foreach ($nodes as $node) {
    //      if ($node->tagName=='div'){
//            $node->nodeValue .= "new content";
      //    }
     // }

//      $co//ntent = $doc->saveHTML();
//$content =  htmlspecialchars($content);
// echo strip_tags($content);
//echo strip_tags_content($content);
//$text = preg_replace('/(<script[^>]*>.+?<\/script>|<style[^>]*>.+?<\/style>)/s', '', $content);
//echo $text;
//$html = preg_replace('#<script(.*?)>(.*?)</script>#is', '', $text);
//$output = preg_replace('/(<[^>]+) style=".*?"/i', '$1', $html);
//echo $output;
// echo strip_tags($output);





 $sql = "SELECT kwID FROM keywords WHERE keyword='$x';";
                echo( $sql . "\n\n" );
                $result = $conn->query( $sql );
                if ( $result->num_rows > 0 )
                        while( $row = $result->fetch_assoc( ) )
                        $kwID = $row['kwID'];
                else {
                      	$sql = "INSERT INTO keywords( keyword ) VALUES ( '$x' );";

                        echo( $sql . "\n\n" );
                        $conn->query( $sql );
                        $sql = "SELECT kwID FROM keywords WHERE keyword='$x';";

                        echo( $sql . "\n\n" );
                        $result = $conn->query( $sql );

                        if ( $result->num_rows > 0 )
                        while( $row = $result->fetch_assoc( ) )
                        $kwID = $row['kwID'];
                }
//if(++$st == 80) break;



//    echo $output;



              // The array that we pass to stream_context_create() to modify our User Agent.
                $options = array('http'=>array('method'=>"GET", 'headers'=>"User-Agent: howBot/0.1\n"));
                $context = stream_context_create($options);
                $doc = new DOMDocument();
                @$doc->loadHTML(@file_get_contents($final[$i], false, $context));

                // Create an array of all of the title tags.
                $title = $doc->getElementsByTagName("title");
                // There should only be one <title> on each page, so our array should have only 1 element.
                $title = $title->item(0)->nodeValue;
                // Give $description and $keywords no value initially. We do this to prevent errors.
                $description = "";
                $keywords = "";
                // Create an array of all of the pages <meta> tags. There will probably be lots of these.
                $metas = $doc->getElementsByTagName("meta");
                // Loop through all of the <meta> tags we find.

                for ($j = 0; $j < $metas->length; $j++) {
                        $meta = $metas->item($j);
                        // Get the description and the keywords.
                        if (strtolower($meta->getAttribute("name")) == "description"){
                                $description = $meta->getAttribute("content");}
                        if (strtolower($meta->getAttribute("name")) == "keywords"){
                               $keywordsmain = $meta->getAttribute("content");}
                }
/**
                # Find the ID of the input keyword from the keywords table.
                $sql = "SELECT id FROM web_scrape WHERE url='$final[$i]';";

                $result = $conn->query( $sql );
                if ( $result->num_rows > 0 ){
                        while( $row = $result->fetch_assoc( ) ){
                        $id = $row['id'];}
                 echo "<pre>";
                 echo $id;
                 echo "</pre>";
                }else {
                       	$sql = "INSERT INTO web_scrape(url, title, keyword, description ) VALUES ('$final[$i]','$title', '$keywords','$description' );";

                        $conn->query( $sql );
                }
                
**/


   		# Find the ID of the input keyword from the keywords table.
     		$sql = "SELECT kwID FROM keywords WHERE keyword='$keywordsmain';";
     		//echo( $sql . "\n\n" );
     		$result = $conn->query( $sql );
     		if ( $result->num_rows > 0 )
        		while( $row = $result->fetch_assoc( ) )
		        $kwID = $row['kwID'];
		else {
			$sql = "INSERT INTO keywords( keyword ) VALUES ( '$keywordsmain' );";

		        echo( $sql . "\n\n" );
		        $conn->query( $sql );
//		        $sql = "SELECT kwID FROM keywords WHERE keyword='$keywordsmain';";

//		        echo( $sql . "\n\n" );
//		        $result = $conn->query( $sql );

//		        if ( $result->num_rows > 0 )
//		        while( $row = $result->fetch_assoc( ) )
  //         		$kwID = $row['kwID'];
     		}

	     $sql = "SELECT dID FROM description WHERE description='$description';";
	     echo( $sql . "\n\n" );
	     $result = $conn->query( $sql );
	     if ( $result->num_rows > 0 )
		 while( $row = $result->fetch_assoc( ) )
	         $dID = $row['dID'];
     	     else {
		 $sqls = "INSERT INTO description( description ) VALUES ( '$description' );";
        	 echo( $sql . "\n\n" );
	        $conn->query( $sqls );
        	$sql = "SELECT dID FROM description WHERE description='$description';";
	        echo( $sql . "\n\n" );
	       $result = $conn->query( $sql );

	        if ( $result->num_rows > 0 )
	        while( $row = $result->fetch_assoc( ) )
	        $dID = $row['dID'];

     	    }
	     $sql = "SELECT urlID FROM url_title WHERE url='$final[$i]';";
	     echo( $sql . "\n\n" );
	     $result = $conn->query( $sql );
	     if ( $result->num_rows > 0 )
	         while( $row = $result->fetch_assoc( ) )
		 $urlID = $row['urlID'];
	     else {
		$sql = "INSERT INTO url_title( url, title ) VALUES ( '$final[$i]', '$title' );";
	        echo( $sql . "\n\n" );
	        $conn->query( $sql );
	        $sql = "SELECT urlID FROM url_title WHERE url='$final[$i]';";

	        echo( $sql . "\n\n" );
        	$result = $conn->query( $sql );
     		if ( $result->num_rows > 0 )
        	   while( $row = $result->fetch_assoc( ) )
        	   $urlID = $row['urlID'];
 	     }

             # Update the inverted list if the keyword is found.
	     //if ( $found == true ) {
        	$sql = "INSERT INTO www_index VALUES ( '$kwID', '$dID', '$urlID' , ' $x_value');";
	        echo(  $sql . "\n\n" );
	        $conn->query( $sql );
	     //}

if(++$st == 80) break;

//        }else{
//echo "We searched ".$maxiterations." pages and now it is inserted into the database. Enjoy clicking on List Index.";
//break;
}}
}
echo "We searched ".$maxiterations." pages and now it is inserted into the database. Enjoy clicking on List Index.";
break;
$conn->close();

//uptohere


//$conn->close();
// Begin the crawling process by crawling the starting link first.
?>



