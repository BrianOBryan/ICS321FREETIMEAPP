<?php 
//enable this when finished
//error_reporting(0);

session_start();
if (file_exists('config.php')) {
    include('config.php');
}
else {
    include('../../config.php');
}

$conn = mysql_connect($sqlHost, $sqlUser, $sqlPass) or die("Can't connect to host : " . mysql_error());
$db = mysql_select_db($sqlDatabase, $conn) or die("Can't database to database: " . mysql_error());

$userID = $_SESSION['login_user'];
    
$sql = "SELECT Username FROM Account WHERE User_ID = ".$userID;
$table = mysql_query($sql, $conn) or die($sql . " : " . mysql_error());

$rec = mysql_fetch_assoc($table);

echo $rec['Username'];

?>