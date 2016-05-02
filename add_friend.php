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

$error = "";

$conn = mysql_connect($sqlHost, $sqlUser, $sqlPass) or die("Can't connect to host : " . mysql_error());
$db = mysql_select_db($sqlDatabase, $conn) or die("Can't database to database: " . mysql_error());

$userID = $_SESSION['login_user'];
$key = $_POST['key'];
$key = stripslashes($key);
$key = mysql_real_escape_string($key);

if (!ctype_digit($key)) {
    $error = "Invalid ID";
}
 else {

	$sql="SELECT User_ID FROM User_String_Pairs WHERE Random_String = ".$key;
	$table = mysql_query($sql, $conn) or die($sql . " : " . mysql_error());
	
	$rec = mysql_fetch_assoc($table);
	
	$friendID = $rec['User_ID'];
	
	if ($friendID == $userID) {
	    $error = "You can't add yourself!";
	}
	else {
		if ($friendID != "") {
			$sql="SELECT Friend_ID, User_ID FROM Friends WHERE Friend_ID = ".$friendID." AND User_ID = ".$userID." OR Friend_ID = ".$userID." AND User_ID = ".$friendID;
			$table = mysql_query($sql, $conn) or die($sql . " : " . mysql_error());
			$rec = mysql_fetch_assoc($table);
		
			if ($rec != "") {
				$error = "Friend already exists!";
			}
			else {
					$sql="INSERT INTO Friends Values(".$friendID.",".$userID."), (".$userID.",".$friendID.");";
					$execute = mysql_query($sql, $conn) or die($sql . " : " . mysql_error());
			}
		}
		else {
			$error = "Invalid ID";
		}
	}
}

echo $error;
?>