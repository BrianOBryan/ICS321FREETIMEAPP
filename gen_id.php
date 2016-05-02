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

$six_digit_random_number = mt_rand(100000, 999999);

$sql="SELECT Random_String FROM User_String_Pairs WHERE User_ID = ".$userID;
$table = mysql_query($sql, $conn) or die($sql . " : " . mysql_error());
$rec = mysql_fetch_assoc($table);

if ($rec == ""){
$sql="INSERT INTO User_String_Pairs Values(".$userID.",".$six_digit_random_number.");";
$execute = mysql_query($sql, $conn) or die($sql . " : " . mysql_error());
}
else {
$sql = "UPDATE User_String_Pairs SET Random_String = ".$six_digit_random_number." WHERE User_ID = ".$userID;
$execute = mysql_query($sql, $conn) or die($sql . " : " . mysql_error());
}

$sql="SELECT Random_String FROM User_String_Pairs WHERE User_ID = ".$userID;
$table = mysql_query($sql, $conn) or die($sql . " : " . mysql_error());

$rec = mysql_fetch_assoc($table);

echo $six_digit_random_number;

?>