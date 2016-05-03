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

$error = "";

$userID = $_SESSION['login_user'];

$newpass = $_POST['newpass'];
$curpass = $_POST['curpass'];
$newemail = $_POST['newemail'];

// Used to prevent mysql injection
$newpass = stripslashes($newpass);
$newpass = mysql_real_escape_string($newpass);

$unencryptedNewPass = $newpass;

$curpass = stripslashes($curpass);	
$curpass = mysql_real_escape_string($curpass);

$newemail = stripslashes($newemail );
$newemail = mysql_real_escape_string($newemail);
	

if ($curpass == "" && $newpass == "") {
    $sql="SELECT * FROM Account WHERE Email = ".$newemail;
    $table = mysql_query($sql, $conn) or die($sql . " : " . mysql_error());
        
    if (mysql_num_rows($table) != 0) {
        $error = "Email is already taken!";
    } 
    else {
        if ($newemail != ""){
            $sql="UPDATE Account SET Email = ".$newemail." WHERE User_ID = ".$userID;
            $table = mysql_query($sql, $conn) or die($sql . " : " . mysql_error());
        }
    }
}
else if ($curpass != "" && $newpass != "" && $newemail == ""){
		
	$curpass = sha1($curpass);
	$newpass = sha1($newpass);
	$sql="SELECT Password FROM Account WHERE User_ID = ".$userID;
	$table = mysql_query($sql, $conn) or die($sql . " : " . mysql_error());
	$rec = mysql_fetch_assoc($table);
	
	if ($rec['Password'] != $curpass) {
		$error = "Current password does not match";
	} 
	else {
        if (strlen($unencryptedNewPass) < 8) {
            $error = "New password must be > 8 characters";
        }
        else {
            $sql="UPDATE Account SET Password = '".$newpass."' WHERE User_ID = ".$userID;
            $table = mysql_query($sql, $conn) or die($sql . " : " . mysql_error());
        }
	}
}
else {
	$curpass = sha1($curpass);
	$newpass = sha1($newpass);
	
	$sql="SELECT Password FROM Account WHERE User_ID = ".$userID;
	$table = mysql_query($sql, $conn) or die($sql . " : " . mysql_error());
	$rec = mysql_fetch_assoc($table);
	
	if ($rec['Password'] != $curpass) {
		$error = "Current password does not match";
	} 
	else {
        $sql="SELECT * FROM Account WHERE Email = ".$newemail;
        $table = mysql_query($sql, $conn) or die($sql . " : " . mysql_error());
        
        if (mysql_num_rows($table) != 0) {
            $error = "Email is already taken!";
        } else if (strlen($unencryptedNewPass) < 8) {
             $error = "New password must be > 8 characters";
        }
        else {
            $sql="UPDATE Account SET Password = '".$newpass."', Email = ".$newemail." WHERE User_ID = ".$userID;
            $table = mysql_query($sql, $conn) or die($sql . " : " . mysql_error());
        }
	}
}
mysql_close($conn);

echo $error;
?>