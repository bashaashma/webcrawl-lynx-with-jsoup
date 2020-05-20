<html>
<body>
  <link rel="stylesheet" type="text/css" href="http://undcemcs02.und.edu/~b.shrestha/515/1/style.css" />

<?php
if($_POST['password']=="binisha"){
$mysql_host = 'undcsmysql.mysql.database.azure.com';
$mysql_username = 'b.shrestha@undcsmysql';
$mysql_password = 'bshrestha9152';
$mysql_database = 'b_shrestha';
$mysql_conn = mysqli_connect( $mysql_host, $mysql_username, $mysql_password, $mysql_database );
if ( !$mysql_conn ) {
       echo "Error: Unable to connect to MySQL." . PHP_EOL;
       echo "Debugging errno: " . mysqli_connect_errno() . PHP_EOL;
       echo "Debugging error: " . mysqli_connect_error() . PHP_EOL;
       exit;
}else {?>
 <div class="form-main">
<legend> Welcome <?php echo $_POST["username"]; ?></legend>
<br /><br />

<legend>Web Crawler Programming Execrcise I</legend>
<form method="post" action="redirection.php"  target="view">
<center>
Type your search selection or URL to collect pages:  <input type="text" name="url" size="55" value="https://www.w3schools.com/xml/">
<br />

Maximum pages to index (≤ 500): <input type="text" name="limit" size="25" value="20">
<br />
  Select any of the radio button:
  <input type="radio" name="typec" <?php if (isset($gender) && $gender=="url") echo "checked";?> value="URL">URL

  <input type="radio" name="typec" <?php if (isset($gender) && $gender=="title") echo "checked";?> value="Title">Title
  <input type="radio" name="typec" <?php if (isset($gender) && $gender=="keywords") echo "checked";?> value="Keywords">Keywords
  <input type="radio" name="typec" <?php if (isset($gender) && $gender=="description") echo "checked";?> value="Description">Description
  <span class="error">* <?php echo $genderErr;?></span>
  <br><br>

<input type="submit" name ="act" value="List Index" />
<input type="submit" name = "act" value="Web page collection" />
<input type="submit" name = "act" value="Search Web Page" />

<br /><br />
<input type="password" placeholder="password" name= "password" />

<input type="text" name="interface" placeholder="Number *"> &nbsp;
    <input type="submit" name="act" value="Display source"> &nbsp;
    <input type="submit" name= "act"  value="Reset"><br />

<div id="myDIV"name ="view">
<iframe frameborder="0" width="95%" height="500"  name="view">
    </iframe>
</div>
  </form>
</div>
</div>

 <?php } } ?>
</body>
</html>



