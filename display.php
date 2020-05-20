<?php
     header( "Content-type: text/plain" );

 if ( $argv[1] == "binisha" ) {
  // if ( $_POST['password'] == "binisha" ) {
     header( "Content-type: text/plain" );
     if ( $argv[2] == 1 ) {
       $file = fopen( "list.php", "r" ) or exit( "Unable to open file!" );
       while ( !feof( $file ) )  echo  fgets( $file );
       fclose( $file );
     }
     elseif (  $argv[2] == 2 ) {
       $file = fopen( "welcome.php", "r" ) or exit( "Unable to open file!" );
       while ( !feof( $file ) )  echo  fgets( $file );
       fclose( $file );
       echo  ( "\n\n\n============================ new.php ============================= \n\n\n" );
       $file = fopen( "new.php", "r" ) or exit( "Unable to open file!" );
       while ( !feof( $file ) )  echo  fgets( $file );
       fclose( $file );
     }
     elseif ($argv[2] == 3) {
       $file = fopen( "main.java", "r" ) or exit( "Unable to open file!" );
       while ( !feof( $file ) )  echo  fgets( $file );
       fclose( $file );
     }
     else
       echo  "No such interface: " . $_POST['interface'];

     echo  ( "\n\n\n============================== Check.php ============================== \n\n\n" );
     $file = fopen( "Check.php", "r" ) or exit( "Unable to open file!" );
     while ( !feof( $file ) )  echo  fgets( $file );
     fclose( $file );
   }
   else {
     header( "Content-type: text/html" );
     echo  "<html><body><h3>Wrong password: <em>";
     echo  $_POST['password'];
     echo  "</em></h3></body></html>";
   
 }
/** elseif ( $_POST['act'] == "Help" ) {
   header( "Content-type: text/html" );
   $file = fopen( "Help.html", "r" ) or
     exit( "Unable to open file!" );
   while ( !feof( $file ) )
     echo  fgets( $file );
   fclose( $file );
 }**/
?>
