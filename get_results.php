<?php
if(isset($_POST['search']))
{
 $mysql_host = 'undcsmysql.mysql.database.azure.com';
 $mysql_username = 'b.shrestha@undcsmysql';
 $mysql_password = 'bshrestha9152';
 $mysql_database = 'b_shrestha';
 $conn = mysqli_connect( $mysql_host, $mysql_username, $mysql_password, $mysql_database );
 $search_val=$_POST['search_term'];
//echo "select * from web_scrape where MATCH(title,url, description) AGAINST('$search_val')";	
$query = "SELECT MATCH(title, url, description, keyword) AGAINST('$search_val') AS Relevance_score, title, url, description, keyword FROM maintable ORDER BY Relevance_score DESC LIMIT 20;";
$querykeyword = "select occurence from windex w, keywordssingle k where k.keywords = '$search_val' and k.kid = w.kid order by occurence desc limit 1";
//$query = "SELECT MATCH(u.title, u.url, u.description, u.keyword, k.keyword) AGAINST('$search_val') OR Match( k.keyword)  AGAINST('$search_val') AS Relevance_score, u.title, u.url, u.description, u.keyword FROM  maintable u, keywordssingle k, windex w where k.kwID=w.kwID AND w.urlID=u.urlID and w.kID = k.KID  ORDER BY Relevance_score DESC LIMIT 20;";
$get_result = $conn->query($query);
// $get_result =  $conn->query("select * from web_scrape where MATCH(title, url, description) AGAINST('$search_val')");
//$querykeyword =	"select occurence from windex w, keywordssingle k where k.keywords = '$search_val' and k.kid = w.kid";
$get_results = $conn->query($querykeyword);
 while($row=$get_results->fetch_assoc( ))
 {
  echo "max appeared for ". $row['occurence'] . " times"; 
}
 while($row=$get_result->fetch_assoc( ))
 {
  echo "<li><a target=\"_blank\" href='".$row['url']."'><span class='title'>".$row['title']."</span><br><span class='desc'>".$row['url']."</span><br><span class='desc'>".$row['Relevance_score']."</span></a> </li>";
 }
 exit();
}
?>
