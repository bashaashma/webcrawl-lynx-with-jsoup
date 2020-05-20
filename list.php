<?php
// $typec $limit $URL
print_r($argv);

 $typec = $argv[1];
echo count($argv);
if($typec=="URL"){
echo "You choosed URL search";
 $sql  = "SELECT k.keyword, u.url, u.title, u.description FROM keywordssingle k, maintable u, windex w,  WHERE (";
if ( count($argv) == 2 ) {  $sql.= "u.url='";}
       else {
	for ($i = 2; $i <count($argv); $i++ ){
           if ( $i == 2 ){ $sql .= "u.url LIKE '%" . $argv[$i] . "%";}
            else {	$sql .= "' or u.url LIKE '%" . $argv[$i] . "%"; }
}}
         $sql .= "') AND w.urlID=u.urlID and w.kID = k.kID";

}
elseif($typec=="Title"){
echo "You choosed Title";
 $sql  = "SELECT k.keywords, u.url, u.title, u.description FROM keywordssingle k, maintable u, windex w  (";
if ( count($argv) == 2 ) {  $sql.= "u.title='";}
       else {
	for ($i = 2; $i <count($argv); $i++ ){
           if ( $i == 2 ){ $sql .= "u.title LIKE '%" . $argv[$i] . "%";}
            else {	$sql .= "' or u.title LIKE '%" . $argv[$i] . "%"; }
}}
         $sql .= "') w.urlID=u.urlID and w.kID = k.KID";

}elseif ($typec=="Description"){
echo "You choosed Description";
// $sql  = "SELECT k.keyword, u.url, u.title, d.description FROM keywords k, maintable u, windex w, description d WHERE ";
// $sql .= "d.description LIKE '%" . $description . "%' AND k.kID=w.kID AND w.urlID=u.urlID and w.dID = d.dID";
 $sql  = " SELECT k.keywords, u.url, u.title, u.description FROM keywordssingle k, maintable u, windex w  WHERE (";

if ( count($argv) ==2 ) {  $sql.= "u.description ='";}
       else {
	for ($i = 2; $i <count($argv); $i++ ){
           if ( $i == 2 ){ $sql .= "u.description LIKE '%" . $argv[$i] . "%";}
            else {	$sql .= "' or u.description LIKE '%" . $argv[$i] . "%"; }
}}
         $sql .= "') AND w.urlID=u.urlID and w.kID = k.KID";



}elseif($typec=="Keywords"){
echo "You choosed Keyword";
 $sql  = "SELECT k.keywords, u.url, u.title, u.description FROM keywordssingle k, maintable u, windex w  WHERE (";

if ( count($argv) ==2 ) {  $sql.= "k.keywords ='";}
       else {
	for ($i = 2; $i <count($argv); $i++ ){
           if ( $i == 2 ){ $sql .= "k.keywords LIKE '%" . $argv[$i] . "%";}
            else {	$sql .= "' or k.keywords LIKE '%" . $argv[$i] . "%"; }
}}
         $sql .= "') AND w.urlID=u.urlID and w.kID = k.KID";


}else{
echo "You choosed nothing";
 $sql  = "SELECT k.keywords, u.url, u.title, u.description FROM keywordssingle k, maintable u, windex w  where w.urlID=u.urlID and w.kID = k.KID ";

}

 $URL     = $argv[2];
 $description = "Description";

// $password = $_SERVER['DBPASS'];

 # For security, remove some Unix metacharacters.
 $meta    = array( ";", ">", ">>", "<", "*", "?", "&", "|" );
 $keyword = str_replace( $meta, "", $keyword );
 $URL     = str_replace( $meta, "", $URL );

 $mysql_host = 'undcsmysql.mysql.database.azure.com';
 $mysql_username = 'b.shrestha@undcsmysql';
 $mysql_password = 'bshrestha9152';
 $mysql_database = 'b_shrestha';
 $conn = mysqli_connect( $mysql_host, $mysql_username, $mysql_password, $mysql_database );
   $no   = 1;
// $sql  = "SELECT k.keyword, u.url, u.title, d.description FROM keywords k, maintable u, windex w, description d WHERE ";
 //$sql .= "k.keyword LIKE '%" . $keyword . "%' AND k.kID=w.kID AND w.urlID=u.urlID and w.dID = d.dID";
//$sql="SELECT k.keyword, u.url, u.title, d.description FROM keywords k, maintable u, windex w, description d WHERE (u.title LIKE '%function%') AND k.kID=w.kID AND w.urlID=u.urlI$
 echo( $sql );
 echo( "<table width='100%' border='1' bgcolor='white'>" );
 echo( "<tr><th width='5%'>No.</th>" );
 echo( "<th width='25%'>Title</th>" );
 echo( "<th width='20%'>URL</th>" );
 echo( "<th width='25%'>Keyword</th>" );
 echo( "<th width='25%'>Description</th></tr>" );


 $result = $conn->query( $sql );
 if ( $result->num_rows > 0 )
   while( $row = $result->fetch_assoc( ) ) {
     echo( "<tr><td>". $no++ . "</td><td>" . $row[title] );
     echo( "</td><td><a target='_blank' href='" . $row[url] . "'>" . $row[url] );
     echo( "</a></td><td>" . $row[keywords] . "</td><td>" . $row[description] . "</td>></tr>" );
   }
 echo( "</table>" );

 $conn->close( );
?>



