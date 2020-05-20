<?php

 # Remove leading and trailing spacing.
 $URL     = trim( $_POST["url"] );
 $limit = trim( $_POST["limit"] );
 $typec = $_POST["typec"] ;
$password = $_POST["password"];
$page = $_POST["interface"];
 # For security, remove some Unix metacharacters.
 $meta    = array( ";", ">", ">>", "<", "*", "?", "&", "|" );
 $keyword = str_replace( $meta, "", $keyword );
 $URL     = str_replace( $meta, "", $URL );


 # MySQL password hid in $_SERVER['DBPASS']

 if ( $_POST['act'] == "Display source" ) {
   header( "Content-type: text/plain" );
   system( "/usr/bin/php  display.php  $password $page" );
 }

 elseif ( $_POST['act'] == "List Index" ) {
   header( "Content-type: text/html" );
   system( "/usr/bin/php  list.php   $typec $URL" );
 }

 elseif ( $_POST["act"] == "Web page collection" ) {
   header( "Content-type: text/html" );
//   system( "/usr/bin/php  new.php  $limit $URL" );
   system("/usr/bin/java -cp .:'/home/b.shrestha/public_html/515/2/jarfile/*' mains $limit $URL"); 
 }
 elseif ( $_POST["act"] == "Search Web Page" ) {
   header( "Content-type: text/html" );
   system( "/usr/bin/php  search.html  $URL" );
 }

 elseif ( $_POST["act"] == "Reset" ) {

   header( "Content-type: text/html" );
 $mysql_host = 'undcsmysql.mysql.database.azure.com';
 $mysql_username = 'b.shrestha@undcsmysql';
 $mysql_password = 'bshrestha9152';
 $mysql_database = 'b_shrestha';
 $conn = mysqli_connect( $mysql_host, $mysql_username, $mysql_password, $mysql_database );
   $no   = 1;

if ( $conn->connect_error )
  die( 'Could not connect: ' . $conn->connect_error );

$sql = "DELETE FROM windex;";
echo( $sql . "\n" );
if ( $conn->query( $sql ) == TRUE )
  echo "Table windex deleted successfully\n\n";
else
  echo "Error deleting table: " . $conn->error;

$sql = "DELETE FROM keywordssingle;";
echo( $sql . "\n" );
if ( $conn->query( $sql ) == TRUE )
  echo "Table keywords deleted successfully\n\n";
else
  echo "Error deleting table: " . $conn->error;
$sql = "DELETE FROM maintable;";
echo( $sql . "\n" );
if ( $conn->query( $sql ) == TRUE )
  echo "Table maintable deleted successfully";
else
  echo "Error deleting table: " . $conn->error;



$sql = "ALTER table windex auto_increment =1;";
if ( $conn->query( $sql ) == TRUE )
  echo "Altered successfully";
else
  echo "Error altering  table: " . $conn->error;

$conn->close( );


echo "CLEARED!!!";
/**   $file = fopen( "Help.html", "r" ) or
     exit( "Unable to open file!" );
   while ( !feof( $file ) )
     echo  fgets( $file );
   fclose( $file );**/
 }

 else {
   header( "Content-type: text/html" );
   echo( "<html><body>" );
   echo( "<h3>No such option: " . $_POST["act"] . "</h3>" );
   echo( "</body></html>" );
 }

?>

